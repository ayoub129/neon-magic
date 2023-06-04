<?php

function customize()
{
    require 'config/config.php';
    $json = json_decode(file_get_contents('php://input'), true);
    if (isset($json)) {
        $Text = $json['Text'];
        $font = $json['font'];
        $align = $json['align'];
        $color = $json['color'];
        $size = $json['size'];
        $price = $json['price'];
        $request = $json['request'];
        $customizable_orders = array("text" =>  $Text, "font" => $font, "align" => $align, "color" => $color, "size" => $size, "reques" => $request, "price" => $price);

        // $query = "INSERT INTO `customizable-orders` (`text` , `font` , `align` , `color` , `size` , `request` , `price`) VALUES ('$Text' , '$font' , '$align' , '$color' , '$size' , '$request' , '$price')";

        // if ($conn->query($query)) {
        //     echo  '{"data":"Live is good"}';
        // } else {
        //     echo '{"data": "somthing went wrong"}';
        // }
    }
}

// call the login function
customize();
