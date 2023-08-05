<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>ADD CATEGORY</h1>
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
        <br>
        <!--add category form starts-->
        <form action="" method="POST"enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td><input type="text" name="title" placeholder="category title"></td>
                    
                </tr>
                <tr>
                    <td>select image:</td>
                    <td>
                    <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes" >YES
                        <input type="radio" name="featured" value="No" >NO
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                    <input type="radio" name="active" value="Yes" >YES
                    <input type="radio" name="active" value="No" >NO
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                </tr>
                
            </table>

        </form>

        <!--add category form ends-->
        <?php 
            //check whether the submit button is clicked or not

            if(isset($_POST['submit']))
                {
                    //button clicked
                    //echo "Button clicked";

                    //1. get the data from category form
                    $title = $_POST['title'];

                    //for radio input type we need to check whether the butoon ois selected or not
                    if(isset($_POST['featured']))
                    {
                        //get the value from form
                        $featured = $_POST['featured'];
                    }
                    else
                    {
                        //set the default value
                        $featured = "No";
                    }
                    if(isset($_POST['active']))
                    {
                        $active = $_POST['active'];
                    }
                    else
                    {
                        $active = "No";
                    
                    }
                    //check whether the image is selected or not and set the value for image name accordingly
                    //print_r($_FILES['image']);

                    //die(); //break the code here

                    if(isset($_FILES['image']['name']))
                    {
                        //upload the image
                        //to upload image we need image name and source path and destination path
                        $image_name = $_FILES['image']['name'];
                        //upload image only if image is selected
                        if($image_name!="")
                        {                   
                        //auto rename image
                        //get the extension of our image(jpg,png,gif,etc) e.g "specialfood1.jpg"
                        $ext = end(explode('.', $image_name));

                        //rename the image
                        $image_name = "food_category_".rand(0000, 9999).'.'.$ext; //e.g. food_category_834.jpg

                        $source_path = $_FILES['image']['tmp_name'];

                        $destination_path = "../images/category/".$image_name;

                        //finally upload the image
                        $upload = move_uploaded_file($source_path, $destination_path);

                        //check whether the image is uploaded or not
                        //and if the image is not uploaded then we will stop the process and redirect with error msg
                        if($upload==false)
                        {
                            //set msg
                            $_SESSION['upload'] = "<div class='error'>Failed to upload the image.</div>";
                            //redirect to add category page
                            header("location:".SITEURL.'admin/add-category.php');
                            
                            //stop the process
                            die();
                        }
                    }

                    }
                    else{
                        //dont upload the image and the image name value as blank
                        $image_name="";
                    }

                    //2. create sql query to insert category into database
                    $sql = "INSERT INTO tbl_category SET
                    title='$title',
                    image_name='$image_name',
                    featured='$featured',
                    active='$active' ";
                    
                    //3. executing query and saving data into database
                    $res = mysqli_query($conn, $sql);

                    //4. check whether the (query is executed )data is inserted or not and data added or not
                    if($res==TRUE)
                    {
                        //query executed and actegory added
                        $_SESSION['add'] = "<div class='success'>Category added successfully.</div>";
                        //redirect page TO MANAGE CATEGORY PAGE
                        header('location:'.SITEURL.'admin/manage-category.php');
                    }
                    else
                    {
                        //failed to add category                        
                        $_SESSION['add'] = "<div class='error'>Failed to add category .</div>";
                        //redirect page TO MANAGE CATEGORY PAGE
                        header('location:'.SITEURL.'admin/add-category.php');
            
                    }


                }
        ?>
    </div>
<div>

<?php include('partials/footer.php'); ?>