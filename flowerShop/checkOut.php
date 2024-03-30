<?php
include 'connection.php';
session_start();


$user_id = $_SESSION['user_id'];
if (!isset($user_id)) {
    header('location:login.php');
    exit(); // Add exit after header redirect to stop script execution
}

if (isset($_POST['order_btn'])) {
    // Validate form data
    $name = mysqli_real_escape_string($conn, $_POST['Name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $number = mysqli_real_escape_string($conn, $_POST['number']);
    $method = mysqli_real_escape_string($conn, $_POST['method']);
    $home = mysqli_real_escape_string($conn, $_POST['home']);
    $pin = mysqli_real_escape_string($conn, $_POST['pin']);

    if (empty($name) || empty($email) || empty($number) || empty($method) || empty($home) || empty($pin)) {
        // Handle empty fields
        $error_message = "All fields are required.";
    } else {
        // Store form data in session
        $_SESSION['order_data'] = [
            'Name' => $name,
            'email' => $email,
            'number' => $number,
            'method' => $method,
            'home' => $home,
            'pin' => $pin,
            'grand_total' => isset($_POST['grand_total']) ? $_POST['grand_total'] : 0, // Ensure 'grand_total' is set
        ];
        header('location: payment.php');
    }
}


?>
<!--<style type="text/css">-->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="mani.css">
    <link rel="stylesheet" type="text/css" href="Category.css">
    <link rel="stylesheet" type="text/css" href="order.css">
    <link rel="stylesheet" type="text/css" href="Wishlist.css">
    <link rel="stylesheet" type="text/css" href="Contact.css">
    <link rel="stylesheet" type="text/css" href="check.css">
    <link rel="stylesheet" type="text/css" href="Pay.css">


    <title>flower shop</title>
</head>

<body>

    <?php include 'header.php'; ?>
    <div class="banner">
        <h1>checkout page</h1>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit</p>
    </div>
    <div class="checkout-form">
        <h1 class="title">payment process</h1>
        <?php
        if (isset($message)) {
            foreach ($message as $message) {
                echo '
                    <div class="message">
                        <span>' . $message . '</span>
                        <i class="fa-solid fa-xmark" onclick="this.parentElement.remove()"></i>
                    </div>
                ';
            }
        }
        ?>
        <div class="display-order">
            <table>
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id='$user_id'") or die('query failed');
                    $total = 0;
                    $grand_total = 0;
                    if (mysqli_num_rows($select_cart) > 0) {
                        while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {
                            $total_price = ($fetch_cart['price'] * $fetch_cart['quantity']);
                            $grand_total += $total_price;
                    ?>
                            <tr>
                                <td><?= $fetch_cart['name']; ?></td>
                                <td>Rs. <?= $fetch_cart['price']; ?></td>
                                <td><?= $fetch_cart['quantity']; ?></td>
                                <td>Rs. <?= $total_price; ?></td>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
            <div class="delivery">
                <span>Delivery Price: Rs. 300</span>
            </div>
            <?php
            $grand_total += 300; // Adding delivery price to grand total
            ?>
            <span class="grand_total">Total amount payable : Rs. <span id="total_amount"><?= $grand_total; ?></span>/-</span>
        </div>

        <form name="" action="" method="post">
            <div class="input-field">
                <label>your name</label>
                <input type="text" name="Name" placeholder="Enter your name">
            </div>
            <div class="input-field">
                <label>your number</label>
                <input type="text" name="number" placeholder="Enter your number">
            </div>
            <div class="input-field">
                <label>your email</label>
                <input type="text" name="email" placeholder="Enter your email">
            </div>
            <div class="input-field">
                <label>select payment method</label>
                <select name="method" class="select">
                    <option selected disabled>Select payment method</option>
                    <option value="cash on delivery">cash on delivery</option>
                    <option value="credit card">credit card</option>
                </select>
            </div>
            <div class="input-field">
                <label>address :</label>
                <input type="text" name="home" placeholder="e.g  no.236/2, Kumbukgete, Kurunegala">
            </div>
            <div class="input-field">
                <label>pin code</label>
                <input type="number" name="pin" placeholder="e.g 110012">
            </div>
            <div class="input-field">
                <input type="hidden" name="grand_total" value="<?= $grand_total; ?>">
            </div>
            <button type="submit" name="order_btn" class="btn2">order now</button>
        </form>
    </div>



    <?php include 'footerr.php'; ?>
    <script type="text/javascript" src="script.js"></script>
    <script type="text/javascript" src="scriptcloseedit.js"></script>

</body>

</html>

<!---->