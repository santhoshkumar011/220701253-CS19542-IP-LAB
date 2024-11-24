<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking - Cinema Ticket Booking</title>
    <link rel="stylesheet" type="text/css" href="index.css">
</head>
<body>
    <div class="navbar gradient-background">
        <a href="index.php">Home</a>
        <a href="movies.php">Movies</a>
        <a href="booking.php">Booking</a>
        <a href="contact.php">Contact Us</a>
    </div>

    <div class="hero gradient-background">
        <h1>Book Your Ticket</h1>
    </div>

    <div class="booking-details">
        <?php
        $conn = new mysqli('localhost', 'root', '1234', 'cinema_booking');

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        if (isset($_GET['movie_id'])) {
            $movie_id = $_GET['movie_id'];

            $sql = "SELECT name, showtime FROM movies WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $movie_id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                echo "<h2>Movie: " . $row['name'] . "</h2>";
                echo "<p>Showtime: " . date('d M Y, H:i', strtotime($row['showtime'])) . "</p>";

                echo "
                <form method='POST' action='booking.php?movie_id=" . $movie_id . "'>
                    <label for='customer_name'>Your Name:</label>
                    <input type='text' id='customer_name' name='customer_name' required>
                    <label for='seat_number'>Seat Number:</label>
                    <input type='text' id='seat_number' name='seat_number' required>
                    <button type='submit'>Confirm Booking</button>
                </form>";
            } else {
                echo "<p>Movie not found.</p>";
            }

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $customer_name = $_POST['customer_name'];
                $seat_number = $_POST['seat_number'];

                $insert_sql = "INSERT INTO bookings (movie_id, customer_name, seat_number) VALUES (?, ?, ?)";
                $insert_stmt = $conn->prepare($insert_sql);
                $insert_stmt->bind_param("iss", $movie_id, $customer_name, $seat_number);
                
                if ($insert_stmt->execute()) {
                    echo "<p>Booking confirmed for " . $customer_name . "!</p>";
                } else {
                    echo "<p>Booking failed: " . $conn->error . "</p>";
                }
            }

        } else {
            echo "<p>No movie selected.</p>";
        }

        $stmt->close();
        $conn->close();
        ?>
    </div>

    <footer class="gradient-background">
        <p>&copy; 2024 Cinema Ticket Booking. All rights reserved.</p>
    </footer>
</body>
</html>
