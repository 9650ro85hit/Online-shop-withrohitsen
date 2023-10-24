<?php
error_reporting(0);
// Database configuration
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




?>


<?php
if($_SERVER["REQUEST_METHOD"]){
$username = $_POST['name'];
$pass = $_POST['pass'];

if(isset($_POST['submit'])){
    $query = "SELECT * FROM `admins` WHERE name =  '$username'";

    // Execute the query
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }

    // Check if any rows were returned
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if($row['name']==$username && $row['password'] == $pass){
            echo '<div class="alert alert-primary alert-dismissible fade show" role="alert">
            <strong>Holy guacamole!</strong>You have loggdin successfully.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
            session_start();
            $_SESSION['name'] = $username;
            header('Location:dashbord.php');
        }

        else{
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Holy guacamole!</strong>Username or password not match.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }
    } 
}
}



?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="admin_login.css">
  </head>
  <body>
    <h2 style="text-align:center; color:white; background-color:black; ">Adming Loign pannale</h2>
  <div class="form_container" >

  <form method="POST">
  <div class="mb-3 ">
    <label for="exampleInputEmail1" class="form-label" id="label">User Name</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="name">

  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label" id="label">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" name="pass">
  </div>

  <button type="submit" class="btn btn-primary " name="submit">Submit</button>
</form>

  </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>