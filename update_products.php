<?php
// error_reporting(0);
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

$imgid = $_SESSION['id_to_upload'];
?>

<?php
if(isset($_POST['goback'])){
    header('location:addproduct.php');
    exit();
}
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
<?php
if($_SERVER["REQUEST_METHOD"] === "POST"){
    $rname = $_POST['product_name'];
    $rdetails = $_POST['product_details'];
    $rprice = $_POST['product_price'];
    $rid = $_POST['product_id'];
    $targetDir = "uploads/"; // Directory where you want to store the images
    $uploadOk = 1;

    // Function to check if a file was uploaded and if it's an image
    function isImage($file) {
        return isset($file) && $file["error"] === UPLOAD_ERR_OK && getimagesize($file["tmp_name"]) !== false;
    }

    $rimage1 = $image1; // Default to the existing image if not uploaded
    if (isImage($_FILES["img1"])) {
        $targetFile1 = $targetDir . basename($_FILES["img1"]["name"]);
        $imageFileType1 = strtolower(pathinfo($targetFile1, PATHINFO_EXTENSION));
        if (!in_array($imageFileType1, ["jpg", "jpeg", "png", "webp"])) {
            echo "Sorry, only JPG, JPEG, PNG & WEBP files are allowed for Image 1.";
            $uploadOk = 0;
        } else {
            if (!move_uploaded_file($_FILES["img1"]["tmp_name"], $targetFile1)) {
                echo "Sorry, there was an error uploading Image 1.";
                $uploadOk = 0;
            } else {
                $rimage1 = $targetFile1; // Set to the new image path if uploaded successfully
            }
        }
    }

    $rimage2 = $image2; // Default to the existing image if not uploaded
    if (isImage($_FILES["img2"])) {
        $targetFile2 = $targetDir . basename($_FILES["img2"]["name"]);
        $imageFileType2 = strtolower(pathinfo($targetFile2, PATHINFO_EXTENSION));
        if (!in_array($imageFileType2, ["jpg", "jpeg", "png", "webp"])) {
            echo "Sorry, only JPG, JPEG, PNG & WEBP files are allowed for Image 2.";
            $uploadOk = 0;
        } else {
            if (!move_uploaded_file($_FILES["img2"]["tmp_name"], $targetFile2)) {
                echo "Sorry, there was an error uploading Image 2.";
                $uploadOk = 0;
            } else {
                $rimage2 = $targetFile2; // Set to the new image path if uploaded successfully
            }
        }
    }

    $rimage3 = $image3; // Default to the existing image if not uploaded
    if (isImage($_FILES["img3"])) {
        $targetFile3 = $targetDir . basename($_FILES["img3"]["name"]);
        $imageFileType3 = strtolower(pathinfo($targetFile3, PATHINFO_EXTENSION));
        if (!in_array($imageFileType3, ["jpg", "jpeg", "png", "webp"])) {
            echo "Sorry, only JPG, JPEG, PNG & WEBP files are allowed for Image 3.";
            $uploadOk = 0;
        } else {
            if (!move_uploaded_file($_FILES["img3"]["tmp_name"], $targetFile3)) {
                echo "Sorry, there was an error uploading Image 3.";
                $uploadOk = 0;
            } else {
                $rimage3 = $targetFile3; // Set to the new image path if uploaded successfully
            }
        }
    }

    if ($uploadOk == 0) {
        echo "Sorry, your file(s) was/were not uploaded.";
    } else {
        // File checks passed, proceed to update the database
        $query =  "UPDATE `products` SET `name` = '$rname', `details` = '$rdetails', `image_1` = '$rimage1', `image_2` = '$rimage2', `image_3` = '$rimage3', `price` = '$rprice' WHERE `products`.`id` = $rid";

        if (mysqli_query($conn, $query)) {
            echo '<div class="alert alert-primary alert-dismissible fade show" role="alert">
            <strong>Holy guacamole!</strong> Product added successfully.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Update Products</title>
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
        margin-left: 36%;
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

<?php
if($_SERVER["REQUEST_METHOD"]){
    $imgid = $_SESSION['id_to_upload'];

    $query = "SELECT * FROM `products`";

    // Execute the query
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    } else {
        while ($row = mysqli_fetch_assoc($result)) {
            if($row['id'] == $imgid){
                echo '<div class="container text-center" >';
                echo '<div class="row">';
                echo '<div class="col">';
                echo '<img src="' . $row['image_1'] . '" alt="Image 1" width="200"><br>';
                echo '</div>';
                echo '</div>';
                echo '<div class="row" id="row2" style="height: 80px;">';
                echo '<div class="image-preview-container" id="image-previews">';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
        }
    }
}
?>
<div class="form_container">
    <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label" id="label">Product Name</label>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                   name="product_name" value='<?php echo $name; ?>'>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label" id="label">Product price</label>
            <input type="number" class="form-control" id="exampleInputPassword1" name="product_price" value='<?php echo $price; ?>'>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label" id="label">Image : 1</label>
            <input type="file" class="form-control" id="exampleInputPassword1" name="img1"
                   accept=".jpg,.png,.jpeg,.webp" value='<?php echo $image1; ?>'>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label" id="label">Image : 2</label>
            <input type="file" class="form-control" id="exampleInputPassword1" name="img2"
                   accept=".jpg,.png,.jpeg,.webp" value='<?php echo $image2; ?>'>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label" id="label">Image : 3</label>
            <input type="file" class="form-control" id="exampleInputPassword1" name="img3"
                   accept=".jpg,.png,.jpeg,.webp" value='<?php echo $image3; ?>'>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label" id="label">Product Details</label>
            <textarea name="product_details" id="" cols="30" rows="1"><?php echo $details; ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary" name="submit">Update</button>
        <button type="submit" class="btn btn-danger" name="goback">Go Back</button>
        <input type="number" class="form-control" id="exampleInputPassword1" name="product_id" value='<?php echo $id; ?>' hidden>
    </form>
</div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>
</html>
