<head>
    <title>Link-Book: Profile</title>
    <?php include("header.php"); ?>


</head>


<body>
<?php
include("checksession.php");
include("navbar.php");    
include("profileController.php");    
$user = getUserData($_GET[uid]);
    
    checkIfBusiness($user);

if ($_SESSION[uid] != $_GET[uid]) {
    $_SESSION[isEditable] = false;
}


if ($_SESSION[uid] == $_GET[uid]) {
    $_SESSION[isEditable] = true;
    $_SESSION[fName] = $user[fName];
    $_SESSION[lName] = $user[lName];
    $_SESSION[email] = $user[email];
    $_SESSION[organization] = $user[organization];
    $_SESSION[coding_languages] = $user[coding_languages];
    $_SESSION[bio] = $user[bio];
    $_SESSION[uIDnum] = $user[uIDnum];
    $_SESSION[profile_picture] = $user[profile_picture];

}

$picPath = $_SESSION[profile_picture];


if ($picPath == "empty") {
    $picPath = "../img/no_profile.jpg";
}
?>

<style>

    .updateButton {
        padding: 10px;
    }

    input {
        position: static;
    }

    .centered {
        position: fixed;
        top: 50%;
        left: 50%;
        /* bring your own prefixes */
        transform: translate(-50%, -50%);
    }

    .inputform {
        position: fixed;
        top: 50%;
        left: 50%;
        /* bring your own prefixes */
        transform: translate(-50%, -50%);
        width: 400px;
        height: 200px;
        margin-top: 10px;
        margin-left: 1px;
        background-color: #white;
        opacity: 1;
        border-radius: 3px;
        box-shadow: 0px 0px 10px 0px #424242;
        padding: 10px;

        font-family: helvetica;
        visibility: hidden;
        display: none;
    }

    .inputform .close_input {
        position: absolute;
        top: 14px;
        left: 370px;
        width: 15px;
        height: 15px;
    }

    .inputform1 .dologin {
        margin-left: 5px;
        margin-top: 10px;
        width: 5px;
        height: 40px;
        border: none;
        border-radius: 3px;
        color: #E6E6E6;
        background-color: grey;
        font-size: 20px;
    }

    h4 {
        padding-left: 10px;
    }

    .updateOrg {
        padding-left: 10px;
    }

    .updateBio {
        padding-left: 10px;
    }

    .updateCode {
        padding-left: 10px;
    }

    .aboutText {

        padding-bottom: 5px;
    }


</style>


<script>
    $(document).ready(function () {

        $("#show_input1").click(function () {
            showpopup1();
        });
        $("#close_input1").click(function () {
            hidepopup1();
        });
        $("#show_input2").click(function () {
            showpopup2();
        });
        $("#close_input2").click(function () {
            hidepopup2();
        });
        $("#show_input3").click(function () {
            showpopup3();
        });
        $("#close_input3").click(function () {
            hidepopup3();
        });
        $("#show_input4").click(function () {
            showpopup4();
        });
        $("#close_input4").click(function () {
            hidepopup4();
        });
        $("#show_input5").click(function () {
            showpopup5();
        });
        $("#close_input5").click(function () {
            hidepopup5();
        });

    });

        $("#inputform1").fadeIn();
        $("#inputform1").css({"visibility": "visible", "display": "block"});
    }
    function hidepopup1() {
        $("#inputform1").fadeOut();
        $("#inputform1").css({"visibility": "hidden", "display": "none"});
    }
    function showpopup2() {
        $("#inputform2").fadeIn();
        $("#inputform2").css({"visibility": "visible", "display": "block"});
    }
    function hidepopup2() {
        $("#inputform2").fadeOut();
        $("#inputform2").css({"visibility": "hidden", "display": "none"});
    }
    function showpopup3() {
        $("#inputform3").fadeIn();
        $("#inputform3").css({"visibility": "visible", "display": "block"});
    }
    function hidepopup3() {
        $("#inputform3").fadeOut();
        $("#inputform3").css({"visibility": "hidden", "display": "none"});
    }
    function showpopup4() {
        $("#inputform4").fadeIn();
        $("#inputform4").css({"visibility": "visible", "display": "block"});
    }
    function hidepopup4() {
        $("#inputform4").fadeOut();
        $("#inputform4").css({"visibility": "hidden", "display": "none"});
    }
    function showpopup5() {
        $("#inputform5").fadeIn();
        $("#inputform5").css({"visibility": "visible", "display": "block"});
    }
    function hidepopup5() {
        $("#inputform5").fadeOut();
        $("#inputform5").css({"visibility": "hidden", "display": "none"});
    }

    function hideButtons() {
        $("#show_input1").css({"visibility": "hidden", "display": "none"});
    }
    function showButtons() {
        $("#show_input1").css({"visibility": "visible", "display": "block"});
    }

    if ($_SESSION[uid] == $user[uIDnum]) {
        showButtons();
    }
    else {
        hideButtons();
    }

