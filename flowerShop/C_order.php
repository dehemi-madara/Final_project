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
    
    <link rel="stylesheet" type="text/css" href="COrder.css">

    <title>flower shop</title>
</head>
<body>

    <?php include 'header.php'; ?>
    <div class="banner">
        <h1>order</h1>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit</p>
    </div>

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

    <div class="order-section">
    <div class="box-container">
    <table class="order-details">
        <thead>
            <tr>
                <th>Placed On</th>
                <th>Name</th>
                <th>Number</th>
                <th>Email</th>
                <th>Address</th>
                <th>Payment Method</th>
                <th>Total Products</th>
                <th>Total Price</th>
                <th>Payment Status</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                // Ensure $user_id is properly set
                $user_id = $_SESSION['user_id'];
                
                // Query to fetch orders for the current user
                $select_orders = mysqli_query($conn,"SELECT * FROM `orders` WHERE user_id='$user_id'") 
                                or die('Query failed');
                
                // Check if there are any orders
                if (mysqli_num_rows($select_orders) > 0) {
                    // Loop through each order
                    while($fetch_orders = mysqli_fetch_assoc($select_orders)){
            ?>
            <tr>
                <td><?php echo $fetch_orders['placed_on']; ?></td>
                <td><?php echo $fetch_orders['name']; ?></td>
                <td><?php echo $fetch_orders['number']; ?></td>
                <td><?php echo $fetch_orders['email']; ?></td>
                <td><?php echo $fetch_orders['address']; ?></td>
                <td><?php echo $fetch_orders['method']; ?></td>
                <td><?php echo $fetch_orders['total_products']; ?></td>
                <td><?php echo $fetch_orders['total_price']; ?></td>
                <td><?php echo $fetch_orders['payment_status']; ?></td>
            </tr>
            <?php 
                    }
                } else {
                    // Display a message if no orders found
                    echo '
                    <tr>
                        <td colspan="9" class="empty">No orders placed yet!!</td>
                    </tr>
                    ';
                }
            ?>
        </tbody>
    </table>
</div>



    </div>

<?php include 'footerr.php'; ?>
    <script type="text/javascript" src="script.js"></script>
    <script type="text/javascript" src="scriptcloseedit.js"></script>
    
</body>
</html>