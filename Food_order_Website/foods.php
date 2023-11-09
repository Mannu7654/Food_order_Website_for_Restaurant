<?php include('partials-front/menu.php'); ?>


    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php 
                // Display all the category that are active
                // SQL query
                $sql="SELECT * FROM tbl_food WHERE active='Yes'";
                $res=mysqli_query($conn,$sql);

                $count=mysqli_num_rows($res);

                // Check whether categories ia available or not
                if($count>0)
                {
                    // Food Available
                    while($row=mysqli_fetch_assoc($res))
                    {
                        // Get the value
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
                                        // Display Message
                                        echo "<div class='error'>Image not Available</div>";
                                     }
                                     else
                                     {
                                        // Image Available
                                        ?>
                                        <!-- <img src="images/menu-pizza.jpg" alt="Chicke Hawain Pizza" class="img-responsive img-curve"> -->
                                        <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Pizza" class="img-responsive img-curve">

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

                                <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                            </div>
                        </div>


                        <?php
                    }
                }
                else
                {
                    // food not available
                    echo "<div class'error'>Food not Found</div>";
                }

            ?>

            

            


            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->


<?php include('partials-front/footer.php'); ?>