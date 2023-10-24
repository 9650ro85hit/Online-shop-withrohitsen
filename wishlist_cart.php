<?php
// session_start();
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
    $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
  }

 
?>

<?php
if(isset($_POST['add_to_wishlist'])){


    if($user_id == ''){
        header('location:user_login.php');
    } else {
        $pid = $_POST['pid'];
        $name = $_POST['name'];
        $price = $_POST['price']; // Make sure you have a hidden input field with the name 'price' in your form
        $image = $_POST['image'];
        
        $check_wishlist_numbers = $conn->prepare("SELECT * FROM `wishlist` WHERE name=? AND user_id=?");
        if (!$check_wishlist_numbers) {
            die("Prepare failed: " . $conn->error);
        }
        $check_wishlist_numbers->bind_param("si", $name, $user_id); // Bind parameters
        $check_wishlist_numbers->execute(); // Execute the prepared statement
        $check_wishlist_numbers->store_result(); // Store the result
        
        $check_cart_numbers = $conn->prepare("SELECT * FROM `cart` WHERE name=? AND user_id=?");
        if (!$check_cart_numbers) {
            die("Prepare failed: " . $conn->error);
        }
        $check_cart_numbers->bind_param("si", $name, $user_id); // Bind parameters
        $check_cart_numbers->execute(); // Execute the prepared statement
        $check_cart_numbers->store_result(); // Store the result
        
        if($check_wishlist_numbers->num_rows > 0){
         
            echo '<div class="alert alert-secondary alert-dismissible fade show" role="alert">
            <strong><i class="bi bi-emoji-sad fs-4 text-info"></i></strong>already added to wishlist!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        } elseif($check_cart_numbers->num_rows > 0){
            echo '<div class="alert alert-secondary alert-dismissible fade show" role="alert">
            <strong><i class="bi bi-emoji-sad fs-4 text-info"></i></strong>already added to cart!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
          
            
        } else {
            $insert_wishlist = $conn->prepare("INSERT INTO `wishlist` (user_id, pid, name, price, image) VALUES (?, ?, ?, ?, ?)");
            if (!$insert_wishlist) {
                die("Prepare failed: " . $conn->error);
            }
            $insert_wishlist->bind_param("iisds", $user_id, $pid, $name, $price, $image); // Bind parameters
            $insert_wishlist->execute(); // Execute the prepared statement
            echo '<div class="alert alert-primary alert-dismissible fade show" role="alert">
            <strong><i class="bi bi-emoji-sad fs-4 text-info"></i></strong>Added to wishlist!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
            
            // Close the prepared statement
            $insert_wishlist->close();
        }
        
        // Close the prepared statements
        $check_wishlist_numbers->close();
        $check_cart_numbers->close();
    }
}

// add to cart

if(isset($_POST['add_to_cart'])){
    if($user_id == ''){
        header('location:user_login.php');
    } else {
        $pid = $_POST['pid'];
        $name = $_POST['name'];
        $price = $_POST['price']; // Make sure you have a hidden input field with the name 'price' in your form
        $image = $_POST['image'];
        $qty = $_POST['qty'];
        
        $check_wishlist_numbers = $conn->prepare("SELECT * FROM `wishlist` WHERE name=? AND user_id=?");
        if (!$check_wishlist_numbers) {
            die("Prepare failed: " . $conn->error);
        }
        $check_wishlist_numbers->bind_param("si", $name, $user_id); // Bind parameters
        $check_wishlist_numbers->execute(); // Execute the prepared statement
        $check_wishlist_numbers->store_result(); // Store the result
        
        $check_cart_numbers = $conn->prepare("SELECT * FROM `cart` WHERE name=? AND user_id=?");
        if (!$check_cart_numbers) {
            die("Prepare failed: " . $conn->error);
        }
        $check_cart_numbers->bind_param("si", $name, $user_id); // Bind parameters
        $check_cart_numbers->execute(); // Execute the prepared statement
        $check_cart_numbers->store_result(); // Store the result
        
        if($check_cart_numbers->num_rows > 0){
            echo '<div class="alert alert-secondary alert-dismissible fade show" role="alert">
            <strong><i class="bi bi-emoji-sad fs-4 text-info"></i></strong> Already added!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        } else {
            $check_wishlist_numbers = $conn->prepare("SELECT * FROM `wishlist` WHERE name=? AND user_id=?");
            if (!$check_wishlist_numbers) {
                die("Prepare failed: " . $conn->error);
            }
            $check_wishlist_numbers->bind_param("si", $name, $user_id); // Bind parameters
            $check_wishlist_numbers->execute(); // Execute the prepared statement
            $check_wishlist_numbers->store_result(); // Store the result
            
            if($check_wishlist_numbers->num_rows > 0){
                $delete_wishlist = $conn->prepare("DELETE FROM `wishlist` WHERE name=? AND user_id =?");
                if (!$delete_wishlist) {
                    die("Prepare failed: " . $conn->error);
                }
                $delete_wishlist->bind_param("si", $name, $user_id); // Bind parameters
                $delete_wishlist->execute(); // Execute the prepared statement
                $delete_wishlist->close();
            }
            
            $insert_cart = $conn->prepare("INSERT INTO `cart` (user_id, pid, name , price, quantity, image) VALUES (?, ?, ?, ?, ?, ?)");
            if (!$insert_cart) {
                die("Prepare failed: " . $conn->error);
            }
            $insert_cart->bind_param("iisiis", $user_id, $pid, $name, $price, $qty, $image); // Bind parameters
            $insert_cart->execute(); // Execute the prepared statement
            echo '<div class="alert alert-primary alert-dismissible fade show" role="alert">
            <strong><i class="bi bi-emoji-sad fs-4 text-info"></i></strong> Added to cart!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        //   echo $name;
            
            // Close the prepared statement
            $insert_cart->close();
        }
        
        // Close the prepared statements
        $check_wishlist_numbers->close();
        $check_cart_numbers->close();
    }
}


?>