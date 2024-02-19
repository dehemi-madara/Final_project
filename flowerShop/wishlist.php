<?php
    include 'connection.php';
    session_start();

    //  $user_id = $_SESSION['user_id'];
     //if (!isset($user_id)) {
          //header('location:login.php');
   // }
    
    /*----------------adding products to wishlist----------*/
    if(isset($_POST['add_to_wishlist'])){
        $product_id = $_POST['product_id'];
        $product_name = $_POST['product_name'];
        $product_price = $_POST['product_price'];
        $product_image = $_POST['product_image'];

        $wishlist_number = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');
        $cart_number = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

        if(mysqli_num_rows($wishlist_number)>0){
            $message[]='products already exist in wishlist';

        }else if(mysqli_num_rows($cart_number)>0){
            $message[] = 'product already exist in cart';
        }else{
            mysqli_query($conn, "INSERT INTO `wishlist` (`user_id`, `pid` ,`name`, `price`,`image`) VALUES('$user_id','$product_id', '$product_name','$product_price','$product_image')");
            $message[]='products successfully added in wishlist';
        }
 } 
  /*----------------adding products to cart----------*/
  if(isset($_POST['add_to_cart'])){
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];

   $cart_number = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');
if(mysqli_num_rows($cart_number)>0){
        $message[] = 'product already exist in cart';
    }else{
        mysqli_query($conn, "INSERT INTO `cart` (`user_id`, `pid` ,`name`, `price`,`image`) VALUES('$user_id','$product_id', '$product_name','$product_price','$product_image')");
        $message[]='products successfully added in cart';
    }


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
    <link rel="stylesheet" type="text/css" href="category.css">
    
    <title>flower shop</title>
</head>
<body>

    <?php include 'header.php'; ?>
    <div class="banner">
        <h1>my wishlist</h1>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit</p>
    </div>

    <div class="shop">
    <h1 class="title">products added in wishlist</h1> 
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
        $select_wishlist = mysqli_query($conn,"SELECT * FROM `wishlist` WHERE user_id='$user_id'") or die('query failed');
        if(mysqli_num_rows($select_wishlist) > 0) {
            while($fetch_wishlist = mysqli_fetch_assoc($select_wishlist)) {
        ?>
        <form action="" method="post" class="box">
            <div class="icon">
                <a href="wishlist.php?delete=<?php echo $fetch_wishlist['id'];?>" class="fa-solid fa-eye-slash"></a>
                <a href="view_page.php?pid=<?php echo $fetch_products['id']; ?>" class="fa-solid fa-eye"></a>
            </div>
            <img src="image/<?php echo $fetch_wishlist['image']; ?>">
            <div class="price">$<?php echo $fetch_wishlist['price']; ?>/-</div>
            <div class="name"><?php echo $fetch_wishlist['name']; ?></div>
            <input type="hidden" name="product_id" value="<?php echo $fetch_wishlist['id']; ?>">
            <input type="hidden" name="product_name" value="<?php echo $fetch_wishlist['name']; ?>">
            <input type="hidden" name="product_price" value="<?php echo $fetch_wishlist['price']; ?>">
            <input type="hidden" name="product_image" value="<?php echo $fetch_wishlist['image']; ?>">
            <button type="submit" name="add_to_cart" class="btn2"> add to cart<i class="fa-cart-shopping"></i></button>
           
        </form>
        <?php 
        $grand_total+= $fetch_wishlist['price'];
            }
        } else {
            echo '<img src = "image/banner1.jpg">';
        }
        ?>
    </div>
    <div class="wishlist_total">
        <p>total amount payable : <span>$<?php echo $grand_total?>/-</span></p>
        <a href="shop.php"> continue shopping</a>
        <a href="wishlist.php?delete_all" class = "btn2 <?php echo ($grand_total > 1)?'':'disabled'?>" onclick="return
        confirm('do you want to delete all from wishlist')"> </a>
    </div>
    
</div>

<?php include 'footerr.php'; ?>
    <script type="text/javascript" src="script.js"></script>
    <script type="text/javascript" src="scriptcloseedit.js"></script>
    
</body>
</html>