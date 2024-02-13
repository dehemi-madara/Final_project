<?php
// Destroy all session data
if (isset($_POST['logout'])){
session_destroy();

// Redirect to the login page
header("Location: login.php");}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="styleLogin.css">
    <link rel="stylesheet" type="text/css" href="styleHeader.css">
    <title>Document</title>
    <script src="https://kit.fontawesome.com/95da0b33ad.js" crossorigin="anonymous"></script>
</head>
<body>
    <!-- header part -->
    <header class="header">
        <div class="flex">
            <!-- Flower Girls logo -->
            <a href="admin.php" class="logo">Flower <span>Girls</span></a>
            <!--  navigation bar -->
            <nav class="navbar">
                <a href="admin.php">Home</a>
                <a href="admin_product.php">Products</a>
                <a href="admin_orders.php">Orders</a>
                <a href="admin_user.php">Users</a>
                <a href="admin_message.php">Message</a>
            
                <form method="post" action="login.php">
                    <button type="submit" name="logout" class="btn btn-danger"><i class="fa-solid fa-user"></i></button>
                </form>
                <!-- <svg xmlns="http://www.w3.org/2000/svg" name="logout" padding-left="60px" width="30" height="30" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0z"/>
                    <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z"/>
                </svg> -->
            </nav>

            
             <!-- navigation bar user icon (log out part)
            <div class="icons">
                <i class="fa-regular fa-user" id="user-icon"></i>
            </div>
            <div class="user-box">
                <p>username : <span><?php echo $_SESSION['admin_name'];?></span></p>
                <p>email : <span><?php echo $_SESSION['admin_email'];?></span></p>
                <form method="post" class="logout">
                    <button name="logout" class="logout-btn">LOG OUT</button>
                </form>
            </div> -->
        </div>
    </header>
    
</body>
</html>