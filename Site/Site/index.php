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
    <div class="row" style="margin-top: 0em">
        <img src="backgrounds/bg<?php echo(rand(0,16));?>.jpg" style="height: 40em; width: 70em"/>
    </div>
    <div class="row">
        <div class="col-lg-7">
            <h1 class="brand" style="padding-left: 0px">Link-Book</h1>
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-1" style="margin-top: 20px">
            <button class="btn btn-success" style="padding: 10px; padding-left: 20px; padding-right: 20px" onclick="window.location.href='register.php'">Sign-Up</button>
        </div>
</div>

</body>