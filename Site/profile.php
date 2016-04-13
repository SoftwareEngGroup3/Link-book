<head>
    <title>Link-Book: Profile</title>
    <?php include("header.php"); ?>
</head>
<body>
<?php
include("checksession.php");
include("navbar.php");
?>
<a href="home.php">Home</a>
<a href="#" style="color:red">Profile</a>
<a href="connections.php">Connections</a>
<a href="search.php">Search</a>
<a href="listings.php">Listings</a>
<a href="logout.php">Log-Out</a>
<h1>Link-Book</h1>
This page will be populated with a whole bunch of fields based on the profile table.
If profile.userID == session.userID, these fields will be editable and savable
else, they will be read only.
</body>