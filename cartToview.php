<?php
session_start();
error_reporting(0);
include 'wishlist_cart.php';
include 'user_header.php';
$host = "sql106.infinityfree.com"; // Change this to your database host
$username = "if0_35248209"; // Change this to your database username
$password = "YcylRBTta5"; // Change this to your database password
$database = "if0_35248209_rohitsenshop"; // Change this to your database name

try {
    // Create a PDO database connection
    $conn = new PDO("mysql:host=$host;dbname=$database", $username, $password);

    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
$user_id = $_SESSION['user_id']; 
?>

<!doctype html>
<html lang="en">
<head>
   
            <?php
            // Get the product ID from the query string
            $id = isset($_GET['id']) ? $_GET['id'] : 1;

            $select_products = $conn->prepare("SELECT * FROM `products` WHERE id=:id");
            $select_products->bindParam(':id', $id, PDO::PARAM_INT);
            $select_products->execute();

            // Loop through your products
            while ($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <form action="#" method="POST" class="slide">
                    <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
                    <input type="hidden" name="name" value="<?= $fetch_products['name']; ?>">
                    <div class="slidex">
                        <input type="hidden" name="price" value="<?= $fetch_products['price']; ?>">

                        <!-- Product image -->
                        <input type="hidden" name="image" value="<?= $fetch_products['image_1']; ?>">

                        <div class="container text-center">
                            <div class="row">
                                <div class="col">
                                    <img src="<?= $fetch_products['image_1']; ?>" alt="Image 2" width="200">
                                  
                                <div class="name"><?= $fetch_products['name']; ?></div>
                                <div class="price">$<span><?= $fetch_products['price']; ?></span>/-</div>
                                    <br>
                                </div>

                              
                            </div>
                            <div class="row" id="row2" style="height: 80px; overflow:none;">
                                <div class="image-preview-container" id="image-previews">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <?php
            }
            ?>
        </div>
    </div>

</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>
</html>



<?php

$host = "sql106.infinityfree.com"; // Change this to your database host
$username = "if0_35248209"; // Change this to your database username
$password = "YcylRBTta5"; // Change this to your database password
$database = "if0_35248209_rohitsenshop"; // Change this to your database name

// Create a database connection
$conn = mysqli_connect($host, $username, $password, $database);

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$imgid = $id;
?>



<?php
$query = "SELECT * FROM `products` WHERE `id` =  '$imgid'";

// Execute the query
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

// Check if any rows were returned
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $id = $row['id'];
    $name = $row['name'];
    $details = $row['details'];
    $price = $row['price'];
    $image1 = $row['image_1'];
    $image2 = $row['image_2'];
    $image3 = $row['image_3'];
}
?>



<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Quick view</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
          rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
          crossorigin="anonymous">
<!-- Extra script starts -->
<script>
    // JavaScript to update image previews and display clicked image
    document.addEventListener('DOMContentLoaded', function () {
        const imagePreviews = document.getElementById('image-previews');
        const images = [
            '<?php echo $image1; ?>',
            '<?php echo $image2; ?>',
            '<?php echo $image3; ?>'
        ];

        // Create and append image preview elements
        for (let i = 0; i < images.length; i++) {
            const imagePreview = document.createElement('img');
            imagePreview.src = images[i];
            imagePreview.className = 'image-preview';

            // Add a click event to display the clicked image
            imagePreview.addEventListener('click', function () {
                displayImage(images[i]);
            });

            imagePreviews.appendChild(imagePreview);
        }

        // Function to display the selected image in a modal
        function displayImage(imageSrc) {
            const modal = document.getElementById('image-modal');
            const modalImage = document.getElementById('modal-image');
            modalImage.src = imageSrc;
            modal.style.display = 'block';
        }

        // Close the modal when clicking outside the image
        const modal = document.getElementById('image-modal');
        modal.addEventListener('click', function () {
            modal.style.display = 'none';
        });
    });
</script>
<!-- Extra script ends -->



</head>
<style>




    body {
        background-color: #f0f0f0;
    }

    /* Add shadow to images */
    img {
        box-shadow: 3px 3px 5px 0px rgba(0, 0, 0, 0.5);
    }

    #row2 {
        margin-top: 20px;
    }

    #row2 > .col > img:hover {
        width: 100px;
        height: 81px;
    }

    /* Style for image preview container */
    .image-preview-container {
        display: flex;
        justify-content: space-between;
        margin-top: 10px;
        max-width: 300px;
        margin:0px;
        /* margin-left: 36%; */
    }

    /* Style for image previews */
    .image-preview {
        width: 80px;
        height: 80px;
        border: 1px solid #ddd;
        margin-right: 10px;
        cursor: pointer;
    }

    /* Highlight the selected image preview */
    .image-preview:hover {
        border: 2px solid #007bff;
        width: 82px;
        height: 82px;
    }

    /* Style for the clicked image container */
    .clicked-image-container {
        display: none;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: white;
        border: 1px solid #ccc;
        padding: 10px;
        z-index: 2;
        
    }

    /* Style for the clicked image */
    .clicked-image {
        max-width: 90%;
        max-height: 90%;
    }
</style>
<body>

<!-- Modal to display clicked image -->
<div id="image-modal" class="modal" style="max-width:400px; text-align:center; max-height:100%; margin-left:65%; margin-top:120px;">
    <span class="close" id="close-modal" style="background-color:gray; ">&times;</span>
    <img class="modal-content" id="modal-image">
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>
</html>
<?php
include('footer.php');
?>