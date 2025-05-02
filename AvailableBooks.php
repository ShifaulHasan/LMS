<?php

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

// Fetch rented book IDs
$sql_rented_books = "SELECT DISTINCT book_id FROM rented_books";
$result_rented_books = $conn->query($sql_rented_books);

// Check if rented books data exists
$rented_book_ids = [];
if ($result_rented_books->num_rows > 0) {
    // Fetch rented book IDs
    while ($row = $result_rented_books->fetch_assoc()) {
        $rented_book_ids[] = $row['book_id'];
    }
}

// Fetch available books data from the database
$sql_available_books = "SELECT * FROM books";
if (!empty($rented_book_ids)) {
    $sql_available_books .= " WHERE id NOT IN (" . implode(",", $rented_book_ids) . ")";
}

$result_available_books = $conn->query($sql_available_books);

// Check if available books data exists
$available_books = [];
if ($result_available_books->num_rows > 0) {
    // Fetch available books data
    while ($row = $result_available_books->fetch_assoc()) {
        $available_books[] = $row;
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
  <title>Available Books - Library Management System</title>
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
        <li class="nav-item active">
          <a class="nav-link" href="AvailableBooks.php">Available Books</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="SearchBook.php">Search Books</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="aboutus.php">About Us</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Log In
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="userlogin.php">User</a>
            <a class="dropdown-item" href="AdminLogin.php">Admin</a>
          </div>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="container mt-5">
  <h2><center>Available Books</center></h2>
  <div class="row justify-content-center">
    <div class="col-md-8">
      <table class="table">
        <thead>
          <tr>
            <th>Title</th>
            <th>Author</th>
            <th>ISBN</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($available_books as $book): ?>
          <tr>
            <td><?php echo $book['title']; ?></td>
            <td><?php echo $book['author']; ?></td>
            <td><?php echo $book['isbn']; ?></td>
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
