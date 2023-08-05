<?php
    //include contants file
    include('../config/constants.php');

    //echo "Delete Page";
    //check whether the id and image_name value is set or not
    if(isset($_GET['Id']) AND isset($_GET['image_name']))
    {
        //get the value and delete
        //echo "Get Value and Delete";
        $Id = $_GET['Id'];
        $image_name = $_GET['image_name'];

        //remove  the physical image file is available
        if($image_name != "")
        {
            //image is available. So remove it
            $path = "../images/category/".$image_name;
            //remove the image
            $remove = unlink($path);

//if faliled to remove img then add an error msg and stop the process
            if($remove==false)
            {
                //set the session msg
                $_SESSION['remove'] = "<div class='error'>Failed to Remove Category Image.</div>";
                //redirect to manage category page
                header('location:'.SITEURL.'admin/manage-category.php');
                //stop  the process
                die();
            }
        }
        //delete data from database
        //sql query delete data from databse
        $sql = "DELETE FROM tbl_category WHERE Id=$Id";
        //execute the query
        $res = mysqli_query($conn,$sql);

        //chech whether the data is deleted from db or not
        if($res==true)
    {
        //set success msg and redirect
        
        //echo "admin deleted ";
        //create session variable to display message
        $_SESSION['delete'] = "<div class='success'>Category deleted successfully.</div>";
        //redirect to mange category page
        header('location:'.SITEURL.'admin/manage-category.php');
    }
    else
    {
        //failed to delete admin
       // echo "failed to delete admin";
       $_SESSION['delete'] = "<div class='error'>Failed to delete category. Try again later.</div>";
       header('location:'.SITEURL.'admin/manage-category.php');
    }
    }
    else{
        //redirect to Manage category page
        header('location:'.SITEURL.'admin/manage-category.php');
    }
?>