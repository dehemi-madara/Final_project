<?php 
    /* database connection */
    include 'connection.php';
    session_start();

    /* login form submition */
    if(isset($_POST['submit-btn'])) {

        /* provide security for email and password  */
        $filter_email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
        $email = mysqli_real_escape_string($conn, $filter_email);

        $filter_password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
        $password= mysqli_real_escape_string($conn, $filter_password);

        /* get the users details from user table in the database */
        $select_user = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email'") or die('query failed');
       

        /* check the email & password correct */
        if(mysqli_num_rows($select_user) > 0){
            $row = mysqli_fetch_assoc($select_user);
            if($row['user_type'] == 'admin'){
                $_SESSION['admin_name'] = $row['name'];
                $_SESSION['admin_email'] = $row['email'];
                $_SESSION['admin_id'] = $row['id'];
                /* if user type = admin and email,password correct, then open admin panel */
                header('location:admin.php');

            }else if($row['user_type'] == 'user'){
                $_SESSION['user_name'] = $row['name'];
                $_SESSION['user_email'] = $row['email'];
                $_SESSION['user_id'] = $row['id'];
                /* if user type = user and email,password correct, then open client panel */
                header('location:index.php');
            }else{
                /* else give error message */
                $message[] = 'incorrect email or password';
            }
        }
    }
?>

<!DOCTYPE HTML>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="styleLogin.css">
        <link rel="stylesheet" href="https://cdn jsdeliver.net npm bootstrap-icons@1.10.2/font bootstrap-icons.css">
        <title>user login page</title>
    </head>
    <body>
        <!-- login container -->
        <section class="form-container">
            <form action="" method="post">
                <h3>login now</h3>
                <input type="email" name="email" placeholder="enter your email" required>
                <input type="password" name="password" placeholder="enter your password" required>
                <!-- login button -->
                <input type="submit" name="submit-btn" class="btn" value="regisyer now">

                <!-- link the register page -->
                <p>Do not have an account ?<a href="register.php">register now</a></p>
            </form>
        </section>
    </body>
    </html>