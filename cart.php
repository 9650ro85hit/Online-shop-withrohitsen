<?php
error_reporting(0);
// session_start();
include 'user_header.php';
include 'wishlist_cart.php';

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
$user_id = $_SESSION['user_id']; // Corrected variable name


?>


<?php

// Use prepared statement with placeholders
$select_wishlist = $pdo->prepare("SELECT * FROM cart WHERE user_id = :user_id");
$select_wishlist->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$select_wishlist->execute();

$cont = 0; // Initialize the count variable
$totalprice = 0;

// Loop through your products


while ($fetch_wishlist = $select_wishlist->fetch(PDO::FETCH_ASSOC)) {
    $cont++;
    $totalprice = $totalprice + $fetch_wishlist['price'];
    $id = $fetch_wishlist['id'];
    $pid  = $fetch_wishlist['pid'];
    $name = $fetch_wishlist['name'];
    $price  =$fetch_wishlist['price'];
    $quantity = $fetch_wishlist['quantity'];
    $image = $fetch_wishlist['image'];



}



?>

<?php
if(isset($_POST['submuit'])){
    $name = $_POST['name'];
    $number = $_POST['number'];
    $email = $_POST['email'];
    $payment_method = $_POST['pmethode'];
    $address = $_POST['address'];


    $qury = "INSERT INTO `orders` (`id`, `user_id`, `name`, `number`, `email`, `method`, `address`, `total_products`, `total_price`, `placed_on`, `payment_status`) VALUES (NULL, '$user_id', '$name', '$number', '$email', '$payment_method', '$address', '$cont', '$totalprice', current_timestamp(), 'panding');";
$result = mysqli_query($conn,$qury);

if($result){
  echo '<div class="alert alert-primary alert-dismissible fade show" role="alert">
  <strong><i class="bi bi-emoji-heart-eyes-fill fs-4 text-info"></i></strong> Order placed successfully!
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}
else{
    echo "data not inserted";
}

$quryy = "DELETE FROM `cart` WHERE `cart`.`user_id` = $user_id;";
$result = mysqli_query($conn,$quryy);

}



?>




<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
  </head>

  <style>


  .carousel-item {
    background-image: url('./images/backgrd.png');
    background-repeat: no-repeat; /* Prevent background image from repeating */
    background-size: cover; /* Cover the entire carousel item with the background image */
    background-position: center center;
    margin-top:40px;
    text-align: center;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 300px; /* Adjust the desired height */
    background-position: fixed;
  }

  .carousel-item img {
    max-width: 100%; /* Ensure the image fits within the container */
    max-height: 100%; /* Ensure the image fits within the container */
    width: auto;
    height: auto;
    margin: 0 auto; /* Center the image horizontally */
  }

  .carousel-caption {
    background: rgba(0, 0, 0, 0.5); /* Add a semi-transparent background to captions for better visibility */
    padding: 15px; /* Add padding to captions */
    color: white; /* Set text color */
  }

  .totalrate{
    
    background-color:gray;
    color:white;
    font-size:25px;
    text-align:center;
    overflow:none;
    margin-top:20px;

  }
  .totalrate>p>span{
    color:blue;
  }
  </style>
  <body>

</div>
<?php
// if(isset($_POST['add_to_cart'])){
//   echo $_POST['pid'];
//   echo $_POST['name'];
//   echo $_POST['price'];
// }


// ... (previous code)

