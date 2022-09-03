<?php

session_start();

require_once ("php/AccountDb.php");
require_once ("php/CreateDb.php");
require_once ("php/component.php");

$db = new CreateDb("Productdb", "Producttb");
$acctdb = new AccountDb("Accountdb", "Accounttb");
$username = $email = $password = "";
$nameErr = $emailErr = $passwdErr = $confirmErr = "";
$validated = True;

if (isset($_POST['register'])) {

    // Validate username
    if (empty($_POST['username'])) {
        $nameErr = "Username is required";
        $validated = False;
    } else {
        $username =  $_POST['username'];
        $validated = True;
    }

    // Validate email
    if (empty($_POST['email'])) {
        $emailErr = "Email is required";
        $validated = False;
    } else {
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
            $validated = False;
        } else {
            $email = $_POST['email'];
            $validated = True;
        }
    }

    // Validate password
    if (empty($_POST['user_password'])) {
        $passwdErr = "Password is required";
        $validated = False;
    } else {
        $uppercase = preg_match('@[A-Z]@', $_POST['user_password']);
        $lowercase = preg_match('@[a-z]@', $_POST['user_password']);
        $number    = preg_match('@[0-9]@', $_POST['user_password']);
        $specialChars = preg_match('@[^\w]@', $_POST['user_password']);
        if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($_POST['user_password']) < 8) {
            $passwdErr = "Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.";
            $validated = False;
        } else {
            $password =  $_POST['user_password'];
            $validated = True;
        }
    }

    if (empty($_POST['confirm'])) {
        $confirmErr = "Please retype your password";
        $validated = False;
    } else {
            if(strcmp($password, $_POST['confirm']) != 0) {
                $confirmErr = "Passwords do not match.";
                $validated = False;
            } else {
                $validated = True;
            }
    }

    if ($validated) {
        $sql = "INSERT INTO Accounttb VALUES (default, '$username',
                '$password', '$email', 0)";
        $acctdb->insert($sql);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="shortcut icon" href="https://img.icons8.com/fluency/452/spa-candle.png"/>
    <link rel="stylesheet" href="assets/styles.css?php echo time(); ?>">
    <link rel="stylesheet" href="assets/normalize.css?php echo time(); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.css" integrity="sha512-9nqhm3FWfB00id4NJpxK/wV1g9P2QfSsEPhSSpT+6qrESP6mpYbTfpC+Jvwe2XY27K5mLwwrqYuzqMGK5yC9/Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="d-flex flex-column min-vh-100 bg-secondary">
    <?php 
        require_once('php/header.php');
    ?>
    
    <section class="vh-100 mb-5 mt-5">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-dark text-white mt-5" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">

                            <div class="mb-md-5 mt-md-4 pb-5">

                                <h2 class="fw-bold mb-4 text-uppercase">CREATE ACCOUNT</h2>
                                <p class="text-white-50 mb-5">Please enter your info!</p>
                                
                                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
                                    <div class="form-outline form-white mb-4">
                                        <input type="text" id="typeUsername" class="form-control form-control-lg" name="username" value="<?php echo $username;?>"/>
                                        <label class="form-label" for="typeUsername">Username</label>
                                        <p class="text-white-50 mb-5"><?php echo $nameErr;?></p>
                                    </div>

                                    <div class="form-outline form-white mb-4">
                                        <input type="email" id="typeEmail" class="form-control form-control-lg" name="email" value="<?php echo $email;?>"/>
                                        <label class="form-label" for="typeEmail">Email</label>
                                        <p class="text-white-50 mb-5"><?php echo $emailErr;?></p>
                                    </div>

                                    <div class="form-outline form-white mb-4">
                                        <input type="password" id="typePassword" class="form-control form-control-lg" name="user_password"/>
                                        <label class="form-label" for="typePassword">Password</label>
                                        <p class="text-white-50 mb-5"><?php echo $passwdErr;?></p>
                                    </div>

                                    <div class="form-outline form-white mb-4">
                                        <input type="password" id="retypePassword" class="form-control form-control-lg" name="confirm"/>
                                        <label class="form-label" for="retypePassword">Confirm Password</label>
                                        <p class="text-white-50 mb-5"><?php echo $confirmErr;?></p>
                                    </div>

                                    <button class="btn btn-outline-warning btn-lg px-5 mb-4" type="submit" name="register">Register</button>

                                    <div class="d-flex justify-content-center text-center mt-4 pt-1">
                                        <a href="#!" class="text-white"><i class="fab fa-facebook-f fa-lg"></i></a>
                                        <a href="#!" class="text-white"><i class="fab fa-twitter fa-lg mx-4 px-2"></i></a>
                                        <a href="#!" class="text-white"><i class="fab fa-google fa-lg"></i></a>
                                    </div>
                                </form>
                            </div>

                            <div>
                                <p class="mb-0">Already have an account? <a href="account.php" class="text-white-50 fw-bold">Sign In</a>
                                </p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="mt-auto py-5">
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