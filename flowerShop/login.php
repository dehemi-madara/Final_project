<?php 
    /* database connection */
    include 'connection.php';
    //session_start();

    /* login form submition */
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        /* provide security for email and password  */
        $email = isset($_POST['email']) ? filter_var($_POST['email'], FILTER_SANITIZE_STRING) : '';
        $password = isset($_POST['password']) ? filter_var($_POST['password'], FILTER_SANITIZE_STRING) : '';

        /* get the users details from user table in the database */
        $select_user = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email'");

        /* check the email & password correct */
        if(mysqli_num_rows($select_user) > 0){
            $row = mysqli_fetch_assoc($select_user);

            if ($row['email'] == $email) {
                
                if ($row['password'] == $password) {

                    if ($row['user_type'] == 'admin') {
                        
                        header('location:admin.php');
                    }else if($row['user_type'] == 'user'){
                        header('location:index.php');
                    }
                }else{
                    echo '<script>alert("Login Fail! Check Your Password, ' . $row['name'] . '");</script>';
                }
            }else{
                echo '<script>alert("Login Fail! Check Your Email")</script>';
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
            <form action="login.php" method="post">
                <h3>login now</h3>
                <input type="email" name="email" placeholder="enter your email" required>
<input type="password" name="password" placeholder="enter your password" required>

                <!-- login button -->
                <input type="submit" name="submit-btn" class="btn" value="login now">

                <!-- link the register page -->
                <p>Do not have an account ?<a href="register.php">register now</a></p>
            </form>
        </section>
    </body>
    </html>