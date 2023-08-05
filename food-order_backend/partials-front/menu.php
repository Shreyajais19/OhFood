<?php include('config\constants.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Below line makes webpage responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Oohfood!</title>

    <!-- Link the css file -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <!-- Navbar section starts here -->
    <section class="Navbar">
        <br>
        <div class="container">
            <div class="Logo">
                <a href="#" title="logo">
                <img src="images/Wlogo.png" alt="logo" width="15%" height="10%">
            </div>

            <div class="menu text-right">
            <ul>
                <li>
                    <a href="<?php echo SITEURL; ?>index.php">Home</a>
                </li>
                <li>
                    <a href="<?php echo SITEURL; ?>category.php">Categories</a>
                </li>
                <li>
                    <a href="<?php echo SITEURL; ?>food.php">Foods</a>
                </li>
                <li>
                    <a href="contact.html">Contact</a>
                </li>
            </ul>
            </div>  
            
            <div class="clearfix"></div>        
        </div>
        <br>
        

    </section>
    <hr>
    <!-- Navbar section ends here -->