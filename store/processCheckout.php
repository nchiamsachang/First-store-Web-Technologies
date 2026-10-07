<?php

$config = file("config.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$host = $config[0];
$user = $config[1];
$pass = $config[2];
$dbname = $config[3];

$conn = new mysqli($host, $user, $pass, $dbname);

$name_first = $_POST["name_first"];
$name_last = $_POST["name_last"];
$email = $_POST["email"];
$address1 = $_POST["address1"];
$address2 = $_POST["address2"];
$city = $_POST["city"];
$state = $_POST["state"];
$zip = $_POST["zip"];
$phone = $_POST["phone"];
$fax = $_POST["fax"];
$cc_no = $_POST["cc_no"];

$exp_mo = 12;
$exp_yr = 2030;
$mail_list = 0;

$item_no = $_COOKIE["buy_id"];
$quantity = $_COOKIE["buy_qty"];

$sql1 = "INSERT INTO Customer (cc_no, exp_mo, exp_yr, name_first, name_last, email, address1, address2, city, state, zip, phone, fax, mail_list)
             VALUES ($cc_no, $exp_mo, $exp_yr, '$name_first', '$name_last', '$email', '$address1', '$address2', '$city', '$state', $zip, '$phone', '$fax', $mail_list)";
$conn->query($sql1);

$sql2 = "INSERT INTO Orders1 (cc_no, item_no, quantity, date_sold)
             VALUES ($cc_no, $item_no, $quantity, now())";
$conn->query($sql2);

$sql3 = "UPDATE Product SET inventory = inventory - $quantity WHERE item_no = $item_no";
$conn->query($sql3);

$conn->close();

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Order Confirmation</title>
    <meta charset="UTF-8" />
    <style>
        body {
            background-color: #b9ffff;
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 50px;
        }

        h1 {
            color: green;
        }
    </style>
</head>

<body>

    <h1>Thank you for your order!</h1>
    <p>Your order has been processed successfully.</p>

    <br />
    <a href="store_index.html">Continue Shopping</a>

</body>
</html>