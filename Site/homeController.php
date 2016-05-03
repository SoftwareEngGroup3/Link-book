<?php
function populateStatuses($uid)
{
    $count = 0;
    include("../secure/secure.php");
    $link = mysqli_connect($site, $user, $pass, $db) or die("Connect Error " . mysqli_error($link));
    $result = mysqli_query($link, "SELECT * FROM `status` ORDER BY `timestamp` DESC");
    while ($statusRow = mysqli_fetch_assoc($result)) {
        $i = 0;
        if ($result2 = mysqli_query($link, "SELECT * FROM `users` WHERE uIDnum = $statusRow[uIDnum]")) {
            $userRow = mysqli_fetch_assoc($result2);
            if(usersAreConnected($uid, $userRow[uIDnum])){
                $count++;
                echo "<div class='row' style='padding-bottom: 2em; padding-left: 8em'>";
                printStatus($userRow[profile_picture], $userRow[uIDnum], $userRow[fName], $userRow[lName], $statusRow[content]);
                echo "</div>";
            }
        } else {
            break;
        }
    }


    if($count == 0){
        echo "<div class='row' style='padding-bottom: 2em; padding-left: 8em'>";
        echo "Make some <a href='search.php'>Connections</a> to view their statuses on this page!";
        echo "</div>";
    }

    mysqli_free_result($result);
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

function usersAreConnected($user1, $user2)
{
    if($user1 == $user2){
        return false;
    }
    include("../secure/secure.php");
    $link = mysqli_connect($site, $user, $pass, $db) or die("Connect Error " . mysqli_error($link));
    $result = $link->query("SELECT uIDnum1, uIDnum2 FROM `connections` WHERE uIDnum1 = $user1 OR uIDnum2 = $user1");
    while ($row = $result->fetch_assoc()) {
        if ($row[uIDnum1] == $user2 || $row[uIDnum2] == $user2) {
            $link->close();
            $result->close();
            return true;
        }
    }
    return false;
}

?>