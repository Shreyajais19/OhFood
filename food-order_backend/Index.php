<?php include('partials-front/menu.php'); ?>

    <!-- Foodsearch section starts here -->
    <section class="Foodsearch text-center">
        <div class="container">
           <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
               <input type="search" name="search" placeholder="Search for food..." required>
                <input type="submit" name="submit" value="Search" placeholder="Search" class="btn btn-primary">
            </form> 
        </div>
        <br>
        
       
    </section>
    <hr>
    <!-- Foodsearch section ends here -->

    <?php 
        if(isset($_SESSION['order']))
        {
            echo $_SESSION['order'];
            unset ($_SESSION['order']);
        }
    
    ?>

    <!-- Category section starts here -->
    <section class="category">  
        <br> 
        <div class="container">
            <h2 class="text-center">CATEGORIES</h2>

            <?php 
                //create sql query to display catgeories from database
                $sql = "SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes' LIMIT 6";
                //execute the query
                $res = mysqli_query($conn, $sql);
                //count rows to check whether the category is available or not
                $count= mysqli_num_rows($res);

                if($count>0)
                {
                    //categories available
                    while($row=mysqli_fetch_assoc($res))
                    {
                        //get the values like title, image_name, Id
                        $Id = $row['Id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        ?>

                        <a href="<?php echo SITEURL;?>category-food.php?category_id=<?php echo $Id; ?>">
                            <div class="Box-3 float-container ">
                                <?php 
                                //check whether img is availABLE OR NOT                                
                                if($image_name=="")
                                    {
                                        //display msg
                                        echo "<div class='error'>Image not available</div>";

                                    }
                                    else
                                    {
                                        //image available
                                        ?>
                                        <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="veg"class="img-responsive img-curve ">
                                        <?php
                                    }
                                ?>
                                
                                <h3 class="float-text text-white"><?php echo $title; ?> </h3>
                            </div>
                    
                        </a>
    

                        <?php
                    }
                }
                else
                {                
                    //categories not avalaible
                    echo "<div class='error'>category not added</div>";
                }             
            ?>
        <div class="clearfix"></div>
        </div>
        <br>
    </section>
    <hr>
    <!-- Category section ends here -->

    <!-- FoodMenu section starts here -->
    <section class="food-menu">  
        <div class="container">
            <h2 class="text-center">Food Menu</h2><hr>

            <?php 
                //getting foods from database that are active and featured
                $sql2= "SELECT * FROM tbl_food WHERE active='Yes' AND featured='Yes' LIMIT 6";
                
                //execute the query
                $res2 = mysqli_query($conn, $sql2);

                //count rows
                $count2 = mysqli_num_rows($res2);

                //check whether food available or not
                if($count2>0)
                {
                    //food available
                    while($row=mysqli_fetch_assoc($res2))
                    {
                        //get all the values
                        $Id = $row['Id'];
                        $title = $row['title'];
                        $price = $row['price'];
                        $description = $row['description'];
                        $image_name = $row['image_name'];
                        ?>
                        <div class="food-menu-box">
                            <?php 
                                //check whether img available or not
                                if($image_name=="")
                                {
                                    //img not available
                                    echo "<div class='error'>Image not available</div>";
                                }
                                else
                                {
                                    //image available
                                    ?>
                                    <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="momo" class="img-responsive img-curve" >

                                    <?php
                                }
                            ?>
                        <div class="food-menu-img">
                            
                            </div>
                            <div class="food-menu-desc">
                            <h4><?php echo $title; ?> </h4>
                            <p class="food-price"><?php echo $price; ?></p>
                            <p class="food-detail"><?php echo $description; ?> </p>
                            <br>

                            <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $Id; ?>" class="btn btn-primary"> Order now </a>
                        </div>
                        </div>
                        <?php
                    }
                }
                else
                {
                    //food not available
                    echo "<div class='error'>food not available. </div>";
                }
            ?>            
        <div class="clearfix"></div>
        
            <div class="clearfix"></div>

        </div>
        
        <p class="text-center">
            <a href="#" > see all foods..</a>
            </p>            
        </section>
        
    <!-- FoodMenu section ends here -->
 
    <?php include('partials-front/footer.php'); ?>