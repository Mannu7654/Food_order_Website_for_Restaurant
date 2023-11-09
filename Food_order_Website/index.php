<?php include('partials-front/menu.php'); ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL;?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <?php 
         if(isset($_SESSION['order']))
         {
            echo $_SESSION['order'];
            unset($_SESSION['order']);
         }
    
    ?>

    <!-- Categories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>


            <?php 
                // Create sql query to display categories from database
                $sql="SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes' LIMIT 3";
                $res=mysqli_query($conn,$sql);
                // COunt rows to check category is available or not
                $count= mysqli_num_rows($res);

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
                    echo "<div class'error'>Category not added</div>";
                }
            ?>
            


            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php 
                // Getting From database That are active and featured
                // Create sql query to display categories from database
                $sql2="SELECT * FROM tbl_food WHERE active='Yes' AND featured='Yes' LIMIT 6";
                $res2=mysqli_query($conn,$sql2);
                // COunt rows to check category is available or not
                $count2= mysqli_num_rows($res2);

                if($count2>0)
                {
                    // Category Available
                    while($row=mysqli_fetch_assoc($res2))
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
                    // Category not available
                    echo "<div class'error'>Category not added</div>";
                }
            
            ?>

            



            <div class="clearfix"></div>

            

        </div>

        <p class="text-center">
            <a href="#">See All Foods</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->


    <?php include('partials-front/footer.php'); ?>