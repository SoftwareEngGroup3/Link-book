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
    <table border="2" class="table" id="listingsTable">
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
            var jobTitle = $("#jobTitle").val();
            var company = $("#company").val();
            var location = $("#location").val();
            var desc = $("#description").val();
            var qual = $("#qualifications").val();
            var pay = $("#startingPay").val();
            var cont = $("#contactInfo").val();

            $.ajax({
                type: 'POST',
                url: 'listingsController.php',
                data: {jobTitle: jobTitle, company: company, location: location, desc: desc, qual: qual, pay: pay, cont: cont, uid: <?php echo $_SESSION['uid'] ?>},
                success: function(result) {
                    if(result == "Could not add row!"){
                        alert(result);
                    } else {
                        $('#listingsTable tr:last').before(result);
                        $("#jobTitle").val("");
                        $("#company").val("");
                        $("#location").val("");
                        $("#description").val("");
                        $("#qualifications").val("");
                        $("#contactInfo").val("");
                    }
                },
                dataType: "html"
            });
        });
    });
</script>