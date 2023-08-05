<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>UPDATE CATEGORY</h1>
        <br><br>

        <?php 
        if(isset($_GET['Id']))
        {
            //get the id and all other details
            //echo "Getting the Data";
            $Id=$_GET['Id'];
            //2. create sql query to get the details
            $sql= "SELECT * FROM tbl_category WHERE Id=$Id ";
            //execute the query
            $res= mysqli_query($conn, $sql);
            
            //count the rows to check whether the id iis valid or not
            $count = mysqli_num_rows($res);
            if($count==1)
                {
                    //get the details
                    $row= mysqli_fetch_assoc($res);
                    $title = $row['title'];
                    $current_image = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];
                    
                }
                else
                {
                    //redirect to manage category page with session message
                    $_SESSION['no-category-found'] = "<div class='error'>Category Not Found.</div>";

                    header('location:'.SITEURL.'admin/manage-category.php');  

                }

        }
            else
            {
                //redirect to manage admin page
                header('location:'.SITEURL.'admin/manage-category.php');  

            }
           
            ?>
            

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
            <tr>
                    <td>Title: </td>
                    <td><input type="text" name="title" value="<?php echo $title; ?>"></td>
                    
                </tr>
                <tr>
                    <td>Current Image: </td>
                    <td>
                        <?php
                            if($current_image != "")
                            {
                                //display the image
                                ?>
                                <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image;?>" width="100px" >
                                <?php
                            }
                            else{
                                //display message
                                echo "<div class='error'>Image Not Added.</div>";
                            }
                        ?>
                    </td>
                </tr>
                
                <tr>
                    <td>New Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Featured:</td>
                    <td>
                        <input <?php if($featured=="Yes"){echo "checked";}?> type="radio" name="featured" value="Yes">Yes
                        
                        <input <?php if($featured=="No"){echo "checked";}?> type="radio" name="featured" value="No">No
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input <?php if($active=="Yes"){echo "checked";}?> type="radio" name="active" value="Yes">Yes
                        <input <?php if($active=="No"){echo "checked";}?> type="radio" name="active" value="No">No
                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="Id" value="<?php echo $Id; ?>">
                        <input type="submit" name="submit" value="Update Category" class="btn-secondary">
                    </td>
                    </tr>
                
            </table>
            </form>
            <?php
                if(isset($_POST['submit']))
                {
                    //echo "button clicked";
                    //get all the values from form to update
                    $title = $_POST['title'];
                    $Id = $_POST['Id'];
                    $current_image = $_POST['current_image']; 
                    $featured = $_POST['featured'];
                    $active = $_POST['active'];

                    //updateing new image is selected
                    //check whether the image is selected or not
                    if(isset($_FILES['image']['name']))
                    {
                        //get the image details
                        $image_name = $_FILES['image']['name'];
                        //check whether img is available or not
                        if($image_name != "")
                        {
                            //image available
                            //upload the new img
                            //auto rename image
                        //get the extension of our image(jpg,png,gif,etc) e.g "specialfood1.jpg"
                        $ext = end(explode('.', $image_name));

                        //rename the image
                        $image_name = "food_category_".rand(0000, 9999).'.'.$ext; //e.g. food_category_834.jpg

                        $source_path = $_FILES['image']['tmp_name'];

                        $destiantion_path = "../images/category/".$image_name;

                        //finally upload the image
                        $upload = move_uploaded_file($source_path,$destiantion_path);

                        //check whether the image is uploaded or not
                        //and if the image is not uploaded then we will stop the process and redirect with error msg
                        if($upload==false)
                        {
                            //set msg
                            $_SESSION['upload'] = "<div class='error'>Failed to upload the image.</div>";
                            //redirect to add category page
                            header("location:".SITEURL.'admin/manage-category.php');
                            
                            //stop the process
                            die();
                        }
                            //remove the current img if avialable
                            if($current_image!="")
                            {
                                $remove_path = "../images/category/".$current_image;

                                $remove = unlink($remove_path);
                                //check whether the img is removed or not
                                //if failed to remove then disply msg and stop the process
                                if($remove==false)
                                {
                                    //failed to remove img
                                    $_SESSION['failed-remove'] = "<div class='error'>Failed to remove current image.</div>";
                                    header('location:'.SITEURL.'admin/manage-category.php');
                                    die();
                                }
                            }
                            
                        }
                        else
                        {
                            $image_name= $current_image;
                        }
                    }
                    else{
                        $image_name= $current_image;
                    }

            
                    //update the databse
                    $sql2 = "UPDATE tbl_category SET
                    title = '$title',
                    image_name = '$image_name',
                    featured = '$featured',
                    active = '$active'  
                    WHERE Id ='$Id' ";
            
                    //execute the query
                    $res2 = mysqli_query($conn, $sql2);
            
                    //check whwether the query is executed or not
                    if($res2==TRUE)
                    {
                        //query executed and update successfully
                        $_SESSION['update'] = "<div class='success'>Category updated successfully.</div>";
                        //redirect to mange admin page
                        header('location:'.SITEURL.'admin/manage-category.php');
                    }
                    else
                    {
                        //failed to update admin
                        $_SESSION['update'] = "<div class='error'>Failed to update category.</div>";
                        //redirect to mange admin page
                        header('location:'.SITEURL.'admin/manage-category.php');
                    }
                }
            ?>

    </div>
</div>

<?php include('partials/footer.php');?>