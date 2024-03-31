<?php 
    /* database connection */
    include 'connection.php';
    session_start();

    if (isset($_POST['login'])) {
        $filter_email = filter_var($_POST['email'],FILTER_SANITIZE_STRING);
        $email = mysqli_real_escape_string($conn, $filter_email);

        $filter_password = filter_var($_POST['password'],FILTER_SANITIZE_STRING);
        $password = mysqli_real_escape_string($conn, $filter_password);
    
        $select_user = mysqli_query ($conn, "SELECT * FROM `users` WHERE email= '$email' AND password='$password'") or die ('query failed');
         
    
        //$result = mysqli_query($conn, $query) or die('Query failed');
    
        if (mysqli_num_rows($select_user) > 0) {
            $user_data = mysqli_fetch_assoc($select_user);
            
            
            // $_SESSION['admin_id'] = $user_data['id'];
    
            if ($user_data['user_type'] == 'admin') {
                $_SESSION['admin_name'] = $row['name'];
                $_SESSION['admin_email'] = $row['email'];
                $_SESSION['admin_id'] = $row['id'];
                $_SESSION['user_id'] = $user_data['id'];
                header('location: admin.php');



            } else if ($user_data['user_type'] == 'user') {
                    $_SESSION['user_name'] = $row['name'];
                    $_SESSION['user_email'] = $row['email'];
                    $_SESSION['user_id'] = $row['id'];
                    $_SESSION['user_id'] = $user_data['id'];
                        header('location: index.php');
            }


        
        } else {
            $message[] = 'Invalid email or password';
        }
    }

   
?>

<!DOCTYPE HTML>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="styleLogin.css">
        <link rel="stylesheet" type="text/css" href="All.css">
        <link rel="stylesheet" href="https://cdn jsdeliver.net npm bootstrap-icons@1.10.2/font bootstrap-icons.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
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
                <button type="submit" class="btn btn-primary " id="btnlogin" name="login">Login Now</button>
                <!-- <input type="submit" name="submit-btn" name="login" id="login" class="btn" value="login now"> -->

                <!-- link the register page -->
                <p>Do not have an account ?<a href="register.php">register now</a></p>
            </form>
        </section>
    </body>
    </html>