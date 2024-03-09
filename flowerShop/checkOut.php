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
    <link rel="stylesheet" type="text/css" href="check.css">
    <link rel="stylesheet" type="text/css" href="Pay.css">
    

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
                        <table>
                            <thead>
                                <tr>
                                    <th>Product Name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $select_cart=mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id='$user_id'") or die('query failed');
                                    $total=0;
                                    $grand_total=0;
                                    if(mysqli_num_rows($select_cart)>0) {
                                        while($fetch_cart=mysqli_fetch_assoc($select_cart)){
                                            $total_price=($fetch_cart['price'] * $fetch_cart['quantity']);
                                            $grand_total += $total_price;
                                ?>
                                <tr>
                                    <td><?= $fetch_cart['name']; ?></td>
                                    <td>Rs. <?= $fetch_cart['price']; ?></td>
                                    <td><?= $fetch_cart['quantity']; ?></td>
                                    <td>Rs. <?= $total_price; ?></td>
                                </tr>
                                <?php 
                                        }
                                    }
                                ?>
                            </tbody>
                        </table>
                        <div class="delivery">
                            <span>Delivery Price: Rs. 300</span>
                        </div>
                        <?php 
                            $grand_total += 300; // Adding delivery price to grand total
                        ?>
                        <span class="grand_total">Total amount payable : Rs. <span id="total_amount"><?= $grand_total; ?></span>/-</span>
        </div>

        <form method="post">
            <div class="input-field">
                <label>your name</label>
                <input type="text" name="Name" placeholder="Enter your name">
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
                <label>address :</label>
                <input type="text" name="home" placeholder="e.g  no.236/2, Kumbukgete, Kurunegala">
            </div>
            <div class="input-field">
                <label>pin code</label>
                <input type="number" name="pin" placeholder="e.g 110012">
            </div>
            <!--<input type="submit" name="order_btn" class="btn" value="order now">-->
            <a href="Payment.php" class ="btn2">order now</a>
        </form>
    </div>

    

<?php include 'footerr.php'; ?>
    <script type="text/javascript" src="script.js"></script>
    <script type="text/javascript" src="scriptcloseedit.js"></script>
    
</body>
</html>