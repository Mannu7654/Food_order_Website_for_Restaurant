<?php 

    //Include constantspage
    include('../config/constants.php');

    if(isset($_GET['id']) AND isset($_GET['image_name'])) // Either use '&&' or 'AND'
    {
        // Process to delete

        //1. Get ID and image name
        $id=$_GET['id'];
        $image_name=$_GET['image_name'];

        //2. Remove the image if available
        // Check whether image is available or not
        if($image_name != "")
        {
            // It has image and need to remove from folder
            //Get the image path
            $path= "../images/food/".$image_name;

            //Remove image from folder
            $remove= unlink($path);

            // Check whether the image is removed or not
            if($remove == false)
            {
                //Failed to remove image
                $_SESSION['upload']= "<div class='error'>Failed to remove image file.</div>";
                // Redirect to manage food page
                header('location:'.SITEURL.'admin/manage-food.php');
                //Stop the process of deleteing food
                die();
            }
        }

        //3. Delete Food from Database
        $sql= "DELETE FROM tbl_food WHERE id=$id";
        //Execute the query
        $res=mysqli_query($conn, $sql);

        // Check whether the query executed or not and set the session messge respectively
        //4. Redirect to manage food with session message
        if($res==true)
        {
            //Food delete
            $_SESSION['delete'] = "<div class='success'>Food Deleted successfully.</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
        }
        else
        {
            // Failed to delete
            $_SESSION['delete'] = "<div class='error'>Failed to Delete Food.</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
        }

        

    }
    else
    {
        // Redirect to manage food page

        $_SESSION['unauthorize'] ="<div class='error'>Unauthorized Access.</div>";
        header('location:'.SITEURL.'admin/manage-food.php');
    }
?>