<!DOCTYPE html>


<html>
<head>
    <title>Link-Book: Buisness</title>
    <?php include("header.php");?>
</head>
<body>
<div class="container">

    <?php
    include("checksession.php");
    include("navbar.php");
    include("buisnessController.php");
    $buis = getBuisData($_GET[uid]);
$isEditable = false;
if($_SESSION[uid] == $_GET[uid]){
    $isEditable = true;
}
$picPath = $buis[photo];
if($picPath == "empty"){
    $picPath = "../img/no_profile.jpg";
}
?>
<div class="container" style="margin-top: 3em">
    <div class="col-lg-2">
        <div class="row">
            <img src="<?php echo $picPath ?>" style="height: 15em; width: 13em">
        </div>
            <?php 
            printSmallModule($buis[name], $isEditable);
            printSmallModule($buis[contact_name], $isEditable);
            printSmallModule($buis[contact_email], $isEditable);
            printSmallModule($buis[buis_size], $isEditable);
            printSmallModule($buis[product], $isEditable)
            ?>
    </div>
    <div class="col-lg-8" style="padding-left: 2em">
        <?php
        printBigModule("Job Openings", $buis[openings], $isEditable);
        //printBigModule("")
        ?>
    </div>
   <!--
    <div class="col-lg-2">
       <?php // if($isEditable){?>
        <div class="row"><h5>Update Your Status:</h5></div>
        <div class="row">
            <textarea rows="5" placeholder="Status..."
                      style="height: 5em; resize: none; border-radius: 10px"></textarea>
        </div>
            <div class="row" style="margin-bottom: 2em"></div>
    <?php // }
       // printStatusBlock($buis[uIDnum], 3, 5);?>
    
    </div> -->
    
</html>    