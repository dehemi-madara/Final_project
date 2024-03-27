<?php
    /* database connection */
    include 'connection.php';
    session_start();

    // /* navigation bar icon through login/logout connection */
    // $admin_id = $_SESSION['admin_id'];
    // if (!isset($admin_id)) {
    //     header('location:login.php');
    // }
    // if (isset($_POST['logout'])){
    //     session_destroy();
    //     header('location:login.php');
    // }

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
    <link rel="stylesheet" type="text/css" href="order.css">
    <link rel="stylesheet" type="text/css" href="styleDashboard.css">
    <link rel="stylesheet" type="text/css" href="stylePro.css">
    <link rel="stylesheet" type="text/css" href="styleeditp.css">
    <link rel="stylesheet" type="text/css" href="styleLogin.css">
    
    <link rel="stylesheet" type="text/css" href="messageT.css">
    <title>admin pannel</title>
</head>
<body>
    <!-- header part import -->
    <?php include 'admin_header.php'; ?>
    <!-- boostrap close icon (click the icon, then remove the entire message container) -->
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
    <!-- Message container -->
    <section class="user-container">
    <!-- title -->
    <h1 class="title">Messages</h1>
    <!-- Message table -->
    <table class="message-table">
        <thead>
            <tr>
                <th>User ID</th>
                <th>User Name</th>
                <th>Email</th>
                <th>Message</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $select_message = mysqli_query($conn, "SELECT * FROM `message`") or die('query failed');
            if(mysqli_num_rows($select_message) > 0){
                while($fetch_message = mysqli_fetch_assoc($select_message)){
            ?>
                <tr>
                    <td><?php echo $fetch_message['user_id'] ;?></td>
                    <td><?php echo $fetch_message['name']; ?></td>
                    <td><?php echo $fetch_message['email']; ?></td>
                    <td><?php echo $fetch_message['message']; ?></td>
                    <td>
                        <a href="admin_message.php?delete=<?php echo $fetch_message['id']; ?>" class="delete" onclick="return confirm('Delete this?')">Delete</a>
                    </td>
                </tr>
            <?php 
                }
            } else {
                echo '<tr><td colspan="5" class="empty">No messages yet</td></tr>';
            }
            ?>
        </tbody>
    </table>
</section>

    <!-- import javascript part for icons -->
    <script type="text/javascript" src="script.js"></script>
</body>
</html>