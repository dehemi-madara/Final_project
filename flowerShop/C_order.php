<?php
    include 'connection.php';
    session_start();

     $user_id = $_SESSION['user_id'];
     if (!isset($user_id)) {
          header('location:login.php');
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

    <title>flower shop</title>
</head>
<body>

    <?php include 'header.php'; ?>
    <div class="banner">
        <h1>order</h1>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit</p>
    </div>

    <div class="order-section">
        <div class="box-container">
            <?php 
                $select_orders = mysqli_query($conn,"SELECT * FROM `orders` WHERE user_id='$user_id'") 
                or die('query failed');
                if (mysqli_num_rows($select_orders)>0) {
                    while($fetch_orders=mysqli_fetch_assoc($select_orders)){

            ?>
            <div class="box">
                <p>place on : <span><?php echo $fetch_orders['placed_on']; ?></span></p>
                <p>name : <span><?php echo $fetch_orders['name']; ?></span></p>
                <p>number : <span><?php echo $fetch_orders['number']; ?></span></p>
                <p>email : <span><?php echo $fetch_orders['email']; ?></span></p>
                <p>address : <span><?php echo $fetch_orders['address']; ?></span></p>
                <p>paymentmethod : <span><?php echo $fetch_orders['method']; ?></span></p>
                <p>your order : <span><?php echo $fetch_orders['total_products']; ?></span></p>
                <p>total price : <span><?php echo $fetch_orders['total_price']; ?></span></p>
                <p>payment status : <span><?php echo $fetch_orders['payment_status']; ?></span></p>
                
            </div>
            <?php 
                    }
                }else{
                    echo '
                    <div class="empty">
                        <img src="image/empty1.jpg">
                        <p>No order plased yet!!</p>
                    </div>
                ';
                }
            ?>
        </div>
    </div>

<?php include 'footerr.php'; ?>
    <script type="text/javascript" src="script.js"></script>
    <script type="text/javascript" src="scriptcloseedit.js"></script>
    
</body>
</html>