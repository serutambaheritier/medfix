<?php 
    $connect = mysqli_connect('localhost','root','','medifix');  
    if (!$connect) {
        die("Database Connection Failed: " . mysqli_connect_error());
    }
?>