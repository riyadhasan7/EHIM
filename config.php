<?php
    $con=mysqli_connect("localhost","root","","project") or die("couln't connect");
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
      
?>