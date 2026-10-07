<?php

$config = file("config.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$host = $config[0];
$user = $config[1];
$pass = $config[2];
$dbname = $config[3];

$id_no = $_GET["id_no"];

$conn = new mysqli($host, $user, $pass, $dbname);

$sql = "SELECT * FROM Product WHERE item_no = $id_no";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

$name = $row["ebook_name"];
$description = $row["description"];
$image = $row["image"];
$price = $row["price"];
$inventory = $row["inventory"];

if ($id_no >= 0 && $id_no <= 3) {
    $imagePath = "../images/e-books/health/" . $image;
} else {
    $imagePath = "../images/e-books/parenting/" . $image;
}

$conn->close();

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title><?php echo $name; ?></title>
    <meta charset="UTF-8" />

    <script src="cart.js"></script>

    <style>
        body {
            background-color: #2224A2;
            font-family: Arial;
            text-align: center;
        }

        .product-container {
            width: 60%;
            margin: 40px auto;
            background-color: #CCCCCC;
            padding: 20px;
            border: 3px solid black;
        }

        h1 {
            color: black;
        }

        .product-image {
            border: 3px solid black;
            background-color: white;
            padding: 10px;
        }

        .description {
            font-family: "Lucida Calligraphy";
            margin-top: 15px;
            font-size: 18px;
        }

        .price {
            margin-top: 15px;
            font-weight: bold;
            font-size: 18px;
        }

        .quantity-box {
            margin-top: 10px;
        }

        .buy-button {
            margin-top: 15px;
            background: none;
            border: none;
            cursor: pointer;
        }

        .sold-out {
            margin-top: 15px;
            color: red;
            font-weight: bold;
            font-size: 22px;
        }

        .continue-link {
            display: block;
            margin-top: 15px;
            font-size: 14px;
        }
    </style>

    <script>

        var inventory = <?php echo $inventory; ?>;

        function checkQuantity() {
            var qty = parseInt(document.getElementById("qty").value);

            if (qty > inventory) {
                alert("Sorry, only " + inventory + " in stock.");
                document.getElementById("qty").value = "";
            }
        }

        function buyNow() {
            var qty = parseInt(document.getElementById("qty").value);

            if (isNaN(qty) || qty <= 0) {
                alert("Please enter a valid quantity.");
                return;
            }

            if (qty > inventory) {
                alert("Sorry, only " + inventory + " in stock.");
                return;
            }

            document.cookie = "buy_id=<?php echo $id_no; ?>";
            document.cookie = "buy_name=<?php echo rawurlencode($name); ?>";
            document.cookie = "buy_price=<?php echo $price; ?>";
            document.cookie = "buy_qty=" + qty;

            window.location.href = "checkout.html";
        }

    </script>
</head>

<body>

<div class="product-container">

    <h1><?php echo $name; ?></h1>

    <img src="<?php echo $imagePath; ?>" class="product-image" alt="<?php echo $name; ?>" />

    <div class="description">
        <?php echo $description; ?>
    </div>

    <div class="price">
        Price: $<?php echo number_format($price, 2); ?>
    </div>

    <?php if ($inventory > 0) { ?>

        <div class="quantity-box">
            Quantity:
            <input type="text" id="qty" maxlength="2" size="2" onchange="checkQuantity()" />
        </div>

        <button class="buy-button" onclick="buyNow()">
            <img src="../images/home/buynow.png" alt="Buy Now" />
        </button>

    <?php } else { ?>

        <div class="sold-out">Sold Out</div>

    <?php } ?>

    <a href="store_index.html" class="continue-link">Continue Shopping</a>

</div>

</body>
</html>