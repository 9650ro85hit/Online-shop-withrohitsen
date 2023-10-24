<?php
session_start();
$host = "localhost"; // Change this to your database host
$username = "root"; // Change this to your database username
$password = ""; // Change this to your database password
$database = "shop_db"; // Change this to your database name
$conn = mysqli_connect($host, $username, $password, $database);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$username = $_SESSION['name'];
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin header</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="header.css">
    <style>
        .navbar {
            background-color: #007bff; /* Navbar background color */
        }
        .navbar-brand, .navbar-toggler-icon {
            color: black !important; /* Navbar brand and icon color */
        }
        #dropdownn{
    float: right;
    margin-right: 250px;
}
        .navbar-nav .nav-link {
            color: black !important; /* Nav item text color */
            position: relative;
            transition: color 0.3s;
        }
        .navbar-nav .nav-link::before {
            content: "";
            position: absolute;
            width: 0;
            height: 2px;
            background: black; /* Color of the line */
            bottom: 0;
            left: 0;
            transition: width 0.3s;
        }
        .navbar-nav .nav-link:hover {
            color: black !important; /* Change text color on hover */
        }
        .navbar-nav .nav-link{
          margin-right: 25px;
        }
        .navbar-nav .nav-link:hover::before {
            width: 100%; /* Expand the line width on hover */
        }

        .dropdown-menu {
            background-color: black !important; /* Dropdown menu background color */
        }
        .dropdown-item {
            color: black !important; /* Dropdown item text color */
        }
    </style>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
      <div class="container-fluid">
        <h3>Admin Panel</h3>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse text-center" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active fs-4 ps-5" aria-current="page" href="dashbord.php" >Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active fs-4" aria-current="page" href="products.php">Products</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active fs-4" aria-current="page" href="placed_orders.php">Orders</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active fs-4" aria-current="page" href="updattt.php">Update_Products</a>
            </li>
          </ul>
        </div>
      </div>
      <div class="dropdown" id="dropdownn">
        <h5><?php  echo $username;?></h5>
        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
          <div class="admin_logo"><i class="bi bi-person-fill"></i></div>
        </button>
        <ul class="dropdown-menu bg-light" >
          <li><a class="dropdown-item bg-info mb-2" href="update_profile.php">Update Profile</a></li>
          <li><a class="dropdown-item bg-success mb-2" href="#">Login </a></li>
          <li><a class="dropdown-item bg-warning mb-2" href="register.php">Register</a></li>
          <li><a class="dropdown-item bg-danger mb-2" href="logout.php"  onclick="return confirm('logout from this website?');" >Logout</a></li>
        </ul>
      </div>
    </nav>
    <!-- Rest of your PHP and HTML content -->
    <!-- modal starts -->
    <div class="modal" tabindex="-1">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Modal title</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p>Modal body text goes here.</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </div>
    </div>
    <!-- modal ends -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>