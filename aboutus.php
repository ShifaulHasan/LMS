<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About Us - Library Management System</title>
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
        <li class="nav-item active">
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
  <h2><center>About Us</center></h2>
  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis ac sapien a leo consequat vestibulum. Curabitur placerat, libero a commodo condimentum, metus eros venenatis orci, nec posuere justo nisi non tortor. In lobortis lacus sit amet accumsan posuere. Vivamus vel nunc vel justo eleifend auctor. Proin feugiat, nulla vitae suscipit vehicula, libero metus vehicula metus, id scelerisque turpis risus sed lacus. Fusce sed ante a nunc convallis volutpat. Sed semper, tortor sed consectetur tempus, risus tellus condimentum arcu, et ultricies justo lacus non sapien. Nam et nisi dui.</p>
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
