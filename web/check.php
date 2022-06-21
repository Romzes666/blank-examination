<?php
echo date('m');
/*// (A) OPEN IMAGE
$img = imagecreatefromjpeg("blanks/templates/11/ЕГЭ/Бланк Регистрации/list.jpg");
$iWidth = imagesx($img);
$iHeight = imagesy($img);
$k = (($iWidth+$iHeight)*2)/((1105+1560)*2);
// (B) WRITE TEXT
$txt = "3108110100001";
$fontFile = "C:\Windows\Fonts\arial.ttf"; // CHANGE TO YOUR OWN!
$fontSize = 72;
$fontColor = imagecolorallocate($img, 0, 0, 0);
$posX = 45.9861 * $k;
$posY = 224.986 * $k + 71.9965 * $k;
$angle = 0;
imagettftext($img, $fontSize, $angle, $posX, $posY, $fontColor, $fontFile, $txt);


$posX = 985.986 * $k + 72;
$posY = 28.9861 * $k + 266.997 * $k;
$angle = 90;
imagettftext($img, $fontSize, $angle, $posX, $posY, $fontColor, $fontFile, $txt);

// (C) OUTPUT IMAGE
// (C1) DIRECTLY SHOW IMAGE
header("Content-type: image/jpeg");
imagejpeg($img);
imagedestroy($img);

// (C2) OR SAVE TO A FILE
// $quality = 100; // 0 to 100
// imagejpeg($img, "demo.jpg", $quality);*/