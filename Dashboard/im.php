<?php
$stamp = imagecreatefrompng($_GET['stamp']);
$im = imagecreatefrompng($_GET['src']);

$sx = imagesx($stamp);
$sy = imagesy($stamp);
 
$imgx = imagesx($im);
$imgy = imagesy($im);

$centerX=round($imgx/2)-round($sx/2);
$centerY=round($imgy/2)-round($sy/2);

$padding = 10;
$h = strtolower($_GET['h']);
$v = strtolower($_GET['v']);
$padding = $_GET['p'];
if ($h=="left" && $v=="top")  {
imagecopy($im, $stamp, $padding, $padding, 0, 0, imagesx($stamp), imagesy($stamp));
}
if ($h=="left" && $v=="middle") {
imagecopy($im, $stamp, $padding, $centerY, 0, 0, imagesx($stamp), imagesy($stamp));
}
if ($h=="left" && $v=="bottom")  {
imagecopy($im, $stamp, $padding, $imgy-$sy-$padding, 0, 0, imagesx($stamp), imagesy($stamp));
}


if ($h=="right" && $v=="top") {
imagecopy($im, $stamp, $imgx-$sx-$padding, $padding, 0, 0, imagesx($stamp), imagesy($stamp));
}
if ($h=="right" && $v=="middle") {
imagecopy($im, $stamp, $imgx-$sx-$padding, $centerY, 0, 0, imagesx($stamp), imagesy($stamp));
}
if ($h=="right" && $v=="bottom") {
imagecopy($im, $stamp, $imgx-$sx-$padding, $imgy-$sy-$padding, 0, 0, imagesx($stamp), imagesy($stamp));
}


if ($h=="middle" && $v=="top") {
imagecopy($im, $stamp, $centerX, $padding, 0, 0, imagesx($stamp), imagesy($stamp));
}
if ($h=="middle" && $v=="bottom") {
imagecopy($im, $stamp, $centerX, $imgy-$sy-$padding, 0, 0, imagesx($stamp), imagesy($stamp));
}
if ($h=="middle" && $v=="middle") {
imagecopy($im, $stamp, $centerX, $centerY, 0, 0, imagesx($stamp), imagesy($stamp));
}


exec("convert -blur 0x07 j.png j1.png");

// Output and free memory
//imagepng($im,"j.png");
header('Content-type: image/png');
imagepng($im);
//imagedestroy($im);
//imagejpeg($im, $save_watermark_photo_address, 80)
?>