<!-- Shop page -->
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

<!-- Collections -->
<?php
if (isset($_GET['collection'])) {
    $collection = $_GET['collection'];
    $sql = "SELECT * FROM `collections` WHERE id=$collection";
    $collection = mysqli_query($conn, $sql);

    if (mysqli_num_rows($collection) > 0) {
        // output data of each row
        while ($row = mysqli_fetch_assoc($collection)) {
?>

            <div class="shop-collection-hero">
                <img src="<?php echo $row['image'] ?>" alt="<?php echo $row['name'] ?>">
                <h2><?php echo $row['name'] ?></h2>
            </div>

    <?php }
    } else {
        header("Location: shop.php");
    }
} else { ?>
    <div class="shop-collections ">
        <h2>Collections</h2>
        <div class="shop-collection-cards owl-carousel owl-theme">
            <?php
            $sql = "SELECT * FROM `collections`";
            $collections = mysqli_query($conn, $sql);

            if (mysqli_num_rows($collections) > 0) {
                // output data of each row
                while ($row = mysqli_fetch_assoc($collections)) {
            ?>
                    <div class="shop-collection-card">
                        <img src="<?php echo $row['image'] ?>" alt="<?php echo $row['name'] ?>">
                        <a href="http://localhost/neon-magic/shop.php?collection=<?php echo $row['id'] ?>">
                            <h4><?php echo $row['name'] ?></h4>
                        </a>
                    </div>
            <?php
                }
            } else {
                echo "0 results";
            }
            ?>
        </div>

    </div>
<?php } ?>

