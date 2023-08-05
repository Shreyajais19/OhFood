<?php include('<partials/menu.php');?>
<div class="main-content">
    <div class="wrapper">
        <h1>ADD FOOD</h1>
        <br /><br />

        <?php 
             if(isset($_SESSION['add'])) //checking whether the session is set or not
             {
                 echo $_SESSION['add']; //diaplaying session message
                 unset($_SESSION['add']); //removing session message
             }
            if(isset($_SESSION['upload'])) //uploading image
            {
                echo $_SESSION['upload']; 
                unset($_SESSION['upload']);
            }
        ?>
        <br>
        <form action="" method="POST"enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td><input type="text" name="title" placeholder=" title of food"></td>
                    
                </tr>
                <tr>
                    <td>Description:</td>
                    <td>
                    <textarea name="description" cols="30" rows="5" placeholder="description of food"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price" >
                    </td>
                </tr>
                <tr>
                    <td>Select image:</td>
                    <td>
                    <input type="file" name="image" >
                    </td>
                </tr>
                <tr>
                    <td>Category:</td>
                    <td>
                <select name="category" >
                    <?php
                        //create php code to display categories from database
                        //1. create sql to get all active categories from database
                        $sql = "SELECT * FROM tbl_category WHERE active='YES'";
                        //executing queries
                        $res = mysqli_query($conn, $sql);

                        //count rows to check whether we ahve categories or not
                        $count = mysqli_num_rows($res);

                        //if count is greater than 0, we have categories
                        if($count>0)
                        {
                            //we have catgeories
                            while($row = mysqli_fetch_assoc($res))
                            {
                                //get the details of category
                                $Id = $row['Id'];
                                $title = $row['title'];

                                ?>

                                <option value="<?php echo $Id; ?>"><?php echo $title; ?></option>

                                <?php
                            }
                            

                        }
                        else
                        {
                            // we dont have categories

                            ?>

                            <option value="0" >No categories found  </option>
                            
                            <?php
                        }

                        //2. display the dropdown
                    ?>
                </select>
                    </td>
                </tr>
                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="YES" >YES
                        <input type="radio" name="featured" value="No" >No
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="active" value="YES" >YES
                        <input type="radio" name="active" value="No" >No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add food" class="btn-secondary">
                    </td>
                </tr>                
            </table>
        </form>

        <?php
        //check whether the button is clicked or not
        if(isset($_POST['submit']))
        {
            //add food in database
            //echo "clicked";

            //1. get data from from
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $category = $_POST['category'];

            //check whether the radio button for featured active are check or not
            if(isset($_POST['featured']))
            {
                $featured = $_POST['featured'];
            }
            else
            {
                $featured = "No"; // setting default value
            }
            if(isset($_POST['active']))
            {
                $active = $_POST['active'];

            }
            else
            {
                $active ="No"; //setting default value

            }
            //2. upload the image if selected
            //check whether image is clicked or not and upload the image only if the image is selected of not
            if(isset($_FILES['image']['name']))
            {
                //get the details of the selected image
                $image_name=$_FILES['image']['name'];

                //check if image is selected or not and upload only if selected
                if($image_name!="")
                {
                    // image is selected
                    //a. rename the image
                    // get the extension of slected image like(jpg,png,etc)

                    $ext = end(explode('.', $image_name));

                    //create new name for image
                    $image_name = "food_name_".rand(0000,9999).'.'.$ext;  // new image name

                    //b. upload the image
                    //get src and destination path
                    //src path is the current location of img
                    $src = $_FILES['image']['tmp_name'];

                    //destination path for image to be uploaded
                    $dst = "../images/food/".$image_name; 

                    //finally uploaD THE IMAGE
                    $upload = move_uploaded_file($src, $dst);


                    //check if img is uploaded or not
                    if($upload==false)
                    {
                        //failed to upload img
                        //redirect to add food page with error msg
                        $_SESSION['upload'] = "<div class='error'>Failed to upload image.</div>";
                        header("location:".SITEURL.'admin/add-food.php');

                        //stop the process
                        die();

                    }                  
                }
            }
            else
            {
                $image_name=""; //setting default value as blank
            }

            //3. insert data into database
            //create sql query to add and save data
            $sql2 = "INSERT INTO tbl_food SET
            title= '$title',
            description = '$description',
            price = '$price',
            image_name = '$image_name',
            category_id = '$category',
            featured = '$featured',
            active = '$active' ";

            //execute the query
            $res2 = mysqli_query($conn, $sql2);
            
            //4. redirect with msg to manage food page
            if($res2==true)
            {   
                //data inserted success
                $_SESSION['add'] = "<div class='success'>Food added successfully.</div>";
                header('location:'.SITEURL.'admin/manage-food.php');

            }
            else
            {
                //failed to insert data
                $_SESSION['add'] = "<div class='error'>Failed to add food.</div>";
                //redirect page TO MANAGE CATEGORY PAGE
                header('location:'.SITEURL.'admin/add-food.php');
            }           
        }
        ?>
    </div>
</div>
<?php include('<partials/footer.php');?>