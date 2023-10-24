<?php
error_reporting(0);
include 'header.php';
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



echo'';

?>



<?php
if($_SERVER["REQUEST_METHOD"]){
$username = $_POST['name'];
$pass = $_POST['pass'];
$cpass = $_POST['cpass'];
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
        if($row['name']==$username){         
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Holy guacamole!</strong>User name alrady exist.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
           
        }}

        else{

            if($pass!=$cpass){
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Holy guacamole!</strong>Your confirem password not match.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
            }else{
                $insertSql = "INSERT INTO `admins` (name, password) VALUES (?, ?)";
    
                $stmt = mysqli_prepare($conn, $insertSql);
                mysqli_stmt_bind_param($stmt, "ss", $username, $pass);

                if (mysqli_stmt_execute($stmt)) {
                    echo '<div class="alert alert-primary alert-dismissible fade show" role="alert">
                    <strong>Holy guacamole!</strong>Admin registration successfully.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
                } else {
                    echo "Error: " . mysqli_error($conn);
                }
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
    <title>Register</title>

  </head>
  <body>
  <h2 style="text-align:center; color:white; background-color:black; ">Admin Register</h2>
  <div class="form_container" >

  <form method="POST">
  <div class="mb-3 ">
    <label for="exampleInputEmail1" class="form-label" id="label">User Name</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="name">

  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label" id="label">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" name="pass">
  </div>

  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label" id="label"> Confirem Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" name="cpass">
  </div>
  <button type="submit" class="btn btn-primary " name="submit">Submit</button>
</form>

  </div>

  </body>
</html>