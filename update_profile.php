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

session_start();

$username = $_SESSION['name'];

?>



<?php
if($_SERVER["REQUEST_METHOD"]){

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
            $pass = $row['password'];

            $id = $row['id'];
            
        }
    }

    
}

?>








<?php
if($_SERVER["REQUEST_METHOD"]){
$rname = $_POST['name'];
$rpass = $_POST['pass'];
$rcpass = $_POST['cpass'];
$idd   = $_POST['id'];
$oldpass = $_POST['opass'];
if(isset($_POST['submit'])){


    // Check if any rows were returned
    if($oldpass != $pass){
        // echo $oldpass;
        echo $pass;
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Holy guacamole!</strong>Enter currect old password.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';

    }



    else{
        if($rpass!=$rcpass){
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Holy guacamole!</strong>Confirem Password not match.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }
        else{
            $query = "UPDATE `admins` SET `name` = '$rname', `password` = '$rpass' WHERE `admins`.`id` = $idd";

            // Execute the query
            $result = mysqli_query($conn, $query);
        
            if (!$result) {
                die("Query failed: " . mysqli_error($conn));
            }
            else{
        echo '<div class="alert alert-primary alert-dismissible fade show" role="alert">
        <strong>Holy guacamole!</strong>Profile updated successfully.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
            
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
    <title>Update profile</title>

  </head>
  <body>
  <h2 style="text-align:center; color:white; background-color:black; ">Admin Register</h2>
  <div class="form_container" >

  <form method="POST">
  <div class="mb-3 ">

    <label for="exampleInputEmail1" class="form-label" id="label" >User Name</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="name" value="<?php echo $username; ?>">


  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label" id="label">Old Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" name="opass" placeholder="Enter your old password">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label" id="label"> Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" name="pass" require>
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label" id="label"> Confirem Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" name="cpass" require>
  </div>

  
   
    <input type="number" class="form-control" id="exampleInputPassword1" name="id" value="<?php echo $id; ?>" hidden>
  
  <button type="submit" class="btn btn-primary " name="submit">Submit</button>

</form>

  </div>

  </body>
</html>