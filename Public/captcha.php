<?php
  session_start();

  // Set some important CAPTCHA constants
  define('CAPTCHA_NUMCHARS', 4);  // number of characters in pass-phrase
  define('CAPTCHA_WIDTH', 100);   // width of image
  define('CAPTCHA_HEIGHT', 25);   // height of image

  // Generate the random pass-phrase
  $pass_phrase = "";
  for ($i = 0; $i < CAPTCHA_NUMCHARS; $i++) {

  // Store the encrypted pass-phrase in a session variable
  $_SESSION['pass_phrase'] = SHA1($pass_phrase);

  // Create the image

  // Fill the background
  imagefilledrectangle($img, 0, 0, CAPTCHA_WIDTH, CAPTCHA_HEIGHT, $bg_color);

  for ($i = 0; $i < 5; $i++) {
    imageline($img, 0, rand() % CAPTCHA_HEIGHT, CAPTCHA_WIDTH, rand() % CAPTCHA_HEIGHT, $graphic_color);
  }

  // Sprinkle in some random dots
  for ($i = 0; $i < 50; $i++) {
    imagesetpixel($img, rand() % CAPTCHA_WIDTH, rand() % CAPTCHA_HEIGHT, $graphic_color);
  }

  imagettftext($img, 18, 0, 5, CAPTCHA_HEIGHT - 5, $text_color, 'fonts/Courier New Bold.ttf', $pass_phrase);

  // Output the image as a PNG using a header

  // Clean up
  imagedestroy($img);
  ini_set('display_errors', 1);//设置开启错误提示
  error_reporting('E_ALL & ~E_NOTICE ');//错误等级提示
?>