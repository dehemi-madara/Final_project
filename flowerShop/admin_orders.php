<?php
    /* database connection */
    include 'connection.php';
    session_start();

    /* navigation bar icon through login/logout connection */
    $admin_id = $_SESSION['admin_id'];
    if (!isset($admin_id)) {
        header('location:login.php');
    }
    if (isset($_POST['logout'])){
        session_destroy();
        header('location:login.php');
    }

     /*--------------------deleting orders details from database---------------------- */
     if(isset($_GET['delete'])) {
        $delete_id = $_GET['delete'];

        mysqli_query($conn, "DELETE FROM `orders` WHERE id = '$delete_id'") or die('query failed');

        header('location:admin_orders.php');
    }

     /*-------------- update order details --------------- */

     if(isset($_POST['update_order'])) {
        $order_id = $_POST['order_id'];
        $update_payment = $_POST['update_payment'];

        mysqli_query($conn, "UPDATE `orders` SET payment_status='$update_payment' WHERE id='$order_id'") or die('query failed');
        $message[]='payment status updated successfully';
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
    <link rel="stylesheet" type="text/css" href="styleLogin.css">
    <title>admin pannel</title>
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
     <!-- order container -->
    <section class="order-container">
        <h1 class="title">total placed orders</h1>
        <div class="box-container">
            <!-- select all rows from orders table in database -->
            <?php
                $select_orders = mysqli_query($conn, "SELECT * FROM `orders`") or die('query failed');
                if(mysqli_num_rows($select_orders) > 0){
                    while($fetch_orders = mysqli_fetch_assoc($select_orders)){
                  

            ?>
             <!-- set the above selected details to orders boxes in orders page -->
            <div class="box">
                <p>user Name: <span><?php echo $fetch_orders['name'];?></span></p>
                <p>user Id: <span><?php echo $fetch_orders['user_id'];?></span></p>
                <p>placed on: <span><?php echo $fetch_orders['placed_on'];?></span></p>
                <p>number: <span><?php echo $fetch_orders['number'];?></span></p>
                <p>email: <span><?php echo $fetch_orders['email'];?></span></p>
                <p>total price: Rs. <span><?php echo $fetch_orders['total_price'];?>/-</span></p>
                <p>method: <span><?php echo $fetch_orders['method'];?></span></p>
                <p>address: <span><?php echo $fetch_orders['address'];?></span></p>
                <p>total products: <span><?php echo $fetch_orders['total_products'];?></span></p>

                 <!-- create choose box for select payment status -->
                <form method="post">
                    <input type="hidden" name="order_id" value="<?php echo $fetch_orders['id']; ?>">
                    <select name="update_payment">
                        <option disabled selected><?php echo $fetch_orders['payment_status'];?></option>
                        <option value="pending">Pending</option>
                        <option value="completed">Completed</option>
                    </select>
                     <!-- update and delete button -->
                    <input type="submit" name="update_order" value="update" class="btn">
                    <a href="admin_order.php?delete=<?php echo $fetch_orders['id']; ?>" class="delete" onclick="return conform('delete this')">delete</a>
                </form>
            </div>
            <!-- if no messages yet, print below message on message container -->
            <?php 
                    }
                }else{
                    echo '<p class="empty"> no orders yet</p>';
                } 

            ?>
        </div>
    </section>
    <!-- import javascript part for icons -->
    <script type="text/javascript" src="script.js"></script>
</body>
</html>