<?php
// TODO: Change account pages to PHP components. Fix navbar icons being misaligned on item add.
//start session to access products
session_start();

require_once ("php/AccountDb.php");
require_once('./php/CreateDb.php');
require_once('./php/OrdersDb.php');
require_once('./php/component.php');

// create instance of CreateDb class
$database = new CreateDb("ProductDb", "ProductTb");
$acctdb = new AccountDb("Accountdb", "Accounttb");
$ordersdb = new OrdersDb("Orderdb", "Ordertb");

if (isset($_POST['add'])) {
    // for checking functionality
    // print_r($_POST['product_id']);
    if (isset($_SESSION['cart'])) {
        $item_array_id = array_column($_SESSION['cart'], "product_id");

        if (in_array($_POST['product_id'], $item_array_id)) {
            echo "<script>alert('Product is already in cart!')</script>";
            echo "<script>window.location = 'index.php'</script>";
        } else {
            $count = count($_SESSION['cart']);
            $item_array = array('product_id' => $_POST['product_id']);

            $_SESSION['cart'][$count] = $item_array;
            //print_r($_SESSION['cart']);
        }

    } else {
        $item_array = array('product_id' => $_POST['product_id']);

        // create new session var
        $_SESSION['cart'][0] = $item_array;
        //print_r($_SESSION['cart']);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="https://img.icons8.com/fluency/452/spa-candle.png"/>
        <link rel="stylesheet" href="assets/styles.css?php echo time(); ?>">
        <link rel="stylesheet" href="assets/normalize.css?php echo time(); ?>">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.css" integrity="sha512-9nqhm3FWfB00id4NJpxK/wV1g9P2QfSsEPhSSpT+6qrESP6mpYbTfpC+Jvwe2XY27K5mLwwrqYuzqMGK5yC9/Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <title>Kem's Candles</title>
    </head>
    <body class="d-flex flex-column min-vh-100 bg-light">
        <?php 
            require_once("php/header.php");
        ?>
        <?php 
            require_once("php/featured.php");
        ?>
        <div class="container py-4 position-relative">
            <div class="row text-center py-1">
                <?php
                    $result = $database->getData();
                    while ($row = mysqli_fetch_assoc($result)) {
                        component($row['product_name'], $row['product_price'], $row['product_image'], $row['id']);
                    }
                ?>
            </div>
        </div>
        
        <footer class="mt-auto py-4">
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