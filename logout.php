<?php
session_start();
include"session_check.php";
if(isset($_SESSION['Username']))
  unset($_SESSION['Username']);
session_destroy();
header( 'Location: index.php' ) ;
?>