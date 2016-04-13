<head>
    <title>Link-Book: Listings</title>
    <?php include("header.php") ?>
</head>
<body>
<?php
include("checksession.php");
include("navbar.php");
?>
<h1>Link-Book</h1>
<table border="1">
    <tr>
        <td>Search</td>
        <td>Search</td>
        <td>Search</td>
        <td>Search</td>
        <td></td>
    </tr>
    <tr>
        <td>Job Title</td>
        <td>Company</td>
        <td>Location</td>
        <td>Contact Info</td>
        <td>Message...</td>
    </tr>
    <tr>
        <td>Example Title</td>
        <td><a href="profile.php?pid=example">Example Company</a></td>
        <td>Example Location</td>
        <td>Example Contact Info...</td>
        <td><a href="message.php?pid=example">Message...</a></td>
    </tr>
</table>
</body>