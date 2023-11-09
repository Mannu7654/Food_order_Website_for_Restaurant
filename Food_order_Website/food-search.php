<?php include('partials-front/menu.php'); ?>


    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            <?php 
                // Get the search keyword
                // $search=$_POST['search'];  // Old method to search data
                $search=mysqli_real_escape_string($conn,$_POST['search']);    // search data in secure way

            ?>
            
            <h2>Foods on Your Search <a href="#" class="text-white"><?php echo $search; ?></a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php 

                // SQL query to get foods based on search keyword
                $sql= "SELECT * FROM tbl_food WHERE title LIKE '%$search%' OR details LIKE '%$search%'";
                $res=mysqli_query($conn,$sql);
                
                $count=mysqli_num_rows($res);

                if($count>0)
                {
                    // Food Available
                    while($row=mysqli_fetch_assoc($res))
                    {
                        // Get the details
                        $id=$row['id'];
                        $title=$row['title'];
                        $price=$row['price'];
                        $details=$row['details'];
                        $image_name=$row['image_name'];

                        ?>

                        <div class="food-menu-box">
                            <div class="food-menu-img">
                            <?php 
                                    // Check whether image is available or not
                                     if($image_name =="")
                                     {
                                        // Image not available
                                        echo "<div class='error'>Image not Available</div>";
                                     }
                                     else
                                     {
                                        // Image Available
                                        ?>
                                        <!-- <img src="images/menu-pizza.jpg" alt="Chicke Hawain Pizza" class="img-responsive img-curve"> -->
                                        <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" class="img-responsive img-curve">

                                        <?php
                                     }
                                ?>
                
                            </div>

                            <div class="food-menu-desc">
                                <h4><?php echo $title; ?></h4>
                                <p class="food-price">Rs.<?php echo $price; ?></p>
                                <p class="food-detail">
                                    <?php echo $details; ?>
                                </p>
                                <br>

                                <a href="order.html" class="btn btn-primary">Order Now</a>
                            </div>
                        </div>

                        <?php


                    }
                }
                else
                {
                    // Category not available
                    echo "<div class'error'>Food is not found.</div>";
                }
            ?>

            <div class="clearfix"></div>     

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

<?php include('partials-front/footer.php'); ?>