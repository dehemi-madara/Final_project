<?php
    /* database connection */
    include 'connection.php';
    session_start();

    /* navigation bar icon through login/logout connection */
    $admin_id = $_SESSION['user_id'];
    if (!isset($admin_id)) {
        header('location:login.php');
    }
    if (isset($_POST['logout'])){
        session_destroy();
        header('location:login.php');
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

    <link rel="stylesheet" type="text/css" href="styleLogin.css">
    <link rel="stylesheet" type="text/css" href="styleHeader.css">
    <link rel="stylesheet" type="text/css" href="order.css">
    <link rel="stylesheet" type="text/css" href="styleDashboard.css">
    <link rel="stylesheet" type="text/css" href="stylePro.css">
    <link rel="stylesheet" type="text/css" href="styleeditp.css">
    <link rel="stylesheet" type="text/css" href="All.css">
    <title>admin pannel</title>
</head>
<body>
    <!-- import header part -->
    <?php include 'admin_header.php'; ?>

    <!-- dashboard part -->
    <section class="dashboard" >
        <h1 class="title">dashboard</h1>
        <div class="box-container">
            <!-- Total pending orders display part -->
            <div class="box">
                <?php
                    $total_pendings = 0;
                    $select_pendings = mysqli_query($conn, "SELECT * FROM `orders` WHERE payment_status = 'pending'") or die('query failed');
                    while ($fetch_pendings = mysqli_fetch_assoc($select_pendings)) {
                        $total_pendings += $fetch_pendings['total_price'];
                    }
                ?>  
                <h3>Rs. <?php echo $total_pendings; ?></h3>
                <p>total pendings</p>
            </div>
            <!-- Total completed orders display part -->
            <div class="box">
                <?php
                    $total_completed = 0;
                    $select_completed = mysqli_query($conn, "SELECT * FROM `orders` WHERE payment_status = 'completed'") or die('query failed');
                    while ($fetch_completed = mysqli_fetch_assoc($select_completed)) {
                        $total_completed += $fetch_completed['total_price'];
                    }
                ?>  
                <h3>Rs. <?php echo $total_completed; ?></h3>
                <p>total completed</p>
            </div>
            <!-- Total orders(pending & completed) display part -->
            <div class="box">
                <?php
                    $select_orders = mysqli_query($conn, "SELECT * FROM `orders`") or die('query failed');
                    $num_of_orders = mysqli_num_rows($select_orders);
                ?>  
                <h3><?php echo $num_of_orders; ?></h3>
                <p>order placed</p>
            </div>
            <!-- Total products(currently available) display part -->
            <div class="box">
                <?php
                    $select_products = mysqli_query($conn, "SELECT * FROM `orders`") or die('query failed');
                    $num_of_products = mysqli_num_rows($select_products);
                ?>  
                <h3><?php echo $num_of_products; ?></h3>
                <p>products added</p>
            </div>
            <!-- Total users(currently registered admins & users) display part -->
            <div class="box">
                <?php
                    $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE user_type = 'user'") or die('query failed');
                    $num_of_users = mysqli_num_rows($select_users);
                ?>  
                <h3><?php echo $num_of_users; ?></h3>
                <p>registered users</p>
            </div>
            <!-- Total admins display part -->
            <div class="box">
                <?php
                    $select_admins = mysqli_query($conn, "SELECT * FROM `users` WHERE user_type = 'admin'") or die('query failed');
                    $num_of_admins = mysqli_num_rows($select_admins);
                ?>  
                <h3><?php echo $num_of_admins; ?></h3>
                <p>total admin</p>
            </div>
            <!-- Total users display part -->
            <div class="box">
                <?php
                    $select_totaluser = mysqli_query($conn, "SELECT * FROM `users`") or die('query failed');
                    $num_of_totaluser = mysqli_num_rows($select_totaluser);
                ?>  
                <h3><?php echo $num_of_totaluser; ?></h3>
                <p>total users</p>
            </div>
            <!-- Total messages display part -->
            <div class="box">
                <?php
                    $select_messages = mysqli_query($conn, "SELECT * FROM `message`") or die('query failed');
                    $num_of_messages = mysqli_num_rows($select_messages);
                ?>  
                <h3><?php echo $num_of_messages; ?></h3>
                <p>new messages</p>
            </div>
        </div>
    </section>
    <script type="text/javascript" src="script.js"></script>
</body>
</html>