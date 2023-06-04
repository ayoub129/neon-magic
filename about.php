<?php
require_once("config/config.php");

// start the session for all files
session_start();


// check if the logout button clicked
if (isset($_POST['logout'])) {
    // unset the user id from the sessin variables
    unset($_SESSION['id']);
    // send him to the index
    header("Location:index.php");
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}



$emailErr = "";

if (isset($_POST['sub'])) {
    $email = test_input($_POST["sub-email"]);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email format";
    }

    if ($emailErr == null) {
        $query = "INSERT INTO `subscribers` (`email`) VALUES ('$email')";
        $conn->query($query);
        header("Location: Thanks.php");
    } else {
        echo "<script>alert('Invalid email format ')</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
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
                            <i class="fa-solid fa-right-from-bracket"></i>
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
    <section class="mt-5 container">
        <div class="row align-items-center">
            <div class="col-md-6 col-12">
                <img src="assets/images/dream.jpg" alt="neon magic about image" class="img-fluid">
            </div>
            <div class=" col-md-6 col-12 mt-5">
                <h2 class="fs-2 fw-bold text-dark mb-3">Welcome to <a class="fw-bold text-dark" href="index.php"> <span class="primary-color">Neon</span> Magic</a>
                </h2>
                <p class="text-muted mt-1">
                    We are an independent online Store and we offer you the best offers on the highest quality Neon products.
                </p>
                <p class="text-muted mt-1">
                    <a class="fw-bold text-dark" href="index.php"> <a class="fw-bold text-dark" href="index.php"> <span class="primary-color">Neon</span> Magic</a> was built to provide you with the hottest and the best Neon Signs on the Internet.
                </p>

                <p class="text-muted mt-1">
                    We want you to know that we stand 100% behind the quality of our products. We believe in our products so much that we offer a 10 Days Money Back Guarantee. If there is ever any problem with your order, please send us an email at <span class="fw-bold text-dark">support@neon-magic.online</span>
                </p>

                <p class="text-muted mt-1">
                    Our goal here at <a class="fw-bold text-dark" href="index.php"> <span class="primary-color">Neon</span> Magic</a> is to amaze our customers, create customers for life, and be the number 1 Neon Sign Producers! Thank you and please feel free to reach out via email or contact us on our Social Media pages at any time.
                </p>
                <p class="text-muted mt-1">
                    Buy with confidence at <a class="fw-bold text-dark" href="index.php"> <span class="primary-color">Neon</span> Magic</a> - we will take care of the rest and make sure you are happy!
                </p>
                <p class="text-muted mt-1">
                    Team of <a class="fw-bold text-dark" href="index.php"> <span class="primary-color">Neon</span> Magic</a>
                </p>
            </div>
        </div>
    </section>
    <?php
    require_once("includes/footer.php")
    ?>
    <!-- finished about us page 100%-->