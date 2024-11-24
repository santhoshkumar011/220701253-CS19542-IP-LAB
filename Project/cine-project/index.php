<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cinema Ticket Booking</title>
    <link rel="stylesheet" type="text/css" href="index.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
            color: #333;
        }
        .navbar {
            background-color: #333;
            color: white;
            padding: 10px;
            text-align: center;
        }
        .navbar a {
            color: white;
            margin: 0 15px;
            text-decoration: none;
            font-weight: bold;
        }

        .hero {
            background: url('./download.jpeg');
            height: 400px;
            display: flex;
            justify-content: center;
            align-items: center;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
            font-size: 3em;
            text-align: center;
        }
        .hero h1 {
            margin: 0;
            font-size: 3em;
        }
        .hero p {
            font-size: 1.2em;
        }
        .carousel-container {
            position: relative;
            max-width: 100%;
            margin: 20px auto;
            overflow: hidden;
        }
        .carousel {
            display: flex;
            width: 300%;
            animation: slide 15s infinite;
        }
        .carousel-slide {
            width: 100%;
            flex-shrink: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #f8f9fa;
            padding: 40px;
        }
        .carousel-slide img {
            max-width: 100%;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }
        @keyframes slide {
            0% { transform: translateX(0); }
            33.33% { transform: translateX(-100%); }
            66.67% { transform: translateX(-200%); }
            100% { transform: translateX(0); }
        }
        .movie-highlight {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            text-align: center;
        }
        .movie-highlight h2 {
            margin-bottom: 20px;
            color: #333;
        }
        .movie-list {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            margin: 20px auto;
        }
        .movie {
            background-color: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            width: 200px;
            text-align: center;
        }
        .movie img {
            width: 100%;
            height: auto;
        }
        .movie h3 {
            margin: 10px 0;
            font-size: 1.2em;
        }
        .movie p {
            margin: 5px 0;
        }
        .movie button {
            padding: 10px;
            background-color: #28a745;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 4px;
            margin-bottom: 10px;
        }
        .movie button a {
            color: white;
            text-decoration: none;
        }
        footer {
            text-align: center;
            padding: 20px;
            background-color: #333;
            color: white;
            position: relative;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body class="mainb">
    <div class="navbar gradient-background">
        <a href="index.php">Home</a>
        <a href="movies.php">Movies</a>
        <a href="booking.php">Booking</a>
        <a href="contact.php">Contact Us</a>
    </div>

    <div class="hero linear-text-gradient">
        <h1>Welcome to Cinema Ticket Booking</h1>
        <p>Book your tickets now for the latest movies!</p>
    </div>
<!-- <div class="hero gradient-background">
        <div class="carousel-container">
            <div class="carousel">
                <?php
                $conn = new mysqli('localhost', 'root', '1234', 'cinema_booking');

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "SELECT image_url FROM movies LIMIT 4";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<img src='" . $row['image_url'] . "' alt='Movie Poster'>";
                    }
                } else {
                    echo "<img src='https://via.placeholder.com/150x200?text=No+Movie+Available' alt='No Movie'>";
                }

                $conn->close();
                ?>
            </div>
        </div>
    </div> -->



    <div class="movie-highlight">
        <h2>Featured Movie</h2>
        <img src="data:image/jpeg;base64,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" alt="Featured Movie">
        <p>Don't miss out on our featured movie of the week! Click below to book your tickets.</p>
        <button><a href="movies.php">Book Now</a></button>
    </div>

    <h2 style="text-align: center; margin: 20px;">Now Showing</h2>
    <section class="movie-list">
        <?php
        $conn = new mysqli('localhost', 'root', '1234', 'cinema_booking');

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT id, name, showtime, image_url FROM movies ORDER BY showtime ASC LIMIT 4"; // Display top 4 movies
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "
                <div class='movie'>
                    <img src='" . $row['image_url'] . "' alt='" . $row['name'] . " Poster'>
                    <h3>" . $row['name'] . "</h3>
                    <p>Showtime: " . date('d M Y, H:i', strtotime($row['showtime'])) . "</p>
                    <button><a href='booking.php?movie_id=" . $row['id'] . "'>Book Now</a></button>
                </div>";
            }
        } else {
            echo "<p>No movies are available at the moment.</p>";
        }

        $conn->close();
        ?>
    </section>

    <footer class="gradient-background">
        <p>&copy; 2024 Cinema Ticket Booking. All rights reserved.</p>
    </footer>
</body>
</html>