<div class="shop-filter-products">
    <!-- Filters -->
    <div class="shop-filters">
        <h3>Filters</h3>
        <span class="divider"></span>
        <h4>Types</h4>
        <div class="types-btns">
            <a href="shop.php?type=text"> <button class="type-btn">Text</button></a>
            <a href="shop.php?type=logo"><button class="type-btn">Logo/Shape</button> </a>
        </div>
        <h4>Colors</h4>
        <div class="colors">
            <a href="shop.php?color=yellow">
                <div class="color yellow"></div>
            </a>
            <a href="shop.php?color=white">
                <div class="color white"></div>
            </a>
            <a href="shop.php?color=pink">
                <div class="color pink"></div>
            </a>
            <a href="shop.php?color=blue">
                <div class="color blue"></div>
            </a>
            <a href="shop.php?color=green">
                <div class="color green"></div>
            </a>
            <a href="shop.php?color=orange">
                <div class="color orange"></div>
            </a>
            <a href="shop.php?color=red">
                <div class="color red"></div>
            </a>
        </div>
    </div>

    <!-- Products -->
    <div class="shop-products">
        <div class="d-flex">
            <div class="pr">
                <h3>All Products</h3>
                <p>
                    <?php

                    if (isset($_GET['page_no']) && $_GET['page_no'] != "") {
                        $page_no = $_GET['page_no'];
                    } else {
                        $page_no = 1;
                    }

                    $total_records_per_page = 12;

                    $offset = ($page_no - 1) * $total_records_per_page;
                    $previous_page = $page_no - 1;
                    $next_page = $page_no + 1;
                    $adjacents = "2";

                    $result_count = mysqli_query($conn, "SELECT COUNT(*) As total_records FROM `products`");
                    $total_records = mysqli_fetch_array($result_count);
                    $total_records = $total_records['total_records'];
                    $total_no_of_pages = ceil($total_records / $total_records_per_page);
                    $second_last = $total_no_of_pages - 1; // total pages minus 1

                    $sorting = '';
                    if (isset($_GET['sort'])) {
                        $sort = $_GET['sort'];
                        switch ($sort) {
                            case 'Z':
                                $sorting = 'ORDER BY name DESC';
                                break;
                            case 'new':
                                $sorting = 'ORDER BY creted_at DESC';
                                break;
                            case 'old':
                                $sorting = 'ORDER BY creted_at ASC';
                                break;
                            case 'low':
                                $sorting = 'ORDER BY price ASC';
                                break;
                            case 'high':
                                $sorting = 'ORDER BY price DESC';
                                break;
                            default:
                                $sorting = 'ORDER BY name ASC';
                                break;
                        }
                    }


                    if (isset($_GET['collection'])) {
                        $collection = $_GET['collection'];
                        $sql1 = "SELECT * FROM `products` WHERE collection_id='$collection $sorting LIMIT $offset, $total_records_per_page'";
                    } else if (isset($_GET['type'])) {
                        $type = $_GET['type'];
                        $sql1 = "SELECT * FROM `products` WHERE type='$type' $sorting LIMIT $offset, $total_records_per_page";
                    } else if (isset($_GET['color'])) {
                        $color = $_GET['color'];
                        $sql1 = "SELECT * FROM `products` WHERE color='$color' $sorting LIMIT $offset, $total_records_per_page";
                    } else {
                        $sql1 = "SELECT * from `products` $sorting LIMIT $offset, $total_records_per_page";
                    }

                    $products = mysqli_query($conn, $sql1);
                    echo mysqli_num_rows($products)
                    ?>
                    products
                </p>
            </div>
            <div class="sort">
                <button id='sort' class="sort-btn"> <span> Sort by</span> <i class="fa-solid fa-sort-down"></i></button>
                <ul class="sort-card" id="sortCard">
                    <li class="sort-item"><a href="shop.php?sort=A">Alphabitique:A-Z</a></li>
                    <li class="sort-item"><a href="shop.php?sort=Z">Alphabitique:Z-A</a></li>
                    <li class="sort-item"><a href="shop.php?sort=new">New To Old</a></li>
                    <li class="sort-item"><a href="shop.php?sort=old">Old To New</a></li>
                    <li class="sort-item"><a href="shop.php?sort=low">Price : Low To High</a></li>
                    <li class="sort-item"><a href="shop.php?sort=high">Price : High To Low</a></li>
                </ul>
            </div>
        </div>
        <div class="products">
            <div class="products-grid">
                <?php


                if (mysqli_num_rows($products) > 0) {
                    // output data of each row
                    while ($row = mysqli_fetch_assoc($products)) {
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

            <?php



            ?>

            <ul class="pagination">
                <li <?php if ($page_no <= 1) {
                        echo "class='disabled page-item first'";
                    } else {
                        echo "class=' page-item first'";
                    }  ?>>
                    <a class="page-link" <?php if ($page_no > 1) {
                                                echo "href='?page_no=$previous_page'";
                                            } ?> aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <?php
                if ($total_no_of_pages <= 10) {
                    for ($counter = 1; $counter <= $total_no_of_pages; $counter++) {
                        if ($counter == $page_no) {
                            echo "<li class='page-item active'><a class='page-link'>$counter</a></li>";
                        } else {
                            echo "<li class='page-item'><a class='page-link' href='?page_no=$counter'>$counter</a></li>";
                        }
                    }
                } elseif ($total_no_of_pages > 10) {

                    if ($page_no <= 4) {
                        for ($counter = 1; $counter < 8; $counter++) {
                            if ($counter == $page_no) {
                                echo "<li class='page-item active'><a class='page-link'>$counter</a></li>";
                            } else {
                                echo "<li class='page-item'><a class='page-link' href='?page_no=$counter'>$counter</a></li>";
                            }
                        }
                        echo "<li class='page-item'><a class='page-link'>...</a></li>";
                        echo "<li class='page-item'><a class='page-link' href='?page_no=$second_last'>$second_last</a></li>";
                        echo "<li class='page-item'><a class='page-link' href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
                    } elseif ($page_no > 4 && $page_no < $total_no_of_pages - 4) {
                        echo "<li class='page-item'><a class='page-link' href='?page_no=1'>1</a></li>";
                        echo "<li class='page-item'><a class='page-link' href='?page_no=2'>2</a></li>";
                        echo "<li class='page-item'><a class='page-link'>...</a></li>";
                        for ($counter = $page_no - $adjacents; $counter <= $page_no + $adjacents; $counter++) {
                            if ($counter == $page_no) {
                                echo "<li class='page-item active'><a class='page-link'>$counter</a></li>";
                            } else {
                                echo "<li class='page-item'><a class='page-link' href='?page_no=$counter'>$counter</a></li>";
                            }
                        }
                        echo "<li class='page-item'><a class='page-link'>...</a></li>";
                        echo "<li class='page-item'><a class='page-link' href='?page_no=$second_last'>$second_last</a></li>";
                        echo "<li class='page-item'><a class='page-link' href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
                    } else {
                        echo "<li class='page-item'><a class='page-link' href='?page_no=1'>1</a></li>";
                        echo "<li class='page-item'><a class='page-link' href='?page_no=2'>2</a></li>";
                        echo "<li class='page-item'><a class='page-link'>...</a></li>";

                        for ($counter = $total_no_of_pages - 6; $counter <= $total_no_of_pages; $counter++) {
                            if ($counter == $page_no) {
                                echo "<li class='page-item active'><a class='page-link'>$counter</a></li>";
                            } else {
                                echo "<li class='page-item'><a class='page-link' href='?page_no=$counter'>$counter</a></li>";
                            }
                        }
                    }
                }
                ?>
                <li <?php if ($page_no >= $total_no_of_pages) {
                        echo "class='disabled page-item last'";
                    } else {
                        echo "class=' page-item last'";
                    } ?>>
                    <a <?php if ($page_no < $total_no_of_pages) {
                            echo "href='?page_no=$next_page'";
                        } ?> class="page-link" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>

<?php
// import the Footer
require_once('includes/Footer.php')
?>