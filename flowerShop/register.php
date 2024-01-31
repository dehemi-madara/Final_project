
<?php 
    /* database connection */
    include 'connection.php';

    /* register form submition  */
    /* provide security for email and password  */
    if(isset($_POST['submit-btn'])) {
        $filter_name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
        $name = mysqli_real_escape_string($conn, $filter_name);

        $filter_email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
        $email = mysqli_real_escape_string($conn, $filter_email);

        $filter_password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
        $password= mysqli_real_escape_string($conn, $filter_password);

        $filter_cpassword = filter_var($_POST['cpassword'], FILTER_SANITIZE_STRING);
        $cpassword = mysqli_real_escape_string($conn, $filter_cpassword);

        /* get the users details from user table in the database for check already exist*/

        $select_user = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email'") or die('query failed');

        //$select_user = mysqli_query($conn,"SELECT * FROM 'users' WHERE email = '$email'") or die('query failed');
        //mysqli_query($conn, "INSERT INTO `users` (`name`, `email`, `password`) VALUES ('$name','$email','$password')") or die('query failed');

        
        /* check already existing, wrong passwards */
        if(mysqli_num_rows($select_user) > 0){
            $message[] = 'user already exist';
        }else{
            if($password != $cpassword){
                $message[] = 'wrong password';
            }else{
                /* insert new users details in to database */
                mysqli_query($conn, "INSERT INTO `users` (`name`, `email`, `password`) VALUES ('$name','$email','$password')") or die('query failed');
                $message[] = 'register successfully';

                /* after inserting open login page */
                header('location: login.php');

                 //mysqli_query($conn,"INSERT INTO 'users'('name','email','password') VALUES ('$name','$email','$password')") or die('query failed');
                //$message[] = 'register successfully';
                //header('location:login.php');
                //exit;
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
        
        <title>user registration page</title>
    </head>
    <body>
       <!-- register container -->
        <section class="form-container">
            <form action="" method="post">
                <h3>register now</h3>
                <input type="text" name="name" placeholder="enter your name" required>
                <input type="email" name="email" placeholder="enter your email" required>
                <input type="password" name="password" placeholder="enter your password" required>
                <input type="password" name="cpassword" placeholder="renter your password" required>
                <input type="submit" name="submit-btn" class="btn" value="regisyer now">

                <!-- link login page -->
                <p>Already have an account ?<a href="login.php">login now</a></p>
            </form>
        </section>
    </body>
    </html>