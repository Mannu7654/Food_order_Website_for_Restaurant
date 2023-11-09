<?php include('../config/constants.php'); ?>

<?php    
     // 1. get the ID of Admin to be deleted

     $id =$_GET['id'];
     // 2. Create SQL Query to delete Admin

     $sql= "DELETE FROM tbl_admin WHERE id=$id";

     // Execute The Query

     $res= mysqli_query($conn,$sql);

     // Check whether the query executed or not
     if($res==true)
     {
        //echo "Admin Deleted";
        // create session variable to display message
        $_SESSION['delete'] = "<div class='success'>Admin Deleted Successfully.</div>";
        // Redirect to manage Admin Page
        header('location:'.SITEURL.'admin/manage-admin.php');
     }
     else
     {
        //echo "failed to Delete Admin";

        $_SESSION['delete'] = "<div class='error'>Failed to delete admin.Try agin later.</div>";
        header('location:'.SITEURL.'admin/manage-admin.php');
     }

     // 3. Redirect to Manage Admin page with message (Success/error)

?>