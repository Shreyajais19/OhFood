<?php include('partials-front/menu.php'); ?>

<!-- food search section starts here -->
<section class="Foodsearch text-centre">
  <div class="container">

    <?php
    //get the search keyword
    $search = $_POST['search'];
    ?>

    <h2>Food on Your Search <a href="#" class="text-white">"<?php echo $search; ?>"</a></h2>
  </div>
</section>

<!-- FoodMenu section starts here -->
<section class="food-menu">  
    <div class="container">
        <h2 class="text-center">Food Menu</h2>

        <?php   

        //sql query to get food based on search keyword
        $sql = "SELECT * FROM tbl_food WHERE title LIKE '%$search%' OR description LIKE '%$search%'";
        //execure the query
        //execute the query
        $res = mysqli_query($conn, $sql);

        //count rows
        $count = mysqli_num_rows($res);
        //check whether food available
        if($count>0)
                {
                    //food available
                    while($row=mysqli_fetch_assoc($res))
                    {
                        //get all the values
                        $Id = $row['Id'];
                        $title = $row['title'];
                        $price = $row['price'];
                        $description = $row['description'];
                        $image_name = $row['image_name'];
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
                                    <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="momo" class="img-responsive img-curve" >

                                    <?php
                                }
                            ?>

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

                            <a href="order.html" class="btn btn-primary"> Order now </a>
                        </div>
                        </div>
                        <?php
                    }
                }
                else
                {
                    //food not available
                    echo "<div class='error'>Food not available. </div>";
                }
        ?>

        
        <div class="clearfix"></div>

    
        <div class="clearfix"></div>


    </div>
</section>
<!-- FoodMenu section ends here -->


<?php include('partials-front/footer.php'); ?>