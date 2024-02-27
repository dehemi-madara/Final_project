<?php
    include 'connection.php';
    session_start();

     $user_id = $_SESSION['user_id'];
     if (!isset($user_id)) {
          header('location:login.php');
   }
    
    /*---------------- send message ---------------*/
    if (isset($_POST['submit-btn'])) {
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $number = mysqli_real_escape_string($conn, $_POST['number']);
        $message = mysqli_real_escape_string($conn, $_POST['message']);

        $select_message = mysqli_query($conn,"SELECT * FROM `message` WHERE name = '$name' AND email ='$email' 
            AND number ='$number' AND message = '$message'") or die('query failed');

        if (mysqli_num_rows($select_message)>0) {
            echo 'message already send';
        }else{
            mysqli_query($conn, "INSERT INTO `message` (`user_id`,`name`,`email`,`number`,`message`) 
            VALUES('$user_id','$name','$email','$number','$message')") or die('query failed');
        }
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

    <title>flower shop</title>
</head>
<body>

    <?php include 'header.php'; ?>
    <div class="banner">
        <h1>my contact</h1>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit</p>
    </div>

    <div class="help">
        <h1 class="title">need help</h1>
        <div class="box-container">
            <div class="box">
                <div>
                    <img src="image/location-map.png">
                    <h2>address</h2>
                </div>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
            </div>
            <div class="box">
                <div>
                    <img src="image/open.png">
                    <h2>opening</h2>
                </div>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
            </div>
            <div class="box">
                <div>
                    <img src="image/communications.png">
                    <h2>our contact</h2>
                </div>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
            </div>
            <div class="box">
                <div>
                    <img src="image/offer.png">
                    <h2>special offer</h2>
                </div>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
            </div>
        </div>
    </div>
    <div class="form-containerC">
        <div class="form-section">
            <form method="post">
                <h1>send us your question!</h1>
                <p>we'll get back to you within two days.</p>
                <div class="input-field">
                    <label>your name</label>
                    <input type="text" name="name">
                </div>
                <div class="input-field">
                    <label>your email</label>
                    <input type="text" name="email">
                </div>
                <div class="input-field">
                    <label>your number</label>
                    <input type="text" name="number">
                </div>
                <div class="input-field">
                    <label>message</label>
                    <textarea class="Tmessage"></textarea>
                </div>
                <input type="submit" name="submit-btn" class="btn" value="send message">
            </form>
        </div>
    </div>

<?php include 'footerr.php'; ?>
    <script type="text/javascript" src="script.js"></script>
    <script type="text/javascript" src="scriptcloseedit.js"></script>
    
</body>
</html>