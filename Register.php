<!-- Register page -->
<?php
// start the session for all files
session_start();
// check if the logout button clicked
if (isset($_SESSION['id'])) {
    // send him to the index
    header("Location:index.php");
}

// import config 
require_once('config/config.php');


// init the variables
$email = $lname = $fname = $passerr = $emailerr = $fnameerr  = $lnameerr = '';

// whene the form submited
if (isset($_POST["register"])) {

    // security functions on input to prevent xss
    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // email validation
    if (empty($_POST["email"])) {
        $emailerr = "email is required";
    } else if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $emailerr = "Invalid email format";
    } else {
        $email = test_input($_POST["email"]);
    }

    // first name required
    if (empty($_POST["fname"])) {
        $fnameerr = "FirstName is required";
    } else {
        $fname = test_input($_POST["fname"]);
    }

    // last name required
    if (empty($_POST["lname"])) {
        $lnameerr = "LastName is required";
    } else {
        $lname = test_input($_POST["lname"]);
    }

    //  password required
    if (empty($_POST["password"])) {
        $passerr = "password is required";
    } else {
        $password = test_input($_POST["password"]);
        $hash_pass = password_hash("$password", PASSWORD_BCRYPT);
    }

    //   insert new user on the database if there are no err
    if ($passerr == null && $emailerr == null && $lnameerr == null && $fnameerr == null) {
        $sql = "INSERT INTO `users` (`firstname` , `lastname` , `email` , `password` , `isAdmin`) VALUES ('$lname' , '$lname' , '$email' , '$hash_pass' , 'false') ";
        if (mysqli_query($conn, $sql)) {
            header("Location:login.php");
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

    <section class="mt-5">
        <form class="row" method="POST">
            <div class="col-sm-3 col-12"></div>
            <div class="col-sm-6 col-12">
                <div class="card  w-100">
                    <i class="fas p-4 text-center primary-color fa-user fa-3x" alt="account"></i>
                    <div class="card-body p-4">
                        <div class="mb-5">
                            <label for="FirstName" class="form-label">FirstName</label>
                            <input type="FirstName" value="<?php echo $fname ?>" name="fname" class="form-control" id="FirstName" placeholder="FirstName">
                            <span class="text-danger fw-bold"><?php echo $fnameerr ?></span>
                        </div>
                        <div class="mb-5">
                            <label for="LastName" class="form-label">LastName</label>
                            <input type="LastName" value="<?php echo $lname ?>" name="lname" class="form-control" id="LastName" placeholder="LastName">
                            <span class="text-danger fw-bold"><?php echo $lnameerr ?></span>
                        </div>
                        <div class="mb-5">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" value="<?php echo $email ?>" name="email" class="form-control" id="email" placeholder="name@example.com">
                            <span class="text-danger fw-bold"><?php echo $emailerr ?></span>
                        </div>
                        <div class="mb-5">
                            <label for="pass" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" id="pass">
                            <span class="text-danger fw-bold"><?php echo $passerr ?></span>
                        </div>
                        <button type="submit" name="register" class="shops-btn w-100">
                            Register
                        </button>
                    </div>
                    <div class="card-footer ">
                        <p class="text-muted">
                            You Already Have An Account ? <a class="link" href="login.php">Log in</a>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-sm-3 col-12"></div>
        </form>
    </section>

    <?php
    // import the Footer
    require_once('includes/Footer.php')
    ?>
    <!-- Finished -->