<head>
    <title>Link-Book: Home</title>
    <?php include("header.php");?>
</head>
<body>
<div class="container">
<?php
include("checksession.php");
include("navbar.php");
include("homeController.php");
populateStatuses();
?>
</div>
</body>