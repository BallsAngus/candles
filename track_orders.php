<?php

session_start();

require_once ("php/AccountDb.php");
require_once ("php/CreateDb.php");
require_once('./php/OrdersDb.php');
require_once ("php/component.php");

$db = new CreateDb("Productdb", "Producttb");
$acctdb = new AccountDb("Accountdb", "Accounttb");
$ordersdb = new OrdersDb("Orderdb", "Ordertb");

if (isset($_POST['cancel'])){
    if ($_GET['action'] == 'cancel') {
        foreach ($_SESSION['orders'] as $key => $value) {
            if ($value[3] ==  $_GET['id']) {
                // echo "<script>alert('bruh')</script>";
                // echo "<script>window.location = 'track_orders.php'</script>";
                $order_id = $_GET['id'];
                $delete_order = "DELETE FROM ordertb WHERE user_order_id=$order_id";
                $ordersdb->query($delete_order);
                unset($_SESSION['orders'][$key]);
            }
        }

        if (count($_SESSION['orders']) === 0) {
            unset($_SESSION['orders']);
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Orders</title>
    <link rel="shortcut icon" href="https://img.icons8.com/fluency/452/spa-candle.png"/>
    <link rel="stylesheet" href="assets/styles.css?php echo time(); ?>">
    <link rel="stylesheet" href="assets/normalize.css?php echo time(); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.css" integrity="sha512-9nqhm3FWfB00id4NJpxK/wV1g9P2QfSsEPhSSpT+6qrESP6mpYbTfpC+Jvwe2XY27K5mLwwrqYuzqMGK5yC9/Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="d-flex flex-column min-vh-100 bg-light">
    <?php 
        require_once('php/header.php');
    ?>
    <div class="container-fluid cart">
        <div class="row px-5">
            <div class="col-md-7">
                <div class="shopping-cart">
                    <h6>Your Orders</h6>
                    <hr>

                    <?php
                    if (empty($_SESSION['email']) or is_null($_SESSION['email'])) {
                        echo "<h5>Log in to track your orders!</h5>";
                    } else {
                        $email = $_SESSION['email'];
                        $query = "SELECT product_name, product_price, product_image, user_order_id, amount FROM ordertb WHERE email LIKE '$email'";
                        $result = $ordersdb->query($query);
                        // Add a num orders column to accounts database so this operation becomes constant rather than linear.
                        if ($result->num_rows !== 0) {
                            $orders = $result->fetch_all();
                            $_SESSION["orders"] = [];
                            foreach ($orders as &$value) {
                                array_push($_SESSION["orders"], $value);
                                order_component($value[0], $value[1], $value[2], $value[3], $value[4]);
                            }
                        } else {
                            echo "<h5>You have no orders</h5>";
                        }
                    }
                    ?>

                </div>
            </div>
        </div>
    </div>
    <footer class="mt-auto">
        <div class="end_div"><p>COPYRIGHT</p></div>
        <div class="end_div"><p>©2022 JULIAN TUAZON</p></div>
    </footer>

    <!-- Load Bootstrap JS. -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
    <!-- Load React. -->
    <!-- Note: when deploying, replace "development.js" with "production.min.js". -->
    <script src="https://unpkg.com/react@18/umd/react.development.js" crossorigin></script>
    <script src="https://unpkg.com/react-dom@18/umd/react-dom.development.js" crossorigin></script>

    <!-- Load jQuery. -->
    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>

    <!-- Load JS scripts. -->
    <script src="assets\header-btn.js"></script>
</body>
</html>