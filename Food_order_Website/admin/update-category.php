<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>

        <br><br><br>

        <?php 
            // Check whether the id is set or not
            if(isset($_GET['id']))
            {
                // Get the id and all other details
                $id =$_GET['id'];
                // create sql querey to get all other details
                $sql="SELECT * FROM tbl_category WHERE id= $id";
                //Execute the query
                $res=mysqli_query($conn,$sql);

                // COunt the rows to check whether the id is valid or not
                $count =mysqli_num_rows($res);

                if($count ==1)
                {
                    //Get all the data
                    $row= mysqli_fetch_assoc($res);
                    $title= $row['title'];
                    $current_image= $row['image_name'];
                    $featured= $row['featured'];
                    $active= $row['active'];

                }
                else
                {
                    // Redirect to manage category with session message
                    $_SESSION['no-category-found'] = "<div class='error'>Category not found </div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
            }
            else
            {
                // Manage category redirect
                header('location:'.SITEURL.'admin/manage-category.php');
            }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
        <table class="tbl-30">
            <tr>
                <td>Title: </td>
                <td>
                    <input type="text" name="title" value="<?php echo $title; ?>">
                </td>
            </tr>

            <tr>
                <td>
                    <?php
                        if($current_image != "")
                        {
                            // Display the message
                            ?>

                             <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>" width="200px">
                            <?php
                        }
                        else
                        {
                            // Display the message
                            echo "<div class='error'> Image not Added </div>";
                        }
                    ?>
                </td>
            </tr>

            <tr>
                <td>New Image : </td>
                <td>
                    <input type="file" name="image">
                </td>
            </tr>

            <tr>
                <td>Featured: </td>
                <td>
                    <input <?php if($featured == "Yes") {echo "checked";} ?> type="radio" name="featured" value="Yes"> Yes

                    <input <?php if($featured == "No") {echo "checked";} ?> type="radio" name="featured" value="No"> No
                </td>
            </tr>

            <tr>
                <td>Active: </td>
                <td>
                    <input <?php if($active == "Yes") {echo "checked";} ?> type="radio" name="active" value="Yes"> Yes

                    <input <?php if($active == "No") {echo "checked";} ?> type="radio" name="active" value="No"> No
                </td>
            </tr>

            <tr>
                <td>
                    <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="submit" name="submit" value="Update-Category" class="btn-secondary">
                </td>
            </tr>
        </table>
</form>

        <?php
              
              if(isset($_POST['submit']))
              {
                // 1. Get all the value from the form

                $id= $_POST['id'];
                $title= $_POST['title'];
                $current_image= $_POST['current_image'];
                $featured= $_POST['featured'];
                $active= $_POST['active'];

                //2. Updating new image if selected
                //checked whether image is selected or not
                if(isset($_FILES['image']['name']))
                {
                    // Get the image Details
                    $image_name = $_FILES['image']['name'];

                    // Check whether image is available or not
                    if($image_name != "")
                    {
                        // Image Available
                        // A. Upload the new image 

                        // Auto Rename our image
                        // Get the extension of our image (jpg,png,gif,etc) e.g. "specialfood1.jpg"
                        $ext= end(explode('.',$image_name));

                        // Rename the image
                        $image_name= "Food_category_".rand(000,999).'.'.$ext;  // e.g. "food_category_834.jpg"

                    
                        $source_path = $_FILES['image']['tmp_name'];

                        $destination_path = "../images/category/".$image_name;

                        // Finally upload the image
                        $upload= move_uploaded_file($source_path,$destination_path);

                       // Check whether the mage uploaded and not
                       // ANd if the image is not uploaded then stop the processa and redirect with error image
                        if($upload==false)
                        {
                            $_SESSION['upload'] = "<div class='error'>Failed to upload image</div>";
                            // Redirect the add category page
                            header('loaction:'.SITEURL.'admin/manage-category.php');
                            // STop the process
                            die();
                        }

                        // B. remove current image if available
                        if($current_image != "")
                        {
                            $remove_path= "../images/category/".$current_image;

                            $remove= unlink($remove_path);

                            // Check whether image is remove or not
                            //If failed to remove then dispaly message and stop the process
                            if($remove==false)
                            {
                                 // Failed to remove image
                                $_SESSION['failed-remove'] = "<div class='error'> Failed to remove current Image</div>";
                                header('location:'.SITEURL.'admin/manage-category.php');
                                die(); // Stop the process
                            }
                        }
                        
                    }
                    else
                    {
                        $image_name= $current_image;
                    }
                }
                else
                {
                    $image_name = $current_image;
                }

                // 3.Update the database
                $sql2= "UPDATE tbl_category SET
                        title = '$title',
                        image_name= '$image_name',
                        featured = '$featured',
                        active = '$active'
                        WHERE id= $id
                ";

                // Execute the query
                $res2 = mysqli_query($conn, $sql2);

                // Redirect to manage category with message
                // Checked whether excuated or not
                if($res2== true)
                {
                    // Category updated
                    $_SESSION['update'] = "<div class='succcess'> Category Update Successfully<?div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
                else
                {
                    // Failed to Category updated
                    $_SESSION['update'] = "<div class='error'> Failed to update Category.<?div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }

              }
        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>