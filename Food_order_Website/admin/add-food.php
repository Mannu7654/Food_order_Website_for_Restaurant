<?php include('partials/menu.php') ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>

        </br></br></br>

        <?php

        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }


        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Title of the food" value="">
                    </td>
                </tr>

                <tr>
                    <td>Description : </td>
                    <td>
                        <textarea name="details" cols="30" rows="5"
                            placeholder="Description of the Food"></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price : </td>
                    <td>
                        <input type="number" name="price">
                    </td>
                </tr>

                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Category : </td>
                    <td>
                        <select name="category">

                            <?php
                            // Create PHP code to diaplay categories from Database
                            //1. Create SQl to get all article categories from database
                            $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

                            //Execute query
                            $res = mysqli_query($conn, $sql);

                            // COunt Rows to checkwhether we have category or not
                            $count = mysqli_num_rows($res);

                            //If count is greater than zero, we have categories else we dont have categories
                            if ($count > 0) {
                                // We have categories
                                while ($row = mysqli_fetch_assoc($res)) {
                                    // get the deatils of categories
                                    $id = $row['id'];
                                    $title = $row['title'];
                                    ?>

                                    <option value="<?php echo $id; ?>"><?php echo $title; ?></option>

                                    <?php
                                }
                            } else {
                                // We don't have categories
                                ?>
                                <option value='0'>No Category Found</option>
                                <?php
                            }
                            ?>

                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes">
                        Yes
                        <input type="radio" name="featured" value="No">
                        No
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes
                        <input type="radio" name="active" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                    </td>
                </tr>

            </table>
        </form>

        <?php

        // Check whether the button is clickes or not
        if (isset($_POST['submit'])) {
            // Add the food in Database
        
            // 1. Get the data from form
            $title = $_POST['title'];
            $details = $_POST['details'];
            $price = $_POST['price'];
            $category = $_POST['category'];

            // Check whether radio button for featured and active are checkd or not
            if (isset($_POST['featured'])) {
                $featured = $_POST['featured'];
            } else {
                $featured = "No"; // Setting default value
            }

            if (isset($_POST['active'])) {
                $active = $_POST['active'];
            } else {
                $active = "No"; // Setting default value
            }

            // 2. Upload the image if selected
            // Check whether the selected image is clicked or not and upload the image only if image is clicked
            if (isset($_FILES['image']['name'])) {
                // Get the details of the selectedd image 
                $image_name = $_FILES['image']['name'];

                // check whether image is selected or not and upload image only if selected
                if ($image_name != "") {
                    // Image is selected
                    // A. Rename the image
                    // Get the extension of selected image (jpg,png,gif. etc)
                    $ext = end(explode('.', $image_name));

                    // Create new name for image
                    $image_name = "Food-Name-" . rand(0000, 9999) . "." . $ext; // new image like : Food-Name-656.jpg
        
                    // Upload the Image
                    // Get the source path and distination path
        
                    // SOurce pathis the current location of the image
                    $src = $_FILES['image']['tmp_name'];

                    // Destinbation path  for the image to be uploaded
                    $dst = "../images/food/".$image_name;

                    // Finally Upload the food image
                    $upload = move_uploaded_file($src, $dst);

                    // check whether image uploaded or not
                    if ($upload == false) {
                        // Failed to upload the image
                        // Redirect to add food page with error message
                        $_SESSION['upload'] = "<div class='error'>Failed to Upload Image.</div>";
                        header('location:'.SITEURL.'admin/add-food.php');
                        // Stop the process
                        die();
                    }
                }
            } else {
                $image_name = ""; // Setting default value is blank
            }

            // 3. Insert the database
            // Create a sql query to save or add food
            // FOr integer value no need to pass value inside quotes '' but for string value it is compulsory to add quotes.
            $sql2 = "INSERT INTO tbl_food SET
                    title= '$title',
                    details='$details',
                    price= $price,
                    image_name= '$image_name',
                    category_id = $category,
                    featured= '$featured',
                    active= '$active'
            ";

            // Execute the query
            $res2 = mysqli_query($conn, $sql2);
            // Check whether data is inserted or not
            // 4. Redirect with message to manage food page
            if ($res2 == true) {
                $_SESSION['add'] = "<div class='success' >Food Added Successfully</div>";
                header('location:'.SITEURL.'admin/manage-food.php');
            } else {
                $_SESSION['add'] = "<div class='error' >Failed to add food</div>";
                header('location:'.SITEURL.'admin/manage-food.php');
            }

        }
        ?>

    </div>
</div>

<?php include('partials/footer.php') ?>