<html>
<head>
    <title>Linkbook &mdash; Login</title>
    <?php include("header.php");?>
</head>
<body>
<?php
include("navbar.php");
session_start();
if ($_SESSION["loggedin"] == "true") {
    header("Location: home.php");
}
?>
<form class="ui large form" action="<?= $_SERVER['PHP_SELF'] ?>" method='POST'>
    <div class="container">

        <div class="row" style="padding-bottom: 3%">
            <h2>Log-In</h2>
        </div>
        <div class="row" style="padding-bottom: 3%">
            <div class="col-lg-2"></div>
            <div class="col-lg-4">
                Username: <input required type="text" name="username" placeholder="Username"/>
            </div>
        </div>
        <div class="row" style="padding-bottom: 3%">
            <div class="col-lg-2"></div>
            <div class="col-lg-4">
                Password: <input required type="password" name="password" placeholder="Password"/>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-2">
            </div>
            <div class="col-lg-8 pull-right">
                <input class="ui blue fluid large submit button" type="submit" name="submit" value="Login"/>
            </div>
        </div>
</form>
<div class="row">
    <div class="col-lg-3">
        Need an account? <a href="register.php">Register here</a>
    </div>
</div>
</div>
<?php

if (isset($_POST['submit'])) { // Was the form submitted?

    include("../secure/secure.php");

    $link = mysqli_connect($site, $user, $pass, $db) or die("Connect Error " . mysqli_error($link));

    $key = $_POST['username'];

    $password = $_POST['password'];

    if ($stmt = mysqli_prepare($link, "SELECT * FROM users WHERE username = ?")) {
        mysqli_stmt_bind_param($stmt, "s", $key);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $uIDnum, $fName, $lName, $email, $user, $salt, $hashed_password, $orgo, $bio, $pic, $lang);

        mysqli_stmt_fetch($stmt);

        if (password_verify($salt . $_POST['password'], $hashed_password)) {
            session_start();
            $_SESSION["loggedin"] = "true";
            $_SESSION["uid"] = $uIDnum;
            header("Location: index.php");
        } else {
            echo '   Invalid password.';
        }

        mysqli_stmt_close($stmt);
    }

} else if (isset($_POST['register'])) {
    header("Location: register.php");
}

?>
</body>
</html>
