<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>UPDATE FOOD</h1>
        <br><br>

<?php
    //check whether id is set or not
    if(isset($_GET['Id']))
        {
            //get the id and all other details
            //echo "Getting the Data";
            $Id=$_GET['Id'];
            //2. create sql query to get the details
            $sql2="SELECT * FROM tbl_food WHERE Id=$Id ";
            //execute the query
            $res2=mysqli_query($conn, $sql2);
            
            //count the rows to check whether the id iis valid or not
            $count2 = mysqli_num_rows($res2);
            if($count2==1)
            {
            $row2 = mysqli_fetch_assoc($res2);

            //get the individual values of selected food
            $title = $row2['title'];
            $description = $row2['description'];
            $price = $row2['price'];
            $current_image = $row2['image_name'];
            $current_category = $row2['category_id'];
            $featured = $row2['featured'];
            $active = $row2['active'];
        }
        else{
            $_SESSION['no-food-found'] = "<div class='error'>Food Not Found.</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
        }
    }
    else
    {
        //redirect to manage admin page
        header('location:'.SITEURL.'admin/manage-food.php');  

    }
?>


        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
            <tr>
                    <td>Title: </td>
                    <td><input type="text" name="title" value="<?php echo $title; ?>"></td>
                    
                </tr>
                <tr>
                    <td>Description:</td>
                    <td>
                    <textarea name="description" cols="30" rows="5"><?php echo $description;?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price" value="<?php echo $price;?>">
                    </td>
                </tr>
                <tr>
                <td>Current Image: </td>
                    <td>
                        <?php
                            if($current_image == "")
                            {
                                echo "<div class='error'>Image Not Added.</div>";
                                //display the image
                                
                            }
                            else
                            {
                                //display message
                                ?>

                                <img src="<?php echo SITEURL;?>images/food/<?php echo $current_image; ?>" width="150px" >

                                <?php
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Select New Image:</td>
                    <td>
                    <input type="file" name="name" >
                    </td>
                </tr>
                <tr>
                    <td>Category:</td>
                    <td>
                <select name="category" >
                    <?php
                        //create php code to display categories from database
                        //1. create sql to get all active categories from database
                        $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
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
                                $category_id = $row['Id'];
                                $category_title = $row['title'];

                                //echo "<option value='$category_id'>$category_title</option>";
                                ?>

                                <option <?php if($current_category==$category_id){echo "Selected";} ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>

                                <?php

                            }
                            

                        }
                        else
                        {
                            // we dont have categories

                            echo "<option value='0'>Category Not Available.</option>";
                        }                        
                        ?>
                    </select>
                </td>
                </tr>
                
                
                <tr>
                    <td>Featured: </td>
                    <td>
                        <input <?php if($featured=="Yes"){echo "checked";}?> type="radio" name="featured" value="Yes" >Yes
                        <input <?php if($featured=="No"){echo "checked";}?> type="radio" name="featured" value="No" >No
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input <?php if($active=="Yes"){echo "checked";}?> type="radio" name="active" value="Yes" >Yes
                        <input <?php if($active=="No"){echo "checked";}?> type="radio" name="active" value="No" >No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="Id" value="<?php echo $Id; ?>">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">                        
                        <input type="submit" name="submit" value="Update Food" class="btn-secondary">
                    </td>
                </tr>                
            </table>
            </form>

            <?php
                if(isset($_POST['submit']))
                {
                    //echo "button clicked";
                    //get all the values from form to update
                    $Id = $_POST['Id'];
                    $title = $_POST['title'];                    
                    $description = $_POST['description'];
                    $price = $_POST['price'];
                    $current_image = $_POST['current_image']; 
                    $category = $_POST['category'];

                    $featured = $_POST['featured'];
                    $active = $_POST['active'];

                    //updating new image is selected
                    //check whether the image is selected or not
                    if(isset($_FILES['image']['name']))
                    {
                        //get the image details
                        $image_name = $_FILES['image']['name'];
                        //check whether img is available or not
                        if($image_name!="")
                        {
                            //image available
                            //upload the new img
                            //auto rename image
                            //get the extension of our image(jpg,png,gif,etc) e.g "specialfood1.jpg"
                            $ext = end(explode('.', $image_name));

                            //rename the image
                            $image_name = "food_name_".rand(0000, 9999).'.'.$ext; //e.g. food_category_834.jpg

                            $src_path = $_FILES['image']['tmp_name'];

                            $dest_path = "../images/food/".$image_name;

                            //finally upload the image
                            $upload = move_uploaded_file($src_path,$dest_path);

                            //check whether the image is uploaded or not
                            //and if the image is not uploaded then we will stop the process and redirect with error msg
                            if($upload==false)
                            {
                                //set msg
                                $_SESSION['upload'] = "<div class='error'>Failed to upload the image.</div>";
                                //redirect to add food page
                                header('location:'.SITEURL.'admin/manage-food.php');
                                
                                //stop the process
                                die();
                            }
                            //remove the current img if avialable
                            if($current_image!="")
                            {
                                $remove_path = "../images/food/".$current_image;

                                $remove = unlink($remove_path);
                                //check whether the img is removed or not
                                //if failed to remove then disply msg and stop the process
                                if($remove==false)
                                {
                                    //failed to remove img
                                    $_SESSION['remove-failed'] = "<div class='error'>Failed to remove current image.</div>";
                                    header('location:'.SITEURL.'admin/manage-food.php');
                                    die();
                                }
                            }
                            
                        }
                        else
                        {
                            $image_name= $current_image; //defaullt img when img is not slected
                        }
                        
                    }
                    else
                    {
                        $image_name= $current_image; //default img when button is not clicked
                    }

            
                    //update the databse
                    $sql3 = "UPDATE tbl_food SET
                    title = '$title',
                    description = '$description',
                    price = '$price',
                    image_name = '$image_name',
                    category_id = '$category',
                    featured = '$featured',
                    active = '$active'
                    WHERE Id = '$Id' ";
            
                    //execute the query
                    $res3 = mysqli_query($conn, $sql3);
            
                    //check whwether the query is executed or not
                    if($res3==TRUE)
                    {
                        //query executed and update successfully
                        $_SESSION['update'] = "<div class='success'>Food updated successfully.</div>";
                        //redirect to manage admin page
                        header('location:'.SITEURL.'admin/manage-food.php');
                    }
                    else
                    {
                        //failed to update admin
                        $_SESSION['update'] = "<div class='error'>Failed to update food.</div>";
                        //redirect to mange admin page
                        header('location:'.SITEURL.'admin/manage-food.php');
                    }
                }
            ?>

    </div>
</div>

<?php include('partials/footer.php');?>