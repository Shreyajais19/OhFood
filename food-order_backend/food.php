<?php include('partials-front/menu.php'); ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="Foodsearch text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <hr>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- FoodMenu section starts here -->
    <section class="food-menu">  
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php
            //display foods that are active
            $sql = "SELECT * FROM tbl_food WHERE  active='Yes'";
            $res = mysqli_query($conn, $sql);
            //count rows to check whether the category is available or not
            $count= mysqli_num_rows($res);

            if($count>0)
            {  
              //food available
              while($row=mysqli_fetch_assoc($res))
              {
                //get the values like title, image_name, Id
                $Id = $row['Id'];
                $title = $row['title'];
                $description = $row['description'];
                $price = $row['price'];
                $image_name = $row['image_name'];
                ?>

                <div class="food-menu-box">
                  <div class="food-menu-img">

                  <?php 
                  //check whether img is availABLE OR NOT                                
                  if($image_name=="")
                  {
                    //display msg not there
                    echo "<div class='error'>image not available</div>";
                  }
                  else
                  {
                    //image available
                    ?>
                    <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="veg"class="img-responsive img-curve ">
                    <?php
                  }
                ?>
                    
              </div>
                <div class="food-menu-desc">
                <h4><?php echo $title; ?></h4>
                <p class="food-price"><?php echo $price; ?></p>
                <p class="food-detail"><?php echo $description; ?></p>
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
              echo "<div class='error'>image not available</div>";

            }
            ?>
              
              
            <div class="clearfix"></div>
        
            <div class="clearfix"></div>

        </div>
    </section>
    
    <!-- FoodMenu section ends here -->

    <?php include('partials-front/footer.php'); ?>