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
// Handle update button click
if (isset($_POST['update'])) {
    $imageId = $_POST['image_id'];
    session_start();
    $_SESSION['id_to_upload'] = $imageId;
    header("Location: update_products.php");
    exit; // Make sure to exit after setting the header to prevent further execution
}
?>



<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_details = $_POST['product_details'];

    // Handle image uploads
    $targetDir = "uploads/"; // Directory where you want to store the images
    $uploadOk = 1;

    // Process each image input separately
    $targetFile1 = $targetDir . basename($_FILES["img1"]["name"]);
    $imageFileType1 = strtolower(pathinfo($targetFile1, PATHINFO_EXTENSION));

    $targetFile2 = $targetDir . basename($_FILES["img2"]["name"]);
    $imageFileType2 = strtolower(pathinfo($targetFile2, PATHINFO_EXTENSION));

    $targetFile3 = $targetDir . basename($_FILES["img3"]["name"]);
    $imageFileType3 = strtolower(pathinfo($targetFile3, PATHINFO_EXTENSION));

    // Check if image file is a valid format
    foreach ([$_FILES["img1"], $_FILES["img2"], $_FILES["img3"]] as $file) {
        if (!isset($file) || $file["error"] !== UPLOAD_ERR_OK) {
            echo "File is not an image or there was an error uploading.";
            $uploadOk = 0;
            break; // Break the loop if any of the files is not an image or has an upload error
        }
        $check = getimagesize($file["tmp_name"]);
        if ($check === false) {
            echo "File is not an image.";
            $uploadOk = 0;
            break; // Break the loop if any of the files is not an image
        }
    }

    // Check file size (you can adjust the maximum file size)
    foreach ([$_FILES["img1"], $_FILES["img2"], $_FILES["img3"]] as $file) {
        if ($file["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
            break; // Break the loop if any of the files is too large
        }
    }

    // Allow certain file formats
    foreach ([$imageFileType1, $imageFileType2, $imageFileType3] as $fileType) {
        if (!in_array($fileType, ["jpg", "png", "jpeg", "webp"])) {
            echo "Sorry, only JPG, JPEG, PNG & WEBP files are allowed.";
            $uploadOk = 0;
            break; // Break the loop if any of the files has an invalid format
        }
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file(s) was/were not uploaded.";
    } else {
        // If everything is ok, try to upload files and insert data into the database
        if (
            move_uploaded_file($_FILES["img1"]["tmp_name"], $targetFile1) &&
            move_uploaded_file($_FILES["img2"]["tmp_name"], $targetFile2) &&
            move_uploaded_file($_FILES["img3"]["tmp_name"], $targetFile3)
        ) {
            // File uploaded successfully, now insert data into the database
            $query = "INSERT INTO products (name, price, details, image_1, image_2, image_3) VALUES ('$product_name', '$product_price', '$product_details', '$targetFile1', '$targetFile2', '$targetFile3')";

            if (mysqli_query($conn, $query)) {
                echo '<div class="alert alert-primary alert-dismissible fade show" role="alert">
                <strong>Holy guacamole!</strong>Product added successfully.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        } else {
            echo "Sorry, there was an error uploading your file(s).";
        }
    }
}
?>

<?php
// Handle delete button click
if (isset($_POST['delete'])) {
    $imageId = $_POST['image_id'];

    // Perform the delete operation using the image ID
    $query = "DELETE FROM `products` WHERE `id` = $imageId";

    if (mysqli_query($conn, $query)) {
        echo "Image with ID $imageId has been deleted.";
    } else {
        echo "Error deleting image: " . mysqli_error($conn);
    }
}
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Products</title>
</head>
<body>
<h2 style="text-align:center; color:white; background-color:black; ">Add Products</h2>
<div class="form_container">
    <form method="POST" enctype="multipart/form-data">
        <div class="mb-3 ">
            <label for="exampleInputEmail1" class="form-label" id="label">Product Name</label>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                   name="product_name">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label" id="label">Product price</label>
            <input type="number" class="form-control" id="exampleInputPassword1" name="product_price">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label" id="label">Image : 1</label>
            <input type="file" class="form-control" id="exampleInputPassword1" name="img1"
                   accept=".jpg,.png,.jpeg,.webp">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label" id="label">Image : 2</label>
            <input type="file" class="form-control" id="exampleInputPassword1" name="img2"
                   accept=".jpg,.png,.jpeg,.webp">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label" id="label">Image : 3</label>
            <input type="file" class="form-control" id="exampleInputPassword1" name="img3"
                   accept=".jpg,.png,.jpeg,.webp">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label" id="label">Product Details</label>
            <textarea name="product_details" id="" cols="30" rows="1" maxlength="250"></textarea>
        </div>
        <button type="submit" class="btn btn-primary " name="submit">Submit</button>
    </form>
</div>


<!-- image show section start -->
<style>

   
    .image-frame {
        border: 2px solid #ccc;
        padding: 10px;
        margin: 10px;
        display: inline-block;}
.btn{
    margin: 20px;

}
</style>

<div class="row">
    <div class="col">

    <?php
if($_SERVER["REQUEST_METHOD"]){
$username = $_POST['name'];
$pass = $_POST['pass'];
$cpass = $_POST['cpass'];
if(isset($_POST['submit'])){
    $query = "SELECT * FROM `products`";

    // Execute the query
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }
    else{
        

        while ($row = mysqli_fetch_assoc($result)) {
            echo '<div class="image-frame">';
            echo '<img src="' . $row['image_2'] . '" alt="Image 2" width="200"><br>';
            echo '<form method="POST" action="">'; // Add a form for each image
            echo '<input type="hidden" name="image_id" value="' . $row['id'] . '">'; // Hidden field to store image ID
            echo '<button type="submit" class="btn btn-primary" name="update">Update</button>';
            echo '<button type="submit" class="btn btn-danger" name="delete">Delete</button>';
            echo '</form>';
            echo '</div>';
 
            // echo "<br>";
        }

    }
    // Check if any rows were returned
    

       
}

}



?>

    </div>
</div>










<!-- image show section ends -->

</body>
</html>
