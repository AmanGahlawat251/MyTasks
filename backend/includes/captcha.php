<?php
header ("Content-type: image/jpg");
session_start(); 
$string1="abcdefghijkmnpqrstuvwxyz";
$string2="23456789";
$string=$string1.$string2;
$string= str_shuffle($string);
$text= substr($string,0,6); 
//$text = rand(10000,99999); 
$_SESSION["vercode"] = $text; 
$height = 25; 
$width = 65; 
  
$image_p = imagecreate($width, $height); 
$black = imagecolorallocate($image_p, 0, 0, 0); 
$white = imagecolorallocate($image_p, 255, 255, 255); 
$font_size = 14; 
  
imagestring($image_p, $font_size, 5, 5, $text, $white); 
//imagejpeg($image_p, null, 80); 
ImagePng ($image_p); // image displayed
imagedestroy($image_p); // Memory allocation for the image is removed. 


?>