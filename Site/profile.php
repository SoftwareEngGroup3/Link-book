<head>
    <title>Link-Book: Profile</title>
    <?php include("header.php"); ?>
</head>
<body>
<?php
include("checksession.php");
include("navbar.php");
?>
This page will be populated with a whole bunch of fields based on the profile table.
If profile.userID == session.userID, these fields will be editable and savable
else, they will be read only.
</body>