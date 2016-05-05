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
<script>
    $(document).ready(function () {
        $("#submitButton").click(function () {
            var jobTitle = $("#jobTitle").html();
            var company = $("#company").html();
            var location = $("#location").html();
            var desc = $("#description").html();
            var qual = $("#qualifications").html();
            var pay = $("#startingPay").html();
            var cont = $("#contactInfo").html();

            $.ajax({
                type: 'POST',
                url: 'listingsController.php',
                data: {jobTitle: jobTitle, company: company, location: location, desc: desc, qual: qual, pay: pay, cont: cont},
                success: function(result) {
                    alert(result);
                    window.location.href = "listings.php";
                },
                dataType: "html"
            });
        });
    });
</script>