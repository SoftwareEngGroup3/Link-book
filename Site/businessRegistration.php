<!--Buisness Registration-->
<html>
<head>
    <?php include("header.php") ?>
</head>
<body>
<?php
include("navbar.php");
session_start();
if ($_SESSION["loggedin"] == "true") {
    header("Location: home.php");
}
?>
<div class="container">

    <div class="row">
        <div class="col-md-4 col-sm-4 col-xs-3"></div>
        <div class="col-md-4 col-sm-4 col-xs-6">

            <h3 class="row form-group">User Registration</h3>

            <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">

                <div class="row form-group">
                    <div class="ui input">
                        <input type="text" name="firstname" placeholder="First Name"/>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="ui input">
                        <input type="text" name="lastname" placeholder="Last Name"/>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="ui input">
                        <input type="email" name="email" placeholder="Email"/>
                    </div>
                </div>

                <div class="row form-group">
                    <input class='form-control' type="text" name="username" placeholder="username">
                </div>
                <div class="row form-group">
                    <input class='form-control' type="password" name="password" placeholder="password">
                </div>
                <div class="row form-group">
                    <input class=" btn btn-default" type="submit" name="submit" value="Register"/>
                </div>
                <div class="row form-group">
                    <input class=" btn btn-default" type="submit" name="home" value="Home"/>
                </div>
            </form>
        </div>
    </div>
    <?php
    if (isset($_POST['submit'])) { // Was the form submitted?
        include("../secure/secure.php");

        $link = mysqli_connect($site, $user, $pass, $db) or die("Connect Error " . mysqli_error($link));

        $sql = "INSERT INTO users(uIDnum, fName, lName, email, username, salt, hashed_pass, organization, bio, profile_picture, coding_languages) VALUES(?,?,?,?,?,?,?,?,?,?,?)";

        //$sql = "INSERT INTO user(username, salt, hashed_password) VALUES(?,?,?)";

        if ($stmt = mysqli_prepare($link, $sql)) {


            $uIDnum = mt_rand();

            $fName = $_POST['firstname'];
            $lName = $_POST['lastname'];
            $email = $_POST['email'];

            $user = $_POST['username'];
            $salt = mt_rand();
            $hpass = password_hash($salt . $_POST['password'], PASSWORD_BCRYPT) or die("bind param");

            $orgo = "empty";
            $bio = "empty";
            $pic = "empty";
            $lang = "empty";

            mysqli_stmt_bind_param($stmt, "issssssssss", $uIDnum, $fName, $lName, $email, $user, $salt, $hpass, $orgo, $bio, $pic, $lang) or die("bind param");

            //mysqli_stmt_bind_param($stmt, "sss", $user, $salt, $hpass) or die("bind param");

            if (mysqli_stmt_execute($stmt)) {
                echo "<h4>Success</h4>";
            } else {
                echo "<h4>Failed</h4>";
            }
            //$result = mysqli_stmt_get_result($stmt);
        } else {
            die("prepare failed");
        }
    } else if (isset($_POST['home'])) {
        header("Location: index.php");
    }
    ?>
</div>
</body>
</html>
