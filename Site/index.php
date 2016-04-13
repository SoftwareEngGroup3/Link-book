<head>
    <title>Link-Book</title>
    <?php include("header.php"); ?>
</head>
<body>
<?php
include("navbar.php");
session_start();
if ($_SESSION["loggedin"] == "true") {
    header("Location: home.php");
}
?>
<h1>Link-Book</h1>
<img src="http://il5.picdn.net/shutterstock/videos/6875158/thumb/1.jpg"/>
<a href="register.php">Register</a>

</body>