<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="styleHeader.css">
    <title>Document</title>
</head>
<body>
    <!-- header part -->
    <header class="header">
        <div class="flex">
            <!-- Logo -->
            <a href="admin.php" class="logo">Flower <span>Shop</span></a>
            <nav class="navbar">
                <a href="admin.php">Home</a>
                <a href="admin_product.php">Products</a>
                <a href="admin_orders.php">Orders</a>
                <a href="admin_user.php">Users</a>
                <a href="admin_message.php">Message</a>
            </nav>
            <div class="icons">
                <i class="fa-regular fa-user" id="user-icon"></i>
               
            </div>
            <div class="user-box">
                <p>username : <span><?php echo $_SESSION['admin_name'];?></span></p>
                <p>email : <span><?php echo $_SESSION['admin_email'];?></span></p>
                <form method="post" class="logout">
                    <button name="logout" class="logout-btn">LOG OUT</button>
                </form>
            </div>
        </div>
    </header>
    
</body>
</html>