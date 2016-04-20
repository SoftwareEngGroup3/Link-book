<?php
function populateStatuses()
{
    include("../secure/secure.php");
    $link = mysqli_connect($site, $user, $pass, $db) or die("Connect Error " . mysqli_error($link));
    $result = mysqli_query($link, "SELECT * FROM `status` ORDER BY `timestamp` DESC");
    while ($statusRow = mysqli_fetch_assoc($result)) {
        $i = 0;
        echo "<div class='row' style='padding-bottom: 2em; padding-left: 8em'>";
        if ($result2 = mysqli_query($link, "SELECT * FROM `users` WHERE uIDnum = $statusRow[uIDnum]")) {
            $userRow = mysqli_fetch_assoc($result2);

            printStatus($userRow[profile_picture], $userRow[uIDnum], $userRow[fName], $userRow[lName], $statusRow[content]);
        } else {
            break;
        }
        echo "</div>";
    }
}

function printStatus($picPath, $uid, $fName, $lName, $text)
{
    if ($picPath == "empty") {
        $picPath = "../img/no_profile.jpg";
    }
    ?>
    <div class="col-md-2"></div>
    <div class="col-md-1">
        <div class="row">
            <a href="profile.php?uid=<?php echo $uid ?>"><img src="<?php echo $picPath ?>" height="120em" width="110em""></a>
        </div>
        <div class="row">
            <a href="profile.php?uid=<?php echo $uid; ?>"><?php echo $fName . " " . $lName; ?></a>
        </div>
    </div>
    <div class="col-md-4" style="border: 1px solid black; height: 7em; margin-left: 3em">
        <?php echo $text; ?>
    </div>
    <?php
}

?>