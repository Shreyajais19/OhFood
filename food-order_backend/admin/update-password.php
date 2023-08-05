<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Change password</h1>
        <br>
        <br>
        <?php
            if(isset($_GET['Id']))
            {
                $Id=$_GET['Id'];
            }
            ?>

        
        <form action="" method="POST">
            <table class="tbl-30">
            <tr>
                    <td>CURRENT PASSWORD: </td>
                    <td><input type="password" name="current_pswd" placeholder="current password"></td>
                    
                </tr>
                <tr>
                    <td>NEW PASSWORD:</td>
                    <td>
                        <input type="password" name="new_pswd" placeholder="new password">
                    </td>
                </tr>
                <tr>
                    <td>CONFIRM PASSWORD</td>
                    <td>
                    
                    <input type="password" name="confirm_pswd" placeholder="confirm password">
                    </td>
                </tr>
                
                <tr>
                    <td colspan="2">
                    <input type="hidden" name="id" value="<?php echo $Id; ?>">
                    <input type="submit" name="submit" value="change password" class="btn-secondary">
                    </td>
                </tr>
                
            </table>

        </form>

        <br><br>
    </div>
</div>
<?php 
    //CHECK WHETHER THE SUBMIT BUTTON IS CLICKED OR NOT
    if(isset($_POST['submit']))
    {
        //echo "clicked";

        //1. get the data from form
        $Id = $_POST['id'];
        $current_pswd =md5($_POST['current_pswd']);
        $new_pswd =md5($_POST['new_pswd']);
        $confirm_pswd =md5($_POST['confirm_pswd']);
        //2. check whether the user with current id and pswd exists or not
        $sql = "SELECT * FROM tbl_admin WHERE Id=$Id AND password='$current_pswd'";

        //execute the query
        $res = mysqli_query($conn, $sql);

        if($res==TRUE)
        {
            //check whether data is available or not
            $count= mysqli_num_rows($res);
            if($count==1)
            {
                //user exists and password can be changed
                //echo "user found";
                //check whether the new password and confirm match or not
                if($new_pswd==$confirm_pswd)
                {
                    //update the password
                    //echo "Password match."
                    $sql2 = "UPDATE tbl_admin SET 
                    password='$new_pswd'
                    WHERE id=$Id";
                    //execute the query
                    $res2 = mysqli_query($conn, $sql2);
                    //check whether the query is executed or not
                    if($res2==TRUE)
                    {
                        //display source message
                        //redirect to manage admin page with your message
                        $_SESSION['change-pwd'] ="<div class='success'>Password changed successfully. </div>";
                        //Redirect the user
                        header('location:'.SITEURL.'admin/manage-admin.php');
                    }
                    else{
                        //display error message
                            //redirect to manage admin page with your message
                            $_SESSION['change-pwd'] ="<div class='error'>Failed to change password. </div>";
                            //Redirect the user
                            header('location:'.SITEURL.'admin/manage-admin.php');
                    }
                }
                else
                {
                    //redirect to manage admin page with your message
                    $_SESSION['pwd-not-match'] ="<div class='error'>Password did not match. </div>";
                    //Redirect the user
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }

            }
            else
            {
                //user does not exist set msg and redirect
                $_SESSION['user-not-found'] ="<div class='error'>User not found! </div>";
                //Redirect the user
                header('location:'.SITEURL.'admin/manage-admin.php');
                

            }
        }
        //3. check whether the new and confirm pswd match or not

        //4. change pswd if above is true

        
    }
?>


<?php include('partials/footer.php'); ?>