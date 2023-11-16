<?php
session_start();

$width = 150;
$height = 50;

$fontFile = $_SERVER['DOCUMENT_ROOT'] . "/GTST/assets/img/OpenSans-Regular.ttf";

// Generate captcha code
$randomCode = substr(md5(uniqid(rand(), true)), 0, 6);

// Assign captcha in session
$_SESSION['captchaCode'] = $randomCode;

// Create a blank image with dimensions 168x37
$captchaImage = imagecreatetruecolor($width, $height);

// Set the background color
$backgroundColor = imagecolorallocate($captchaImage, 255, 255, 255);
imagefill($captchaImage, 0, 0, $backgroundColor);

// Set the text color (black)
$textColor = imagecolorallocate($captchaImage, 0, 0, 0);

// Draw the CAPTCHA code on the image
imagettftext($captchaImage, 20, 0, 10, 35, $textColor, $fontFile, $randomCode);

$warpedImage = imagecreatetruecolor($width, $height);
imagefill($warpedImage, 0, 0, imagecolorallocate($warpedImage, 255, 255, 255));

for ($x = 0; $x < $width; $x++) {
    for ($y = 0; $y < $height; $y++) {
        $index = imagecolorat($captchaImage, $x, $y);
        $color_comp = imagecolorsforindex($captchaImage, $index);

        $color = imagecolorallocate($warpedImage, $color_comp['red'], $color_comp['green'], $color_comp['blue']);

        $imageX = $x;
        $imageY = $y + sin($x / 10) * 10;

        imagesetpixel($warpedImage, $imageX, $imageY, $color);
    }
}

// Set the content type header to display the image
header("Content-type: image/jpeg");

// Output the image as JPEG
imagejpeg($warpedImage);

// Clean up
imagedestroy($warpedImage);
imagedestroy($captchaImage);
