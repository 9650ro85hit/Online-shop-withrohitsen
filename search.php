<?php
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






<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Search</title>
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
  </style>
  <body>
   

<form action="" method="POST">
<input type="search" name="search" id="">

<button type="submit" name="submitt" class="btn btn-success">Search</button>



</form>



  
</div>
<?php
// if(isset($_POST['add_to_cart'])){
//   echo $_POST['pid'];
//   echo $_POST['name'];
//   echo $_POST['price'];
// }

?>

<!-- categry start -->

<!-- porduct section starts -->
<!-- Inside your product slider section -->



<section class="home-products">
  <h1 class="hedding">latest products</h1>

  <div class="products-sliderx">
    <div class="w">
      <?php
if(isset($_POST['submitt'])){
    $cont = 0;
    $searchTerm = '%' . $_POST['search'] . '%'; // Add wildcards to search for partial matches

    // Use prepared statement with placeholders
    $select_products = $pdo->prepare("SELECT * FROM products WHERE name LIKE :searchTerm");
    $select_products->bindParam(':searchTerm', $searchTerm, PDO::PARAM_STR);
    $select_products->execute();
      // Loop through your products
      while ($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)) {
        $cont  = $cont+1;
      ?>
      <form action="" method="POST" class="slide">
        <input type="hidden" name="pid" value= "<?=$fetch_products['id']; ?>" >
        <input type="hidden" name="name" value="<?= $fetch_products['name']; ?>">
        <div class="slidex">
        <input type="hidden" name="price" value="<?=$fetch_products['price'];?>">

          <!-- Product image -->
          <input type="hidden" name="image" value="<?= $fetch_products['image_1']; ?>">

          <!-- <input type="hidden" name="image" value="<? = $fetch_products['image_1']; ?>"> -->

          <button type="submit" name="add_to_wishlist"><i class="bi bi-heart-fill"></i></button>

<a href="quick_view.php?id=<?= $fetch_products['id']; ?>"><i class="bi bi-eye-fill"></i></a>

          <img src="<?=$fetch_products['image_1']; ?>" alt="" class="image">

          <!-- Product name and price -->
          <div class="name"><?=$fetch_products['name']; ?></div>
          <div class="price">$<span><?=$fetch_products['price']; ?></span>/-</div>

          <!-- Quantity input and add to cart button -->
          <div class="flex">
            <input type="number" name="qty" class="qty" min="1" max="99" value="1" onkeypress="if(this.value.length == 2) return false;">
            <input type="submit" value="add_to_cart" name="add_to_cart" class="btn">
          </div>
        </div>
        
        </form>
      <?php
      }
      if($cont<1){
        echo '<div class="alert alert-secondary alert-dismissible fade show" role="alert">
        <strong><i class="bi bi-emoji-frown fs-4 text-info"></i></strong> Product not found!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
      }
    }
      ?>
    </div>
  </div>



  <!-- Slider navigation controls -->
  <div class="slider-controls">
    <button class="prev-button" onclick="prevSlide()">Previous</button>
    <button class="next-button" onclick="nextSlide()">Next</button>
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


<?php

include 'footer.php';
?>