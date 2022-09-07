<?php

session_start();

if (isset($_SESSION['id'])) {
    unset($_SESSION['id']);
}

if (isset($_SESSION['email'])) {
    unset($_SESSION['email']);
}

if (isset($_SESSION['username'])) {
    unset($_SESSION['username']);
}

header("Location: index.php");
die;