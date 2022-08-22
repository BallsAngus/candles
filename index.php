<?php

require_once('./php/component.php')
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
    <title>Document</title>
</head>
<body>
   <header class="shop_header">
        <nav class="navigation">
            <ul class="top_nav">
                <li>
                    <a href="index.php">HOME</a>
                </li>
                <li>
                    <a href="">FEATURED</a>
                </li>
                <li>
                    <a href="">NEWS</a>
                </li>
                <li>
                    <a href="">CONTACT</a>
                </li>
            </ul>
        </nav>
   </header>
   <div class="logo">
    <img src="https://p1-e6eeae93.imageflux.jp/c!/a=2,w=788,u=0/harapecostoreinc/83e17412d61629c396a7.png">
   </div>
   <div class="container">
    <div class="row text-center py-5">
        <?php
            component("Candle", "$9.99", "https://cdn.discordapp.com/attachments/460191223601430531/1007659107299377172/Screenshot_20220812-073543_Instagram.jpg");
            component("Candle Bundle", "$19.99", "https://cdn.discordapp.com/attachments/460191223601430531/1007659107655876679/Screenshot_20220812-073553_Instagram.jpg");
            component("Blossom Candle", "$12.99", "https://cdn.discordapp.com/attachments/460191223601430531/1007659107978850444/Screenshot_20220812-073613_Instagram.jpg");
            component("Mini Bear Candle", "$5.99", "https://cdn.discordapp.com/attachments/460191223601430531/1007659108297609276/Screenshot_20220812-073624_Instagram.jpg");
        ?>
    </div>
   </div>
   <footer class="end">
    <div class="end_div"><p>COPYRIGHT</p></div>
    <div class="end_div"><p>©2022 JULIAN TUAZON</p></div>
</footer>
</body>
</html>