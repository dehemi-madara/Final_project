<?php 
    /* database connection */
    include 'connection.php';
    //session_start();

    /* login form submition */
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        /* provide security for email and password  */
        $filter_email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
        $email = mysqli_real_escape_string($conn, $filter_email);

        $filter_password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
        $password= mysqli_real_escape_string($conn, $filter_password);

        /* get the users details from user table in the database */
        $select_user = mysqli_query($conn, "SELECT * FROM `users`");

        /* check the email & password correct */
        if(mysqli_num_rows($select_user) > 0){
            $row = mysqli_fetch_assoc($select_user);

            if ($row['email'] == $email) {
                
                if ($row['password'] == $password) {

                    if ($row['user_type'] == 'admin') {
                        
                        header('location:admin.php');
                    }else{
                        header('location:index.php');
                    }
                }else{
                    echo '<script>alert("Login Fail! Check Your Password, ' . $row['name'] . '");</script>';
                }
            }else{
                echo '<script>alert("Login Fail! Check Your Email")</script>';
            }
            // if($row['user_type'] == 'admin'){
                
            //     //check admin email inside the Database
            //     if($row['email']==$email){

            //         //check admin password if email is correct
            //         if($row['password']==$password){
            //             header('location:admin.php');
            //         }
            //         else{
            //             echo '<script>alert("Login Fail! Check Your Password, ' . $row['name'] . '");</script>';
            //         }
                    
            //     }else{
            //         echo '<script>alert("Login Fail! Check Your Email");</script>';
            //     }


            // }else if($row['user_type'] == 'user'){
            //     //check user Password and email inside the Database
            //     if($row['email']==$email ){
            //         if( $row['password']==$password){
            //             header('location:index.php');
            //         }
            //         else{
            //             echo '<script>alert("Login Fail! Check Your Password, ' . $row['name'] . '");</script>';
            //         }
                    
            //     }else{
            //         echo '<script>alert("Login Fail! Check Your Email");</script>';
            //     }
                
            // }else{
            //     /* else give error message */
            //     $message[] = 'incorrect email or password';
            // }
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