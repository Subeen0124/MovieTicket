<?php
// Function to get the number of rows in a table
function getRowCount($con, $table)
{
    $sql = "SELECT COUNT(*) AS count FROM $table";
    $stmt = $con->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $count = $row['count'];
    $stmt->close();
    return $count;
}

// Establish database connection
$con = new mysqli("localhost", "root", "", "dbmovies");

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Include the navigation component
include '../components/adminfixed.php';

?>

<section class="dashboard">
    <h1>Welcome Back, Admin</h1>
    <div class="container">
        <a href="manageusers.php" class="dash-box">
            <h3>Number of Registered Users : <?php echo getRowCount($con, "users"); ?></h3>
            <img src="../C:\Users\Dell\Downloads" alt="users">
        </a>
        <a href="managemovies.php" class="dash-box">
            <h3>Number of Movies : <?php echo getRowCount($con, "moviess"); ?></h3>
            <img src="../images/.png" alt="movies">
        </a>
        <a href="manageseats.php" class="dash-box">
            <h3>Number of Seats : <?php echo getRowCount($con, "seats"); ?></h3>
            <img src="../images/.png" alt="seats">
        </a>
    </div>
</section>
</body>

</html>

<?php
// Close the database connection
$con->close();
?>