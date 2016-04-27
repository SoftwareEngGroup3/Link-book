<html>
<head>
    <title>Linkbook &mdash; Administration</title>
    <?php include("header.php");?>
</head>
<body>
<?php
session_start();
if($_SESSION["username"] != "Admin") {
    header("Location: home.php");
}
include("navbar.php");
include("profileController.php");

?>
<div>
    <h1> Welcome Admin</h1>
</div>



</body>
</html>
