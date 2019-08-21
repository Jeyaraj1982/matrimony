<?php
/*
image.php
*/
    header("Content-type: image/jpeg");
    $imgPath = 'https://blog.doh.ms/wp-content/uploads/cropped-PHP-2016-0640.jpg';
    $image = imagecreatefromjpeg($imgPath);
    $color = imagecolorallocate($image, 255, 255, 255);
    $string = "http://recentsolutions.net";
    $fontSize = 3;
    $x = 115;
    $y = 185;
    imagestring($image, $fontSize, $x, $y, $string, $color);
    imagejpeg($image);
    imagejpeg($image,"t.jpeg");
?>