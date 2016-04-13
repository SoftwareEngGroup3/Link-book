<?php
function populateUsers($query, $usersPerRow)
{
    include("../secure/secure.php");
    $link = mysqli_connect($site, $user, $pass, $db) or die("Connect Error " . mysqli_error($link));
    if ($query == "") {
        $result = mysqli_query($link, "SELECT * FROM `users`");
        while ($row = mysqli_fetch_assoc($result)) {
            $i = 0;
            echo "<div class='row' style='padding-bottom: 2em'>";
            for ($i; $i < $usersPerRow; $i++) {
                if ($i == 0 || ($row = mysqli_fetch_assoc($result))) {
                    echo "<div class='col-lg-2'>";
                    printUsers($row[uIDnum], $row[profile_picture], $row[fName], $row[lName], true);
                    echo "</div>";
                } else {
                    break;
                }
            }
            echo "</div>";
        }
        mysqli_free_result($result);
    } else {
        //TODO
    }
}

function printUsers($uid, $picPath, $fName, $lName, $withConnectButton)
{
    if($picPath == "empty"){
        $picPath = "../img/no_profile.jpg";
    }
    ?>
    <div class="row">
        <div class="col-lg-12">
            <a href="profile.php?uid=<?php echo $uid ?>"><img src="<?php echo $picPath?>" height="120em" width="110em" onclick="window.location.href="></a>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <a href="profile.php?uid=<?php echo $uid ?>"><?php echo "$fName $lName" ?></a>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="btn btn-success" style="height: 2em; width: 8em">Connect</div>
        </div>
    </div>
    <?php
}

