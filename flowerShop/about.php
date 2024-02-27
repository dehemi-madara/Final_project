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
    <link rel="stylesheet" type="text/css" href="services.css">

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
    <div class="banner-2">
        <h1>Let Us Make Your Wedding Flawless</h1>
        <a href="shop.php" class="btn2">shop now</a>
    </div>
    <div class="services">
        <h1 class="title">our services</h1>
        <div class="box-container">
            <div class="box">
                <i class="fa-solid fa-percent"></i>
                <h3>30% OFF + FREE SHIPPING</h3>
                <p>Starting at Rs.10,000. Plus,get Rs.50,000 creditlyear on regular orders</p>
            </div>
            <div class="box">
                <i class="fa-solid fa-asterisk"></i>
                <h3>FRESHEST BLOOMS</h3>
                <p>Exlusive farm-fresh flowers with our Happiness Guarantee</p>
            </div>
            <div class="box">
                <i class="fa-solid fa-bell"></i>
                <h3>SUPPER FLEXIBLE</h3>
                <p>Customize recipient, date, or flowers, Skip or cancel anytime.</p>
            </div>
        </div>
    </div>
    <div class="stylist">
        <h1 class="title">Florial stylist</h1>
        <p>Meet the Team that Makes Miracles Happen</p>
        <div class="box-container">
            <div class="box">
                <div class="img-box">
                    <img src="image/social1.jpg">
                    <div class="social-links">
                        <i class="fa-brands fa-instagram"></i>
                        <i class="fa-brands fa-youtube"></i>
                        <i class="fa-brands fa-twitter"></i>
                        <i class="fa-brands fa-whatsapp"></i>
                    </div>
                </div>
                <h3>flower girls</h3>
                <p>developer</p>
            </div>
            <div class="box">
                <div class="img-box">
                    <img src="image/social2.jpg">
                    <div class="social-links">
                        <i class="fa-brands fa-instagram"></i>
                        <i class="fa-brands fa-youtube"></i>
                        <i class="fa-brands fa-twitter"></i>
                        <i class="fa-brands fa-whatsapp"></i>
                    </div>
                </div>
                <h3>flower girls</h3>
                <p>developer</p>
            </div>
            <div class="box">
                <div class="img-box">
                    <img src="image/social3.jpg">
                    <div class="social-links">
                        <i class="fa-brands fa-instagram"></i>
                        <i class="fa-brands fa-youtube"></i>
                        <i class="fa-brands fa-twitter"></i>
                        <i class="fa-brands fa-whatsapp"></i>
                    </div>
                </div>
                <h3>flower girls</h3>
                <p>developer</p>
            </div>
        </div>
    </div>
    <div class="testamonial-container">
        <h1 class="title">what people say</h1>
        <div class="container">
            <div class="testamonial-item active">
                <img src="image/person1.jpg">
                <h3>flower girls</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. 
                    Ipsum, excepturi. Nobis maiores eveniet voluptatibus 
                    dignissimos possimus quod recusandae, ex nesciunt aliquid? 
                    Beatae suscipit, dicta vero minima facilis, fugit unde, 
                    aliquam provident et nobis ipsa saepe voluptatum nam fuga 
                    debitis impedit at dignissimos odit! Quae nobis deleniti 
                    voluptates ut pariatur ducimus?
                </p>
            </div>
            <div class="testamonial-item">
                <img src="image/person2.jpg">
                <h3>flower girls</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. 
                    Ipsum, excepturi. Nobis maiores eveniet voluptatibus 
                    dignissimos possimus quod recusandae, ex nesciunt aliquid? 
                    Beatae suscipit, dicta vero minima facilis, fugit unde, 
                    aliquam provident et nobis ipsa saepe voluptatum nam fuga 
                    debitis impedit at dignissimos odit! Quae nobis deleniti 
                    voluptates ut pariatur ducimus?
                </p>
            </div>
            <div class="testamonial-item">
                <img src="image/person3.jpg">
                <h3>flower girls</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. 
                    Ipsum, excepturi. Nobis maiores eveniet voluptatibus 
                    dignissimos possimus quod recusandae, ex nesciunt aliquid? 
                    Beatae suscipit, dicta vero minima facilis, fugit unde, 
                    aliquam provident et nobis ipsa saepe voluptatum nam fuga 
                    debitis impedit at dignissimos odit! Quae nobis deleniti 
                    voluptates ut pariatur ducimus?
                </p>
            </div>
            <div class="left-arrow" onclick="nextSlide();"><i class="fa-solid fa-arrow-left"></i></div>
            <div class="right-arrow" onclick="prevSlide();"><i class="fa-solid fa-arrow-right"></i></div>
        </div>
    </div>

    <?php include 'footerr.php'; ?>


   
    <script type="text/javascript" src="script.js"></script>
    <script type="text/javascript" src="scriptcloseedit.js"></script>
    <script type="text/javascript" src="scriptTestimonial.js"></script>

</body>
</html>