<?php 
// Include the connection file
include 'connect.php';

// Start the session
session_start();

// Unset all session variables
session_unset();

// Destroy the session
session_destroy();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Logout</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link href="./css/output.css" rel="stylesheet">
</head>

<body>
    <div class="container" id="logout">
        <h1 class="form-title">Logged Out</h1>
        <p>You have been successfully logged out.</p>
        <a href="login.php" class="btn">Go to Login</a>
    </div>
</body>

</html>

<?php

if(isset($_POST['logout'])){
    header('location: login.php');
}
