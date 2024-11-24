<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movies - Cinema Ticket Booking</title>
    <link rel="stylesheet" type="text/css" href="index.css">
    <style>
        .movie-list {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }
        .movie {
            border: 1px solid #ccc;
            padding: 15px;
            width: 200px;
            text-align: center;
            background-color: #f9f9f9;
        }
        .movie img {
            width: 100%;
            height: auto;
        }
        .movie h3 {
            font-size: 1.2em;
        }
        .movie p {
            margin: 10px 0;
        }
        .movie button {
            padding: 10px;
            background-color: #28a745;
            color: white;
            border: none;
            cursor: pointer;
        }
        .movie button a {
            color: white;
            text-decoration: none;
        }
        
        
        .carousel-container {
            position: relative;
            max-width: 100%;
            margin: 20px auto;
            overflow: hidden;
        }
        .carousel {
            display: flex;
            width: 400%;
            animation: slide 10s infinite;
        }
        .carousel img {
            height:100vh;
            width: 25%;
            object-fit: cover;
        }
        @keyframes slide {
            0% { transform: translateX(0); }
            25% { transform: translateX(-25%); }
            50% { transform: translateX(-50%); }
            75% { transform: translateX(-75%); }
            100% { transform: translateX(0); }
        }

        .search-container {
            text-align: center;
            margin: 20px 0;
        }
        .search-container input[type="text"] {
            padding: 10px;
            width: 200px;
            border: 1px solid #ccc;
        }
        .search-container button {
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="navbar gradient-background">
        <a href="index.php">Home</a>
        <a href="movies.php">Movies</a>
        <a href="booking.php">Booking</a>
        <a href="contact.php">Contact Us</a>
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

    <div class="search-container">
        <form method="GET" action="">
            <input type="text" name="search" placeholder="Search for movies...">
            <button type="submit">Search</button>
        </form>
    </div>

    <section id="movies" class="movie-list">
        <?php
        $conn = new mysqli('localhost', 'root', '1234', 'cinema_booking');

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        
        $search = isset($_GET['search']) ? $_GET['search'] : '';
        $sql = "SELECT id, name, showtime, image_url FROM movies WHERE name LIKE ? ORDER BY showtime ASC";
        $stmt = $conn->prepare($sql);
        $searchTerm = "%" . $search . "%"; 
        $stmt->bind_param("s", $searchTerm);
        $stmt->execute();
        $result = $stmt->get_result();

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
            echo "<p>No movies found matching your search.</p>";
        }

        $stmt->close();
        $conn->close();
        ?>
    </section>

    <footer class="gradient-background">
        <p>&copy; 2024 Cinema Ticket Booking. All rights reserved.</p>
    </footer>
</body>
</html>
