<?php
    /* database connection */
    include 'connection.php';
    session_start();

    /* navigation bar icon through login/logout connection */
    // $admin_id = $_SESSION['admin_id'];
    // if (!isset($admin_id)) {
    //     header('location:login.php');
    // }
    // if (isset($_POST['logout'])){
    //     session_destroy();
    //     header('location:login.php');
    // }

    /* ------------adding products to database------------- */
    if (isset($_POST['add_product'])){
        $product_name = mysqli_real_escape_string($conn, $_POST['name']);
        $product_price = mysqli_real_escape_string($conn, $_POST['price']);
        $product_detail = mysqli_real_escape_string($conn, $_POST['detail']);
        $image = $_FILES['image']['name'];
        $image_size = $_FILES['image']['size'];
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $image_folder = 'image/'.$image;

        /* check out, does the item to be inserted already exist? */
        $select_product_name = mysqli_query($conn, "SELECT name FROM `products` WHERE name = '$product_name'") or die('query failed');
        if(mysqli_num_rows($select_product_name) > 0){
            $message[] = 'product name already exist';
        }else{
            /* above condition false, insert item to database */
            $insert_product = mysqli_query($conn, "INSERT INTO `products`(`name`, `price`, `product_detail`, `image`)
                VALUES('$product_name','$product_price','$product_detail','$image')") or die('query failed');
            /* check the image size */
            if($insert_product){
                if($image_size > 2000000) {
                    $message[] = 'product image size is too large';
                }else{
                    move_uploaded_file($image_tmp_name, $image_folder);
                    $message[] = 'product added successfully';
                }
            }
        }
    }
    /*----------------deleting products from database-------------------*/
    if(isset($_GET['delete'])) {
        $delete_id = $_GET['delete'];
        $select_delete_image = mysqli_query($conn, "SELECT image FROM `products` WHERE id = $delete_id") or die('query failed');
        $fetch_delete_image = mysqli_fetch_assoc($select_delete_image);
        unlink('image/'.$fetch_delete_image['image']);

        mysqli_query($conn, "DELETE FROM `products` WHERE id = '$delete_id'") or die('query failed');

        /* after delete items stay in the product page */
        header('location:admin_product.php');
    }
    /*------------------------update products--------------------*/
    if(isset($_POST['update_product'])) {
        $update_p_id = $_POST['$update_p_id'];
        $update_p_name = $_POST['$update_p_name'];
        $update_p_price = $_POST['$update_p_price'];
        $update_p_detail = $_POST['$update_p_detail'];
        $update_p_img=$_FILES['$update_p_image']['name'];
        $update_p_image_tmp_name=$_FILES['$update_p_image']['tmp_name'];
        $update_p_image_folder = 'image/'.$update_p_img;

        $update_query = mysqli_query($conn, "UPDATE `products` SET id='$update_p_id', name='$update_p_name', price='$update_p_price',
        product_detail = '$update_p_detail',image='$update_p_img' WHERE id='$update_p_id'") or die('query failed');

        if($update_query) {
            move_uploaded_file($update_p_image_tmp_name,$update_p_image_folder);
            $message[]='product update successfully';
            header('location:admin_product.php');
        }else{
            $message[]='product could not updated successfully';
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" 
    crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="styleHeader.css">
    <link rel="stylesheet" type="text/css" href="styleOrders.css">
    <link rel="stylesheet" type="text/css" href="styleDashboard.css">
    <link rel="stylesheet" type="text/css" href="styleAdminPro.css">
    <link rel="stylesheet" type="text/css" href="styleeditp.css">
    <title>Document</title>
</head>
<body>
    <!-- header part import -->
    <?php include 'admin_header.php'; ?>

     <!-- boostrap close icon (click the icon, then remove the entire message container) -->
    <?php 
        if(isset($message)){
            foreach($message as $message) {
                echo'
                    <div class="message">
                        <span>'.$message.'</span>
                        <i class="bi bi-x-circle" onclick="this.parentElement.remove()"></i>
                    </div>
                ';
            }
        }
    ?>

     <!-- product add container -->
    <section class="add-products">
         <!-- set the text boxes and buttons in the form -->
        <form method="post" action="" enctype="multipart/form-data">
            <h1 class="title">Add new products</h1>
            <div class="input-field">
                <label>product name</label>
                <input type="text" name="name" required>
            </div>
            <div class="input-field">
                <label>product price</label>
                <input type="text" name="price" required>
            </div>
            <div class="input-field">
                <label>product detail</label>
                <textarea name="detail" required></textarea>
            </div>
            <div class="input-field">
                <label>product image</label>
                 <!-- all image types accept -->
                <input type="file" name="image" accept="image/jpg, image/png, image/jpeg, image/webp" required>
            </div>
            <input type="submit" name="add_product" value="add product" class="btn">
        </form>
    </section>

    <!-------------------show products section--------------------->
    
    <section class="show-products">
        <div class="box-container">

             <!-- get the product details from product table in the database -->
            <?php
                $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die('query failed');
                if(mysqli_num_rows($select_products) > 0){
                    while($fetch_products = mysqli_fetch_assoc($select_products)){
 
                
            ?>
            
             <!-- set the above selected details to products boxes in product page -->
            <div class="box">
                <img src="image/<?php echo $fetch_products['image']; ?>">
                
                <p>price : Rs. <?php echo $fetch_products['price']; ?></p>
                <h4><?php echo $fetch_products['name']; ?></h4>
                <p class="detail"><?php echo $fetch_products['product_detail']; ?></p>
                
                <!-- delete and edit buttons -->
                <a href="admin_product.php?edit=<?php echo $fetch_products['id'] ?>" class="edit">edit</a>
                <a href="admin_product.php?delete=<?php echo $fetch_products['id'] ?>" class="delete" onclick = "
                    return conform('delete this product');">delete</a>
            </div>
            <?php
                    }
                } 
            ?>
        </div>
    </section>

    <!-- open update container (after click the above update button) -->
    <section class="update-container">
        
        <!-- select all details of products table in database for update -->
        <?php 
            if (isset($_GET['edit'])){
                $edit_id = $_GET['edit'];
                $edit_query = mysqli_query($conn, "SELECT * FROM `products` WHERE id = $edit_id") or die('query failed');
                if(mysqli_num_rows($edit_query) > 0){
                    while($fetch_edit = mysqli_fetch_assoc($edit_query)){

                   
        ?>

        <!-- set the above selected details to update boxes in update container -->
        <form method="post" action="" enctype="multipart/form-data">
            <img src="image/<?php echo $fetch_edit['image']; ?>" alt="">
            <input type="hidden" name="update_p_id" value="<?php echo $fetch_edit['id']; ?>">
            <input type="text" name="update_p_name" value="<?php echo $fetch_edit['name']; ?>">
            <input type="number" min="0" name="update_p_price" value="<?php echo $fetch_edit['price']; ?>">
            <textarea name="update_p_detail"><?php echo $fetch_edit['product_detail']; ?></textarea>
            <input type="file" name="update_p_image" accept="image/png,image/jpg,image/jpeg,image/webp">
            <!-- update and close buttons -->
            <input type="submit" name="update_product" value="update" class="edit">
            <input type="reset" value="cancle" class="option-btn btn" id="close-edit">
            
        </form>

        <!-- hidden update container & become product page  -->
        <?php
                    }
                }
                echo "<script>document.querySelector('.update-container').style.display ='block';</script>";
            } 
        ?>
    </section>
    <!-- icons event-->
    <script type="text/javascript" src="script.js"></script>
    <!-- close event-->
    <script type="text/javascript" src="scriptcloseedit.js"></script>
</body>
</html>