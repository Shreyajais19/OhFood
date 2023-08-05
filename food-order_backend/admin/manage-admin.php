      <?php include('partials/menu.php'); ?>

        <!-- Main content Section Starts -->
        <div class="main-content">
            <div class="wrapper">
               <h1>MANAGE ADMIN</h1>

               <br />

               <?php 
                  if(isset($_SESSION['add']))
                  {
                     echo $_SESSION['add']; //diaplaying session message
                     unset($_SESSION['add']); //removing session message
                  }
                  if(isset($_SESSION['delete']))
                  {
                     echo $_SESSION['delete'] = "<div class='success'>Admin deleted successfully.</div>";
                     unset ($_SESSION['delete']) ;
                  }

                  if(isset($_SESSION['update']))
                  {
                     echo $_SESSION['update']; 
                     unset($_SESSION['update']); 
                  }

                  if(isset($_SESSION['user-not-found']))
                  {
                     echo $_SESSION['user-not-found']; 
                     unset($_SESSION['user-not-found']); 
                  }

                  if(isset($_SESSION['pwd-not-match']))
                  {
                     echo $_SESSION['pwd-not-match']; 
                     unset($_SESSION['pwd-not-match']); 
                  }
                  if(isset($_SESSION['change-pwd']))
                  {
                     echo $_SESSION['change-pwd']; 
                     unset($_SESSION['change-pwd']); 
                  }
               
               ?>
               <br><br>

               <!-- button to add admin -->
               <a href="add-admin.php" class="btn-primary">Add Admin</a>
               
               <br /><br /><br />
               <table class="tbl-full" >
                  <tr>
                     <th>S.N.</th>
                     <th>FULL NAME</th>
                     <th>USERNAME</th>
                     <th>ACTIONS</th>
                    
                  </tr>

                  <?php 
                     //query to get all admin
                     $sql = 'SELECT * FROM tbl_admin';
                     //execute the query
                     $res = mysqli_query($conn, $sql);

                     //check whether the query is executed or not
                     if($res==TRUE)
                     {
                        //count rows to check whether we have data in database or not
                        $count = mysqli_num_rows($res); //function to get all the rows in database

                        $sn=1; //create a variable and assign a  value

                        //check the number of rows
                        if($count>0)
                        {
                           //we have data in database
                           while($row=mysqli_fetch_assoc($res))
                           {
                              //using while loop to get all  the data from database
                              //and while loop will run as long as we have data in databse                                             
                              // get individual data                               
                                 $Id = $row['Id'];                                 
                                 $Full_name = $row['Full_name'];                            
                                           
                                 $Username = $row['Username'];                                                             

                              //display the values in our table
                              ?>
                             

                              <tr>
                                 <td><?php echo $sn++; ?>. </td>
                                 <td><?php echo $Full_name; ?></td>
                                 <td><?php echo $Username; ?></td>
                                 <td>
                                    <a href="<?php echo SITEURL; ?>admin/update-password.php? Id=<?php echo $Id; ?>" class="btn-primary">Change password</a>
                                    <a href="<?php echo SITEURL; ?>admin/update-admin.php? Id=<?php echo $Id; ?>" class="btn-secondary"> Update admin</a>
                                    <a href="<?php echo SITEURL; ?>admin/delete-admin.php? Id=<?php echo $Id; ?>" class="btn-danger"> Delete admin</a>
                                 </td>
                              </tr>
                              

                              <?php 
                           }
                        }
                        else
                        {
                           // we do not have data in database                     
                        }

                     }
                  ?>              
               
               </table>

            </div>
        </div>
        <!-- Main content Section Starts -->

        <?php include('partials/footer.php');?>
