<?php include('../config/constants.php');?>

<html>
    <head>
        <title>Login  - Food Order System</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>
    <body>
        <div class="login">
            <h1 class="text-center">Admin Login</h1>
            <br><br>

            <?php
                if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }
                if(isset($_SESSION['no-login-message']))
                {
                    echo $_SESSION['no-login-message'];
                    unset($_SESSION['no-login-message']);
                }
            ?>
<br><br>
            <!-- login form starts here -->
            <form action="" method= "POST" class="text-center">
                Username: </BR>
                <input type="text" name="username" placeholder="Enter Username"><br></BR>
                Password: <BR>
                <input type="password" name="password" placeholder="Enter Password"></BR></BR>
                <input type="submit" name="submit" value="Submit" class="btn-primary">
                <br><br>
            </form>
            <!-- login form ends here -->
            <p class="text-center">Created By - <a href="dsu.edu.in">Bca</a></p>
        </div>
        
    </body>
</html>
<?php
    //check whether the submit button is clicked or not
    if(isset($_POST['submit']))
    {
        //Process for Login
        //1. Get the Data from login form
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        //2.Check sql query whether the user with username and password exists or not
        $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";
        
        //3. Execute the query
        $res = mysqli_query($conn, $sql);

        //4.Count rows to check whether the user exists or not
        $count = mysqli_num_rows($res);

        if($count==1)
                {
                    //user available and login success
                    $_SESSION['login'] = "<div class='success'>Login Successful.</div>";
                    $_SESSION['user'] = $username; //to check whether the user is logged in or not and logout will unset it.

                    //redirect to home page/dashboard
                    header('location:'.SITEURL.'admin/');  
                
                }
                else
                {
                    //user available and login success
                    $_SESSION['login'] = "<div class='error text-center'>Usename or Password did not match.</div>";
                    //redirect to home page/dashboard
                    header('location:'.SITEURL.'admin/login.php');  
                }
    }

?>