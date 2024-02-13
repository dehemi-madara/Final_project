<?php
    include 'connection.php';
    session_start();

    // $user_id = $_SESSION['user_id'];
    // if (!isset($user_id)) {
    //     header('location:login.php');
    // }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" 
    crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="main.css">
    <title>flower shop</title>
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="slider-section">
        <div class="slider-show-container">
            <div class="wrapper-one">
                <div class="wrapper-text">inspired by nature</div>
            </div>
            <div class="wrapper-two">
                <div class="wrapper-text">fresh flower for you</div>
            </div>
            <div class="wrapper-three">
                <div class="wrapper-text">inspired by nature</div>
            </div>
        </div>
    </div>
    <div>
        <div class="row">
            <div class="card">
                <div class="details">
                    <span>30% OFF TODAY</span>
                    <h1>simple & elegant</h1>
                    <a href="shop.php">shop now</a>
                </div>
            </div>
            <div class="card">
                <div class="details">
                    <span>30% OFF TODAY</span>
                    <h1>simple & elegant</h1>
                    <a href="shop.php">shop now</a>
                </div>
            </div>
            <div class="card">
                <div class="details">
                    <span>30% OFF TODAY</span>
                    <h1>simple & elegant</h1>
                    <a href="shop.php">shop now</a>
                </div>
            </div>
        </div>
    </div>
    <div class="categories">
        <h1 class = "title">TOP CATEGORIES</h1>
        <div class="box-container">
            <div class="box">
                <img src="image/f.jpg">
                <span>birthday</span>
            </div>
            <div class="box">
                <img src="image/f.jpg">
                <span>sympathy</span>
            </div>
            <div class="box">
                <img src="image/f.jpg">
                <span>next day</span>
            </div>
            <div class="box">
                <img src="image/f.jpg">
                <span>plant</span>
            </div>
            <div class="box">
                <img src="image/f.jpg">
                <span>wedding</span>
            </div>
        </div>
    </div>
    <div class="banner3">
        <div class="detail">
            <span>BETTER THAN CAKE</span>
            <h1>BIRTHDAY BOUQES</h1>
            <p>hiiiiii.......</p>
            <a href="shop.php">explore<i class="fa-solid fa-arrow-right"></i></a>
        </div>
    </div>
    <div class="shop">
       <h1 class="title">shop besh sellers</h1> 
       <?php
       if(isset($message)) {
        foreach ($message as $message) {
            echo '
            <div class="message"
            <span>' .$message.'</span>
            <i class="fa-solid fa-circle" onclick="this.parentElement.remove()"></i>
            </div>';
        }
       }
       ?>
       <div class="box-container">
        <?php
        $select_products = mysqli_query($conn,"SELECT * FROM 'products'") or die('query failed');
        if(mysqli_num_rows($select_products)>0){
            while($fetch_products=mysqli_fetch_assoc($select_products)){

          
        ?>
        <form action="" method="post" class="box">
            <img src="image/<?php echo $fetch_products['image']; ?>">
            <div class="price">$<?php echo $fetch_products['price']; ?>/-</div>
            <div class="name">$<?php echo $fetch_products['name']; ?></div>
            <input type="hidden" name="product_id" value="<?php echo $fetch_products['image']; ?>">
            <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
            <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
            <input type="hidden" name="product_image" value="<?php echo $fetch_products['price']; ?>">
            <div class="icon">
                <a href="view_page.php?pid=<?php echo $fetch_products['image']; ?>" class="fa-solid fa-eye"></a>
                <button type ="submit" name="add_to_wishlist" class="fa-solid fa-heart"></button>
                <button type ="submit" name="add_to_cart" class="fa-solid fa-cart-shopping"></button>
            </div>
       </form>
        <?php 
                }
            }else{
                echo '<p class="empty">no products added yet !</p>';
            }
        
        ?>
        

       </div>
       <div class="more">
        <a href="shop.php">load more</a>
        <i class="fa-solid fa-arrow-down"></i>
       </div>
    </div>

    <?php include 'footer.php'; ?>
    <script type="text/javascript" src="script.js"></script>
</body>
</html>