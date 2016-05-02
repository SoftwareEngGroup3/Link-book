<head>
    <title>Link-Book: Profile</title>
    <?php include("header.php"); ?>
</head>
<body>
<?php
include("checksession.php");
include("navbar.php");
include("profileController.php");
$user = getUserData($_GET[uid]);
$isEditable = false;
if($_SESSION[uid] == $_GET[uid]){
    $isEditable = true;
}
$picPath = $user[profile_picture];
if($picPath == "empty"){
    $picPath = "../img/no_profile.jpg";
}
?>
<div class="container" style="margin-top: 3em">
    <div class="col-lg-2">
        <div class="row">
            <img src="<?php echo $picPath ?>" style="height: 15em; width: 13em">
        </div>
            <?php printSmallModule($user[fName]." ".$user[lName], $isEditable);
            printSmallModule($user[email], $isEditable);
            printSmallModule($user[organization], $isEditable);
            printSmallModule($user[coding_languages], $isEditable)?>
    </div>
    <div class="col-lg-8" style="padding-left: 2em">
        <?php
        printBigModule("About Me", $user[bio], $isEditable);
        //printBigModule("")
        ?>
    </div>
    <div class="col-lg-2">
        <?php if($isEditable){?>
        <div class="row"><h5>Update Your Status:</h5></div>
        <div class="row">
            <textarea rows="5" placeholder="Status..."
                      style="height: 5em; resize: none; border-radius: 10px"></textarea>
        </div>
            <div class="row" style="margin-bottom: 2em"></div>
    <?php }
        printStatusBlock($user[uIDnum], 3, 5);?>

    </div>
</div>
</body>