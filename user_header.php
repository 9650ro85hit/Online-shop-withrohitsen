<?php
// ob_start();
session_start();
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



if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
    
}
else{
    $user_id = '';
    
}




?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User header</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="header.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        .navbar {
            background-color: #007bff; /* Navbar background color */
            text-align:center !important;
            padding:10px !important;
        }

        .navbar-brand, .navbar-toggler-icon {
            color: black !important; /* Navbar brand and icon color */
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
            margin-left:20px;
            
        }

        .navbar-nav .nav-link:hover {
            color: black !important; /* Change text color on hover */
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
  <style>
        /* Custom CSS for the container */
        body {
            overflow-x: hidden; /* Prevent horizontal overflow */
        }

        .container {
            max-width: 400px; /* Set your desired maximum width */
            margin: 0 auto; /* Center the container horizontally */
            background-color: #f0f0f0; /* Set your desired background color */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2); /* Add a box shadow */
            padding: 20px; /* Add padding to create space inside the container */
            text-align: center; 
            margin-top:20px;  
        }
        .dropdown{
          float: right;
    margin-right: 250px;
        }
    </style>
  <body>
    
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <h3><a href="shop.php" style="color:black; text-decoration:none;"><span style="color:blue;">RS</span>shopie</a></h3>
    
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse text-center" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active fs-4 ps-5" aria-current="page" href="home.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active fs-4 ps-5" aria-current="page" href="about_shop.php">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active fs-4 ps-5" aria-current="page" href="user_orders.php">Order</a>
        </li>

        <li class="nav-item">
          <a class="nav-link active fs-4 ps-5" aria-current="page" href="shop.php">Shop</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active fs-4 ps-5" aria-current="page" href="messages.php">Contact</a>
        </li>
       
      </ul>
     
    </div>
  </div>
    <div class="icons">
<?php
       $count_wishlist_items = $conn->prepare("SELECT * FROM `wishlist` WHERE user_id=?");
       $count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id=?");
       
       if ($count_wishlist_items && $count_cart_items) {
           $count_wishlist_items->bind_param("s", $user_id);
           $count_cart_items->bind_param("s", $user_id);
       
           if ($count_wishlist_items->execute()) {
               $count_wishlist_items->store_result(); // Store the result set
       
               $total_wishlist_items = $count_wishlist_items->num_rows;
       
               $count_wishlist_items->close(); // Close the result set
       
           } else {
               echo "Error executing the wishlist SQL statement: " . $count_wishlist_items->error;
           }
       
           if ($count_cart_items->execute()) {
               $count_cart_items->store_result(); // Store the result set
       
               $total_cart_items = $count_cart_items->num_rows;
            
               $count_cart_items->close(); // Close the result set
       
           } else {
               echo "Error executing the cart SQL statement: " . $count_cart_items->error;
           }
       } else {
           echo "Error preparing SQL statements: " . $conn->error;
       }
?>
<a href="search.php"><i class="bi bi-search"></i></a>
<a href="wishlist.php"><i class="bi bi-suit-heart-fill"></i>
<span>(<?php echo $total_wishlist_items;?>)</span>
</a>
<a href="cart.php"><i class="bi bi-cart-plus-fill"></i>
<span>(<?php echo $total_cart_items;?>)</span>
</a>

 

    </div>
<?php
$query = "SELECT * FROM users"; // Change your_table_name to 
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

// Fetch and display data

$cont = 0;
while ($row = mysqli_fetch_assoc($result)) {
    if($row['id'] == $user_id){
   $username =  $row['name'];
   echo '<div class="dropdown" id="dropdownn">';
   echo '<h5>';
   echo  $username;
   echo '</h5>';
 echo'<button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">';
 echo '<div class="admin_logo">';
 echo '<i class="bi bi-person-fill">';
 echo '</i>';
 echo '</div>';
 echo '</button>';
 echo '<ul class="dropdown-menu bg-light" >';
   echo '<li>';
   echo '<a class="dropdown-item bg-info mb-2" href="update_profile_user.php">';
   echo 'Update Profile'; 
   echo '</a>';
   echo '</li>';
   echo '<li>';
   echo '<a class="dropdown-item bg-success mb-2" href="user_login.php">';
   echo 'Loing'; 
   echo '</a>';
   echo '</li>';

   echo '<li>';
   echo '<a class="dropdown-item bg-warning mb-2" href="user_register.php">';
   echo 'Register'; 
   echo '</a>';
   echo '</li>';
   echo '<li>';
   echo '<a class="dropdown-item bg-danger mb-2" href="user_logout.php">';
   echo 'Logout'; 
   echo '</a>';
   echo '</li>';
 echo '</ul>';
echo '</div>';
}
else{
if(!$user_id){
  echo '<div class="dropdown" id="dropdownn">';
  echo '<h5>';
  echo  'Login Frist';
  echo '</h5>';
echo'<button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">';
echo '<div class="admin_logo">';
// echo '<i class="bi bi-person-fill">';
echo '</i>';
echo '</div>';
echo '</button>';
echo '<ul class="dropdown-menu bg-light" >';
 
  echo '<li>';
  echo '<a class="dropdown-item bg-success mb-2" href="user_login.php">';
  echo 'Loing'; 
  echo '</a>';
  echo '</li>';

  echo '<li>';
  echo '<a class="dropdown-item bg-warning mb-2" href="user_register.php">';
  echo 'Register'; 
  echo '</a>';
  echo '</li>';
  
echo '</ul>';
echo '</div>';
break;
}
}
    $cont = $cont+1;
}

?>

</ul>
</div>
</nav><script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>