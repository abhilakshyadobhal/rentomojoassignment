<?php
$connect = mysqli_connect("db4free.net:3306","abhimojo","Dobhal@7","abhimojo");
/*for local browser
$connect = mysqli_connect("localhost","root","","rentomojo");
*/// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
?>