</script>


<script type="text/javascript">
    function updatePage() {
        document.getElementById("page").innerHTML = "<?php echo $user[fName]; echo " "; echo $user[lName]; ?>";
    }
</script>


<div class="col-lg-2">

    <?php if ($_SESSION[isEditable]) { ?>


        <?php
    }

    if (isset($_POST['updateName'])) {
        include("../secure/secure.php");
        $link = mysqli_connect($site, $user, $pass, $db) or die("Connect Error " . mysqli_error($link));

        $sql = "UPDATE users SET fName = ?, lName = ? WHERE uIDnum = ?";
        //$sql = "UPDATE users SET users(uIDnum, fName, lName, email, username, salt, hashed_pass, organization, bio, profile_picture, coding_languages) VALUES(?,?,?,?,?,?,?,?,?,?,?)";

        if ($stmt = mysqli_prepare($link, $sql)) {

            $fName = $_SESSION[fName] = $_POST['firstname'];
            $lName = $_SESSION[lName] = $_POST['lastname'];

            $uIDnum = $_SESSION[uid];
            $_SESSION[isEditable] = true;

            mysqli_stmt_bind_param($stmt, "ssi", $fName, $lName, $uIDnum) or die("bind param");


            if (mysqli_stmt_execute($stmt)) {

            } else {
                echo "<h4>Failed</h4>";
            }
        }
    } else if (isset($_POST['updateEmail'])) {
        include("../secure/secure.php");
        $link = mysqli_connect($site, $user, $pass, $db) or die("Connect Error " . mysqli_error($link));

        $sql = "UPDATE users SET email = ? WHERE uIDnum = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {

            $email = $_SESSION[email] = $_POST['email'];
            $uIDnum = $_SESSION[uid];
            $_SESSION[isEditable] = true;

            echo $fName;
            mysqli_stmt_bind_param($stmt, "si", $email, $uIDnum) or die("bind param");

            if (mysqli_stmt_execute($stmt)) {

            } else {
                echo "<h4>Failed</h4>";
            }
        }
    } else if (isset($_POST['updateCode'])) {
        include("../secure/secure.php");
        $link = mysqli_connect($site, $user, $pass, $db) or die("Connect Error " . mysqli_error($link));

        $sql = "UPDATE users SET coding_languages = ? WHERE uIDnum = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {

            $coding_languages = $_SESSION[coding_languages] = $_POST['coding_languages'];
            $uIDnum = $_SESSION[uid];
            $_SESSION[isEditable] = true;

            mysqli_stmt_bind_param($stmt, "si", $coding_languages, $uIDnum) or die("bind param");

            if (mysqli_stmt_execute($stmt)) {

            } else {
                echo "<h4>Failed</h4>";
            }
        }
    } else if (isset($_POST['updateOrg'])) {
        include("../secure/secure.php");
        $link = mysqli_connect($site, $user, $pass, $db) or die("Connect Error " . mysqli_error($link));

        $sql = "UPDATE users SET organization = ? WHERE uIDnum = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {

            $organization = $_SESSION[organization] = $_POST['organization'];
            $uIDnum = $_SESSION[uid];
            $_SESSION[isEditable] = true;

            mysqli_stmt_bind_param($stmt, "si", $organization, $uIDnum) or die("bind param");

            if (mysqli_stmt_execute($stmt)) {

            } else {
                echo "<h4>Failed</h4>";
            }
        }
    } else if (isset($_POST['updateBio'])) {
        include("../secure/secure.php");
        $link = mysqli_connect($site, $user, $pass, $db) or die("Connect Error " . mysqli_error($link));

        $sql = "UPDATE users SET bio = ? WHERE uIDnum = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {

            $bio = $_SESSION[bio] = $_POST['bio'];
            $uIDnum = $_SESSION[uid];
            $_SESSION[isEditable] = true;

            mysqli_stmt_bind_param($stmt, "si", $bio, $uIDnum) or die("bind param");

            if (mysqli_stmt_execute($stmt)) {

            } else {
                echo "<h4>Failed</h4>";
            }
        }
    }


    ?>


</div>

