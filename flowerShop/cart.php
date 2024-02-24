<?php
    include 'connection.php';
    session_start();

     $user_id = $_SESSION['user_id'];
     if (!isset($user_id)) {
          header('location:login.php');
   }

   
    /*----------------update products to cart ---------*/
    if (isset($_POST['update_quantity_btn'])) {
        $update_quantity_id = $_POST['update_quantity_id'];
        $update_value = $_POST['update_quantity'];

        $update_query = mysqli_query($conn,"UPDATE `cart` SET quantity='$update_value' WHERE id='$update_quantity_id'") or die('query failed');
        if ($update_query) {
            header('location:cart.php');
        }
    }
    
    /*----------------adding products to wishlist----------*/
   
  /*----------------adding products to cart----------*/
  

/* ------------------------ delete products to wishlist ------------------------- */
if(isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];

    mysqli_query($conn, "DELETE FROM `cart` WHERE id = '$delete_id'") or die('query failed');

    header('location:cart.php');
}
/* ------------------------ delete products to wishlist ------------------------- */
if(isset($_GET['delete_all'])) {

    mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');

    header('location:cart.php');
}


?>
<!--<style type="text/css">-->
   
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" 
    crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="mani.css">
    <link rel="stylesheet" type="text/css" href="Category.css">
    <link rel="stylesheet" type="text/css" href="order.css">
    <link rel="stylesheet"type="text/css"href="Wishlist.css">
    <link rel="stylesheet"type="text/css"href="cart.css">

    <title>flower shop</title>
</head>
<body>

    <?php include 'header.php'; ?>
    <div class="banner">
        <h1>my cart</h1>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit</p>
    </div>

    <div class="shop">
    <h1 class="title">products added in cart</h1> 
    <?php
    if(isset($message)) {
        foreach ($message as $message) {
            echo '
                <div class="message">
                    <span>' .$message.'</span>
                    <i class="fa-solid fa-circle" onclick="this.parentElement.remove()"></i>
                </div>';
        }
    }
    ?>
  <div class="box-container">
    <?php
    $grand_total = 0;
    $select_cart = mysqli_query($conn, "SELECT * FROM `cart` ") or die('query failed');
    if (mysqli_num_rows($select_cart) > 0) {
        while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {
            ?>
            <div class="box">
                <div class="icon">
                    <!-- Use appropriate class for delete icon -->
                    <a href="cart.php?delete=<?php echo $fetch_cart['id']; ?>" class="fa-solid fa-times-circle"></a>
                    <a href="view_page.php?pid=<?php echo $fetch_cart['id']; ?>" class="fa-solid fa-eye"></a>
                </div>
                <img src="image/<?php echo $fetch_cart['image']; ?>">
                <div class="price">Rs.<?php echo $fetch_cart['price']; ?>/-</div>
                <div class="name"><?php echo $fetch_cart['name']; ?></div>
                <form method="post">
                    <input type="hidden" name="update_quantity_id" value="<?php echo $fetch_cart['id'] ?>">
                    <div class="dty">
                        <input type="number" min="1" name="update_quantity" value="<?php echo $fetch_cart['quantity'] ?>">
                        <!--<input type="submit" name="update_quantity_btn" value="update">-->
                        <button type="submit" name="update_quantity_btn" class="btn3" value="update">update</button>
                    </div>
                </form>
                <div class="total-amt">
                    Total Amount : <span><?php echo $total_amt = ($fetch_cart['price'] * $fetch_cart['quantity']) ?></span>
                </div>
            </div>
            <?php
            $grand_total += $total_amt;
        }
    } else {
        echo '
            <div class="empty">
                <img src="image/empty1.jpg">
                <p>No products in your cart yet!!</p>
            </div>
        ';
    }
    ?>
</div>

<div class="dlt">
    <a href="cart.php?delete_all" class="btn2">delete all</a>
</div>
<div class="cart_total">
    <p>Total amount payable :  <span>Rs.<?php echo $grand_total ?>/-</span></p>
    <a href="shop.php" class ="btn2">Continue shopping</a>
    <a href="chechout.php" class="btn2 <?php echo ($grand_total > 1) ? '' : 'disabled' ?>" 
    onclick="return confirm('Do you want to delete all from cart')">proceed to check out</a>
</div>

    
</div>

<?php include 'footerr.php'; ?>
    <script type="text/javascript" src="script.js"></script>
    <script type="text/javascript" src="scriptcloseedit.js"></script>
    
</body>
</html>