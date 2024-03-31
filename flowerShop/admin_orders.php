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
        $message[]='Payment status updated successfully';
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
    <link rel="stylesheet" type="text/css" href="styleDashboard.css">
    <link rel="stylesheet" type="text/css" href="stylePro.css">
    <link rel="stylesheet" type="text/css" href="styleeditp.css">
    <link rel="stylesheet" type="text/css" href="styleLogin.css">
    <link rel="stylesheet" type="text/css" href="orderTable.css">
    <link rel="stylesheet" type="text/css" href="All.css">
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
    <h1 class="title">Total Placed Orders</h1>

    <?php
    $select_orders = mysqli_query($conn, "SELECT * FROM `orders`") or die('Query failed');
    if(mysqli_num_rows($select_orders) > 0){
    ?>
        <table class="order-details">
            <thead>
                <tr>
                    <th>User Name</th>
                    <th>User ID</th>
                    <th>Placed On</th>
                    <th>Number</th>
                    <th>Email</th>
                    <th>Total Price</th>
                    <th>Method</th>
                    <th>Address</th>
                    <th>Total Products</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while($fetch_orders = mysqli_fetch_assoc($select_orders)){
                ?>
                <tr>
                    <td><?php echo $fetch_orders['name'];?></td>
                    <td><?php echo $fetch_orders['user_id'];?></td>
                    <td><?php echo $fetch_orders['placed_on'];?></td>
                    <td><?php echo $fetch_orders['number'];?></td>
                    <td><?php echo $fetch_orders['email'];?></td>
                    <td>Rs. <?php echo $fetch_orders['total_price'];?>/-</td>
                    <td><?php echo $fetch_orders['method'];?></td>
                    <td><?php echo $fetch_orders['address'];?></td>
                    <td><?php echo $fetch_orders['total_products'];?></td>
                    <td>
                        <form method="post">
                            <input type="hidden" name="order_id" value="<?php echo $fetch_orders['id']; ?>">
                            <select name="update_payment">
                                <option disabled selected><?php echo $fetch_orders['payment_status'];?></option>
                                <option value="pending">Pending</option>
                                <option value="completed">Completed</option>
                            </select>
                            <input type="submit" name="update_order" value="Update" class="btn">
                        </form>
                        <a href="admin_orders.php?delete=<?php echo $fetch_orders['id']; ?>" class="delete" onclick="return confirm('Delete this?')">Delete</a>
                    </td>
                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    <?php
    } else {
        echo '<p class="empty">No orders yet</p>';
    }
    ?>
</section>

    <!-- import javascript part for icons -->
    <script type="text/javascript" src="script.js"></script>
</body>
</html>