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

// Fetch rented book IDs for the user
$sql_rented_books = "SELECT book_id FROM rented_books WHERE user_id = '$user_id'";
$result_rented_books = $conn->query($sql_rented_books);

// Check if rented book data exists
$rented_book_ids = [];
if ($result_rented_books->num_rows > 0) {
    // Fetch rented book IDs
    while ($row = $result_rented_books->fetch_assoc()) {
        $rented_book_ids[] = $row['book_id'];
    }
}

// Fetch available books data from the database
$available_books = [];
if (!empty($rented_book_ids)) {
    // If user has rented books, exclude them from available books query
    $sql_available_books = "SELECT * FROM books WHERE id NOT IN (" . implode(",", $rented_book_ids) . ")";
} else {
    // If user hasn't rented any books, fetch all books
    $sql_available_books = "SELECT * FROM books";
}

$result_available_books = $conn->query($sql_available_books);

// Check if available books data exists
if ($result_available_books->num_rows > 0) {
    // Fetch available books data
    while ($row = $result_available_books->fetch_assoc()) {
        $available_books[] = $row;
    }
}

// Close database connection
$conn->close();

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle book rental process
    $book_id = $_POST['book'];
    $rent_date = date("Y-m-d");
    $return_date = date("Y-m-d", strtotime("+7 days")); // Example: Set return date to 7 days from rent date

    // Database connection
    $conn = new mysqli($servername, $db_username, $db_password, $db_name);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare SQL statement to insert rented book details
    $sql_rent = "INSERT INTO rented_books (user_id, book_id, rent_date, return_date) VALUES ('$user_id', '$book_id', '$rent_date', '$return_date')";

    // Execute SQL statement
    if ($conn->query($sql_rent) === TRUE) {
        // Successfully rented book
        // Redirect to UserProfile.php or confirmation page
        header("Location: UserProfile.php");
        exit();
    } else {
        // Error occurred while renting book
        echo "Error: " . $sql_rent . "<br>" . $conn->error;
    }

    // Close database connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Rent a Book - Library Management System</title>
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
  <h2><center>Rent a Book</center></h2>
  <div class="row justify-content-center">
    <div class="col-md-6">
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <div class="form-group">
          <label for="book">Select Book:</label>
          <select class="form-control" id="book" name="book" required>
            <!-- Populate book options from database -->
            <?php foreach ($available_books as $book): ?>
              <option value="<?php echo $book['id']; ?>"><?php echo $book['title']; ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <button type="submit" class="btn btn-primary">Rent Book</button>
      </form>
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
