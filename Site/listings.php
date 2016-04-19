<head>
    <title>Link-Book: Listings</title>
    <?php include("header.php") ?>
</head>
<body>
<?php
include("checksession.php");
include("navbar.php");
include("listingsController.php");
?>
<div class="container">
    <table border="2" class="table">
        <tr bgcolor="#f5f5dc">
            <td>Job Title</td>
            <td>Company</td>
            <td>Location</td>
            <td>Description</td>
            <td>Qualifications</td>
            <td>Starting Pay</td>
            <td>Contact Info</td>
            <td></td>
        </tr>
        <?php generateListings("", ""); ?>
    </table>
</div>
</body>