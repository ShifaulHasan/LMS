<?php
// Start the session
session_start();

// Check if admin is not logged in, redirect to AdminLogin.php
if (!isset($_SESSION['admin_id'])) {
    header("Location: AdminLogin.php");
    exit;
}

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lms_db";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to select all rented books with user details using a join
$select_query = "SELECT rented_books.user_id, rented_books.book_id, rented_books.rent_date, rented_books.return_date, users.username, 
                 books.title AS book_title, books.isbn, books.author, books.category
                 FROM rented_books
                 INNER JOIN users ON rented_books.user_id = users.id
                 INNER JOIN books ON rented_books.book_id = books.id";

$result = $conn->query($select_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Rent Details - Library Management System</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Custom CSS */
        body {
            background-color: #f0f8ff; /* Light Sky Blue */
        }
        .navbar {
            background-color: #87ceeb; /* Sky Blue */
        }
        .footer {
            background-color: #87ceeb; /* Sky Blue */
            padding: 20px 0;
            text-align: center;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
        <a class="navbar-brand" href="#">Library Management System</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="Home.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="registration.php">Registration</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="AvailableBooks.php">Available Books</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="SearchBook.php">Search Books</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="aboutus.php">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="AdminProfile.php">Admin Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <h2><center>Book Rent Details</center></h2>
    <table class="table">
        <thead>
        <tr>
            <th>User ID</th>
            <th>Username</th>
            <th>Book ID</th>
            <th>Book Title</th>
            <th>Author</th>
            <th>Category</th>
            <th>ISBN</th>
            <th>Rent Date</th>
            <th>Return Date</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                ?>
                <tr>
                    <td><?php echo $row['user_id']; ?></td>
                    <td><?php echo $row['username']; ?></td>
                    <td><?php echo $row['book_id']; ?></td>
                    <td><?php echo $row['book_title']; ?></td>
                    <td><?php echo $row['author']; ?></td>
                    <td><?php echo $row['category']; ?></td>
                    <td><?php echo $row['isbn']; ?></td>
                    <td><?php echo $row['rent_date']; ?></td>
                    <td><?php echo $row['return_date']; ?></td>
                </tr>
                <?php
            }
        } else {
            echo "<tr><td colspan='9'>No rented books found</td></tr>";
        }
        ?>
        </tbody>
    </table>
</div>

<footer class="footer">
    <div class="container">
        <p>&copy; 2024 Library Management System</p>
    </div>
</footer>

<!-- Bootstrap JS (optional, if you want to use Bootstrap features like dropdowns) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
