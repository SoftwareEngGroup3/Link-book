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
            generateMessages($_SESSION["uid"], $_GET["bid"]);
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