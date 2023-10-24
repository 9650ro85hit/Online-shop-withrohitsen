<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Your Shop Name</title>
    <link rel="stylesheet" href="styles.css">
    
    <style>
/* Reset some default styles */
body, h1, h2, p, ul, li {
    margin: 0;
    padding: 0;
}

/* Apply a background color and font style */
body {
    background-color: #f4f4f4;
    font-family: Arial, sans-serif;
    line-height: 1.6;
}

/* Style the header and navigation */
header {
    background-color: #333;
    color: #fff;
    padding: 20px 0;
}

header h1 {
    font-size: 24px;
    margin: 0;
}

nav ul {
    list-style: none;
    float: right;
}

nav ul li {
    display: inline;
    margin-left: 20px;
}

nav ul li a {
    text-decoration: none;
    color: #fff;
}

nav ul li.active a {
    border-bottom: 2px solid #fff;
}

/* Create sections with background colors */
.containerer {
    max-width: 960px;
    margin: 0 auto;
    padding: 20px;
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    border-radius: 5px;
}

.about-section, .mission-section {
    background-color: #fff;
    margin-bottom: 20px;
    padding: 20px;
}

/* Style headings and paragraphs */
h2 {
    font-size: 28px;
    margin-bottom: 20px;
}

p {
    font-size: 16px;
    margin-bottom: 20px;
}

/* Style the footer */
footer {
    background-color: #333;
    color: #fff;
    text-align: center;
    padding: 10px 0;
}

/* Make the page responsive */
@media (max-width: 768px) {
    header {
        text-align: center;
    }

    nav ul {
        float: none;
        text-align: center;
        margin-top: 10px;
    }

    nav ul li {
        display: block;
        margin-bottom: 10px;
    }
}


    </style>
</head>
<body>
    <header>
       <?php
include('user_header.php');
       ?>
    </header>
    
    <section class="about-section">
        <div class="containerer">
            <h2>About Us</h2>
            <p>Welcome to RSshopie, your go-to destination for quality products.</p>
            <p>At Your Shop Name, we are passionate about providing our customers with the best shopping experience. We offer a wide range of products, from electronics to fashion, all carefully selected to meet your needs.</p>
            <p>Our mission is to make online shopping easy, convenient, and enjoyable. We believe in quality, affordability, and excellent customer service.</p>
        </div>
    </section>
    
    <section class="mission-section">
        <div class="containerer">
            <h2>Our Mission</h2>
            <p>Our mission is to provide you with a one-stop shop for all your needs. We aim to:</p>
            <ul>
                <li>Offer a diverse selection of high-quality products</li>
                <li>Ensure competitive prices and great value for your money</li>
                <li>Deliver a seamless and secure online shopping experience</li>
                <li>Provide top-notch customer support</li>
            </ul>
        </div>
    </section>
    
    <footer>
        <?php
include('footer.php');
        ?>
    </footer>
</body>
</html>
