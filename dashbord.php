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

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="dashbord.css">
</head>
<body>
    <h1>WELCOME TO DASHBOARD</h1>
<div class="container">
<div class="row">
        <div class="col">
                <h3>Welcome!</h3>
            <?php
            $username = 'rohit';
            $query = "SELECT * FROM `admins` WHERE name =  '$username'";

            // Execute the query
            $result = mysqli_query($conn, $query);
        
            if (!$result) {
                die("Query failed: " . mysqli_error($conn));
            }
        
            // Check if any rows were returned
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $name = $row['name'];
        
            }
            ?>


                <p><?php $name ?></p>
                <a href="update_profile.php">Update Profile</a>
        </div>
        
    <div class="col">
        <?php
$total_pendings = 0;
$select_pendings = $conn->prepare("SELECT * FROM `orders` WHERE payment_status = ?");
$select_pendings->bind_param("s", $payment_status);
$payment_status = "pending"; 
$select_pendings->execute();

$result = $select_pendings->get_result();

while ($fetch_pendings = $result->fetch_assoc()) {
    $total_pendings += $fetch_pendings['total_price'];
}
  
    
    ?>
<h3><span>$</span><?= $total_pendings; ?><span>/-</span></h3>

    <p>total pendings</p>
    <a href="placed_orders.php">See orders</a>
    </div>
    <div class="col">
    <?php
$total_compleate = 0;
$select_compleate = $conn->prepare("SELECT * FROM `orders` WHERE payment_status = ?");
$select_compleate->bind_param("s", $payment_status);
$payment_status = "complete"; 
$select_compleate->execute();

$result = $select_compleate->get_result();

while ($fetch_pendings = $result->fetch_assoc()) {
    $total_compleate += $fetch_pendings['total_price'];
}
  
    
    ?>
<h3><span>$</span><?= $total_compleate; ?><span>/-</span></h3>

    <p>total compleat</p>
    <a href="placed_orders.php">See orders</a>

    </div>
    <div class="col">
        <?php
      $select_orders = $conn->prepare("SELECT * FROM `orders`");
      $select_orders->execute();
      $result = $select_orders->get_result();
      $numbers_of_orders = mysqli_num_rows($result);
      
        ?>
        <h3><?= $numbers_of_orders;?></h3>
        <p>total orders</p>
        <a href="placed_orders.php">see orders</a>
    </div>
</div>

<div class="row">
        <div class="col">
        <?php
      $select_products = $conn->prepare("SELECT * FROM `products`");
      $select_products->execute();
      $result = $select_products->get_result();
      $numbers_of_products = mysqli_num_rows($result);
      
        ?>
        <h3><?= $numbers_of_products;?></h3>
        <p>Products add</p>
        <a href="products.php">see products</a>
        </div>
        
    <div class="col">
    <?php
      $select_users = $conn->prepare("SELECT * FROM `users`");
      $select_users->execute();
      $result = $select_users->get_result();
      $numbers_of_users = mysqli_num_rows($result);
      
        ?>
        <h3><?= $numbers_of_users;?></h3>
        <p>users accounts</p>
        <a href="user_accounts.php">see users</a>

    </div>
    <div class="col">
    <?php
      $select_admins = $conn->prepare("SELECT * FROM `admins`");
      $select_admins->execute();
      $result = $select_admins->get_result();
      $numbers_of_admins = mysqli_num_rows($result);
      
        ?>
        <h3><?= $numbers_of_admins;?></h3>
        <p>total adminss</p>
        <a href="admin_accounts.php">see admins</a>

    </div>
    <div class="col">
    <?php
      $select_message = $conn->prepare("SELECT * FROM `user_message`");
      $select_message->execute();
      $result = $select_message->get_result();
      $numbers_of_message = mysqli_num_rows($result);
      
        ?>
        <h3><?= $numbers_of_message;?></h3>
        <p>users accounts</p>
        <a href="totmessages.php">see messagess</a>

    </div>
</div>

</div>
</body>
</html>