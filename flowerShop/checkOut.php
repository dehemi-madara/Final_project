<?php
    include 'connection.php';
    session_start();

     $user_id = $_SESSION['user_id'];
     if (!isset($user_id)) {
          header('location:login.php');
   }
    
    /*---------------- order placed ---------------*/
   if (isset($_POST['order_btn'])) {
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $number = mysqli_real_escape_string($conn, $_POST['number']);
        $method = mysqli_real_escape_string($conn, $_POST['method']);
        $address = mysqli_real_escape_string($conn, 'home no.'.$_POST['home'].','
        .$_POST['street'].','.$_POST['city'].','.$_POST['pin']);
        $placed_on = date('D-M-Y');
        $cart_total=0;
        $cart_products[]='';
        $cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id='$user_id'") or die('query failed'); 

        if (mysqli_num_rows($cart_query)>0) {
            while($cart_item = mysqli_fetch_assoc($cart_query)){
                $cart_products[]=$cart_item['name'].' ('.$cart_item['quantity'].' )';
                $sub_total = ($cart_item['price'] * $cart_item['quantity']);
                $cart_total += $sub_total;
            }
        }
        $total_products = implode(',', $cart_products);
        mysqli_query($conn, "INSERT INTO `orders`(`user_id`, `name`, `number`, `email`, `method`, `address`, `total_products`, 
        `total_price`, `placed_on`, `payment_status`) VALUES ('$user_id','$name','$number','$email','$method',
        '$address','$total_products','$cart_total','$placed_on','')") or die(mysqli_error($conn));
 
        mysqli_query($conn, "DELETE FROM `cart` WHERE user_id='$user_id'");
        $message[]='order placed successfully';
        header('location:checkOut.php');
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
    <link rel="stylesheet" type="text/css" href="Contact.css">
    <link rel="stylesheet" type="text/css" href="checkOut.css">

    <title>flower shop</title>
</head>
<body>

    <?php include 'header.php'; ?>
    <div class="banner">
        <h1>checkout page</h1>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit</p>
    </div>
    <div class="checkout-form">
        <h1 class="title">payment process</h1>
        <?php 
        if (isset($message)) {
            foreach ($message as $message) {
                echo '
                    <div class="message">
                        <span>'.$message.'</span>
                        <i class="fa-solid fa-xmark" onclick="this.parentElement.remove()"></i>
                    </div>
                ';
            }
        }
        ?>
        <div class="display-order">
            <?php 
                $select_cart=mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id='$user_id'") or die('query failed');
                $total=0;
                $grand_total=0;
                if(mysqli_num_rows($select_cart)>0) {
                    while($fetch_cart=mysqli_fetch_assoc($select_cart)){
                        $total_price=($fetch_cart['price']* $fetch_cart['quantity']);
                        $grand_total = $total+=$total_price;
            ?>
            <span><?= $fetch_cart['name']; ?>(<?= $fetch_cart['quantity']; ?>)</span>
            <?php 
                    }
                }
            ?>
            <span class="grand_total">Total amount payable : Rs. <?= $grand_total; ?>/-</span>
        </div>
        <form method="post">
            <div class="input-field">
                <label>your name</label>
                <input type="text" name="name" placeholder="Enter your name">
            </div>
            <div class="input-field">
                <label>your number</label>
                <input type="text" name="number" placeholder="Enter your number">
            </div>
            <div class="input-field">
                <label>your email</label>
                <input type="text" name="email" placeholder="Enter your email">
            </div>
            <div class="input-field">
                <label>select payment method</label>
                <select name="method" class="select">
                    <option selected disabled>Select payment method</option>
                    <option value="cash on delivery">cash on delivery</option>
                    <option value="credit card">credit card</option>
                </select>
            </div>
            <div class="input-field">
                <label>address line 1:</label>
                <input type="text" name="home" placeholder="e.g home no.">
            </div>
            <div class="input-field">
                <label>address line 2:</label>
                <input type="text" name="street" placeholder="e.g street name">
            </div>
            <div class="input-field">
                <label>city :</label>
                <input type="text" name="city" placeholder="e.g kurunegala">
            </div>
            <div class="input-field">
                <label>pin code</label>
                <input type="number" name="pin" placeholder="e.g 110012">
            </div>
            <input type="submit" name="order_btn" class="btn" value="order now">
        </form>
    </div>

    

<?php include 'footerr.php'; ?>
    <script type="text/javascript" src="script.js"></script>
    <script type="text/javascript" src="scriptcloseedit.js"></script>
    
</body>
</html>