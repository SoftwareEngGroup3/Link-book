<?php
function generateListings($query, $colQueried)
{
    include("../secure/secure.php");
    $link = mysqli_connect($site, $user, $pass, $db) or die("Connect Error " . mysqli_error($link));
    if ($query == "") {
        $result = mysqli_query($link, "SELECT * FROM `listing`");
        while ($listRow = mysqli_fetch_assoc($result)) {
            //echo $listRow[bIDnum];
            $result2 = mysqli_query($link, "SELECT * FROM `business` WHERE bIDnum = ".$listRow[bIDnum]);
            $busRow = mysqli_fetch_assoc($result2);
            //print_r($busRow);
            printRow($listRow[job_title], $listRow[job_description], $listRow[qualifications], $busRow[name], $listRow[location], $listRow[starting_pay], $busRow[contact_email], $listRow[bIDnum]);
        }
    }
}

function printRow($title, $description, $qualifications, $name, $location, $pay, $email, $busID)
{
    $na = "N/A";
    if($title == ""){
        $title = $na;
    }
    if($description == ""){
        $description = $na;
    }
    if($name == ""){
        $name = $na;
    }
    if($location == ""){
        $location = $na;
    }
    if($email == ""){
        $email = $na;
    }
    if($qualifications == ""){
        $qualifications = $na;
    }
    if($pay == ""){
        $pay = $na;
    }
    ?>
    <tr>
        <td><?php echo $title ?></td>
        <td><a href="profile.php?bid=<?php echo $busID ?>"><?php echo $name ?></a></td>
        <td><?php echo $location ?></td>
        <td><?php echo $description ?></td>
        <td><?php echo $qualifications ?></td>
        <td><?php echo $pay ?></td>
        <td><?php echo $email ?></td>
        <td><a href="message.php?bid=<?php echo $busID ?>">Message...</a></td>
    </tr>
    <?php
}

?>