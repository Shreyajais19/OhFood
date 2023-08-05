<?php
    include('../config/constants.php');

    //echo "Delete Food Page";
    
    if(isset($_GET['Id']) AND isset($_GET['image_name']))
    {
        //get the value and delete
        //echo "Get Value and Delete";
        $Id = $_GET['Id'];
        $image_name = $_GET['image_name'];
        if($image_name != "")
        {
            //image is available. So remove it
            $path = "../images/food/".$image_name;
            //remove the image
            $remove = unlink($path);

            //if faliled to remove img then add an error msg and stop the process
            if($remove==false)
            {
                //set the session msg
                $_SESSION['upload'] = "<div class='error'>Failed to Remove  Image.</div>";
                //redirect to manage category page
                header('location:'.SITEURL.'admin/manage-food.php');
                //stop  the process
                die();
            }
        }

        $sql = "DELETE FROM tbl_food WHERE Id=$Id";
        //execute the query
        $res = mysqli_query($conn, $sql);

        //chech whether the data is deleted from db or not
        if($res==true)
        {
            //set success msg and redirect
            
            //echo "admin deleted ";
            //create session variable to display message
            $_SESSION['delete'] = "<div class='success'>Food deleted successfully.</div>";
            //redirect to mange category page
            header('location:'.SITEURL.'admin/manage-food.php');
        }
        else
        {
            //failed to delete admin
        // echo "failed to delete admin";
        $_SESSION['delete'] = "<div class='error'>Failed to delete Food. Try again later.</div>";
        header('location:'.SITEURL.'admin/manage-food.php');
        }
        }
        else
        {
            //redirect to Manage category page
            $_SESSION['unauthorize'] = "<div class='error'>Unauthorized Access</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
        }

        ?>