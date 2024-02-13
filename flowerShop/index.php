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
    <?php include 'footer.php'; ?>
    <script type="text/javascript" src="script.js"></script>
</body>
</html>