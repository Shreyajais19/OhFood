<?php include('partials-front/menu.php'); ?>
    <?php
        //check whether the food id is set or not
        if(isset($_GET['food_id']))
        {
            //get food id and details of the selected food
            //category id is set and get the id
            $food_id = $_GET['food_id'];
            //getb the details of selected foods
            $sql = "SELECT * FROM tbl_food WHERE id=$food_id";
            $res = mysqli_query($conn, $sql);
            //get the value from databse
            $count = mysqli_num_rows($res);
            //check if data is available
            if($count==1)
            {
                //we have data
                //get data
                $row = mysqli_fetch_assoc($res);
                $title = $row['title'];
                $price = $row['price'];
                $description = $row['description'];
                $image_name = $row['image_name'];
            }
            else
            {
                //food not vailable
                header('location:'.SITEURL);

            }
            
        }
        else
        {
            header('location:'.SITEURL);
        }
    ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="Foodsearch">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" method="POST" class="order">
                <br>
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">
                    <?php 
                        //check if img available or not
                        if($image_name=="")
                        {
                            //img not available
                            echo "<div class='error'>Image not Available</div>";

                        }
                        else
                        {
                            //img not avialable
                            ?>
                            
                            <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                            
                            <?php
                        }                  
                    ?>
                        
                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $title; ?></h3>
                        <input type="hidden" name="food" value="<?php echo $title; ?>">

                        <p class="food-price"><?php echo $price; ?></p>
                        <input type="hidden" name="price" value="<?php echo $price; ?>">

                        <div class="order-label">Quantity</div>
                        <input type="number" name="quantity" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>DELIVERY DETAILS:</legend>
                    <div class="order-label">FULL NAME</div>
                    <input type="text" name="full-name" placeholder="E.g. shreya jaiswal" class="input-responsive" required>

                    <div class="order-label">PHONE NUMBERS</div>
                    <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                    <div class="order-label">EMAIL</div>
                    <input type="email" name="email" placeholder="E.g. ohfood1@gmail.com" class="input-responsive" required>

                    <div class="order-label">ADDRESS</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>
                <br>

            </form>

            <?php  
                // check whether submit button is clicked
                if(isset($_POST['submit']))
                {
                    ///get all the details from the form
                    $food = $_POST['food'];
                    $price = $_POST['price'];
                    $quantity = $_POST['quantity'];

                    $total = $price * $qty;

                    $order_date = date("Y-m-d h:i:sa");//order  date

                    $status = "Ordered"; //ordered, on delivery and delivered and cancel
                    $customer_name = $_POST['full-name'];
                    $customer_contact = $_POST['contact'];
                    $customer_email = $_POST['email'];
                    $customer_address = $_POST['address'];    
                    
                    //save the order in db
                    //create sql to save data
                    $sql2 = "INSERT INTO tbl_order SET
                        food = '$food',
                        price = $price,
                        quantity = $quantity,
                        total = $total,
                        order_date = '$order_date',
                        status = '$status', 
                        customer_name = '$customer_name',
                        customer_contact = '$customer_contact',
                        customer_email = '$customer_email',
                        customer_address = '$customer_address' ";     

                        //echo $sql2; die();  

                    // execute queries
                    
                    $res2 = mysqli_query($conn, $sql2);

                    if($res2==true)
                    {
                        //query executed and order saved
                        $_SESSION['order'] = "<div class='success text-center'> FOOD ORDERED SUCCESSFULLY! </div>"; 
                        header('location:'.SITEURL);

                    }
                    else
                    {
                        //failed to save order
                        $_SESSION['order'] = "<div class='error text-center'>  FAILED TO ORDER FOOD.</div>"; 
                        header('location:'.SITEURL);
                    }                   

                
                }
            
            ?>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>