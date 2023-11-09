<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>

        <br/><br/>

        <?php 
            // 1. Get the ID of selected admin
            $id=$_GET['id'];

            //2. Create SQL Query to get the details
            $sql="SELECT * FROM tbl_admin WHERE id=$id";

            // execute the query

            $res= mysqli_query($conn, $sql);

            // Check query executed or not
            if($res==true)
            {
                $count = mysqli_num_rows($res);

                // check whether admin data is available or not
                if($count==1)
                {
                    //echo "Admin Available";
                    $row=mysqli_fetch_assoc($res);

                    $full_name = $row['full_name'];
                    $username= $row['username'];
                }
                else
                {
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }
            }
        ?>

        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td>
                        <input type="text" name="full_name" value="<?php echo $full_name; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Username: </td>
                    <td>
                        <input type="text" name="username" value="<?php echo $username; ?>">
                    </td>
                </tr>

                <br/>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>
    </div>
</div>

<?php
     
     // check the submit button is clicked or not
     if(isset($_POST['submit']))
     {
        //echo "Button Clicked";

        //Get all the values from form to update
        $id= $_POSt['id']; 
        $full_name= $_POSt['full_name']; 
        $username= $_POSt['username']; 

        // SQL query to update admin
        $sql="UPDATE tbl_admin SET
            full_name = '$full_name',
            username = '$username'
            WHERE id='$id'
            ";

            $res=mysqli_query($conn, $sql);

            if($res==true)
            {
                $_SESSION['update'] ="<div class='success'>Admin Updated Successfully.</div>";

                header('location:'.SITEURL.'admin/manage-admin.php');
            }
            else
            {
                $_SESSION['update'] ="<div class='error'>Failed  to Updated Admin.</div>";

                header('location:'.SITEURL.'admin/manage-admin.php');
            }
     }
?>



<?php include('partials/footer.php'); ?>