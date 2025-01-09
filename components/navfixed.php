<?php
session_start();

// Check if the user is not logged in, redirect to the login page
if (!isset($_SESSION["username"]) || $_SESSION["role"] != 1) {
    header("Location: index.php");
    exit();
}
$username = $_SESSION["username"];

function activePage($page)
{
    $currentPage = basename($_SERVER['PHP_SELF']);
    if ($currentPage == $page) {
        echo 'class="active"';
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="images/favion.png" type="image/x-icon">
    <title>Movie Ticket Booking</title>
    <script>
        function toggleNav() {
            let nav = document.getElementById("nav");
            if (nav.style.display === "block") {
                nav.style.display = "none";
            } else {
                nav.style.display = "block";
            }
        }
    </script>
</head>

<body>
    <header>
        <div class="header-buttons">
            <div class="hamburger" onclick="toggleNav()">&#9776;</div>
            <div class="logout">
                <a href="logout.php">Logout</a>
            </div>
        </div>
        <h1>Movie Ticket Booking</h1>
    </header>

    <nav id="nav">
        <a href="movies.php" <?php activePage('movies.php'); ?>>Movies</a>
        <a href="booking.php" <?php activePage('Booking.php'); ?>>Booking</a>
        <a href="seats.php" <?php activePage('seats.php'); ?>>Seats</a>
    </nav>