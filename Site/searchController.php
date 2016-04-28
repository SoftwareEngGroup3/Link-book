<?php

if (isset($_POST[uidToChange])) {
    if (isset($_POST[uid])) {
        $uid = $_POST[uidToChange];
        $myid = $_POST[uid];
        if (isset($_POST[addConnection])) {
            $add = $_POST[addConnection];
            if($add == "true") {
                createConnection($uid, $myid);
            } else {
                destroyConnection($uid, $myid);
            }
        }
    }
}

function populateUsers($q, $usersPerRow, $withConnectButton, $userID, $connectionsOnly)
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
        if ($q == "") {
            $stmt->bind_param("ii", $userID, $adminID);
        } else {
            $q = "%" . $q . "%";
            $stmt->bind_param("ssii", $q, $q, $userID, $adminID);
        }
        $stmt->execute();
        $result = $stmt->get_result();
        getUsersFromResult($result, $usersPerRow, $withConnectButton, $userID, $connectionsOnly);

    } else {
        echo "Prepare issue" . $stmt->error;
    }
    $result->close();
    $stmt->close();
    $link->close();
}

function getUsersFromResult($result, $usersPerRow, $withConnectButton, $userID, $connectionsOnly)
{
    if($connectionsOnly) {
        $count = 0;
    } else {
        $count = 5; //Don't want the no-connections message appearing on search
    }
    while ($row = mysqli_fetch_assoc($result)) {
        $firstRow = true;
        $i = 0;
        echo "<div class='row' style='padding-bottom: 2em'>";
        for ($i; $i < $usersPerRow; $i++) {
            if ($firstRow || ($row = mysqli_fetch_assoc($result))) {
                $firstRow = false;
                if($connectionsOnly){
                    if(usersAreConnected($userID, $row[uIDnum])){
                        $count++;
                        echo "<div class='col-lg-2'>";
                        if ($withConnectButton) {
                            if (usersAreConnected($userID, $row[uIDnum])) {
                                printUser($row[uIDnum], $row[profile_picture], $row[fName], $row[lName], false, true);
                            } else {
                                printUser($row[uIDnum], $row[profile_picture], $row[fName], $row[lName], true, false);
                            }
                        } else {
                            printUser($row[uIDnum], $row[profile_picture], $row[fName], $row[lName], false, false);
                        }
                        echo "</div>";
                    } else {
                        $i--;
                    }
                } else {
                    $count++;
                    echo "<div class='col-lg-2'>";
                    if ($withConnectButton) {
                        if (usersAreConnected($userID, $row[uIDnum])) {
                            printUser($row[uIDnum], $row[profile_picture], $row[fName], $row[lName], false, true);
                        } else {
                            printUser($row[uIDnum], $row[profile_picture], $row[fName], $row[lName], true, false);
                        }
                    } else {
                        printUser($row[uIDnum], $row[profile_picture], $row[fName], $row[lName], false, false);
                    }
                    echo "</div>";
                }
            } else {
                break;
            }
        }
        echo "</div>";
    }
    if($count == 0){
        echo "Please add some users to view them on this page!";
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
            <div class="btn btn-success changeButton" style="height: 2em; width: 8em">
                <p class="posit">Connect</p>
                <p class="hidden" style="display: none">
                    <?php echo $uid ?>
                </p>
            </div>
        </div>
    </div>
<?php }
    if ($withDisconnectButton) { ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="btn btn-danger changeButton" style="height: 2em; width: 8em">
                    <p class="posit">Disconnect</p>
                    <p class="hidden" style="display: none">
                        <?php echo $uid ?>
                    </p>
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

function usersAreConnected($user1, $user2)
{
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

function destroyConnection($user1, $user2)
{
    include("../secure/secure.php");
    $link = mysqli_connect($site, $user, $pass, $db) or die("Connect Error " . mysqli_error($link));
    $result = $link->query("DELETE FROM `connections` WHERE (uIDnum1 = $user1 AND uIDnum2 = $user2) OR (uIDnum1 = $user2 AND uIDnum2 = $user1)");
    if ($link->affected_rows == 1) {
        echo "1";
        $link->close();
    } else {
        if ($link->affected_rows == 0) {
            echo "No connections were removed";
        } else {
            echo "Too MANY connections were removed. Please contact site admins.";
        }
        $link->close();
    }
}


?>
