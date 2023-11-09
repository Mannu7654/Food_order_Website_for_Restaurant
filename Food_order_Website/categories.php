<?php include('partials-front/menu.php'); ?>


    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore the Foods Items</h2>

            <?php 
                // Display all the category that are active
                // SQL query
                $sql="SELECT * FROM tbl_category WHERE active='Yes'";
                $res=mysqli_query($conn,$sql);

                $count=mysqli_num_rows($res);

                // Check whether categories ia available or not
                if($count>0)
                {
                    // Category Available
                    while($row=mysqli_fetch_assoc($res))
                    {
                        // Get the value
                        $id=$row['id'];
                        $title=$row['title'];
                        $image_name=$row['image_name'];

                        ?>

                        <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>">
                            <div class="box-3 float-container">

                                <?php 
                                    // Check whether image is available or not
                                     if($image_name =="")
                                     {
                                        // Display Message
                                        echo "<div class='error'>Image not Available</div>";
                                     }
                                     else
                                     {
                                        // Image Available
                                        ?>
                                        <!-- <img src="images/pizza.jpg" alt="Pizza" class="img-responsive img-curve"> -->
                                        <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="Pizza" class="img-responsive img-curve">

                                        <?php
                                     }
                                ?>
                                

                                <h3 class="float-text text-white"><?php echo $title; ?></h3>
                            </div>
                        </a>

                        <?php
                    }
                }
                else
                {
                    // Category not available
                    echo "<div class'error'>Category not Found</div>";
                }

            ?>

            

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->


<?php include('partials-front/footer.php'); ?>