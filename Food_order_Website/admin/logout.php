<?php 

     include('../config/constants.php');
     // 1. Destory the session
     session_destroy();   // Unset $_session ans user

     //2. Redirect the login page
     header('location:'.SITEURL.'admin/login.php');

?>