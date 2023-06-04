<!-- Shop page -->
<?php
// import config 
require_once('config/config.php');


// add to cart functionality
if (isset($_POST['add'])) {
    // check if the session exist
    if (isset($_SESSION['cart'])) {
        //  get the product id that on cart
        $item_arr_id = array_column($_SESSION['cart'], column_key: "product_id");
        // check if the product already on cart 
        if (in_array($_POST['product_id'], $item_arr_id)) {
            // display an alert
            echo '<script>alert("product is already added to the cart")</script>';
            // if the product not on cart add it
        } else {
            // see how much item on the cart
            $count = count($_SESSION['cart']);
            // create an array with that product id
            $item_arr = array('product_id' => $_POST["product_id"]);
            // add it to cart with the count as a key
            $_SESSION['cart'][$count] = $item_arr;
        }
    }
    // session cart variable not exist
    else {
        // create an array with that product id
        $item_arr = array('product_id' => $_POST["product_id"]);
        // create a new session with cart variable with the0 key
        $_SESSION['cart'][0] = $item_arr;
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

// import the header
require_once('includes/Header.php');

// get the id
$id = $_GET['id'];
$sql = "SELECT * from `products` WHERE id='$id'";
$product = mysqli_query($conn, $sql);
// output data of each row
while ($row = mysqli_fetch_assoc($product)) {
?>

    <!-- product -->
    <div class="product">
        <div class="product-images">
            <div class="main-img"><img id="main-image" src="<?php echo $row['image'] ?>-red.jpg" alt="<?php echo $row['image'] ?>"></div>
            <div class="show-images">
                <img src="<?php echo $row['image'] ?>-red.jpg" alt="<?php echo $row['name'] ?>">
                <img src="<?php echo $row['image'] ?>-yellow.jpg" alt="<?php echo $row['name'] ?>">
                <img src="<?php echo $row['image'] ?>-blue.jpg" alt="<?php echo $row['name'] ?>">
                <img src="<?php echo $row['image'] ?>-green.jpg" alt="<?php echo $row['name'] ?>">
            </div>
            <p> <i class="fa-solid fa-truck"></i> Get your order in 7-10 days</p>
        </div>
        <div class="product-description">
            <h2 class="product-title"><?php echo $row['name'] ?></h2>
            <div class="d-flex">
                <?php if ($row['sale'] != '') { ?>
                    <button class="sale-btn">Sale!</button>
                <?php } ?>
                <h3 class="product-price">
                    <span><?php echo $row['sale'] ?>.00 dh</span>
                    <sup><del><?php echo $row['price'] ?>.00 dh</del></sup>
                </h3>
            </div>

            <span class="divider"></span>
            <h4> <i class="fa-solid fa-palette"></i> Colors</h4>
            <div class="colors">
                <div class="color yellow"></div>
                <div class="color white"></div>
                <div class="color pink"></div>
                <div class="color blue"></div>
                <div class="color green"></div>
                <div class="color red"></div>
            </div>
            <h4><i class="fa-solid fa-filter"></i> Size</h4>
            <div class="sizes">
                <button class="size-btn active">40 cm To 60 cm</button>
                <button class="size-btn">65 cm To 80 cm</button>
                <button class="size-btn">85 cm To 100 cm</button>
            </div>
            <form method="POST" class="checkout">
                <input type="hidden" name="product_id" value="<?php echo $row['id'] ?>">
                <button class="checkout-btn"><i class="fa-solid fa-lock"></i> Secure Checkout</button>
                <button id="addcart" type="submit" name="add" class="cart-btn"> <i class="fa-solid fa-bag-shopping"></i> Add To Cart</button>
            </form>
        </div>
    </div>

<?php
} // end of while loop
?>



<div class="why">
    <div class="why-container">
        <h2>Why neon signiture?</h2>
        <div class="why-grid">
            <div class="why-grid-item">
                <i class="fa-solid fa-pencil fa-3x"></i>
                <div class="item-container">
                    <h3>Easy to install</h3>
                    <p>each neon sign has high quality acrylic board that holds the sign together with pre drilled holes for easy installation!</p>
                </div>
            </div>
            <div class="why-grid-item">
                <i class="fa-solid fa-bolt fa-3x"></i>
                <div class="item-container">
                    <h3>Energy efficient</h3>
                    <p>with a life span of 100k hours, our LED neon sign are stronger and energy effecient.</p>
                </div>
            </div>
            <div class="why-grid-item">
                <i class="fa-solid fa-truck-fast fa-3x"></i>
                <div class="item-container">
                    <h3>Free shipping</h3>
                    <p>we ship all our signs anywhere in morocco for free! Average shipping times are 2-4 business days.</p>
                </div>
            </div>
            <div class="why-grid-item">
                <i class="fa-solid fa-credit-card fa-3x"></i>
                <div class="item-container">
                    <h3>safe payment</h3>
                    <p>safe payment for your signs with our diffrent payment methode : Credit card - paypal or cash on delivery</p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
// import the Footer
require_once('includes/Footer.php')
?>