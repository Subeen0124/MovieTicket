<?php
session_start();
include 'connect.php';

if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit();
}

// Add Movie
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $poster_url = $_POST['poster_url'];
    $now_showing = isset($_POST['now_showing']) ? 1 : 0;

    $query = "INSERT INTO movies1 (title, description, poster_url, now_showing) VALUES ('$title', '$description', '$poster_url', '$now_showing')";
    mysqli_query($con, $query);
    header('Location: manage_movies.php');
    exit();
}

// Delete Movie
if (isset($_GET['delete'])) {
    $movie_id = $_GET['delete'];
    $query = "DELETE FROM movies1 WHERE id = $movie_id";
    mysqli_query($con, $query);
    header('Location: manage_movies.php');
    exit();
}
include 'header.php';
?>
<main>
    <h2>Manage Movies</h2>
    <form method="post">
        <input type="text" name="title" placeholder="Title" required>
        <textarea name="description" placeholder="Description" required></textarea>
        <input type="text" name="poster_url" placeholder="Poster URL" required>
        <label>
            <input type="checkbox" name="now_showing"> Now Showing
        </label>
        <button type="submit">Add Movie</button>
    </form>

    <h3>Existing Movies</h3>
    <table>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Description</th>
            <th>Now Showing</th>
            <th>Actions</th>
        </tr>
        <?php
        $query = "SELECT * FROM movies1";
        $result = mysqli_query($con, $query);

        while ($movie = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            echo '<td>' . $movie['id'] . '</td>';
            echo '<td>' . htmlspecialchars($movie['title']) . '</td>';
            echo '<td>' . htmlspecialchars($movie['description']) . '</td>';
            echo '<td>' . ($movie['now_showing'] ? 'Yes' : 'No') . '</td>';
            echo '<td><a href="manage_movies.php?delete=' . $movie['id'] . '">Delete</a></td>';
            echo '</tr>';
        }
        ?>
    </table>
</main>

<footer>
    <p>&copy; 2024 MovieZone. All rights reserved.</p>
</footer>
</body>

</html>