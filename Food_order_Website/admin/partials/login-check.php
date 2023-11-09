
<?php 
    
    // Authorization Access control 
    //Check whether the user is logged in or not

    if(!isset($_SESSION['user']))
    {
        // user is not login
        // Rrdirect the login page with message
        $_SESSION['no-login-message'] = "<div class='error text-center'>Please Login to access Admin Panel</div>";

        header('location:'.SITEURL.'admin/login.php');
    }
?>


