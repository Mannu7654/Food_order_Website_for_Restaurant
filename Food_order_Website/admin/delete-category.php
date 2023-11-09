<?php 
      include('../config/constants.php');

    //  echo "Delete page";
    // Check whether the id and image_name value is not set

    if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
        // GEt the value and delete
        $id= $_GET['id'];
        $image_name=$_GET['image_name'];

        // Remove the physical image filr is available
        if($image_name != "")
        {
            // Image is available so remove it
            $path= "../images/category/".$image_name;
            // Remove the image
            $remove= unlink($path);

            // If failled to rmeove image then an error message and stopp the process
            if($remove == false)
            {
                $_SESSION['remove'] = "<div class='error'>Failed to Remove Category Image</div>";
                // redirect to manage category page
                header('location:'.SITEURL.'admin/manage-category.php');
                // Stop the process
                die();
            }
        }

        // Delete data from Database

        // Sql query delete data from databse
        $sql= "DELETE FROM tbl_category WHERE id=$id";

        // Execute the query
        $res= mysqli_query($conn,$sql);

        //check whether the data is delete from database or not
        if($res == true)
        {
            // Set success message and redirect
            $_SESSION['delete'] ="<div class='success'> Category deleted Successfully. </div>";
            // Redirect to manage category
            header('location:'.SITEURL.'admin/manage-category.php');
        }
        else
        {
            // Set fail message and redirect
            $_SESSION['delete'] ="<div class='error'> Failed to deleted Successfully. </div>";
            // Redirect to manage category
            header('location:'.SITEURL.'admin/manage-category.php');
        }

        //Redirect the mange category page with message
    }
    else
    {
        // Redirect to manage category Page
        header('location:'.SITEURL.'admin/manage-category.php');
    }

?>