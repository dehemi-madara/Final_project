<?php

include 'connection.php';
session_start();

$user_id = $_SESSION['user_id'];
if (!isset($user_id)) {
    header('location:login.php');
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
        <button type="submit" name="payment" onclick="paymentGateway();" class="btn btn-primary">Pay Now</button>
    </div>

    <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
    <script type="text/javascript" src="paymentScript.js"> </script>
    <script type="text/javascript" src="script.js"></script>
    <script type="text/javascript" src="scriptcloseedit.js"></script>

</body>

</html>