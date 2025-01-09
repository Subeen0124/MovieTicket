<?php
include 'connect.php';
if (!$con) {
    die('Database connection failed. Please try again later.');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movies - Movie Ticket Booking</title>
    <link href="./output.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>

<body class="bg-gray-100">
    <header class="bg-gray-800 shadow-md">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <!-- Logo -->
            <a href="#" class="text-2xl font-bold text-red-500">
                MovieZone
            </a>
            <!-- Navigation Links -->
            <nav class="hidden md:flex space-x-6 text-white">
                <a href="index.php" class="hover:text-red-500">Home</a>
                <a href="movies.php" class="hover:text-red-500">Movies</a>
            </nav>

            <div class="hidden md:flex space-x-4">
                <a href="login.php" class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded">Login</a>
                <a href="logout.php" class="px-4 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded">Logout</a>
            </div>

            <!-- Mobile Menu Button -->
            <button class="md:hidden focus:outline-none text-white" id="menu-toggle">
                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>
        <!-- Mobile Menu -->
        <nav class="hidden md:hidden bg-gray-700" id="mobile-menu">
            <a href="index.php" class="block px-4 py-2 hover:bg-gray-600">Home</a>
            <a href="movies.php" class="block px-4 py-2 hover:bg-gray-600">Movies</a>

        </nav>
    </header>
    <main class="container mx-auto px-4 py-8">
        <section class="slider-container carousel relative shadow-xl bg-gray-100 rounded-lg overflow-hidden ">
            <div class="slider-content carousel-wrapper relative w-full h-96">
                <div
                    class="slider-single carousel-item absolute inset-0 w-full h-full bg-cover bg-center transition-opacity duration-700 ease-in-out opacity-100">
                    <img class="slider-single-image"
                        style="background-image: url('https://picsum.photos/id/973/800/400');" id="slide-1" />
                    <h1 class="slider-single-title text-3xl font-bold text-center">Through the Ocean</h1>
                    <a class="slider-single-likes" href="javascript:void(0);">
                        <p class="mt-2 text-lg">An epic journey beneath the waves.</p>
                    </a>
                </div>

                <div
                    class="slider-single carousel-item absolute inset-0 w-full h-full bg-cover bg-center transition-opacity duration-700 ease-in-out opacity-0">
                    <img class="slider-single-image"
                        style="background-image: url('https://picsum.photos/id/973/800/400');" id="slide-2" />
                    <h1 class="slider-single-title text-center text-3xl font-bold">Beautiful Night</h1>
                    <a class="slider-single-likes" href="javascript:void(0);">
                        <p class="mt-2 text-lg">A serene night under the stars.</p>
                    </a>
                </div>

                <div
                    class="slider-single carousel-item absolute inset-0 w-full h-full bg-cover bg-center transition-opacity duration-700 ease-in-out opacity-0">
                    <img class="slider-single-image"
                        style="background-image: url('https://picsum.photos/id/973/800/400');" id="slide-3" />
                    <h1 class="slider-single-title text-center text-3xl font-bold">Through the Wall Surface</h1>
                    <a class="slider-single-likes" href="javascript:void(0);">
                        <p class="mt-2 text-lg">Breaking barriers and building stories.</p>
                    </a>
                </div>
            </div>
            <div class="absolute inset-x-0 bottom-0 flex justify-center p-4">
                <button class="carousel-indicator w-3 h-3 rounded-full transition-all transform hover:scale-125"
                    data-target="#slide-1"></button>
                <button
                    class="carousel-indicator w-3 h-3 bg-gray-400 rounded-full transition-all transform hover:scale-125"
                    data-target="#slide-2"></button>
                <button
                    class="carousel-indicator w-3 h-3 bg-gray-400 rounded-full transition-all transform hover:scale-125"
                    data-target="#slide-3"></button>
            </div>
            <button class="absolute left-4 top-1/2 transform -translate-y-1/2 text-white bg-gray-800 p-2 rounded-full"
                id="prev-slide">
                <i class="fas fa-chevron-left"></i>
            </button>
            <button class="absolute right-4 top-1/2 transform -translate-y-1/2 text-white bg-gray-800 p-2 rounded-full"
                id="next-slide">
                <i class="fas fa-chevron-right"></i>
            </button>
        </section>
        <section class="movies">
            <h2 class="text-3xl font-bold text-gray-800">Now Showing</h2>
            <div class="movie-grid grid grid-cols-1 md:grid-cols-3 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                <?php
                $query = "SELECT * FROM movies1 WHERE now_showing = 1";
                $result = mysqli_query($con, $query);

                while ($movie = mysqli_fetch_assoc($result)) {
                    echo '<div class="movie-card">';
                    echo '<img src="' . htmlspecialchars($movie['poster_url']) . '" alt="' . htmlspecialchars($movie['title']) . ' Poster">';
                    echo '<h3>' . htmlspecialchars($movie['title']) . '</h3>';
                    echo '<p>' . htmlspecialchars($movie['description']) . '</p>';
                    echo '</div>';
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
                    <h2 class="text-lg font-bold text-white mb-4">About MovieZone</h2>
                    <p class="text-sm">
                        MovieZone is your ultimate destination for discovering and streaming movies and TV shows.
                        Explore the latest releases and timeless classics, all in one place.
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