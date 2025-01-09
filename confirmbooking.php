<?php
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $selectedSeats = $_POST['selected_seats'];
    $seatsArray = explode(',', $selectedSeats);

    foreach ($seatsArray as $seatNumber) {
        $query = "UPDATE seats SET status = 'reserved' WHERE seat_number = '$seatNumber'";
        mysqli_query($con, $query);
    }

    echo "<script>alert('Seats booked successfully!'); window.location.href='index.php';</script>";
}
?>