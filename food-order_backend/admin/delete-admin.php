<?php
    //include constants.php file here
    include('../config/constants.php');

    //1. get the ID of admin to be deleted
    
    $Id = $_GET['Id'];

     //2. create SQL Query to delete admin
    $sql = "DELETE FROM tbl_admin WHERE Id=$Id";

    //execute the query
    $res = mysqli_query($conn,$sql);

    // check whether the query executed succesfully or not
    if($res==true)
    {
        //query executed successfully and admin deleted
        
        //echo "admin deleted ";
        //create session variable to display message
        $_SESSION['delete'] = "<div class='success'>Admin deleted successfully.</div>";
        //redirect to mange admin page
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
    else
    {
        //failed to delete admin
       // echo "failed to delete admin";
       $_SESSION['delete'] = "<div class='error'>Failed to delete Admin. Try again later.</div>";
       header('location:'.SITEURL.'admin/manage-admin.php');
    }
    //3. Redirect to manage admin  page with message (success/error)

?>