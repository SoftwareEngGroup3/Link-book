<head>
    <title>Link-Book</title>
    <?php include("header.php"); ?>
</head>
<body>
<div class="container">
<?php
include("navbar.php");
session_start();
if ($_SESSION["loggedin"] == "true") {
    header("Location: home.php");
}
?>
    <div class="row">
        <div class="col-lg-6">
            <h1 class="brand">Link-Book</h1>
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-1" style="margin-top: 20px">
            <button class="btn btn-success" style="padding: 10px; padding-left: 20px; padding-right: 20px" onclick="window.location.href='register.php'">Sign-Up</button>
        </div>
    </div>
    <div class="row" style="margin-top: 1em">
        <img src="http://il5.picdn.net/shutterstock/videos/6875158/thumb/1.jpg"/>
    </div>
</div>

</body>