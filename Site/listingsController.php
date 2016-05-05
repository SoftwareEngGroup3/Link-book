<?php

if(isset($_POST['uid'], $_POST['jobTitle'],$_POST['company'],$_POST['location'],$_POST['desc'],$_POST['qual'],$_POST['pay'],$_POST['cont'])){
    insertRow($_POST['jobTitle'],$_POST['company'],$_POST['location'],$_POST['desc'],$_POST['qual'],$_POST['pay'],$_POST['cont']);
}

function insertRow($jobTitle, $company, $location, $desc, $qual, $pay, $contactInfo){
    include("../secure/secure.php");
    $link = mysqli_connect($site, $user, $pass, $db) or die("Connect Error " . mysqli_error($link));
    $sql = "INSERT INTO listing(bIDnum, job_title, job_description, qualifications, starting_pay, location, contactInfo, companyName) VALUES(?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $link->stmt_init();
    if ($stmt->prepare($sql)){
        $bIDnum = 2;
        $stmt->bind_param("isssssss", $bIDnum, $jobTitle, $desc, $qual, $pay, $location, $contactInfo, $company);
        $stmt->execute();
        $result = $stmt->get_result();
        echo "Row Added!";
    } else {
        echo "Prepare Issue: " . $stmt->error;
    }
}

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
        ?>
        <tr style="height: 2em;">
            <td><input type="text" style="width: 8em" placeholder="Job Title" id="jobTitle"></td>
            <td><input type="text" style="width: 8em" placeholder="Company" id="company"></td>
            <td><input type="text" style="width: 8em" placeholder="Location" id="location"></td>
            <td><input type="text" style="width: 8em" placeholder="Description" id="description"></td>
            <td><input type="text" style="width: 8em" placeholder="Qualifications" id="qualifications"></td>
            <td><input type="text" style="width: 8em" placeholder="Starting Pay" id="startingPay"></td>
            <td><input type="text" style="width: 8em" placeholder="Contact Info" id="contactInfo"></td>
            <td><div class="btn btn-success" id="submitButton">Submit</div></td>


        </tr>
        <?php
        mysqli_free_result($result);
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