if(isset($_POST['delete'])){
    // Get the item ID to be deleted
    
    $itemIDToDelete = $_POST['pid']; // Assuming 'pid' is the identifier for the item to delete
    $query = "DELETE FROM `cart` WHERE `cart`.`id` = $itemIDToDelete";
    $result = mysqli_query($conn,$query);
    if($result){
        echo '<div class="alert alert-primary alert-dismissible fade show" role="alert">
        <strong><i class="bi bi-trash3-fill fs-4 text-danger"></i></strong> Item deleted successfully!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
    
}
// ... (rest of your code)


?>


<!-- categry start -->

<!-- porduct section starts -->
<!-- Inside your product slider section -->



<section class="home-products">
  <h1 class="hedding">Shoping Cart</h1>

  <div class="products-sliderx">
    <div class="w">
      <?php

        // Use prepared statement with placeholders
        $select_wishlist = $pdo->prepare("SELECT * FROM cart WHERE user_id = :user_id");
        $select_wishlist->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $select_wishlist->execute();
    
        $cont = 0; // Initialize the count variable
        $totalprice = 0;
       
        // Loop through your products
      

        while ($fetch_wishlist = $select_wishlist->fetch(PDO::FETCH_ASSOC)) {
            $cont++;
            $totalprice = $totalprice + $fetch_wishlist['price'];
      ?>
      
      <form action="" method="POST" class="slide">
        <input type="hidden" name="pid" value= "<?=$fetch_wishlist['id']; ?>" >
       
        <input type="hidden" name="name" value="<?= $fetch_wishlist['name']; ?>">
        <div class="slidex">
        <input type="hidden" name="price" value="<?=$fetch_wishlist['price'];?>">
          <!-- Product image -->
          
          <input type="hidden" name="image" value="<?= $fetch_wishlist['image']; ?>">

          <!-- <input type="hidden" name="image" value="<? = $fetch_wishlist['image']; ?>"> -->

         

<a href="quick_view.php?id=<?= $fetch_wishlist['pid']; ?>"><i class="bi bi-eye-fill"></i></a>

          <img src="<?=$fetch_wishlist['image']; ?>" alt="" class="image">

          <!-- Product name and price -->
          <div class="name"><?=$fetch_wishlist['name']; ?></div>
          <div class="price">$<span><?=$fetch_wishlist['price']; ?></span>/-</div>

          <!-- Quantity input and add to cart button -->
          <div class="flex">
            <input type="number" name="qty" class="qty" min="1" max="99" value="1" onkeypress="if(this.value.length == 2) return false;">
            <input type="submit" value="edit" name="caledit" class="btn"> 
            <div class="btns">
            
            <input type="submit" value="delete" name="delete" class="btn" style="background-color:brown";>
            </div>
 
          </div>
                <?php
                        // $subprice = 0;
                        // if(isset($_POST['caledit'])){
                        // $noi = $_POST['qty'];
                        // $itemp = $_POST['price'];
                        // $subprice =  $noi * $itemp;
                        // $totalprice = $totalprice + $subprice;
                        // $totalprice = $totalprice - $itemp;
                        // echo $_POST['pid'];
                        // }
                    ?>
        </div>
        <!-- <div class="totalrate">
            <p>Grand subitem: <span>$<?php echo $subprice ?></span>/-</p>
        </div> -->
        </form>
      <?php
      }


      if($cont<1){
        echo '<div class="alert alert-secondary alert-dismissible fade show" role="alert">
        <strong><i class="bi bi-emoji-sad fs-4 text-info"></i></strong>  wishlist empty!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
      }
    
      ?>
    </div>
  </div>



  <!-- Slider navigation controls -->
  <div class="slider-controls">
    <button class="prev-button" onclick="prevSlide()">Previous</button>
    <button class="next-button" onclick="nextSlide()">Next</button>
  </div>
        <div class="totalrate">
            <p>Grand Total: <span>$<?php echo $totalprice ?></span>/-</p>
        </div>
</section>



<!-- porduct section ends -->

<script>
  // JavaScript for slider navigation
  let slideIndex = 0;
  const slides = document.querySelectorAll('.slidex');
  const maxSlides = Math.ceil(slides.length /3); // Assuming 3 slides are displayed at a time

  function showSlides() {
    for (let i = 0; i < slides.length; i++) {
      slides[i].style.display = 'none';
    }

    // Display the current set of slides (3 at a time)
    for (let i = slideIndex * 6; i < (slideIndex + 1) * 6 && i < slides.length; i++) {
      slides[i].style.display = 'block';
    }
  }

  function prevSlide() {
    slideIndex--;
    if (slideIndex < 0) {
      slideIndex = maxSlides - 1;
    }
    showSlides();
  }

  function nextSlide() {
    slideIndex++;
    if (slideIndex >= maxSlides) {
      slideIndex = 0;
    }
    showSlides();
  }

  // Show the first set of slides initially
  showSlides();
</script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>
  
<h1 class="text-center">Make order please</h1>
<form method="POST">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Name</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="name">
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Number</label>
    <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="number">
  </div>

  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Email address</label>
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email">
  </div>

  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label"> Payment Method</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="pmethode">
  </div>

  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label" >Full Address</label>
   <textarea name="address" id="" cols="10" rows="1"></textarea>
  </div>




  <button type="submit" class="btn btn-primary" name="submuit">Submit</button>
</form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>

<?php

include 'footer.php';
?>