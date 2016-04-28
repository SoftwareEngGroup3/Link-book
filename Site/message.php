<head>
    <title>Link-Book: Message</title>
    <?php include("header.php"); ?>
</head>
<body>
<?php
include("checksession.php");
include("navbar.php");
include("messageController.php");
?>
<div class="container">
    <?php
    if (isset($_GET["user"])) {
        generateMessages($_SESSION["uid"], $_GET["user"]);
    } else {
        if (isset($_GET["bid"])) {
            $bid = $_GET["bid"];
            include("../secure/secure.php");
            $link = mysqli_connect($site, $user, $pass, $db) or die("Connect Error " . mysqli_error($link));
            $result = mysqli_fetch_assoc(mysqli_query($link, "SELECT * FROM `business` WHERE bIDnum = $bid")) or die("Connect Error: Can't fetch business " . mysqli_error($link));

            generateMessages($_SESSION["uid"], $result[uIDnum]);
            
            mysqli_free_result($result);

        } else {
            header("Location: home.php");
        }
    } ?>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="row">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Enter Your Message Here..."
                           style="height: 5em">
                </div>
            </div>
            <div class="row pull-right">
                <div class="btn btn-success">Send</div>
            </div>
        </div>
    </div>
</div>
</body>