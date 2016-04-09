<head>
    <title>Link-Book</title>
</head>
<body>
<?php
session_start();
if ($_SESSION["loggedin"] == "true") {
    header("Location: home.php");
}
?>
Toolbar:
<a href="login.php">Log-In</a>
<h1>Link-Book</h1>
<a href="register.php">Register</a>
<p>Picture</p>

</body>