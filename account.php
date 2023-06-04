<!-- Account page -->
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

// get the user info
$user_id = $_SESSION['id'];

if (!isset($user_id)) {
    header('Location: Login.php');
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

    <!-- My Account -->
    <?php

    $sql = "SELECT * FROM `users` WHERE `id` = '$user_id'";
    $result = mysqli_query($conn, $sql);

    // pagination on orders
    $sql2 = "SELECT count(id) as nmbr_of_orders FROM `orders` WHERE `user_id` = '$user_id'";
    $result2 = mysqli_query($conn, $sql2);
    $row2 = mysqli_fetch_assoc($result2);

    if (!isset($_GET['page'])) {
        $page = 1;
    } else {
        $page = $_GET['page'];
    }
    $nbr_elemnts_per_page = 10;
    $nbr_page = ceil($row2['nmbr_of_orders'] / $nbr_elemnts_per_page);

    $start = ($page - 1) * $nbr_elemnts_per_page;
    $sql3 = "SELECT * FROM `orders` WHERE `user_id` = '$user_id'  ORDER BY `id` DESC  LIMIT $start , $nbr_elemnts_per_page";
    $result3 = mysqli_query($conn, $sql3);

    ?>
    <section class="mt-5 container">
        <div class="row">
            <div class="bg-white  col-12">
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <h2 class="text-dark fs-4 fw-bold mb-5">My Account Details</h2>
                    <p class="text-muted">
                        Email <br>
                        <span class="text-dark fw-bold"><?php echo $row['email'] ?> </span>
                    </p>
                    <p class="text-muted">
                        First Name <br>
                        <span class="text-dark fw-bold"><?php echo $row['firstname'] ?> </span>
                    </p>
                    <p class="text-muted">
                        Last Name <br>
                        <span class="text-dark fw-bold"><?php echo $row['lastname'] ?></span>
                    </p>
                    <?php if ($row['isAdmin'] == "true") { ?>
                        <a href="admin/products.php?page=1" class="text-danger">
                            Admin
                        </a>
                    <?php } ?>
                <?php } ?>
            </div>
        </div>
    </section>

    <?php if ($row2['nmbr_of_orders'] == 0) { ?>
        <section class="mt-5 container">
            <div class="row">
                <div class="col-md-2 col-0"></div>
                <div class="bg-white col-md-8 col-12">
                    <h2 class="text-dark fs-4 fw-bold mb-5">Order History</h2>
                    <div class="text-center">
                        <h3 class="fs-5 fw-bold">
                            Uh ho!
                        </h3>
                        <p class="text-muted">You haven't placed any orders yet.</p>
                        <a href="shop.php" class="btn shop-btn"> Take Me To Shop Now </a>
                    </div>
                </div>
                <div class="col-md-2 col-0"></div>
            </div>
        </section>
    <?php } else { ?>
        <!-- Orders summary -->
        <section class="container mt-5">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="fs-1 fw-bold text-dark">Orders History</h2>
                    <div class="text-dark">
                        <span class="fw-bold">
                            <?php
                            echo $row2['nmbr_of_orders'];
                            ?>
                        </span>
                        <span>Order</span>
                    </div>
                    <table class="table table-bordered text-dark mt-4">
                        <thead>
                            <tr>
                                <th scope="col">image</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">size</th>
                                <th scope="col">Total Price</th>
                                <th scope="col">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row3 = mysqli_fetch_assoc($result3)) {
                                $product_id = $row3["product_id"];
                            ?>
                                <tr class="ms-4 ">
                                    <?php
                                    $sql4 = "SELECT * FROM `products` WHERE `id` = '$product_id'";
                                    $result4 = mysqli_query($conn, $sql4);
                                    while ($row4 = mysqli_fetch_assoc($result4)) {  ?>
                                        <td scope="row" class="fw-bold w-15">
                                            <div class="cardhv bg-dark text-white fw-bold h-150">
                                                <a href="product.php?id=<?php echo $product_id ?>">
                                                    <img src="<?php echo $row4["image"] ?>-<?php echo $row3["color"] ?>.jpg" alt="<?php echo $row4["name"] ?>" class="img-fluid image">
                                                    <div class="background-overlay">
                                                        <h5 class="text-over text-white"><?php echo $row4['name'] ?></h5>
                                                    </div>
                                                </a>
                                            </div>
                                        </td>
                                        <td scope="row" class="w-15"><span class="mx-2 fw-bold"><?php echo $row3["Quantity"] ?></span></td>
                                        <td scope="row" class="w-15"><span class="mx-2 fw-bold"><?php echo $row3["size"] ?></span></td>
                                        <td scope="row" class="fw-bold w-15">$<?php echo $row4["price"] * $row3["Quantity"] ?></td>
                                    <?php } ?>
                                    <td scope="row" class="w-15"><span class="mx-2 fw-bold"><?php echo $row3["date"] ?></span></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <div class="text-center">
                        <div id="pagination" class="mt-5">
                            <?php
                            for ($i = 1; $i <= $nbr_page; $i++) {
                                echo "<a class='btn shop-btn' href='?page=" . $i . "'>" . $i . "</a>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php } ?>
    <!-- finished -->

    <?php
    // import the Footer
    require_once('includes/Footer.php')
    ?>