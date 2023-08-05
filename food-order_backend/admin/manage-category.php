<?php include('<partials/menu.php');?>
   <div class="main-content">
      <div class="wrapper">
        <h1>MANAGE CATEGORY</h1>

        <br /><br />
        <?php 
            if(isset($_SESSION['add'])) //checking whether the session is set or not
            {
                echo $_SESSION['add']; //diaplaying session message
                unset($_SESSION['add']); //removing session message
             }
             if(isset($_SESSION['remove']))
             {
                echo $_SESSION['remove'];
                unset($_SESSION['remove']);
             }
             if(isset($_SESSION['delete']))
             {
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
             }
             if(isset($_SESSION['no-category-found']))
             {
                echo $_SESSION['no-category-found'];
                unset($_SESSION['no-category-found']);
             }
             if(isset($_SESSION['update']))
             {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
             }
             if(isset($_SESSION['upload']))
             {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
             }
             if(isset($_SESSION['failed-remove']))
             {
                echo $_SESSION['failed-remove'];
                unset($_SESSION['failed-remove']);
             }
            
        ?>
        <br><br>

               <!-- button to add category -->
               <a href="<?php echo SITEURL; ?>admin/add-category.php" class="btn-primary">Add Category</a>
               
               <br /><br /><br />
               <table class="tbl-full" >
                  <tr>
                     <th>S.N.</th>
                     <th>TITLE</th>
                     <th>IMAGE</th>
                     <th>FEATURED</th>
                     <th>ACTIVE</th>
                     <th>ACTIONS</th>
                  </tr>
                  <?php 
                     //query to get all categories from database
                     $sql = "SELECT * FROM tbl_category";

                     //execute query
                     $res = mysqli_query($conn, $sql);

                     //count rows
                     $count =  mysqli_num_rows($res);

                     ///create seriall variable number and assign value as 1
                     $sn=1;

                     //check whether we have data in our database or not
                     if($count>0)
                     {
                        //we have data in db
                        //get the data and diaplay
                        while($row = mysqli_fetch_assoc($res))
                        {
                           $Id = $row['Id'];
                           $title = $row['title'];
                           $image_name = $row['image_name'];
                           $featured = $row['featured'];
                           $active = $row['active'];

                           ?>

                              <tr>
                                 <td><?php echo $sn++; ?></td>
                                 <td><?php echo $title; ?></td>

                                 <td>

                                    <?php 

                                       //check whether image name is available or not
                                       if($image_name!= "")
                                       {
                                          //display the image
                                          ?>

                                          <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>"width="100px">                                    
                                          
                                          <?php
                                       }
                                       else
                                       {
                                          //diaplay the message
                                          echo "<div class='error'>image not added.</div>";

                                       }
                                    
                                    ?>
                                 </td>

                                 <td><?php echo $featured; ?></td>
                                 <td><?php echo $active; ?></td>
                                 <td>
                                    <a href="<?php echo SITEURL; ?>admin/update-category.php?Id=<?php echo $Id;?>" class="btn-secondary"> Update category</a>
                                    <a href="<?php echo SITEURL; ?>admin/delete-category.php?Id=<?php echo $Id;?>&image_name=<?php echo $image_name;?>" class="btn-danger"> Delete category</a>
                                 </td>
                              </tr>
                           <?php 

                        }

                     }
                     else
                     {
                        //no data  in db
                        //we will display the msg inside table
                        ?>

                        <tr>
                           <td colspan="6"><div class="error" >No category added.</div></td>
                        </tr>

                        <?php

                     }
                  ?>                 
                                
               </table>
      </div>
   </div>
<?php include('<partials/footer.php');?>