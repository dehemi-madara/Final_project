<?php
    include 'connection.php';
    session_start();

    $admin_id = $_SESSION['admin_id'];
    if (!isset($admin_id)) {
        header('location:login.php');
    }
    if (isset($_POST['logout'])){
        session_destroy();
        header('location:login.php');
    }

     /*--------------------deleting orders details from database---------------------- */
     if(isset($_GET['delete'])) {
        $delete_id = $_GET['delete'];

        mysqli_query($conn, "DELETE FROM `message` WHERE id = '$delete_id'") or die('query failed');

        header('location:admin_message.php');
    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" 
    crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="styleHeader.css">
    <link rel="stylesheet" type="text/css" href="styleOrders.css">
    <link rel="stylesheet" type="text/css" href="styleDashboard.css">
    <link rel="stylesheet" type="text/css" href="styleAdminPro.css">
    <link rel="stylesheet" type="text/css" href="styleeditp.css">
    <link rel="stylesheet" type="text/css" href="styleLogin.css">
    <title>admin pannel</title>
</head>
<body>
    <?php include 'admin_header.php'; ?>
    <?php 
        if(isset($message)){
            foreach($message as $message) {
                echo'
                    <div class="message">
                        <span>'.$message.'</span>
                        <i class="bi bi-x-circle" onclick="this.parentElement.remove()"></i>
                    </div>
                ';
            }
        }
    ?>
    <section class="user-container">
        <h1 class="title">Messages</h1>
        <div class="box-container">
            <?php
                $select_message = mysqli_query($conn, "SELECT * FROM `message`") or die('query failed');
                if(mysqli_num_rows($select_message) > 0){
                    while($fetch_message = mysqli_fetch_assoc($select_message)){
                  

            ?>
            <div class="box">
                <p>user id: <span><?php echo $fetch_message['id'] ;?></span></p>
                <p>user name : <span><?php echo $fetch_message['name']; ?></span></p>
                <p>email: <span><?php echo $fetch_message['email']; ?></span></p>
                <p><?php echo $fetch_message['message']; ?></p>
                <a href="admin_message.php?delete=<?php echo $fetch_message['id']; ?>" class="delete" onclick = "
                    return conform('delete this');">Delete</a>
            </div>
            <?php 
                    }
                }else{
                    echo '<p class="empty"> no message yet</p>';
                }

            ?>
        </div>
    </section>
    <script type="text/javascript" src="script.js"></script>
</body>
</html>