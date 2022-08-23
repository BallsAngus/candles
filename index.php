<?php

//start session to access products
session_start();

require_once('./php/CreateDb.php');
require_once('./php/component.php');

// create instance of CreateDb class
$database = new CreateDb("ProductDb", "ProductTb");

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
            print_r($_SESSION['cart']);
        }

    } else {
        $item_array = array('product_id' => $_POST['product_id']);

        // create new session var
        $_SESSION['cart'][0] = $item_array;
        print_r($_SESSION['cart']);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="assets/styles.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.css" integrity="sha512-9nqhm3FWfB00id4NJpxK/wV1g9P2QfSsEPhSSpT+6qrESP6mpYbTfpC+Jvwe2XY27K5mLwwrqYuzqMGK5yC9/Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <title>Kem's Candles</title>
    </head>
    <body class="bg-light d-flex flex-column min-vh-100">
        <?php 
            require_once("php/header.php");
        ?>
        <div class="logo">
            <img src="https://p1-e6eeae93.imageflux.jp/c!/a=2,w=788,u=0/harapecostoreinc/83e17412d61629c396a7.png">
        </div>
        <div class="container">
            <div class="row text-center py-5">
                <?php
                    $result = $database->getData();
                    while ($row = mysqli_fetch_assoc($result)) {
                        component($row['product_name'], $row['product_price'], $row['product_image'], $row['id']);
                    }
                ?>
            </div>
        </div>
        <footer class="mt-auto">
            <div class="end_div"><p>COPYRIGHT</p></div>
            <div class="end_div"><p>©2022 JULIAN TUAZON</p></div>
        </footer>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>
    </body>
</html>