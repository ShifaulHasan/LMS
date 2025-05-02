<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "lms_db";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get username and password from the form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare SQL statement
    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";

    // Execute SQL statement
    $result = $conn->query($sql);

    // Check if there is a matching user
    if ($result->num_rows == 1) {
        // Start session
        session_start();
        // Store username in session variable
        $_SESSION['username'] = $username;
        // Redirect to UserProfile.php upon successful login
        header("Location: UserProfile.php");
        exit();
    } else {
        // Display error message if login fails
        echo '<div class="container mt-5"><div class="alert alert-danger" role="alert">Invalid username or password!</div></div>';
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
  <title>User Login - Library Management System</title>
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
        <li class="nav-item active">
          <a class="nav-link" href="userlogin.php">User</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="container mt-5">
  <h2><center>User Login</center></h2>
  <div class="row justify-content-center">
    <div class="col-md-6">
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <div class="form-group">
          <label for="username">Username:</label>
          <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="form-group">
          <label for="password">Password:</label>
          <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
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
