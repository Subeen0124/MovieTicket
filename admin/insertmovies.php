<?php
$con = mysqli_connect("localhost", "root", "", "dbmovies");

if (!$con)
    die("Connection Failed" . mysqli_connect_error());

$idErr = $message = "";

include '../components/adminfixed.php';

if (isset($_POST['insert'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $des = $_POST['description'];
    $link = $_POST['link'];
    $cat = $_POST['category'];

    //Check if the id is already exists in database
    $checkId = "SELECT * FROM resources WHERE id = ?";
    $checkIdStmt = $con->prepare($checkId);
    $checkIdStmt->bind_param("s", $id);
    $checkIdStmt->execute();
    $checkIdResult = $checkIdStmt->get_result();
    if ($checkIdResult->num_rows > 0) {
        $idErr = "ID already exist";
    }
    $checkIdStmt->close();

    if (empty($idErr)) {
        $sql = "INSERT INTO `resources` VALUES ('$id','$title','$cat','$des','$link')";
        $result = $con->query($sql);
        if ($result == TRUE) {
            header("Location: manageresources.php?status=inserted");
            exit;
        } else {
            echo "<script>alert('Something went wrong!')</script>";
        }
    }
}
?>
<section class="update">
    <button class="back-button" onclick="history.back()">&lt; Go Back </button>
    <h1>Please Enter the Details</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" onsubmit="return validateForm()" name="insertForm">
        <label for="id">ID : </label><input type="number" name="id" id="id">
        <span class="error" id="idErr"><?php echo $idErr; ?></span><br>
        <label for="title">Title : </label><input type="text" name="title" id="title">
        <span class="error" id="titleErr"></span> <br>
        <label for="category">Category : </label><input type="text" name="category" id="category">
        <span class="error" id="categoryErr"></span> <br>
        <label for="description">Description : </label><input type="text" name="description" id="description">
        <span class="error" id="descriptionErr"></span> <br>
        <label for="link">Link : </label><input type="text" name="link" id="link">
        <span class="error" id="linkErr"></span><br>
        <input type="submit" name="insert" value="Add">
    </form>
</section>
<script>
    function validateForm() {
        let id = document.getElementById("id").value;
        let title = document.getElementById("title").value;
        let category = document.getElementById("category").value;
        let description = document.getElementById("description").value;
        let link = document.getElementById("link").value;

        document.getElementById("idErr").innerHTML = "";
        document.getElementById("titleErr").innerHTML = "";
        document.getElementById("categoryErr").innerHTML = "";
        document.getElementById("descriptionErr").innerHTML = "";
        document.getElementById("linkErr").innerHTML = "";

        let errors = [];

        if (id == "") {
            errors.push({
                id: "idErr",
                msg: "ID is required"
            });
        } else {
            if (id < 0) {
                errors.push({
                    id: "idErr",
                    msg: "ID cannot be negative"
                });
            }
        }

        if (title == "") {
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

        if (category == "") {
            errors.push({
                id: "categoryErr",
                msg: "Category is required"
            });
        } else {
            let categoryFormat = /^[a-zA-Z]+[a-zA-Z\s]*?[^0-9]$/;
            if (!category.match(categoryFormat)) {
                errors.push({
                    id: "categoryErr",
                    msg: "Category must contain only letters and spaces"
                });
            }
        }

        if (description == "") {
            errors.push({
                id: "descriptionErr",
                msg: "Description is required"
            });
        } else {
            let descriptionFormat = /^[a-zA-Z\s]+$/;
            if (!(description.match(descriptionFormat))) {
                errors.push({
                    id: "descriptionErr",
                    msg: "Enter a valid description"
                });
            } else {
                if (description.length < 10) {
                    errors.push({
                        id: "descriptionErr",
                        msg: "Description must be atleast 10 characters long"
                    });
                }
            }
        }

        if (link == "") {
            errors.push({
                id: "linkErr",
                msg: "Link is required"
            });
        } else {
            let linkFormat = /^(?:((A-Za-z)+):)?(\/(0,3))((0-9.\-A-Za-z)+) (?::(\d+))?(?:\/((^?#)))?(?:\?((^#)))?(?:#(.*))?$/;
            if (!(link.match(linkFormat))) {
                errors.push({
                    id: "linkErr",
                    msg: "Enter a valid link"
                });
            }
        }

        if (errors.length > 0) {
            errors.forEach(function(err) {
                document.getElementById(err.id).innerHTML = err.msg;
            });
            return false;
        }

        return true;
    }
</script>
</body>

</html>