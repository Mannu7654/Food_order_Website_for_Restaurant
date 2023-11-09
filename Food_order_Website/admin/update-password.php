<?php include('partials/menu.php'); ?>

<div>
    <div>
        <h1>Change Password</h1>
        <br/><br/>

        <?php 
            if(isset($_GET['id']))
            {
                $id=$_GET['id'];
            }
        ?>

        <form action="" method="POST">

           <table>
               <tr>
                  <td>Current Password: </td>
                  <td>
                    <input type="password" name="current_password" placeholder="Current Password">
                  </td>
               </tr>

               <tr>
                  <td>New Password: </td>
                  <td>
                    <input type="password" name="new_password" placeholder="New Password">
                  </td>
               </tr>

               <tr>
                  <td>Confirm Password: </td>
                  <td>
                    <input type="password" name="confirm_password" placeholder="Confirm Password">
                  </td>
               </tr>

               <tr>
                  <td>
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="submit" name="submit" value="Change Password" class="btn-secondary">
                  </td>
               </tr>

           </table>
        </form>
    </div>
</div>

<?php 
      // Check whether the submit button is clicked or not
      if(isset($_POST['submit']))
      {
        // 1. Get the data from form
        $id=$_POST['id'];
        $current_password =md5($_POST['current_password']);
        $new_password =md5($_POST['new_password']);
        $confirm_password =md5($_POST['confirm_password']);

        // 2. Check the user with current ID and current Password exists or not
        $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";

        // Execute the querey
        $res = mysqli_query($conn,$sql);

        if($res==true)
        {
            $count =mysqli_num_rows($res);

            if($count ==1)
            {
                // User exits and password can be changed
                //echo "user found";

                // Check whether the new password and confirm password match or not

                if($new_password==$confirm_password)
                {
                    // update the password
                    //echo "Password matched";

                    $sql2="UPDATE tbl_admin SET
                        password='$new_password'
                        WHERE id=$id
                        ";

                    $res2 = mysqli_query($conn, $sql2);

                    if($res2==true)
                    {
                        // Display Success Message

                        $_SESSION['change-pwd'] = "<div class='success'>Password change Successfully. </div>";
                        //Redirect the pages
                        header('location:'.SITEURL.'admin/manage-admin.php');
                    }
                    else
                    {
                        // Display error message

                        $_SESSION['change-pwd'] = "<div class='error'>Failed to Change Password. </div>";
                        //Redirect the pages
                        header('location:'.SITEURL.'admin/manage-admin.php');
                    }
                }
                else
                {
                    $_SESSION['pwd-not-match'] = "<div class='error'>Password did Not found. </div>";
                    //Redirect the pages
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }
            }
            else
            {
                $_SESSION['user-not-found'] = "<div class='error'>User Not found. </div>";
                //Redirect the pages
                header('location:'.SITEURL.'admin/manage-admin.php');
            }
        }
        // 3. Check whether the new password and conform password match or not

        //4. Change password if all above is true

      }
?>



<?php include('partials/menu.php'); ?>