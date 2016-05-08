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
printAddStatusRow($_SESSION[picPath], $_SESSION[uid], $_SESSION[fName], $_SESSION[lName]);
populateStatuses($_SESSION[uid]);
?>
</div>
</body>
<script>
    $(document).ready(function () {
        $("#statusTextArea").keypress(function(e){
            var code = e.keyCode ? e.keyCode : e.which;
            if(e.keyCode == 13 || e.keyCode == 10){
                e.preventDefault();
                var text = $("#statusTextArea").val();
                $picPath = "<?php echo $_SESSION[picPath];?>";  //Handling potential nil value
                if($picPath == "empty"){
                    $picPath = "../img/no_profile.jpg";
                }
                $.ajax({
                    type: 'POST',
                    url: 'homeController.php',
                    data: {picPath: $picPath, uid: <?php echo $_SESSION[uid]; ?>, fName: "<?php echo $_SESSION[fName]; ?>", lName: "<?php echo $_SESSION[lName]; ?>", addStatus: true, text: text},
                    success: function(result){
                        $("#addingStatusRow").after(result);
                        $("#statusTextArea").val("");
                    },
                    dataType: "html"
                });
            }
        });
    });
</script>