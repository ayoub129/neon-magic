<!-- Design page -->
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


<!-- Design -->

<div class="design">
    <div class="image">
        <div class="images-flex">
            <div class="onoff-buttons">
                <button class="onoff active">On</button>
                <button class="onoff">Off</button>
            </div>
            <span id="price"></span>
        </div>
        <h2 id="neon-text" class='neon-text'></h2>
    </div>
    <div class="opt">

        <div class="options">
            <button class='text-btn'><i class="fa-solid fa-font"></i> Write Your Text</button>
            <p class='text-pr'>Write your text</p>
            <span class='text-sec'>2 lines, <span id="maxchar"></span> characters max per line for current size</span>
            <textarea id="text" class="text" cols="30" rows="4" oninput="limitChar(this)" placeholder="Enter Text Bellow"></textarea>
            <p class="error" id="charcounter"></p>
            <div class="ds-block">
                <div class="flex-item">
                    <p class="text-pr">Choose a font</p>
                    <div class="dis-flex">
                        <div class="font">
                            <button id="font" class="font-btn"><span id="selected"> Alexa</span> <i class="fa-solid fa-sort-down"></i></button>
                            <ul class="fontcard" id="fontCard">
                                <li class="sort-item"><button class="font-btns active">Alexa</button></li>
                                <li class="sort-item"><button class="font-btns">Amanda</button></li>
                                <li class="sort-item"><button class="font-btns">Austin</button></li>
                                <li class="sort-item"><button class="font-btns">Vintage</button></li>
                                <li class="sort-item"><button class="font-btns">Chelsea</button></li>
                                <li class="sort-item"><button class="font-btns">barcelona</button></li>
                            </ul>
                        </div>
                        <div class="align">
                            <div class="align-btn active"><i class="fa-solid fa-align-left"></i></div>
                            <div class="align-btn"><i class="fa-solid fa-align-center"></i></div>
                            <div class="align-btn"><i class="fa-solid fa-align-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="flex-item">
                    <p class='text-pr'>Choose a Color</p>
                    <div class="ds-flex">
                        <div class="bordered active">
                            <div class="color pink"></div>
                        </div>
                        <div class="bordered ">
                            <div class="color red"></div>
                        </div>
                        <div class="bordered ">
                            <div class="color yellow"></div>
                        </div>
                        <div class="bordered">
                            <div class="color blue"></div>
                        </div>
                        <div class="bordered">
                            <div class="color white"></div>
                        </div>
                        <div class="bordered">
                            <div class="color green"></div>
                        </div>
                        <div class="bordered">
                            <div class="color orange"></div>
                        </div>
                    </div>
                </div>
            </div>
            <p class='text-pr'>Choose a size</p>
            <div class="btn-grid">
                <button class='sizes active'>
                    <p>
                        Small
                    </p>
                    <small>40 cm et 64 cm</small>
                </button>
                <button class="sizes">
                    <p>
                        Medium
                    </p>
                    <small>65 cm et 84 cm</small>
                </button>
                <button class="sizes">
                    <p>
                        Large
                    </p>
                    <small>85 cm et 100 cm</small>
                </button>
            </div>

            <p class='text-pr'>Any Other Special Requests</p>
            <span class='text-sec'>Place in Special Requests and We will contact you before production</span>
            <textarea id="request" class="text" cols="30" rows="10" placeholder="Your Requests ..."></textarea>
        </div>
        <button id="finish" class='finish-btn'>Finish</button>
    </div>
</div>

<!-- Feautures  -->
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