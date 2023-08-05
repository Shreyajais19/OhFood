<?php include('partials-front/menu.php'); ?>

<?php
    //check whether id is passed or not
    if(isset($_GET['category_id']))
    {
        //category id is set and get the id
        $category_id = $_GET['category_id'];
        //Get the category title based on category id
        $sql = "SELECT title FROM tbl_category WHERE id=$category_id";
        //execute the query
        $res = mysqli_query($conn, $sql);
        //get the value from databse
        $row = mysqli_fetch_assoc($res);
        //get the totle
        $category_title = $row['title'];
    }
    else{
        //category not passed
        //redirect to home page
        header('location:'.SITEURL);

    }
?>


    <!-- fOOD sEARCH Section Starts Here -->
    <section class="Foodsearch text-centre">
  <div class="container">

    <h2 class="text-white">Foods on <a href="#" class="text-white">"<?php echo $category_title; ?>"</a></h2>
  </div>
</section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
                $sql2 = "SELECT * FROM tbl_food WHERE category_id=$category_id";
                //execute the query
                $res2 = mysqli_query($conn, $sql2);
            
                $count2 = mysqli_num_rows($res2);
                //check whether food available
                if($count2>0)
                        {
                            //food available
                            while($row2=mysqli_fetch_assoc($res2))
                            {
                                //get all the values
                                $Id = $row2['Id'];
                                $title = $row2['title'];
                                $price = $row2['price'];
                                $description = $row2['description'];
                                $image_name = $row2['image_name'];
                                ?>

                                <div class="food-menu-box">
                                    <div class="food-menu-img">
                                    <?php 
                                    //check whether img available or not
                                    if($image_name=="")
                                    {
                                    //img not available
                                    echo "<div class='error'>Image not Available</div>";
                                    }
                                    else
                                    {
                                     //image available
                                    ?>
                                    <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Crispy Baked Falafels" class="img-responsive img-curve">
                                    <?php
                                    }
                                    ?>                    
                                    </div>
                                    <div class="food-menu-desc">
                                        <h4><?php echo $title; ?></h4>
                                        <p class="food-price"><?php echo $price; ?></p>
                                        <p class="food-detail">
                                        <?php echo $description; ?>
                                        </p>
                                        <br>
                                        <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $Id; ?>" class="btn btn-primary">Order Now</a>
                                    </div>
                                </div>

                                <div class="food-menu-box">
                                        <div class="food-menu-img">
                                        
        
                                       </div>
                                      <div class="food-menu-desc">
                                      <h4><?php echo $title; ?></h4>
                                      <p class="food-price"><?php echo $price; ?></p>
                                      <p class="food-detail">  <?php echo $description; ?></p>
                                      <br>
        
                                      <a href="#" class="btn btn-primary"> Order now </a>
                                      </div>
                                  </div>
                                <div class="food-menu-box">
                                    
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
                            echo "<div class='error'>Food not Available. </div>";
                        }
                ?>

            ?>


            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>