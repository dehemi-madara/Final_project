<?php
    include 'connection.php';
    session_start();

    $user_id = $_SESSION['user_id'] ;
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
    <link rel="stylesheet" type="text/css" href="cart.css">
    
    <title>flower shop</title>
</head>
<body>

    <?php include 'header.php'; ?>

    <div class="banner">
        <h1>about us</h1>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit</p>
    </div>
    <div class="about">
        <div class="row">
            <div class="detail">
                <h1>Visit Our Beautiful Showroom</h1>
                <p>Our showroom is an expression of what we love doing, being creative with floral and plant
                    arrangements. Whether you are looking for a florist for your perfect wedding, or just want to uplift 
                    any room with some one of a kind living decor, Blossom with love can help.
                </p>
                <a href="shop.php" class="btn2">shop now</a>
            </div>
            <div class="img-box">
                <img src="image/banner3.jpg">
            </div>
        </div>
    </div>

    <?php include 'footerr.php'; ?>


   
    <script type="text/javascript" src="script.js"></script>
    <script type="text/javascript" src="scriptcloseedit.js"></script>
    
</body>
</html>