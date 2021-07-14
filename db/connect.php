<?php
$con = $mysqli = new mysqli("localhost","root","","banhang");

// Check connection
if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}
?>