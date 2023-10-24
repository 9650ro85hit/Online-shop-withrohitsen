<?php
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

<!-- INSERT INTO `orders` (`id`, `user_id`, `name`, `number`, `email`, `method`, `address`, `total_products`, `total_price`, `placed_on`, `payment_status`) VALUES (NULL, '2', 'rohit', '234567', 'rohit@gmail.com', 'Credit card', 'vill,post-devrajpur sukandoo 44541,up.', '2', '3498', '2023-09-15', 'pending'); -->

<?php

if ($_SERVER["REQUEST_METHOD"] && isset($_POST['delete'])) {
    // Get the selected user_id for deletion
    $id = $_POST['userId'];
        // echo $id;
    // Prompt the user for confirmation
   
            $deleteQuery = "DELETE FROM `users` WHERE `id` = $id";
        $deleteResult = mysqli_query($conn, $deleteQuery);

        if (!$deleteResult) {
            die("Deletion failed: " . mysqli_error($conn));
        } else {
            // Reload the same page after deletion
            // echo ' window.location.href = "admin_accounts.php';
        }

    

}


?>



<?php
if($_SERVER["REQUEST_METHOD"]){

    $query = "SELECT * FROM `users`";

    // Execute the query
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }

    // Check if any rows were returned

    echo '<div class="contaner">';
  
  
    echo ' <p style="margin-top: 10px; margin-bottom:10px margin-left:40px  maring-right:40px">New Registration:  </p>';
   

    echo '<button class="btn btn-success" name="register">';
    echo '<a href="register.php" style="text-decoration: none;
    font-size: 20px; color:white;">New User</a>';
   echo ' </button>'; // Changed to type="submit"
    
   
    echo '</div>';
    echo '<br>';

    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)){
        
        $id = $row['id'];
            $name = $row['name'];
            $email = $row['email'];
            
        

            echo '<div class="contaner">';
            echo '<form method="POST">';
            echo '<input type="hidden" name="userId" value="' . $id . '">'; // Hidden input to capture user_id
            echo ' <p style="margin-top: 10px; margin-bottom:10px margin-left:40px  maring-right:40px">User Id:       '  . $id . '</p>';
            echo ' <p style="margin-top: 10px; margin-bottom:10px margin-left:40px  maring-right:40px">Username : ' . $name . '</p>';
            echo ' <p style="margin-top: 10px; margin-bottom:10px margin-left:40px  maring-right:40px">User Mail: ' . $email . '</p>';

            
           
            // Changed to type="submit"
            
            
          echo '  <button class="btn btn-danger"  name = "delete">
            Delete
        </button>';
        
           

            echo '</form>';
            echo '</div>';
            echo '<br>';
    }

    }else{
        echo '<div class="contaner">';
        '<p>';
        echo 'Not Orders';
        '</p>';
        '</div>';

    }


}
?>



<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User accounts</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <style>
    .contaner{
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 10px; /* Add padding to create space inside the container */
            margin-top: 50px;
            margin-left: 300px;
            margin-right: 300px;
            text-align: center;
            background-color: rgb(161, 148, 148);
            font-size: 25px;
            /* color: white; */
    }
.contaner>p{
    margin: 10px; /* Apply 10px margin to all sides of <p> tags */
            background-color: white;
            padding: 10px; 
}
  </style>
  <body>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script>

<script>
    function deleteRecord(userId) {
        if (confirm("Are you sure you want to delete this record?")) {
            // Send an AJAX request to delete_record.php
           
        }
    }
</script>

    </script>
  </body>
</html>
