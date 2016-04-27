<?php

if (isset($_POST[uidToAdd])) {
    if (isset($_POST[uid])) {
        $uid = $_POST[uidToAdd];
        $myid = $_POST[uid];
        createConnection($uid, $myid);
    }
}

function populateUsers($q, $usersPerRow, $withConnectButton, $userID)
{
    include("../secure/secure.php");
    $link = mysqli_connect($site, $user, $pass, $db) or die("Connect Error " . mysqli_error($link));
    if ($q == "") {
        $sql = "SELECT uIDnum, profile_picture, fName, lName FROM `users` WHERE (uIDnum != ? AND uIDnum != ?) ORDER BY fName";
    } else {
        $sql = 'SELECT uIDnum, profile_picture, fName, lName FROM `users` WHERE (fName LIKE ? OR lName LIKE ?) AND uIDnum != ? AND uIDnum != ? ORDER BY fName';
    }
    $stmt = $link->stmt_init();
    if ($stmt->prepare($sql)) {
        $adminID = 527973283;
        if($q == "") {
            $stmt->bind_param("ii", $userID, $adminID);
        } else {
            $q = "%" . $q . "%";
            $stmt->bind_param("ssii", $q, $q, $userID, $adminID);
        }
        $stmt->execute();
        $result = $stmt->get_result();
        getUsersFromResult($result, $usersPerRow, $withConnectButton, $userID);

    } else {
        echo "Prepare issue" . $stmt->error;
    }
    $result->close();
    $stmt->close();
    $link->close();
}

function getUsersFromResult($result, $usersPerRow, $withConnectButton, $userID)
{
    while ($row = mysqli_fetch_assoc($result)) {
        $i = 0;
        echo "<div class='row' style='padding-bottom: 2em'>";
        for ($i; $i < $usersPerRow; $i++) {
            if ($i == 0 || ($row = mysqli_fetch_assoc($result))) {
                echo "<div class='col-lg-2'>";
                if($withConnectButton) {
                    if(usersAreConnected($userID, $row[uIDnum])) {
                        printUser($row[uIDnum], $row[profile_picture], $row[fName], $row[lName], false, true);
                    } else {
                        printUser($row[uIDnum], $row[profile_picture], $row[fName], $row[lName], true, false);
                    }
                } else {
                    printUser($row[uIDnum], $row[profile_picture], $row[fName], $row[lName], false, false);
                }
                echo "</div>";
            } else {
                break;
            }
        }
        echo "</div>";
    }
}


function printUser($uid, $picPath, $fName, $lName, $withConnectButton, $withDisconnectButton)
{
    if ($picPath == "empty" || $picPath == "") {
        $picPath = "../img/no_profile.jpg";
    }
    ?>
    <div class="row">
        <div class="col-lg-12">
            <a href="profile.php?uid=<?php echo $uid ?>"><img src="<?php echo $picPath ?>" height="120em" width="110em""></a>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <a href="profile.php?uid=<?php echo $uid ?>"><?php echo "$fName $lName" ?></a>
        </div>
    </div>
    <?php if ($withConnectButton) { ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="btn btn-success" style="height: 2em; width: 8em">Connect<p class="hidden"
                                                                                   style="display: none"><?php echo $uid ?></p>
            </div>
        </div>
    </div>
    <?php }
    if ($withDisconnectButton){ ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="btn btn-danger" style="height: 2em; width: 8em">Disconnect<p class="hidden"
                                                                                       style="display: none"><?php echo $uid ?></p>
                </div>
            </div>
        </div>
    <?php
}
}

function createConnection($id1, $id2)
{
    include("../secure/secure.php");
    $link = mysqli_connect($site, $user, $pass, $db) or die("Connect Error " . mysqli_error($link));
    $sql = "INSERT INTO `connections` (uIDnum1, uIDnum2) VALUES ($id1, $id2)";
    if ($link->query($sql) === TRUE) {
        echo "1";
        $link->close();
    } else {
        echo $link->errno . ": " . $link->error;
        $link->close();
    }
}

function usersAreConnected($user1, $user2){
    include("../secure/secure.php");
    $link = mysqli_connect($site, $user, $pass, $db) or die("Connect Error " . mysqli_error($link));
    $result = $link->query("SELECT uIDnum1, uIDnum2 FROM `connections` WHERE uIDnum1 = $user1 OR uIDnum2 = $user1");
    while($row = $result->fetch_assoc()){
        if($row[uIDnum1] == $user2 || $row[uIDnum2] == $user2){
            $link->close();
            $result->close();
            return true;
        }
    }
    return false;
}


?>
