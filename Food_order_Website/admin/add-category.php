<?php
include('partials/menu.php');
?>

<br /><br />

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>

        <br><br>

        <?php

        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }

        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        ?>

        <br><br>

        <!-- /Add category form start -->
        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>Title : </td>
                    <td>
                        <input type="text" name="title" placeholder="Name of Category">
                    </td>
                </tr>

                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Yes
                        <input type="radio" name="featured" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>Active : </td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes
                        <input type="radio" name="active" value="No"> No
                    </td>
                </tr>
                <br />

                <tr>
                    <td>
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>

        <!-- Add category form ends -->

        <?php

        // Check whether the submit button is clicked or not
        if (isset($_POST['submit'])) {
            //1. Get the value from category form
            $title = $_POST['title'];

            //For radio input type we need to check whether the button is selected or not
            if (isset($_POST['featured'])) {
                // Get the value from form
                $featured = $_POST['featured'];
            } else {
                // Set the default value
                $featured = "NO";
            }

            if (isset($_POST['active'])) {
                // Get the value from form
                $active = $_POST['active'];
            } else {
                // Set the default value
                $active = "NO";
            }

            // Check whetherr image is selected or not
            //print_r($_FILES['image']);
        
            // die();  // Break the code here
        
            if (isset($_FILES['image']['name'])) {
                // Upload the image
                // To upload dimage we need image name and source path and distinaion
        
                $image_name = $_FILES['image']['name'];

                // Upload The image only if image is selected
                if ($image_name != "") {

                    // Auto Rename our image
                    // Get the extension of our image (jpg,png,gif,etc) e.g. "specialfood1.jpg"
                    $ext = end(explode('.', $image_name));

                    // Rename the image
                    $image_name = "Food_category_" . rand(000, 999) . '.' . $ext; // e.g. "food_category_834.jpg"
        

                    $source_path = $_FILES['image']['tmp_name'];

                    $destination_path = "../images/category/" . $image_name;

                    // Finally upload the image
                    $upload = move_uploaded_file($source_path, $destination_path);

                    // Check whether the mage uploaded and not
                    // ANd if the image is not uploaded then stop the processa and redirect with error image
                    if ($upload == false) {
                        $_SESSION['upload'] = "<div class='error'>Failed to upload image</div>";
                        // Redirect the add category page
                        header('loaction:' . SITEURL . 'admin/add-category.php');
                        // STop the process
                        die();
                    }
                }

            } else {
                // Dont upload image 
                $image_name = "";
            }

            //2. Create sql query to insert data into database
            $sql = "INSERT INTO tbl_category SET 
                       title='$title',
                       image_name='$image_name',
                       featured='$featured',
                       active='$active'
                    ";

            // 3. Execute the query and save into database
            $res = mysqli_query($conn, $sql);

            // 4. Check whether the query executed or not
            if ($res == true) {
                $_SESSION['add'] = "<div class='success'>Category Added Successfully</div>";

                header('location:' . SITEURL . 'admin/manage-category.php');
            } else {
                $_SESSION['add'] = "<div class='error'>Failed to Category Added Successfully</div>";

                header('location:' . SITEURL . 'admin/add-category.php');
            }
        }
        ?>
    </div>
</div>


<?php include('partials/footer.php') ?>