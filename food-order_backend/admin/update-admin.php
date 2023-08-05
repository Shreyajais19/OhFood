<?php include('partials/menu.php');?>
<div class="main-content">
    <div class="wrapper">
        <h1>UPDATE ADMIN</h1>
        <br><br>

        <?php 
            //1. get the id of selected admin
            $Id=$_GET['Id'];

            //2. create sql query to get the details
            $sql="SELECT * FROM tbl_admin WHERE Id=$Id ";

            //execute the query
            $res=mysqli_query($conn,$sql);
            
            //check whether the query is executed or not
            if($res==TRUE)
            {
                //check whether the data is available or not
                $count = mysqli_num_rows($res);
                //check whether we have admin data or not
                if($count==1)
                {
                    //get the details
                    //echo"Admin available";
                    $row= mysqli_fetch_assoc($res);
                    $Full_name=$row['Full_name'];
                    $Username=$row['Username'];
                }
                else
                {
                    //redirect to manage admin page
                    header('location:'.SITEURL.'admin/manage-admin.php');  

                }
            }
        ?>

        <form action="" method="POST">
            <table class="tbl-30">
            <tr>
                    <td>Full Name: </td>
                    <td><input type="text" name="full_name" value="<?php echo $Full_name; ?>"></td>
                    
                </tr>
                <tr>
                    <td>Username: </td>
                    <td>
                        <input type="text" name="username" value="<?php echo $Username; ?>">
                    </td>
                </tr>
                
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $Id; ?>">
                        <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                    </td>
                </tr>
                
            </table>

        </form>

    </div>
</div>
<?php
    //CHECK WHETHER THE SUBMIT BUTTON IS CLICKED OR NOT
    if(isset($_POST['submit']))
    {
        //echo "button clicked";
        //get all the values from form to update
        $Id = $_POST['Id'];
        $Full_name = $_POST['full_name'];
        $Username = $_POST['username']; 

        //creaate sql query to update admin
        $sql = "UPDATE tbl_admin SET
        full_name = '$Full_name',
        username = '$Username' 
        WHERE Id ='$Id' ";

        //execute the query
        $res = mysqli_query($conn, $sql);

        //check whwether the query is executed or not
        if($res==TRUE)
        {
            //query executed and update successfully
            $_SESSION['update'] = "<div class='success'>Admin updated successfully.</div>";
            //redirect to mange admin page
            header('location:'.SITEURL.'admin/manage-admin.php');
        }
        else
        {
            //failed to update admin
            $_SESSION['update'] = "<div class='error'>Failed to update admin.</div>";
            //redirect to mange admin page
            header('location:'.SITEURL.'admin/manage-admin.php');
        }
    }
    
?> 
<?php include('partials/footer.php');?>
