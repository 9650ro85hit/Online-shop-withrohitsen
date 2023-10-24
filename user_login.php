<?php
error_reporting(0);
session_start();

include('user_header.php');

$host = "localhost"; // Change this to your database host
$username = "root"; // Change this to your database username
$password = ""; // Change this to your database password
$database = "shop_db"; // Change this to your database name

// Create a database connection
$conn = mysqli_connect($host, $username, $password, $database);

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

try {
  // Create a PDO database connection
  $conn = new PDO("mysql:host=$host;dbname=$database", $username, $password);
  // Set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  die("Connection failed: " . $e->getMessage());
}

// session_start();
if(isset($_SESSION['user_id'])){
  $user_id = $_SESSION['user_id'];
  // echo $user_id;
}else{
  $user_id = '';
}

if(isset($_POST['submit'])){
  
  $email = $_POST['email'];
  $pass = $_POST['password'];
  // echo $email;
  // echo $pass;
  $select_user = $conn->prepare("SELECT * FROM `users` WHERE email=? AND password=?");
  $select_user->execute([$email,$pass]);
  $row = $select_user->fetch(PDO::FETCH_ASSOC);

  if($select_user->rowCount()>0){
 
    $_SESSION['user_id'] = $row['id'];
    // echo $_SESSION['user_id'];
    header('location:home.php');
//  echo 'login successfully';

  }
  else{
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Holy guacamole!</strong> Incorrect email or password.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
  }


}
?>
<!-- user login section starts -->
<!doctype html>
<?php

?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Loing</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
      <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: #f2f2f2;
        }

        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
            border-radius: 5px;
        }

        .container h2 {
            text-align: center;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            font-weight: bold;
        }

        .form-group input[type="email"],
        .form-group input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        .form-group input[type="submit"] {
            background-color: #007BFF;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 3px;
        }

        .form-group input[type="submit"]:hover {
            background-color: #0056b3;
        }
        #regis{
          text-decoration:none;
          color:white;
        }
    </style>
  <body>
    
  <div class="container">
        <h2>Login Form</h2>
        <form action="#" method="POST">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <input type="submit" value="Login" class="bg-success" name="submit">
                <h5>i don't have an account?</h5>
                <button type="button" class="btn btn-warning"><a href="user_register.php" id="regis">Register now</a></button>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>
<!-- user login section ends -->
<?php
include 'footer.php';
?>