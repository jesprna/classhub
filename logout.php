<?php 
session_start();
$_SESSION['username'] = null;
$_SESSION['fullname'] = null;
header("Location: index.php")

?>