<?php session_start();

if(isset($_SESSION['hbUser_Admin'])){
    unset($_SESSION['hbUser_Admin']);
}

if(isset($_SESSION['hbUser_Doctor'])){
    unset($_SESSION['hbUser_Doctor']);
}

if(isset($_SESSION['hbUser_Tech'])){
    unset($_SESSION['hbUser_Tech']);
}

echo "<script>window.location='index';</script>";