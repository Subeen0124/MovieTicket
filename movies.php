<?php
include 'connect.php'; // Include the database connection file
if (!$con) {
    die('Database connection failed. Please try again later.');
}
include 'header.php'; // Include the header file
?>

<main class="min-h-screen bg-black text-white">
    <section class="movies py-12">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mt-8">
            </div>
            <h2 class="text-3xl font-bold text-gray-800 text-center mb-8">Now Showing</h2>
            <div class="movie-grid grid grid-cols-1 md:grid-cols-3 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                <?php
                // Fetch movies from the database (assuming 'now_showing' field is used to filter movies)
                $query = "SELECT * FROM movies1 WHERE now_showing = 1";  // Get movies that are currently showing
                $result = mysqli_query($con, $query);

                // Loop through the movies and display them which are released within the last 30 days using the 'release_date' field
                while ($row = mysqli_fetch_assoc($result)) {
                    if ($row['now_showing'] == 1) {
                        echo '<div class="movie-card">';
                        echo '<img src="' . $row['poster_url'] . '" alt="' . $row['title'] . '">';
                        echo '<div class="movie-info">';
                        echo '<h3>' . $row['title'] . '</h3>';
                        echo '<p>' . $row['description'] . '</p>';
                        echo '<a href="booking.php?id=' . $row['movieid'] . '" class="btn">Book Tickets</a>';
                        echo '</div>';
                        echo '</div>';
                    }
                }
                ?>
            </div>
    </section>
</main>

<!-- Footer -->
<footer class="bg-gray-800 text-gray-400 mt-8">
    <div class="container mx-auto px-4 py-8">
        <!-- Footer Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- About Section -->
            <div>
                <h2 class="text-xl font-bold text-white mb-4">About MovieZone</h2>
                <p class="text-sm">
                    MovieZone is your ultimate destination for discovering and streaming movies and TV shows. Explore
                    the latest releases and timeless classics, all in one place.
                </p>
            </div>

            <!-- Footer Bottom -->
            <div class="text-center mt-8">
                <p class="text-sm">&copy; 2025 MovieZone. All Rights Reserved.</p>
            </div>
        </div>
</footer>

<script src="js/home.js"></script>
<script>
    // Mobile menu toggle script
    const menuToggle = document.getElementById('menu-toggle');
    const mobileMenu = document.getElementById('mobile-menu');

    menuToggle.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
    });
</script>
</body>

</html>