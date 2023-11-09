<?php include('partials/menu.php'); ?>


<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>

        <br/><br/><br/>

        <?php 
            if(isset($_SESSION['add']))  // Checking whether the session is set or not
            {
                echo $_SESSION['add'];  // Displaying session message if set
                unset($_SESSION['add']);  //removing Session Message
            }
        ?>


        <form action="" method="POST">

        <table class="tbl-40">
            <tr>
                <td>Full Name : </td>
                <td><input type="text" name="full_name" placeholder="Enter Your Name"></td>
            </tr>

            <tr>
                <td>Username : </td>
                <td>
                    <input type="text" name="username" placeholder="Your userame">
                </td>
            </tr>

            <tr>
                <td>Password : </td>
                <td>
                    <input type="password" name="password" placeholder="Your password">
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                </td>
            </tr>

        </table>

        </form>


    </div>
</div>

<?php include('partials/footer.php'); ?>

<?php
    // Process the value from form and save it in database

    // check whether the submit button is clicked or not

    if(isset($_POST['submit']))
    {
        // Button clicked
        // echo "Button clicked";

        // 1. Get data from From

        $full_name = $_POST['full_name'];
        $username =$_POST['username'];
        $password = md5($_POST['password']);  // Password Encryption in MD5

        // 2. SQL Query to save the data into database
        $sql ="INSERT INTO tbl_admin SET
               full_name='$full_name',
               username='$username',
               password= '$password'
        ";
       
       // 3.Execute Query and saving Data into Database

        $res = mysqli_query($conn, $sql) or die(mysqli_error());

        // 4. check whether the (Query is executed) data is inserted or not appropriate message
        if($res == TRUE)
        {
            // Data Inserted
            //echo "Data Inserted";
            // Create a session variable to dispaly Message

            $_SESSION['add'] = "<div class='success'>Admin Added Successfully.</div>";

            // Redirect Page
            header("location:".SITEURL.'admin/manage-admin.php');
        }
        else
        {
            // Failed to inserted
            //echo "failed to insert";
            // Create a session variable to dispaly Message

            $_SESSION['add'] = "<div class='error'>Failed to add admin.</div>";

            // Redirect Page
            header("location:".SITEURL.'admin/add-admin.php');
        }
    }
?>