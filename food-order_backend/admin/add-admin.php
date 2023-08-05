<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>ADD ADMIN </h1>

        <br /><br />
        <?php 
            if(isset($_SESSION['add'])) //checking whether the session is set or not
            {
                echo $_SESSION['add']; //diaplaying session message
                unset($_SESSION['add']); //removing session message
             }
            
        ?>

        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td><input type="text" name="full_name" placeholder="enter your name"></td>
                    
                </tr>
                <tr>
                    <td>Username: </td>
                    <td>
                        <input type="text" name="username" placeholder="enter your username">
                    </td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td>
                    <input type="password" name="password" placeholder="enter your password">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>
                
            </table>

        </form>

    </div>
</div>

<?php include('partials/footer.php'); ?>

<?php
    //Process the value from Form and save  it in Database 
    //check whether the submit button is clicked or not

    if(isset($_POST['submit']))
    {
        //button clicked
        //echo "Button clicked";

        //1. get the data from form
        $Full_name = $_POST['full_name'];
        $Username = $_POST['username'];
        $Password = md5($_POST['password']); //password encryption with md5

        //2. sql query to save the data into database
        $sql = "INSERT INTO tbl_admin SET
            Full_name='$Full_name',
            Username='$Username',
            Password='$Password' ";

       //3. executing query and saving data into database

        $res = mysqli_query($conn, $sql) or die(mysqli_error()); //res = resolve

        //4. check whether the (queryis executed )data is inserted or not and display appropriate message
        if($res==TRUE)
        {
            //data inserted
            //echo"data inserted";
            //create a session variable to display message
            $_SESSION['add'] = "admin added successfully";
            //redirect page TO MANAGE ADMIN
            header("location:".SITEURL.'admin/manage-admin.php');
        }
        else
        {
            //failed to insert data
            //echo"data not inserted";
             //create a session variable to display message
             $_SESSION['add'] = " failed to add admin";
             //redirect page TO add ADMIN
             header("location:".SITREURL.'admin/add-admin.php');
 
        }

        
    }

?>