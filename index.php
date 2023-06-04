<!-- home page -->
<?php
// import config 
require_once('config/config.php');


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

// import the header
require_once('includes/Header.php');
?>

<!-- hero section -->
<div class="hero fix">
    <div class="hero-content">
        <div class="content">
            <h1>Light Up Boring Walls With Custom Neon Signs</h1>
            <p>The fastes, most affordable personalized LED Neon Signs out there. Choose one of 100+ ready-made designs or make your own with the help of our user-friendly design creation tool</p>
            <a href="shop.php">
                <button class="shop-btn">Shop our signs</button>
            </a>
        </div>
    </div>
    <div class="absolute-card">
        <div class="card-reviews">
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <span>(4.9)</span>
        </div>
        <div class="afford">
            <i class="fa-solid fa-coins" style="color:#28a745"></i>
            <span>100% Affordable</span>
        </div>
        <div class="energy">
            <i class="fa-solid fa-bolt"></i>
            <span>Energy Efficient</span>
        </div>
        <div class="based">
            <img src="assets/images/flag.png" alt="morocco flag">
            morocco Based
        </div>
    </div>
</div>

<!-- customize -->
<div class="customize">
    <div class="customize-content">
        <div class="text">
            <h2>customize your own led neon sign</h2>
            <p>Use our powerful customizer to create your own neon sign! Stylize text, choose your own font color and even the instalation type</p>
            <a href="Design.php">
                <button class="customize-btn">Customize Your Own Sign Now</button>
            </a>
        </div>
        <div class="images">
            <img src="assets/images/pc.png" alt="site-image">
        </div>
    </div>
</div>

<!-- collections -->
<div class="collections">
    <div class="collection-main">
        <img src="assets/images/love.jpg" alt="love">
        <a href="http://localhost/neon-magic/shop.php">All Collections</a>
    </div>
    <div class="neon-collections">
        <h2>Our Neon Signs Collection</h2>
        <p>Illuminating Your Style with Our Radiant Collection</p>
        <div class="collection-slides">
            <?php
            $sql = "SELECT * FROM `collections` LIMIT 4";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                // output data of each row
                while ($row = mysqli_fetch_assoc($result)) {
            ?>
                    <div class="collection-slide">
                        <img src="<?php echo $row['image'] ?>" alt="<?php echo $row['name'] ?>">
                        <a href="http://localhost/neon-magic/shop.php?collection=<?php echo $row['id'] ?>"><?php echo $row['name'] ?></a>
                    </div>
            <?php
                }
            } else {
                echo "0 results";
            }
            ?>

        </div>
        <a href="shop.php">
            <button class="shop-btn">See All Our Collections</button>
        </a>
    </div>
</div>

<!-- Event -->
<div class="Event">
    <div class="Event-content">
        <div class="images">
            <img src="assets/images/idea.png" alt="site-image">
        </div>
        <div class="text">
            <h2 class="d-block"><span>Neon Sign</span> <br> For Your events</h2>
            <h2 class="d-none"><span>Neon Sign</span> For Your events</h2>
            <p>If you are looking to add statement signage to the entrance or the lobby area, look no further. Didcuss your ideas with our creative team and you will not be disappointed</p>
            <a href="Contact.php">
                <button class="contact-btn">Contact us</button>
            </a>
        </div>
    </div>
</div>

<!-- business -->
<div class="business">
    <div class="text">
        <h2 class="d-block">Led Neon Signs <br> For Businesses</h2>
        <h2 class="d-none">Led Neon Signs For Businesses</h2>
        <p>We provide custome LED neon lights to bring life to your office, shop window, and other places. it's as easy as uploading your company name and logo, tagline, or artwork. we want to make sure the design is what you're looking for, so we send you a free mockup.</p>
        <a href="shop.php">
            <button class="shops-btn">Shop Our Signs</button>
        </a>
    </div>
    <div class="images-grid">
        <div class="card-one">
            <div class="card-content">
                <h4>I already have an image or logo</h4>
                <a href="Upload.php">
                    <button class="card-btn">Upload Your Image</button>
                </a>
            </div>
        </div>
        <div class="card-two">
            <div class="card-content">
                <h4>Customize Your Own LED Neon Sign</h4>
                <a href="Design.php">
                    <button class="card-btn">Customize Now</button>
                </a>
            </div>
        </div>
    </div>
    <img src="assets/images/wave.svg" alt="wave" class="svg">
</div>

<!-- Feautured products -->
<div class="feautured-products">
    <h2>You might like these</h2>
    <p>Handpicked for you by our editors!</p>
    <div class="products-grid">
        <?php
        $sql = "SELECT * FROM `products` LIMIT 4";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while ($row = mysqli_fetch_assoc($result)) {
        ?>
                <div class="product-card">
                    <img src="<?php echo $row['image'] ?>-red.jpg" alt="<?php echo $row['name'] ?>" class="product-image">
                    <div class="text">
                        <a href="Product.php?id=<?php echo $row['id'] ?>">
                            <h4><?php echo $row['name'] ?></h4>
                        </a>
                        <h3>
                            <span><?php echo $row['sale'] ?>DH</span>
                            <sup><del><?php echo $row['price'] ?> DH</del></sup>
                        </h3>
                    </div>
                </div>
        <?php
            }
        } else {
            echo "0 results";
        }
        ?>
    </div>
    <a href="shop.php">
        <button class="shop-btn">See More Neon Signs</button>
    </a>
</div>

<div class="special">
    <h2>See our signs in the most special spaces <a href="https://www.instagram.com/neon_magic.ma/">#neon-magic</a> </h2>
    <div class="special-grid">
        <div class="special-grid-item-1">
            <img src="assets/images/neon-one.jpg" alt="neon one">
        </div>
        <div class="special-grid-item">
            <img src="assets/images/neon-two.jpg" alt="neon two">
        </div>
        <div class="special-grid-item">
            <img src="assets/images/neon-three.jpg" alt="neon three">
        </div>
        <div class="special-grid-item">
            <img src="assets/images/neon-four.jpg" alt="neon four">
        </div>
        <div class="special-grid-item">
            <img src="assets/images/neon-five.jpg" alt="neon five">
        </div>
    </div>
</div>

<?php
// import the Footer
require_once('includes/Footer.php')
?>


<!-- Finished 100%  -->