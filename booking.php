<?php
session_start();
include 'connect.php'; // Include database connection

if (!$con) {
    die('Database connection failed. Please try again later.');
}

// Check if a movie ID is provided
if (!isset($_GET['movie_id']) || empty($_GET['movie_id'])) {
    echo "<script>alert('No movie selected. Redirecting to home page.'); window.location.href='index.php';</script>";
    exit;
}

$movie_id = intval($_GET['movie_id']); // Get movie ID from URL and validate it

// Fetch movie details
$query = "SELECT * FROM movies1 WHERE id = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("i", $movie_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $movie = $result->fetch_assoc();
} else {
    echo "<script>alert('Invalid movie selected. Redirecting to home page.'); window.location.href='index.php';</script>";
    exit;
}

// Handle booking form submission
if (isset($_POST['book'])) {
    $user_email = $_SESSION['email'] ?? null; // Ensure user is logged in
    if (!$user_email) {
        echo "<script>alert('Please log in to book tickets.'); window.location.href='login.php';</script>";
        exit;
    }

    $num_tickets = intval($_POST['num_tickets']);
    $total_price = $num_tickets * $movie['ticket_price'];

    // Insert booking into the database
    $booking_query = "INSERT INTO bookings (user_email, movie_id, num_tickets, total_price) VALUES (?, ?, ?, ?)";
    $stmt = $con->prepare($booking_query);
    $stmt->bind_param("siid", $user_email, $movie_id, $num_tickets, $total_price);

    if ($stmt->execute()) {
        echo "<script>alert('Booking successful!'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Booking failed. Please try again.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Tickets - <?php echo htmlspecialchars($movie['title']); ?></title>
    <link href="./output.css" rel="stylesheet">
</head>

<body class="bg-gray-100 font-sans leading-normal tracking-normal">
    <header class="bg-blue-500 text-white py-4">
        <div class="container mx-auto flex justify-between items-center">
            <div class="logo text-2xl font-bold">MovieZone</div>
            <nav>
                <ul class="hidden md:flex space-x-6">
                    <li><a href="index.php" class="hover:text-gray-300">Home</a></li>
                    <li><a href="movies.php" class="hover:text-gray-300">Movies</a></li>
                </ul>
            </nav>
            <div class="user-options flex items-center space-x-4">
                <?php if (isset($_SESSION['email'])): ?>
                    <span>Welcome, <?php echo htmlspecialchars($_SESSION['email']); ?></span>
                    <a href="logout.php" class="hover:text-gray-300">Logout</a>
                <?php else: ?>
                    <a href="login.php" class="hover:text-gray-300">Login</a>
                <?php endif; ?>
            </div>
        </div>
    </header>

    <main class="container mx-auto mt-10">
        <section class="booking-container ">
            <h1>Book Tickets for <?php echo htmlspecialchars($movie['title']); ?></h1>
            <p><strong>Description:</strong> <?php echo htmlspecialchars($movie['description']); ?></p>
            <p><strong>Ticket Price:</strong> $<?php echo htmlspecialchars($movie['ticket_price']); ?></p>
            <form method="POST" action="">
                <div class="form-group">
                    <label for="num_tickets">Number of Tickets:</label>
                    <input type="number" id="num_tickets" name="num_tickets" min="1" max="10" required>
                </div>
                <button type="submit" name="book" class="btn">Book Now</button>
            </form>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 MovieZone. All rights reserved.</p>
    </footer>
</body>

</html>