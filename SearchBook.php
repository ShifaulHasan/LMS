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

// Check if search form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $search_keyword = $_POST['search_keyword'];

    // Prepare SQL statement to search for books
    $sql_search_books = "SELECT * FROM books WHERE (title LIKE '%$search_keyword%' OR isbn LIKE '%$search_keyword%')";
    if (!empty($rented_book_ids)) {
        $sql_search_books .= " AND id NOT IN (" . implode(",", $rented_book_ids) . ")";
    }

    $result_search_books = $conn->query($sql_search_books);

    // Check if search result exists
    $search_books = [];
    if ($result_search_books->num_rows > 0) {
        // Fetch search result
        while ($row = $result_search_books->fetch_assoc()) {
            $search_books[] = $row;
        }
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
  <title>Search Books - Library Management System</title>
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
        <li class="nav-item active">
          <a class="nav-link" href="SearchBook.php">Search Books</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="aboutus.php">About Us</a>
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
  <h2><center>Search Books</center></h2>
  <div class="row justify-content-center">
    <div class="col-md-6">
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <div class="form-group">
          <label for="search_keyword">Search by Book Name or ISBN:</label>
          <input type="text" class="form-control" id="search_keyword" name="search_keyword" placeholder="Enter book name or ISBN" required>
        </div>
        <button type="submit" class="btn btn-primary">Search</button>
      </form>
    </div>
  </div>

  <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($search_books)): ?>
    <div class="row mt-5">
      <div class="col-md-8">
        <h3>Search Result:</h3>
        <table class="table">
          <thead>
            <tr>
              <th>Title</th>
              <th>Author</th>
              <th>ISBN</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($search_books as $book): ?>
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
  <?php endif; ?>
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
