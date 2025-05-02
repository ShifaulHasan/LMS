<?php
// Start session
session_start();

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    // Redirect to login page if not logged in
    header("Location: userlogin.php");
    exit();
}

// Get username from session
$username = $_SESSION['username'];

// Database connection
$servername = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "lms_db";

// Create connection
$conn = new mysqli($servername, $db_username, $db_password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch user id based on username
$sql_user_id = "SELECT id FROM users WHERE username = '$username'";
$result_user_id = $conn->query($sql_user_id);

// Check if user id exists
if ($result_user_id->num_rows == 1) {
    // Fetch user id
    $row_user_id = $result_user_id->fetch_assoc();
    $user_id = $row_user_id['id'];
} else {
    // Handle error (user not found)
    // For example, redirect the user to an error page
    header("Location: error.php");
    exit();
}

// Fetch rented book data from the database based on user id with a JOIN query
$sql_rented_books = "SELECT rented_books.*, books.title AS book_title, books.author, books.category, books.isbn 
                    FROM rented_books 
                    INNER JOIN books ON rented_books.book_id = books.id 
                    WHERE rented_books.user_id = '$user_id'";
$result_rented_books = $conn->query($sql_rented_books);

// Check if rented book data exists
$rented_books = [];
if ($result_rented_books->num_rows > 0) {
    // Fetch rented book data
    while ($row = $result_rented_books->fetch_assoc()) {
        $rented_books[] = $row;
    }
}

// Close database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Rented Books - Library Management System</title>
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
          <a class="nav-link" href="logout2.php">Logout</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="container mt-5">
  <h2><center>Rented Books</center></h2>
  <div class="row justify-content-center">
    <div class="col-md-8">
      <table class="table">
        <thead>
          <tr>
            <th>Book Title</th>
            <th>Author</th>
            <th>Category</th>
            <th>ISBN</th>
            <th>Rent Date</th>
            <th>Return Date</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($rented_books as $book): ?>
          <tr>
            <td><?php echo $book['book_title']; ?></td>
            <td><?php echo $book['author']; ?></td>
            <td><?php echo $book['category']; ?></td>
            <td><?php echo $book['isbn']; ?></td>
            <td><?php echo $book['rent_date']; ?></td>
            <td><?php echo $book['return_date']; ?></td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
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
