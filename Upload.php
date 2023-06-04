<!-- Upload page -->
<?php
// import config 
require_once('config/config.php');


function boats()
{
    require 'config.php';
    $query = "SELECT * FROM `boats` ORDER BY id DESC ";
    $result = $db->query($query);
    $boats = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $boats = json_encode($boats);
    echo $boats;
}


// search
function searching()
{
    require 'config.php';
    $searching = $_GET['searching'];
    $query = "SELECT * FROM `boats` WHERE `boat` = '$searching' OR `number` = '$searching'  OR `type` = '$searching' OR `price` = '$searching'  OR `onp` = '$searching' OR `total` = '$searching'    ORDER BY id DESC ";
    $result = $db->query($query);
    $boats = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $boats = json_encode($boats);
    echo $boats;
}

function filtering()
{
    require 'config.php';
    $fromdate = $_GET['fromdate'];
    $todate = $_GET['todate'];
    $query = "SELECT * FROM `boats` WHERE `date` BETWEEN '$fromdate' AND '$todate' ORDER BY id DESC ";
    $result = $db->query($query);
    $boats = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $boats = json_encode($boats);
    echo $boats;
}

//create a new boat
function boatsCreate()
{
    require 'config.php';
    $json = json_decode(file_get_contents('php://input'), true);
    $boat =  $json['boat'];
    $number =  $json['number'];
    $type =  $json['type'];
    $price =  $json['price'];
    $onp =  $json['onp'];
    $date = $json['date'];
    $total = $price * $number;

    if (isset($number) && isset($boat)) {
        $query = "INSERT INTO boats (date, boat, number ,type , price ,onp , total)
            VALUES ('$date', '$boat', '$number' , '$type' , '$price' , '$onp' , '$total')";
        $db->query($query);
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
?>

<!-- hero section -->

<div class="upload-flex fix">
    <img src="assets/images/kpop.jpg" alt="kpop" class="upload-img">
    <div class="upload-text">
        <p>NEON MAGIC IS TRUSTED NATIONALLY</p>
        <h2>We Care About You!</h2>
        <a href="#upload">
            <button class="upload-btn">UPLOAD YOUR LOGO OR DESIGN ↓</button>
        </a>
    </div>
</div>

<!-- Upload Form -->

<div class="upload" id="upload">
    <form id="uploadForm">
        <div class="input-container">
            <p class="input-p">ADD IMAGE/LOGO</p>
            <label for="fileupload" class="custom-file-upload">
                <i class="fa-solid fa-cloud-arrow-up"></i>
                Add image/Logo or <br>
                <p>Drag and drop files here</p>
            </label>
            <input id="fileupload" multiple type="file" />
            <p class="input-sec">Add up to 3 files - For Fast Results</p>
            <p class="input-sec">Please Include an Ai File of Your Logo Or Design</p>
        </div>
        <div class="input-container">
            <p class="input-p">INTENDED USE</p>
            <button class='useFor active'>Business</button>
            <button class='useFor'>Personal</button>
            <button class='useFor'>Rather Not To Say</button>
        </div>
        <div class="input-container">
            <p class="input-p">APPROXIMATE WIDTH OF SIGN</p>
            <button class='item-width active'>50 cm</button>
            <button class='item-width'>65 cm</button>
            <button class='item-width'>80 cm</button>
            <button class='item-width'>100 cm</button>
            <button class='item-width'>120 cm</button>
        </div>
        <div class="input-container">
            <p class="input-p">ANY OTHER DETAILS ABOUT YOUR NEON SIGN</p>
            <textarea cols="30" rows="10" placeholder="Type Here ..."></textarea>
        </div>
        <div class="input-container">
            <p class="input-p">FIRST NAME</p>
            <input type="text">
        </div>
        <div class="input-container">
            <p class="input-p">LAST NAME</p>
            <input type="text">
        </div>
        <div class="input-container">
            <p class="input-p">EMAIL</p>
            <input type="text">
        </div>
        <div class="input-container">
            <p class="input-p">PHONE NO.</p>
            <input type="text" placeholder="+212 00000000">
        </div>
        <div class="text-center">
            <button id="uploadBtn" class="form-btn">Submit</button>
        </div>

    </form>
</div>

<!-- Installation  -->
<div class="text-center">
    <h3>SIMPLE INSTALLATION</h3>
</div>
<div class="installation">
    <div class="installation-card">
        <img src="assets/images/hang.jpg" alt="hang" class="icard-img">
        <div class="text">
            <h4><span>1</span> Easy to Hang</h4>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea dicta </p>
        </div>
    </div>
    <div class="installation-card">
        <img src="assets/images/drill.jpg" alt="drill" class="icard-img">
        <div class="text">
            <h4><span>2</span> No Need for Drilling</h4>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Exercita </p>
        </div>
    </div>
    <div class="installation-card">
        <img src="assets/images/plug.jpg" alt="pluging" class="icard-img">
        <div class="text">
            <h4><span>3</span> Plug it IN!</h4>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Totam laudantium repellendus impedit conseq</p>
        </div>
    </div>
</div>

<?php
// import the Footer
require_once('includes/Footer.php')
?>