<div class="container" style="margin-top: 3em">

    <div class="col-lg-2">
        <div class="row">
            <img src="<?php echo $picPath ?>" style="height: 15em; width: 13em">

            <div class="col-md-4 col-sm-4 col-xs-3"></div>
            <div class="col-md-4 col-sm-4 col-xs-6">


                <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST" id="inputform1" class="inputform">

                    <input type="button" type="image" id="close_input1" class="close_input" type="button">

                    <h4> Enter your name: </h4>

                    <div class="updateButton">
                        <div class="ui input">
                            <input type="text" name="firstname" placeholder="<?php echo $_SESSION[fName]; ?>">
                        </div>
                    </div>
                    <div class="updateButton">
                        <div class="ui input">
                            <input type="text" name="lastname" placeholder="<?php echo $_SESSION[lName]; ?>"/>
                        </div>
                    </div>

                    <div class="updateButton">
                        <input type="submit" name="updateName" value="Update"/>
                    </div>
                </form>


                <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST" id="inputform2" class="inputform">

                    <input type="button" type="image" id="close_input2" src="close.png" class="close_input">

                    <h4> Enter your email: </h4>

                    <div class="updateButton">
                        <div class="ui input">
                            <input type="email" name="email" placeholder="<?php echo $_SESSION[email]; ?>"/>
                        </div>
                    </div>

                    <div class="updateButton">
                        <input type="submit" name="updateEmail" required="required" value="Update"/>
                    </div>
                </form>


                <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST" id="inputform3" class="inputform">

                    <input type="button" type="image" id="close_input3" src="close.png" class="close_input">

                    <h4> Enter your organizations: </h4>

                    <div class="updateOrg">
                        <div class="ui input">
                            <input type="text" name="organization"
                                   placeholder="<?php echo $_SESSION[organization]; ?>"/>
                        </div>
                    </div>

                    <div class="updateButton">
                        <input type="submit" name="updateOrg" value="Update"/>
                    </div>
                </form>


                <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST" id="inputform4" class="inputform">

                    <input type="button" type="image" id="close_input4" src="close.png" class="close_input">

                    <h4> Enter your coding languages: </h4>

                    <div class="updateCode">
                        <div class="ui input">
                            <input type="text" name="coding_languages"
                                   placeholder="<?php echo $_SESSION[coding_languages]; ?>"/>
                        </div>
                    </div>

                    <div class="updateButton">
                        <input type="submit" name="updateCode" value="Update"/>
                    </div>
                </form>


                <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST" id="inputform5" class="inputform">

                    <input type="button" type="image" id="close_input5" src="close.png" class="close_input">


                    <div class="updateBio">
                        <div class="ui input">
                            <textarea rows="5" cols="40" name="bio"
                                      required="required"> <?php echo $_SESSION[bio]; ?> </textarea>
                        </div>
                    </div>

                    <div class="updateButton">
                        <input type="submit" name="updateBio" value="Update"/>
                    </div>
                </form>


            </div>

        </div>

        <?php


        if ($_SESSION[isEditable]) {
            printSmallModule($_SESSION[fName] . " " . $_SESSION[lName]); ?>
            <?php if ($_SESSION[uid] == $_SESSION[uIDnum]) { ?>
                <input type="button" id="show_input1" value="Edit">
            <?php } ?>
            <?php printSmallModule($_SESSION[email]); ?>
            <?php if ($_SESSION[uid] == $_SESSION[uIDnum]) { ?>
                <input type="button" id="show_input2" value="Edit">
            <?php } ?>
            <?php printSmallModule($_SESSION[organization]); ?>
            <?php if ($_SESSION[uid] == $_SESSION[uIDnum]) { ?>
                <input type="button" id="show_input3" value="Edit">
            <?php } ?>
            <?php printSmallModule($_SESSION[coding_languages]); ?>
            <?php if ($_SESSION[uid] == $_SESSION[uIDnum]) { ?>
                <input type="button" id="show_input4" value="Edit">
            <?php }
        }

        ?>

        <?php
        if ($_SESSION[isEditable] == false) {
            printSmallModule($user[fName] . " " . $user[lName]); ?>
            <?php if ($_SESSION[uid] == $_SESSION[uIDnum]) { ?>

            <?php } ?>
            <?php printSmallModule($user[email]); ?>
            <?php if ($user[uid] == $user[uIDnum]) { ?>

            <?php } ?>
            <?php printSmallModule($user[organization]); ?>
            <?php if ($_SESSION[uid] == $_SESSION[uIDnum]) { ?>

            <?php } ?>
            <?php printSmallModule($user[coding_languages]); ?>
            <?php if ($_SESSION[uid] == $_SESSION[uIDnum]) { ?>

            <?php }

        }
        ?>


    </div>
    <div class="col-lg-8" style="padding-left: 2em">


        <h3>About Me:</h3>
        <div class="aboutText">
            <?php
            if ($_SESSION[isEditable]) {
                echo $_SESSION[bio];
            }
            if ($_SESSION[isEditable] == false) {
                echo $user[bio];
            }
            echo " ";

            //printBigModule("")
            ?>
        </div>

        <?php if ($_SESSION[uid] == $_SESSION[uIDnum]) {
            if ($_SESSION[isEditable]) { ?>
                <input type="button" id="show_input5" value="Edit">
                <?php
            }
        } ?>

    </div>
    <div class="col-lg-1">
                <?php
                printStatusBlock($_GET[uid], 3, 5); ?>


        </div>
    </div>

</div>
</body>
