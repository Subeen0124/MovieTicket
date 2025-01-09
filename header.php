<?php
// Start the session to check login status
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Ticket Booking</title>
    <!-- Link to CSS -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="icon" href="images/favicon.png" type="image/png">
    <link rel="stylesheet" href="css/header.css">
</head>

<body>
    <header>
        <div class="logo">
            <a href="index.php">MovieZone</a>
        </div>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="movies.php">Movies</a></li>
            </ul>
        </nav>
        <div class="user-options">
            <?php if (isset($_SESSION['email'])): ?>
                <a href="profile.php"><?php echo htmlspecialchars($_SESSION['email']); ?></a>
                <a href="logout.php" class="btn">Logout</a>
            <?php else: ?>
                <a href="login.php" class="btn">Login</a>
                <a href="signup.php" class="btn">Sign Up</a>
            <?php endif; ?>
        </div>
    </header>
</body>

</html>