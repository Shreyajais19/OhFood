<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>UPDATE ORDER</h1>

        <?php
            //check whether id is set or not
            if(isset($_GET['id']))
                {
                    //get the id and all other details
                    //echo "Getting the Data";
                    $id=$_GET['id'];
                    //2. create sql query to get the details
                    $sql ="SELECT * FROM tbl_order WHERE id=$id ";
                    //execute the query
                    $res = mysqli_query($conn, $sql);
                    //count the rows
                    $count = mysqli_num_rows($res);
                    if($count==1)
                        {
                            //get the details
                            $row= mysqli_fetch_assoc($res);

                            $food = $row['food'];
                            $price = $row['price'];
                            $quantity = $row['quantity'];
                            $status =  $row['status'];
                            $customer_name = $row['customer_name'];
                            $customer_contact = $row['customer_contact'];
                            $customer_email = $row['customer_email'];
                            $customer_address = $row['customer_address'];
                            
                            
                        }
                        else
                        {
                            header('location:'.SITEURL.'admin/manage-order.php');  
                        }
                }
                    else
                    {
                        //redirect to manage admin page
                        header('location:'.SITEURL.'admin/manage-order.php');  

                    }
                
        ?>

        <br /><br /><br />
            <form action="" method="POST" class="order">
                <table class="tbl-30">
                    <tr>
                        <td>Food Name</td>
                        <td><b><?php echo $food; ?></b></td>
                    </tr> 
                    <tr>
                        <td>Price</td>
                        <td><b><?php echo $price; ?></b></td>
                    </tr>
                    <tr>
                        <td>Quantity</td>                       
                        <td>
                            <input type="number" name="quantity" value="<?php echo $quantity; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td>
                            <select name="status">
                                <option <?php if($status=="Ordered"){echo "selected";} ?>value="Ordered">Ordered </option>
                                <option <?php if($status=="On Delivery"){echo "selected";} ?>value="On Delivery">On Delivery </option>
                                <option <?php if($status=="Delivered"){echo "selected";} ?>value="Delivered">Delivered</option>
                                <option <?php if($status=="Cancel"){echo "selected";} ?>value="Cancel">Cancel </option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Customer name:</td>
                        <td>
                        <input type="text" name="customer_name" value="<?php echo $customer_name; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>Customer contact:</td>
                        <td>
                        <input type="text" name="customer_contact" value="<?php echo $customer_contact; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>Customer email:</td>
                        <td>
                        <input type="text" name="customer_email" value="<?php echo $customer_email; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>Customer address:</td>
                        <td>
                        <textarea name="customer_address" cols="30" rows="5"><?php echo $customer_address; ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="id" value="<?php echo $id; ?>" >
                            <input type="hidden" name="price" value="<?php echo $price; ?>" >
                            <input type="submit" name="submit" value="Update order" class="btn-secondary">
                        </td>
                    </tr>
                </table>
            </form>
            
            <?php
            if(isset($_POST['submit']))
            {
                //echo "button clicked";
                //get all the values from  form
                $id = $_POST['id'];
                $price = $_POST['price'];
                $quantity = $_POST['quantity'];
                $total = $price * $quantity;
                $status =$_POST['status'];
                $customer_name = $_POST['customer_name'];
                $customer_contact = $_POST['customer_contact'];
                $customer_email = $_POST['customer_email'];
                $customer_address = $_POST['customer_address'];
                //update the  values
                $sql2 = "UPDATE tbl_order SET
                    quantity = $quantity,
                    total = $total,
                    status = '$status',
                    customer_name = '$customer_name',
                    customer_contact = '$customer_contact',
                    customer_email = '$customer_email',
                    customer_address = '$customer_address'
                    WHERE id = $id;
                ";
                //execute the query
                $res2 = mysqli_query($conn, $sql2);

                if($res2==true)
                {
                    //updated
                    $_SESSION['update'] = "<div class='success'>Order Updated Successfully.</div>";
                    header('location:'.SITEURL.'admin/manage-order.php');
                    
                }
                else
                {
                    //failed to update
                    $_SESSION['update'] = "<div class='error'>Failed to Update Order.</div>";
                    header('location:'.SITEURL.'admin/manage-order.php');
                    
                }

                //AND Redirect to manage order with msg

            }
            
            
            ?>

    </div>
</div>

<?php include('<partials/footer.php');?>