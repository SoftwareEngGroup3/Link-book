<?php
function populateUsers($q, $usersPerRow, $connectButton)
{
    include("../secure/secure.php");
    $link = mysqli_connect($site, $user, $pass, $db) or die("Connect Error " . mysqli_error($link));
    if ($q == "") {
        $result = mysqli_query($link, "SELECT * FROM `users` ORDER BY fName");
        getUsersFromResult($result, $usersPerRow, $connectButton);
        mysqli_free_result($result);
    } else {
        $query = 'SELECT uIDnum, profile_picture, fName, lName FROM `users` WHERE fName LIKE ? OR lName LIKE ? ORDER BY fName';
        $stmt = $link->stmt_init();
        if ($stmt->prepare($query)){
            $stmt->bind_param("ss", $q, $q);
            $stmt->execute();
            $result = $stmt->get_result();
            getUsersFromResult($result, $usersPerRow, $connectButton);
        } else {
            echo "Prepare issue";
        }
    }
}

function getUsersFromResult($result, $usersPerRow, $connectButton)
{
    while ($row = mysqli_fetch_assoc($result)) {
        $i = 0;
        echo "<div class='row' style='padding-bottom: 2em'>";
        for ($i; $i < $usersPerRow; $i++) {
            if ($i == 0 || ($row = mysqli_fetch_assoc($result))) {
                echo "<div class='col-lg-2'>";
                printUser($row[uIDnum], $row[profile_picture], $row[fName], $row[lName], $connectButton);
                echo "</div>";
            } else {
                break;
            }
        }
        echo "</div>";
    }
}

function printUser($uid, $picPath, $fName, $lName, $withConnectButton)
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
            <div class="btn btn-success" style="height: 2em; width: 8em">Connect</div>
        </div>
    </div>
    <?php
}
}

?>
