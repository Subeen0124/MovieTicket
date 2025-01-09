<?php
// Connect to database
$con = mysqli_connect("localhost", "root", "", "dbmovies");

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Include necessary files
include '../components/adminfixed.php';

// Function to handle SQL injection
function clean_input($data)
{
    global $con;
    return mysqli_real_escape_string($con, $data);
}

// Handle update request
if (isset($_POST['update'])) {
    $id = clean_input($_POST['id']);
    $title = clean_input($_POST['title']);
    $des = clean_input($_POST['description']);
    $link = clean_input($_POST['poster_url']);
    $nshow = clean_input($_POST['now_showing']);
    $rdate = clean_input($_POST['release_date']);

    // Prepare and execute statement
    $stmt = $con->prepare("UPDATE `movies1` SET `title`=?, `release_date`=?, `now_showing`, `description`=?, `poster_url`=? WHERE `id`=?");
    $stmt->bind_param("ssssi", $title, $rdate, $nshow, $des, $link, $id);

    if ($stmt->execute()) {
        header("Location: managemovies.php?status=updated");
        exit;
    } else {
        echo "Error: " . $con->error;
    }
}

// Handle GET request for editing
if (isset($_GET['id'])) {
    $id = clean_input($_GET['id']);

    // Fetch record to be updated
    $sql = "SELECT * FROM `movies1` WHERE `id`='$id'";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $title = $row['title'];
            $des = $row['description'];
            $link = $row['poster_url'];
            $rdate = $row['release_date'];
            $nshow = $row['now_showing'];
        }
    } else {
        echo "<h2>No Results Found!</h2>";
    }
}

// Close connection
mysqli_close($con);
?>

<section class="update">
    <button class="back-button" onclick="history.back()">&lt; Go Back </button>
    <h1>Please Update the Details</h1>
    <form action="" method="post" onsubmit="return validateForm()">
        <label for="id">ID : </label><input type="number" name="id" id="id" value="<?php echo $id; ?>" readonly>
        <span class="error" id="idErr"></span><br>
        <label for="title">Title : </label><input type="text" name="title" id="title" value="<?php echo $title; ?>">
        <span class="error" id="titleErr"></span> <br>
        <label for="release_date">Release Date : </label><input type="text" name="release_date" id="release_date"
            value="<?php echo $rdate; ?>">
        <span class="error" id="release_dateErr"></span> <br>
        <label for="description">Description : </label><input type="text" name="description" id="description"
            value="<?php echo $des; ?>">
        <span class="error" id="descriptionErr"></span> <br>
        <label for="link">Poster_url : </label><input type="text" name="link" id="link" value="<?php echo $link; ?>">
        <span class="error" id="linkErr"></span><br>
        <label for="now_showing">Now Showing : </label><input type="checkbox" name="now_showing" id="now_showing"
            value="<?php echo $nshow; ?>">
        <span class="error" id="now_showingErr"></span><br>
        <input type="submit" name="update" value="Update">
    </form>
</section>
<script>
    function validateForm() {
        let title = document.getElementById("title").value;
        let category = document.getElementById("release_date").value;
        let description = document.getElementById("description").value;
        let link = document.getElementById("link").value;
        let now_showing = document.getElementById("now_showing").value;

        document.getElementById("titleErr").innerHTML = "";
        document.getElementById("release_dateErr").innerHTML = "";
        document.getElementById("descriptionErr").innerHTML = "";
        document.getElementById("linkErr").innerHTML = "";
        document.getElementById("now_showingErr").innerHTML = "";

        let errors = [];

        if (title === "") {
            errors.push({
                id: "titleErr",
                msg: "Title is required"
            });
        } else {
            let titleFormat = /^[a-zA-Z\s]+$/;
            if (!title.match(titleFormat)) {
                errors.push({
                    id: "titleErr",
                    msg: "Title must contain only letters and spaces"
                });
            }
        }

        if (category === "") {
            errors.push({
                id: "release_dateErr",
                msg: "Category is required"
            });
        } else {
            let release_dateFormat = /^[0-9]{4}-[0-9]{2}-[0-9]{2}$/;
            if (!category.match(release_dateFormat)) {
                errors.push({
                    id: "release_dateErr",
                    msg: "release_date must be in the format YYYY-MM-DD"
                });
            }
        }

        if (description === "") {
            errors.push({
                id: "descriptionErr",
                msg: "Description is required"
            });
        } else {
            let descriptionFormat = /^[a-zA-Z\s]+$/;
            if (!description.match(descriptionFormat)) {
                errors.push({
                    id: "descriptionErr",
                    msg: "Description must contain only letters and spaces"
                });
            } else if (description.length < 10) {
                errors.push({
                    id: "descriptionErr",
                    msg: "Description must be at least 10 characters long"
                });
            }
        }

        if (link == "") {
            errors.push({
                id: "linkErr",
                msg: "Link is required"
            });
        } else {
            let linkFormat = /[-a-zA-Z0-9@:%._\+~#=]{1,256}\.[a-zA-Z0-9()]{1,6}\b([-a-zA-Z0-9()@:%_\+.~#?&//=]*)/gi;
            if (!(link.match(linkFormat))) {
                errors.push({
                    id: "linkErr",
                    msg: "Enter a valid link"
                });
            }
        }

        if (errors.length > 0) {
            errors.forEach(function (err) {
                document.getElementById(err.id).innerHTML = err.msg;
            });
            return false;
        }

        if (now_showing === "") {
            errors.push({
                id: "now_showingErr",
                msg: "Now Showing is required"
            });
        } else {
            let now_showingFormat = /^[0-1]$/;
            if (!now_showing.match(now_showingFormat)) {
                errors.push({
                    id: "now_showingErr",
                    msg: "Now Showing must be 0 or 1"
                });
            }
        }

        return true;
    }
</script>
</body>

</html>