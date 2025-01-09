<?php
// Establish database connection
$con = mysqli_connect("localhost", "root", "", "dbmovies");

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if user ID, table name, and page are set in the GET parameters
if (isset($_GET['id'], $_GET['tbl'], $_GET['redirect'])) {
    // Sanitize input
    $id = mysqli_real_escape_string($con, $_GET['id']);
    $tbl = mysqli_real_escape_string($con, $_GET['tbl']);
    $page = $_GET['redirect']; // No need to sanitize, it's used as a redirect

    // Prepare delete statement
    $sql = "DELETE FROM `$tbl` WHERE `id`=?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    // Check if the deletion was successful
    if ($stmt->affected_rows > 0) {
        // Redirect to the specified page
        header("Location: ../$page");
        exit(); // Terminate script execution after redirect
    } else {
        // Error occurred during deletion
        echo "Error: " . $stmt->error;
    }

    // Close prepared statement
    $stmt->close();
}

// Close the database connection
mysqli_close($con);