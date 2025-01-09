<?php

$con = mysqli_connect('localhost', 'root', '', 'dbmovies');

// Check connection
if (!$con) {
    die("Database connection failed: " . mysqli_connect_error());
}

?>
