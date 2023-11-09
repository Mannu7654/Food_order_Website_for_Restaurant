<?php include('../config/constants.php') ?>

<html>
    <head>
        <title>Login - Food order Portal</title>

        <link rel="stylesheet" href="../css/admin.css">
        <link rel="stylesheet" href="../css/login.css">
    </head>
    
    <body>
        <div class="login">
            
            <h1 id="text-center">Admin Login</h1>
            <br>

            <?php 
                 if(isset($_SESSION['login']))
                 {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                 }

                 if(isset($_SESSION['no-login-message']))
                 {
                    echo $_SESSION['no-login-message'];
                    unset($_SESSION['no-login-message']);
                 }
            ?>

            <br/>
            

            <!-- Login Form Starts Here -->
            <form action="" method="POST" class="text-center">
                <label for="">Username : </label><br/>
                <input type="text" name="username" placeholder="Enter Username"> </br><br/>

                <label for="">Password :</label> <br/>
                <input type="password" name="password" placeholder="Enter Password"> </br><br/>

                <input type="submit" name="submit" value="Login" class="btn login_btn"> <br/><br/>
            </form>

            <br><br>

            <!-- Login Form ends here -->
            <p id="text-center">Created by - <a href="https://github.com/Mannu7654">Mannu Kumar</a></p>
        </div>
    </body>

</html>

<?php
     
     // Check whether submit button is clicked or not
     if(isset($_POST['submit']))
     {
        // Process for Login
        //1. Get the data from Login form

        // $username = $_POST['username'];
        $username = mysqli_real_escape_string($conn,$_POST['username']);
        // $password = md5($_POST['password']);  // Because password is save in encrypted form in database.
        $password = mysqli_real_escape_string($conn,md5($_POST['password']));

        // 2. Sql query to check the username and password exists or not
        $sql= "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

        // 3. Execute the query
        $res = mysqli_query($conn, $sql);

        // 4. COunt rows to check whether the user exists or not
        $count= mysqli_num_rows($res);

        if($count==1)
        {
            //User available and login success
            $_SESSION['login'] = "<div class='success'>Login Successfull.</div>";
            $_SESSION['user'] = $username;    // To check whether user is logged in or not

            // Redirect the page
            header('location:'.SITEURL.'admin/');

        }
        else
        {
            //User not available and login Faild
            $_SESSION['login'] = "<div class='error text-center'> Username and Password not matched. </div>";
            // Redirect the page
            header('location:'.SITEURL.'admin/login.php');
        }
     }
?>
