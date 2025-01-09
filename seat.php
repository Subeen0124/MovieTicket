<?php
// Include database connection
include('connection.php');

// Fetch available seats from the database
$sql = "SELECT seat_id, seat_number, status FROM seats WHERE available = 1";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seat Selection</title>
    <!-- Tailwind CSS CDN -->
    <link hfref="./output.css" rel="stylesheet">
</head>

<body class="bg-gray-100 p-6">

    <h1 class="text-3xl font-bold text-center mb-6">Select Your Seat</h1>

    <div class="max-w-4xl mx-auto">
        <?php
        // Check if there are any available seats
        if ($result->num_rows > 0) {
            echo "<table class='w-full table-auto border-collapse'>";
            echo "<thead class='bg-gray-200'>
                    <tr>
                        <th class='px-4 py-2 border text-left text-sm font-medium text-gray-600'>Seat ID</th>
                        <th class='px-4 py-2 border text-left text-sm font-medium text-gray-600'>Seat Number</th>
                        <th class='px-4 py-2 border text-left text-sm font-medium text-gray-600'>Status</th>
                        <th class='px-4 py-2 border text-left text-sm font-medium text-gray-600'>Action</th>
                    </tr>
                  </thead>
                  <tbody>";

            // Display available seats
            while ($row = $result->fetch_assoc()) {
                $seat_id = $row['seat_id'];
                $seat_number = $row['seat_number'];
                $status = $row['status'];
                $status_class = ($status == 'available') ? 'bg-green-200' : 'bg-red-200';
                $action = ($status == 'available')
                    ? "<button onclick='bookSeat($seat_id)' class='bg-blue-500 hover:bg-blue-700 text-white px-4 py-2 rounded-md'>Book</button>"
                    : "<span class='text-gray-500'>Booked</span>";

                echo "<tr class='hover:bg-gray-50'>
                        <td class='px-4 py-2 border text-sm'>{$seat_id}</td>
                        <td class='px-4 py-2 border text-sm'>{$seat_number}</td>
                        <td class='px-4 py-2 border text-sm {$status_class}'>{$status}</td>
                        <td class='px-4 py-2 border text-sm'>{$action}</td>
                      </tr>";
            }
            echo "</tbody></table>";
        } else {
            echo "<p class='text-center text-lg text-gray-500'>No available seats.</p>";
        }

        // Close the connection
        $conn->close();
        ?>

    </div>

    <script>
        function bookSeat(seatId) {
            if (confirm("Do you want to book this seat?")) {
                // For simplicity, we assume the seat is available and now we're booking it
                // You would typically send an AJAX request to update the database here
                alert("Seat " + seatId + " has been booked!");
            }
        }
    </script>

</body>

</html>