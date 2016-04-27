<head>
    <title>Link-Book: Search</title>
    <?php include("header.php") ?>
</head>
<body>
<?php
include("checksession.php");
include("navbar.php");
include("searchController.php");
?>
<div class="container">
    <div class="row" style="padding-bottom: 1em">
        <div class="col-lg-4">
            <div class="input-group">
                <input type="text" id="searchField" class="form-control" placeholder="Search for...">
                <span class="input-group-btn">
                  <button class="btn btn-default" id="searchBtn" type="button">Go!</button>
                </span>
            </div>
        </div>
    </div>

    <?php if (isset($_GET[q])) {
        populateUsers($_GET[q], 5, true, $_SESSION[uid]);
    } else {
        populateUsers("", 5, true, $_SESSION[uid]);
    } ?>
</div>
</body>
<script>
    $(document).ready(function () {
        $("#searchBtn").click(function () {
            window.location.href = "search.php" + "?q=" + $("#searchField").val();
        });
        $(document).keypress(function (e) {
            if (e.which == 13) {
                $("#searchBtn").click();
            }
        });
        $(".btn-success").click(function (){
            var personID = $(this).find("p").html();
            var btn = $(this);
            $.ajax({
                type: 'POST',
                url: "searchController.php",
                data: {uidToAdd: personID, uid: "<?php echo $_SESSION[uid] ?>"},
                success: function(result){
                    if(result == "1"){
                        btn.toggleClass("btn-success");
                        btn.toggleClass("btn-danger");
                        btn.html("Disconnect");
                    } else {
                        alert(result);
                    }
                },
                dataType: "html",
            });
        });
    });

</script>