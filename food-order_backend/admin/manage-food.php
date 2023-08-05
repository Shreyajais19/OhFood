<?php include('<partials/menu.php');?>
<div class="main-content">
    <div class="wrapper">
        <h1>MANAGE FOOD</h1>
        <br /><br />

              
               <a href="<?php echo SITEURL; ?>admin/add-food.php" class="btn-primary">Add Food</a>
               
               <br /><br /><br />

               <?php 
                  if(isset($_SESSION['add'])) //checking whether the session is set or not
                  {
                     echo $_SESSION['add']; //diaplaying session message
                     unset($_SESSION['add']); //removing session message
                  }
                  if(isset($_SESSION['delete']))
                  {
                     echo $_SESSION['delete'];
                     unset($_SESSION['delete']);
                  }
                  if(isset($_SESSION['upload']))
                  {
                     echo $_SESSION['upload'];
                     unset($_SESSION['upload']);
                  }
                  if(isset($_SESSION['unauthorize']))
                  {
                     echo $_SESSION['unauthorize'];
                     unset($_SESSION['unauthorize']);
                  }
                  if(isset($_SESSION['no-food-found']))
                  {
                     echo $_SESSION['no-food-found'];
                     unset($_SESSION['no-food-found']);
                  }
                  if(isset($_SESSION['update']))
                  {
                     echo $_SESSION['update'];
                     unset($_SESSION['update']);
                  }

                  ?>
                  <br>
                  <br>

               <table class="tbl-full" >
                  <tr>
                     <th>S.N.</th>
                     <th>TITLE</th>
                     <th>PRICE</th>
                     <th>IMAGE</th>
                     <th>FEATURED</th>
                     <th>ACTIVE</th>
                     <th>ACTIONS</th>
                  </tr>

                  <?php
                     //create sql query to get all the food
                     $sql = "SELECT * FROM tbl_food";

                     //execute the query
                     $res = mysqli_query($conn, $sql);

                                         
                     //count to check if we have food or not
                     $count = mysqli_num_rows($res);

                     //create num variable and set default value as 1
                     $sn=1;

                     if($count>0)
                     {
                        //we have food in db
                        //get the foods from db and display
                        while($row=mysqli_fetch_assoc($res))
                        {
                           //get the value from individual columns
                           $Id = $row['Id'];
                           $title = $row['title'];
                           $price= $row['price'];
                           $image_name = $row['image_name'];
                           $featured =$row['featured'];
                           $active = $row['active'];
                           
                           ?>

                           <tr>
                              <td><?php echo $sn++; ?></td>
                              <td><?php echo $title; ?></td>
                              <td><?php echo $price; ?></td>
                              <td>
                                 <?php 
                                     //check whether we have image or not
                                     if($image_name!= "")
                                     {
                                        //we have image,display img
                                        ?>
                                        <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" width="100px">
                                        <?php
                                       
                                    }
                                    else
                                    {
                                       //we do not have image, display error message
                                       echo "<div class='error'>image not added.</div>";                                          
                                    }
                                 
                                 ?>
                              </td>
                              <th><?php echo $featured; ?></th>
                              <th><?php echo $active; ?></th>             

                              <td>
                              <a href="<?php echo SITEURL; ?>admin/update-food.php?Id=<?php echo $Id; ?>" class="btn-secondary"> Update food</a>
                              <a href="<?php echo SITEURL; ?>admin/delete-food.php?Id=<?php echo $Id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger"> Delete food</a>
                              </td>
                           </tr>


                           <?php

                        }
                     }
                     else
                     {
                        //food not added in db
                        echo "<tr> <td colspan='7' class='error'>Food not added yet.</td> </tr>";                    }
                     
                  
                  ?>             
                 
               
               </table>
    </div>
</div>
<?php include('<partials/footer.php');?>