<?php
    /* database connection */
    include 'connection.php';
    session_start();

    /* navigation bar icon through login/logout connection */
    $admin_id = $_SESSION['user_id'];
    if (!isset($admin_id)) {
        header('location:login.php');
    }
    if (isset($_POST['logout'])){
        session_destroy();
        header('location:login.php');
    }

     /*--------------------deleting users details from database---------------------- */
    if(isset($_GET['delete'])) {
        $delete_id = $_GET['delete'];

        mysqli_query($conn, "DELETE FROM `users` WHERE id = '$delete_id'") or die('query failed');

        /* after deleted item stay in this page */
        header('location:admin_user.php');
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
    <link rel="stylesheet" type="text/css" href="All.css">
    
    <link rel="stylesheet" type="text/css" href="userTable.css">
    <title>admin pannel</title>
</head>
<body>
    <!-- import header part -->
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
    
    <!-- user container -->
    <section class="user-container">
        <h1 class="title">Total Registered Users</h1>
        <div class="box-container1">
            <table class="user-details">
                <thead>
                    <tr>
                        <th>User ID</th>
                        <th>User Name</th>
                        <th>Email</th>
                        <th>User Type</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        // Fetching user details from the database
                        $select_users = mysqli_query($conn, "SELECT * FROM `users`") or die('Query failed');
                        if(mysqli_num_rows($select_users) > 0){
                            while($fetch_users = mysqli_fetch_assoc($select_users)){
                    ?>
                    <tr>
                        <td><?php echo $fetch_users['id']; ?></td>
                        <td><?php echo $fetch_users['name']; ?></td>
                        <td><?php echo $fetch_users['email']; ?></td>
                        <td style="color:<?php echo ($fetch_users['user_type'] == 'admin') ? 'purple' : ''; ?>">
                            <?php echo $fetch_users['user_type']; ?>
                        </td>
                        <td>
                            <a href="admin_user.php?delete=<?php echo $fetch_users['id']; ?>" class="delete" onclick="return confirm('Delete?')">Delete</a>
                        </td>
                    </tr>
                    <?php 
                            }
                        } 
                    ?>
                </tbody>
            </table>
        </div>
    </section>
    <script type="text/javascript" src="script.js"></script>
</body>
</html>