<?php include('partials-front/menu.php'); ?>
    
    <!-- CAtegories Section Starts Here -->
    <section class="Category">
        <div class="container">
            <h2 class="text-center">Explore Categories</h2>

            <?php
            //Display all the categories that are active
            //sql quet=ry
            $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
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
                                    <div class="Box-3 float-container">
                                    <?php 
                                    //check whether img is availABLE OR NOT                                
                                    if($image_name=="")
                                        {
                                            //display msg
                                            echo "<div class='error'>Image not found.</div>";

                                        }
                                        else
                                        {
                                            //image available
                                            ?>
                                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="veg"class="img-responsive img-curve ">
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

                
                    //categories not avalaible
                    echo "<div class='error'>Category not Found</div>";
                }
            
            ?>

        
            <div class="clearfix"></div>
        </div>
    </section>
    
    <!-- Categories Section Ends Here -->


    <?php include('partials-front/footer.php'); ?>