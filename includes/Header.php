<?php
// start the session for all files
session_start();

// check if the logout button clicked
if (isset($_POST['logout'])) {
    // unset the user id from the sessin variables
    unset($_SESSION['id']);
    // send him to the index
    header("Location:index.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- OWL cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.css">
    <!-- font awsome cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <!-- our custome style -->
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Neon Magic</title>
</head>

<body>

    <div class="small-header">
        <div class="free-shipping">
            <i class="fa-solid fa-truck-fast"></i>
            <span>Free Shipping</span>
        </div>
        <div class="satisfied">
            <i class="fa-regular fa-thumbs-up"></i>
            <span>Satisfied Customer</span>
        </div>
        <div class="ten-days">
            <i class="fa-regular fa-clock"></i>
            <span>Get Your Neon Sign in under 10 days</span>
        </div>
    </div>

    <header>
        <div class="header-up">
            <div class="header-up-design-search">
                <a href="Design.php"><button class="design-btn">Design Your Neon Sign</button></a>
                <a href="shop.php"><i class="fa-solid fa-magnifying-glass search-icon"></i></a>
            </div>
            <a href="index.php" class="logo">
                <img src="assets/images/logo.png" alt="logo">
            </a>
            <div class="hashtag-cart-account">
                <a href="https://www.instagram.com/neon_magic.ma/" class="hashtag"><img src="assets/images/insta.png" alt="instagram"> #Neon.Magic</a>
                <a href="cart.php" class="cart" id="cart">
                    <i title="cart" class="fa-solid fa-bag-shopping"></i>
                    <span id="card-num"></span>
                </a>
                <a href="account.php">
                    <i title="account" class="fa-regular fa-circle-user"></i>
                </a>
                <?php if (isset($_SESSION["id"])) { ?>
                    <form method="post">
                        <button class="btn-none" name="logout" type="submit">
                            <i title="logout" class="fa-solid fa-right-from-bracket"></i>
                        </button>
                    </form>
                <?php  } ?>
                <i class="fa-solid fa-bars" id="hamburger"></i>
            </div>
        </div>

        <nav class="navigation-menu">
            <ul>
                <li><a href="shop.php">Shop</a></li>
                <li><a href="Design.php">Create Your Own</a></li>
                <li><a href="about.php">About Us</a></li>
                <li><a href="Upload.php">Upload Your Logo</a></li>
            </ul>
            <div class="support-vid">
                <a href="contact.php" class="customer-service"><i class="fa-solid fa-headset"></i> Contact Us</a>
                <a href="https://www.tiktok.com/@neon_magic_ma" class="tiktok"><i class="fa-brands fa-tiktok"></i> Tiktok </a>
            </div>
        </nav>

        <nav class="mobile-navigation" id="mobile-nav">
            <ul>
                <li>
                    <i class="fas fa-times" id="times"></i>
                </li>
                <li>
                    <a href="shop.php">Shop</a>
                </li>
                <li>
                    <a href="Design.php">Create Your Own</a>
                </li>
                <li>
                    <a href="about.php">About Us</a>
                </li>
                <li>
                    <a href="Upload.php">Upload Your Logo</a>
                </li>
                <li>
                    <a href="contact.php" class="customer-service"><i class="fa-solid fa-headset"></i> Contact Us</a>
                </li>
                <li>
                    <a href="https://www.tiktok.com/@neon_magic_ma" class="tiktok"><i class="fa-brands fa-tiktok"></i> Tiktok </a>
                </li>
            </ul>
        </nav>
    </header>