<?php 
    $connect = mysqli_connect('127.0.0.1','root','','medifix');  
    if (!$connect) {
        die("Database Connection Failed: " . mysqli_connect_error());
    }
?>