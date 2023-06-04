<!-- Cart page -->
<?php
// import config 
require_once('config/config.php');

// start the session for all files
session_start();
// check if the logout button clicked
if (isset($_POST['logout'])) {
    // unset the user id from the sessin variables
    unset($_SESSION['id']);
    // send him to the index
    header("Location:index.php");
}


if (isset($_POST['remove'])) {
    if ($_GET['action'] == 'remove') {
        foreach ($_SESSION['cart'] as $key => $value) {
            if ($value["product_id"] == $_GET['id']) {
                unset($_SESSION['cart'][$key]);
                echo "<script>alert('Product has been Removed...!')</script>";
            }
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

    <!-- breadcumps -->
    <section class="container mt-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item "><a href="index.php" class="primary-color">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Cart</li>
            </ol>
        </nav>
    </section>

    <!-- shopping cart summary -->
    <section class="container mt-5">
        <div class="row">
            <div class="col-md-9">
                <h2 class="fs-1 fw-bold text-dark">Shopping Cart</h2>
                <div class="text-dark">
                    <?php
                    if (isset($_SESSION['cart'])) {
                        $count = count($_SESSION['cart']);
                        echo "<span class='fw-bold'>$count</span>";
                    } else {
                        echo "<span class='fw-bold'>0</span>";
                    }
                    ?>

                    <span>item'(s) on the cart </span>
                </div>
                <?php
                $total = 0;
                if (isset($_SESSION['cart'])) { ?>

                    <table class="table  text-dark mt-4">
                        <thead>
                            <tr>
                                <th scope="col">Products</th>
                                <th scope="col">Name</th>
                                <th scope="col">Price</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $product_id = array_column($_SESSION['cart'], column_key: 'product_id');
                            $sql = "SELECT * FROM `products`";
                            $result = mysqli_query($conn, $sql);
                            while ($row = mysqli_fetch_assoc($result)) {
                                foreach ($product_id as $id) {
                                    if ($row['id'] == $id) { ?>
                                        <tr class="align-items-center">
                                            <td scope="row" class="ms-01 ">
                                                <a href="product.php?id=<?php echo $row['id'] ?>"><img src="<?php echo $row['image'] ?>-red.jpg" class="img-fluid " alt="<?php echo $row['name'] ?>"> </a>
                                            </td>
                                            <td scope="row" class="w-15 fw-bold">
                                                <a href="product.php?id=<?php echo $row['id'] ?>" class="w-75 text-dark ms-2"><?php echo $row['name'] ?></a>
                                            </td>
                                            <td scope="row" class="fw-bold w-15">$<?php echo $row['price'] ?></td>
                                            <td scope="row" class="w-15">
                                                <form action="cart.php?action=remove&id=<?php echo $row['id'] ?>" method="POST" class="cart-items">
                                                    <button type="submit" class="btn btn-danger " name="remove">Remove</button>
                                                </form>
                                            </td>
                                        </tr>
                            <?php
                                        $total = $total + $row['price'];
                                    }
                                }
                            } ?>
                        </tbody>
                    </table>
                <?php } else { ?>
                    <section class="mt-5 container">
                        <div class="row">
                            <div class="col-md-2 col-0"></div>
                            <div class="bg-white col-md-8 col-12">
                                <div class="text-center">
                                    <h3 class="fs-5 fw-bold">
                                        Uh ho!
                                    </h3>
                                    <p class="text-muted">Your Shopping Cart Is Empty</p>
                                    <a href="shop.php" class="btn shop-btn"> Take Me To Shop Now </a>
                                </div>
                            </div>
                            <div class="col-md-2 col-0"></div>
                        </div>
                    </section>
                <?php } ?>


            </div>
            <div class="col-md-3">
                <h2 class="fs-1 fw-bold text-dark ">Summary</h2>
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <div>

                        <?php
                        if (isset($_SESSION['cart'])) {
                            $count  = count($_SESSION['cart']);
                            echo "<h6>Price ($count items)</h6>";
                        } else {
                            echo "<h6>Price (0 items)</h6>";
                        }
                        ?>
                        <h6>Delivery Charges</h6>
                    </div>
                    <div>
                        <p class="text-dark">
                            $<?php echo $total; ?>
                        </p>
                        <h6 class="text-success">FREE</h6>
                    </div>
                </div>
                <div class="line bg-secondary w-100"></div>
                <p class="text-muted fs-12">Shipping and discount codes calculated at checkout.</p>
                <a href="info.php?total=<?php echo $total ?>" class="mt-3 btn w-100 shops-btn fw-bold">
                    Go To Checkout
                </a>
            </div>
        </div>
    </section>


    <!-- Email call -->
    <section class="mt-5 justify-content-center text-center container d-flex">
        <address class="me-5">
            <p class="text-dark">
                Email us
            </p>
            <a href="mailto:support@neon-magic.online" class="primary-color">
                support@neon-magic.online
            </a>
        </address>
        <address>
            <p class="text-dark">
                Call us
            </p>
            <a href="tel:+212 675543629" class="primary-color">
                +212 675543629
            </a>
        </address>
    </section>

    <?php
    // import the Footer
    require_once('includes/Footer.php')
    ?>