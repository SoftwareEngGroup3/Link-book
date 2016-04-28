<?php

function getUserData($uid)
{
    include("../secure/secure.php");
    $link = mysqli_connect($site, $user, $pass, $db) or die("Connect Error " . mysqli_error($link));
    $result = mysqli_query($link, "SELECT * FROM `users` WHERE uIDnum = $uid");
    $row = mysqli_fetch_assoc($result);
    return $row;
}

function printBigModule($title, $content, $isEditable)
{
   // if($content == "empty"){return;}
    ?>
    <div class="row">
        <div class="col-lg-2">
            <h4><?php echo $title ?>:</h4>
        </div>
        <?php if ($isEditable) { ?>
            <div class="col-lg-2 col-lg-offset-6">
                <p class="text-right" style="margin-top: 5px">Edit...</p>
            </div>
        <?php } ?>
    </div>
    <div class="row">
        <p style="width: 80%">
            <?php echo $content ?>
        </p>
    </div>
    <?php
}

function printSmallModule($content, $isEditable)
{
   // if($content == "empty"){return;}
    echo '<div class="row"><div class="col-lg-10">' . $content . '</div>';
    if ($isEditable) {
        echo '<div class="col-lg-2">Edit...</div>';
    }
    echo '</div>';

}

function printStatusBlock($uid, $minCells, $maxCells)
{
    include("../secure/secure.php");
    $link = mysqli_connect($site, $user, $pass, $db) or die("Connect Error " . mysqli_error($link));
    $result = mysqli_query($link, "SELECT * FROM `status` WHERE uIDnum = $uid ORDER BY `status`.`timestamp` DESC");
    $numRows = mysqli_num_rows($result);
    $numCells = $numRows;
    if ($numRows <= $minCells) {
        $numCells = $minCells;
    }
    if ($numRows >= $maxCells) {
        $numCells = $maxCells;
    }
    $index = 0;
    while (($row = mysqli_fetch_assoc($result)) && $index < $numCells) {
        printStatusCell($row[content], $index, $numCells);
        $index += 1;
    }
    while ($index < $numCells) {
        printStatusCell("", $index, $numCells);
        $index += 1;
    }
    mysqli_free_result($result);
}

function printStatusCell($content, $index, $numCells)
{
    if ($index == 0) {
        ?>
        <div class="row"
             style="border: 1px solid black; border-top-left-radius: 10px; border-top-right-radius: 10px; height: 5em"><?php echo $content; ?></div>
    <?php } else {
        if ($index == $numCells - 1) {
            ?>
            <div class="row"
                 style="border: 1px solid black; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px; height: 5em"><?php echo $content; ?></div><?php
        } else {
            ?>
            <div class="row"
                 style="border: 1px solid black; height: 5em"><?php echo $content; ?></div><?php
        }
    }
}