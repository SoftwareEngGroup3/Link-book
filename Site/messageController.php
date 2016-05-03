<?php
function generateMessages($sender, $receiver)
{
    include("../secure/secure.php");
    $link = mysqli_connect($site, $user, $pass, $db) or die("Connect Error " . mysqli_error($link));
    $senderInfo = mysqli_fetch_assoc(mysqli_query($link, "SELECT * FROM `users` WHERE uIDnum = $sender")) or die("Connect Error: Can't fetch sender " . mysqli_error($link));
    $receiverInfo = mysqli_fetch_assoc(mysqli_query($link, "SELECT * FROM `users` WHERE uIDnum = $receiver")) or die("Connect Error: Can't fetch receiver " . mysqli_error($link));
    $result = mysqli_query($link, "SELECT * FROM  `messages` WHERE (sender_uIDnum = $sender AND receiver_uIDnum = $receiver) OR (sender_uIDnum = $receiver AND receiver_uIDnum = $sender) ORDER BY send_timestamp ASC");
    if (mysqli_num_rows($result) != 0) {
        while ($messagesRow = mysqli_fetch_assoc($result)) {
            echo "<div class='row' style='margin-bottom: 2em'>";
            if ($messagesRow[sender_uIDnum] == $sender) {
                printSentMessage($senderInfo[profile_picture], $senderInfo[fName] . " " . $senderInfo[lName], $messagesRow[contents]);
            } else {
                printReceivedMessage($receiverInfo[profile_picture], $receiverInfo[fName] . " " . $receiverInfo[lName], $messagesRow[contents], $receiverInfo[uIDnum]);
            }
            echo "</div>";
        }
    } else { ?>
        <div class='row' style='margin-bottom: 2em'>
            <div class='col-md-3'></div>
            <div class='col-md-4'>
                No messages yet! :(
            </div>
        </div>
        <?php

    }
}

function printSentMessage($picPath, $name, $content, $uid)
{
    if ($picPath == "empty") {
        $picPath = "../img/no_profile.jpg";
    } ?>
    <div class="col-md-3"></div>
    <div class="col-md-4" style="border: 1px solid black; height: 7em;">
        <?php echo $content; ?>
    </div>
    <div class="col-md-1" style="margin-left: 3em">
        <div class="row">
            <img src="<?php echo $picPath ?>" height="100em" width="95em"">
        </div>
        <div class="row pull-right">
            You
        </div>
    </div>
    <?php
}

function printReceivedMessage($picPath, $name, $content, $uid)
{
    if ($picPath == "empty") {
        $picPath = "../img/no_profile.jpg";
    } ?>
    <div class="col-md-3"></div>
    <div class="col-md-1">
        <div class="row">
            <a href="profile.php?uid=<?php echo $uid ?>"><img src="<?php echo $picPath ?>" height="100em" width="95em""></a>
        </div>
        <div class="row">
            <a href="profile.php?uid=<?php echo $uid; ?>"><?php echo $name; ?></a>
        </div>
    </div>
    <div class="col-md-4" style="border: 1px solid black; height: 7em; margin-left: 3em">
        <?php echo $content; ?>
    </div>
    <?php
}