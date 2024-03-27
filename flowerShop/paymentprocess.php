<?php

session_start();
if (isset($_SESSION['order_data'])) {
    // Access order data from session
    $order_data = $_SESSION['order_data'];

    // Extract data from order_data array
    $name = isset($order_data['Name']) ? $order_data['Name'] : '';
    $number = isset($order_data['number']) ? $order_data['number'] : '';
    $email = isset($order_data['email']) ? $order_data['email'] : '';
    // $method = isset($order_data['method']) ? $order_data['method'] : '';
    $home = isset($order_data['home']) ? $order_data['home'] : '';
    // $pin = isset($order_data['pin']) ? $order_data['pin'] : '';
    $amount = isset($order_data['grand_total']) ? $order_data['grand_total'] : '';

    $merchant_id = "1226313";
    $order_id = uniqid();
    $merchant_secret = "MTg0NDAzNjI2NzI0MzEwNjY4NTIxMjQzNzkwMzQ1MTc4OTY0ODcxNQ==";
    $currency = "LKR";
    $hash = strtoupper(
        md5(
            $merchant_id .
                $order_id .
                number_format((float)$amount, 2, '.', '') .
                $currency .
                strtoupper(md5($merchant_secret))
        )
    );
    $array = [];
    $array["amount"] = $amount;
    $array["name"] = $name;
    $array["number"] = $number;
    $array["email"] = $email;
    $array["home"] = $home;
    $array["order_id"] = $order_id;
    $array["currency"] = $currency;
    $array["hash"] = $hash;

    $jsonObj = json_encode($array);
    echo $jsonObj;
}
