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

// require the config DB
require_once("config/config.php");

// init the variables
$email = $msg = $name = $nameErr = $emailerr = $msgerr = "";

//  check if the contact form submited
if (isset($_POST['contact'])) {

    // security check function
    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // validate the name
    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
    } else {
        $name = test_input($_POST["name"]);
    }

    // validate the email
    if (empty($_POST["email"])) {
        $emailErr = "email is required";
    } else if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email format";
    } else {
        $email = test_input($_POST["email"]);
    }

    // validate the msg
    if (empty($_POST["message"])) {
        $msgerr = "message is required";
    } else {
        $msg = test_input($_POST["message"]);
    }


    // add new contact message
    if ($nameErr == null && $emailerr == null && $msgerr == null) {
        $sql = "INSERT INTO Contacts (`name` , `email` , `message`) VALUES ('$name' , '$email' , '$msg')";
        if (mysqli_query($conn, $sql)) {
            header("Location: thanks.php");
        }
    }
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


    <div class="row mt-5">
        <div class="col-md-2 col-0"></div>
        <div class="col-md-8 col-12">
            <div class="card p-3">
                <form method="POST" class="card-body" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <h5 class="card-title text-center mb-4">Contact Us</h5>
                    <div class="mb-3">
                        <label for="Name" class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" value="<?php echo $name ?>" id="Name" placeholder="Name">
                        <div class="text-danger fw-bold"> <?php echo $nameErr ?></div>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="<?php echo $email ?>" id="email" placeholder="Email Address">
                        <div class="text-danger fw-bold"> <?php echo $emailerr ?></div>
                    </div>
                    <div class="mb-3">
                        <label for="msg" class="form-label">Message</label>
                        <textarea rows="5" name="message" id="msg" class="form-control" value="<?php echo $msg ?>" placeholder="Message"></textarea>
                        <div class="text-danger fw-bold"> <?php echo $msgerr ?></div>
                    </div>
                    <button type="submit" name="contact" class="shop-btn w-100">Send</button>
                </form>
            </div>
        </div>
        <div class="col-md-2 col-0"></div>
    </div>
    <?php
    require_once("includes/footer.php")
    ?>

    <!-- finished -->