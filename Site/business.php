<!DOCTYPE html>


<html>
<head>
    <title>Link-Book: Business</title>
    <?php include("header.php");?>
</head>
<body>
<div class="container">

    <?php
    include("checksession.php");
    include("navbar.php");
    include("buisnessController.php");
    $buis = getBuisData($_GET[uid]);

if($_SESSION[uid] != $_GET[uid]){
    $_SESSION[isEditable] = false;
}
    

if($_SESSION[uid] == $_GET[uid]){
    $_SESSION[isEditable] = true;
    $_SESSION[bIDnum] = $buis[bIDnum];
    $_SESSION[name] = $buis[name];
    $_SESSION[contact_email] = $buis[contact_email];
    $_SESSION[contact_name] = $buis[contact_name];
    $_SESSION[biz_size] = $buis[biz_size];
    $_SESSION[product] = $buis[product];
    $_SESSION[openings] = $buis[openings];
    $_SESSION[photo] = $buis[photo];

}

    $picPath = $_SESSION[profile_picture];


if($picPath == "empty"){
    $picPath = "../img/no_profile.jpg";
}
?>
    
<style>

.updateButton{
    padding:10px; 
}
    
input{
    position: static;
}
    
.centered {
  position: fixed;
  top: 50%;
  left: 50%;
  /* bring your own prefixes */
  transform: translate(-50%, -50%);
}
    
.inputform
{
  position: fixed;
  top: 50%;
  left: 50%;
  /* bring your own prefixes */
  transform: translate(-50%, -50%);
   width:400px;
   height:200px;
   margin-top:10px;
   margin-left:1px;
   background-color:#white;
   opacity: 1;
   border-radius:3px;
   box-shadow:0px 0px 10px 0px #424242;
   padding:10px;

   font-family:helvetica;
   visibility:hidden;
   display:none;
}
.inputform .close_input
{
   position:absolute;
   top:14px;
   left:370px;
   width:15px;
   height:15px;
}

.inputform1 .dologin
{
   margin-left:5px;
   margin-top:10px;
   width:5px;
   height:40px;
   border:none;
   border-radius:3px;
   color:#E6E6E6;
   background-color:grey;
   font-size:20px;
}
    
h4{
    padding-left:10px;   
}
    
.updateOrg{
     padding-left:10px;      
}
.updateBio{
     padding-left:10px;      
}
    
.updateCode{
     padding-left:10px;      
}
.aboutText{
   
    padding-bottom:5px;
}
   
           
</style>
    
    
<script>
$(document).ready(function(){

   $("#show_input1").click(function(){
    showpopup1();
   });
   $("#close_input1").click(function(){
    hidepopup1();
   });
   $("#show_input2").click(function(){
    showpopup2();
   });
   $("#close_input2").click(function(){
    hidepopup2();
   });
   $("#show_input3").click(function(){
    showpopup3();
   });
   $("#close_input3").click(function(){
    hidepopup3();
   });
   $("#show_input4").click(function(){
    showpopup4();
   });
   $("#close_input4").click(function(){
    hidepopup4();
   });
   $("#show_input5").click(function(){
    showpopup5();
   });
   $("#close_input5").click(function(){
    hidepopup5();
   });

});
 
    //functions
function showpopup1()
{
   $("#inputform1").fadeIn();
   $("#inputform1").css({"visibility":"visible","display":"block"});
}
function hidepopup1()
{
   $("#inputform1").fadeOut();
   $("#inputform1").css({"visibility":"hidden","display":"none"});
}  
function showpopup2()
{
   $("#inputform2").fadeIn();
   $("#inputform2").css({"visibility":"visible","display":"block"});
}
function hidepopup2()
{
   $("#inputform2").fadeOut();
   $("#inputform2").css({"visibility":"hidden","display":"none"});
}
function showpopup3()
{
   $("#inputform3").fadeIn();
   $("#inputform3").css({"visibility":"visible","display":"block"});
}
function hidepopup3()
{
   $("#inputform3").fadeOut();
   $("#inputform3").css({"visibility":"hidden","display":"none"});
}     
function showpopup4()
{
   $("#inputform4").fadeIn();
   $("#inputform4").css({"visibility":"visible","display":"block"});
}
function hidepopup4()
{
   $("#inputform4").fadeOut();
   $("#inputform4").css({"visibility":"hidden","display":"none"});
}  
function showpopup5()
{
   $("#inputform5").fadeIn();
   $("#inputform5").css({"visibility":"visible","display":"block"});
}
function hidepopup5()
{
   $("#inputform5").fadeOut();
   $("#inputform5").css({"visibility":"hidden","display":"none"});
}
       
function hideButtons()
{
    $("#show_input1").css({"visibility":"hidden","display":"none"});
}
function showButtons()
{
    $("#show_input1").css({"visibility":"visible","display":"block"});
}
     
if($_SESSION[uid] == $buis[uIDnum]) {
    showButtons();
}   
else{
    hideButtons();
}
    
</script>
    
    
<script type="text/javascript">
    function updatePage(){
        document.getElementById("page").innerHTML = "<?php echo $buis[fName]; echo " "; echo $buis[lName]; ?>";
    }    
</script>
     

    
    <div class="col-lg-2">
        
    <?php if($_SESSION[isEditable]){?>
        

        

      <?php
        }       

            if (isset($_POST['updateName'])) {
                include("../secure/secure.php");
                $link = mysqli_connect($site, $user, $pass, $db) or die("Connect Error " . mysqli_error($link));
                
                $sql = "UPDATE business SET name = ? WHERE uIDnum = ?";
                //$sql = "UPDATE users SET users(uIDnum, fName, lName, email, username, salt, hashed_pass, organization, bio, profile_picture, coding_languages) VALUES(?,?,?,?,?,?,?,?,?,?,?)";
                
                if ($stmt = mysqli_prepare($link, $sql)) {
                    
                    $fName = $_SESSION[name] = $_POST['name'];
                    
                    $uIDnum = $_SESSION[uid];
                    $_SESSION[isEditable] = true;
                    
                    mysqli_stmt_bind_param($stmt, "ssi", $name, $uIDnum) or die("bind param");

                    
                    if (mysqli_stmt_execute($stmt)) {   

                    } 
                    else {
                        echo "<h4>Failed</h4>";
                    }
                } 
            }

            else if (isset($_POST['updateContEmail'])) {
                include("../secure/secure.php");
                $link = mysqli_connect($site, $user, $pass, $db) or die("Connect Error " . mysqli_error($link));
                
                $sql = "UPDATE business SET contact_email = ? WHERE uIDnum = ?";
                
                if ($stmt = mysqli_prepare($link, $sql)) {
                    
                    $email = $_SESSION[contact_email] = $_POST['contact_email']; 
                    $uIDnum = $_SESSION[uid];
                    $_SESSION[isEditable] = true;
                    
                    echo $fName;
                    mysqli_stmt_bind_param($stmt, "si", $contact_email, $uIDnum) or die("bind param");
                    
                    if (mysqli_stmt_execute($stmt)) {

                    } 
                    else {
                        echo "<h4>Failed</h4>";
                    }
                } 
            }

            else if (isset($_POST['updateContName'])) {
                include("../secure/secure.php");
                $link = mysqli_connect($site, $user, $pass, $db) or die("Connect Error " . mysqli_error($link));
                
                $sql = "UPDATE business SET contact_name = ? WHERE uIDnum = ?";
                
                if ($stmt = mysqli_prepare($link, $sql)) {
                    
                    $coding_languages = $_SESSION[contact_name] = $_POST['contact_name']; 
                    $uIDnum = $_SESSION[uid];
                    $_SESSION[isEditable] = true;
                    
                    mysqli_stmt_bind_param($stmt, "si", $contact_name, $uIDnum) or die("bind param");
                    
                    if (mysqli_stmt_execute($stmt)) {

                    } 
                    else {
                        echo "<h4>Failed</h4>";
                    }
                } 
            }

            else if (isset($_POST['updateSize'])) {
                include("../secure/secure.php");
                $link = mysqli_connect($site, $user, $pass, $db) or die("Connect Error " . mysqli_error($link));
                
                $sql = "UPDATE business SET biz_size = ? WHERE uIDnum = ?";
                
                if ($stmt = mysqli_prepare($link, $sql)) {
                    
                    $organization = $_SESSION[biz_size] = $_POST['biz_size']; 
                    $uIDnum = $_SESSION[uid];
                    $_SESSION[isEditable] = true;
                    
                    mysqli_stmt_bind_param($stmt, "si", $biz_size, $uIDnum) or die("bind param");
                    
                    if (mysqli_stmt_execute($stmt)) {

                    } 
                    else {
                        echo "<h4>Failed</h4>";
                    }
                } 
            }

            else if (isset($_POST['updateProduct'])) {
                include("../secure/secure.php");
                $link = mysqli_connect($site, $user, $pass, $db) or die("Connect Error " . mysqli_error($link));
                
                $sql = "UPDATE business SET product = ? WHERE uIDnum = ?";
                
                if ($stmt = mysqli_prepare($link, $sql)) {
                    
                    $bio = $_SESSION[bio] = $_POST['bio']; 
                    $uIDnum = $_SESSION[uid];
                    $_SESSION[isEditable] = true;
                    
                    mysqli_stmt_bind_param($stmt, "si", $product, $uIDnum) or die("bind param");
                    
                    if (mysqli_stmt_execute($stmt)) {

                    } 
                    else {
                        echo "<h4>Failed</h4>";
                    }
                } 
            }
            
            else if (isset($_POST['updateOpenings'])) {
                include("../secure/secure.php");
                $link = mysqli_connect($site, $user, $pass, $db) or die("Connect Error " . mysqli_error($link));
                
                $sql = "UPDATE business SET openings = ? WHERE uIDnum = ?";
                
                if ($stmt = mysqli_prepare($link, $sql)) {
                    
                    $bio = $_SESSION[bio] = $_POST['bio']; 
                    $uIDnum = $_SESSION[uid];
                    $_SESSION[isEditable] = true;
                    
                    mysqli_stmt_bind_param($stmt, "si", $openings, $uIDnum) or die("bind param");
                    
                    if (mysqli_stmt_execute($stmt)) {

                    } 
                    else {
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
                
                
            <form action="<?= $_SERVER['PHP_SELF'] ?>"  method="POST" id="inputform1" class="inputform">
                
                <input type="button" type = "image" id = "close_input1" class="close_input" type = "button">
                
                <h4> Enter your company name: </h4>
                
                <div class="updateButton">
                    <div class="ui input">
                        <input type="text" name="name" placeholder="<?php echo $_SESSION[name]; ?>"/>
                    </div>
                </div>

                <div class="updateButton">
                    <input type="submit" name="updateName" value="Update" />
                </div>
            </form>
            
                
            <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST" id="inputform2" class="inputform">
                
                <input type="button" type = "image" id = "close_input2" src = "close.png" class="close_input">
                
                <h4> Enter Contact email: </h4>
                
                <div class="updateButton">
                    <div class="ui input">
                        <input type="email" name="email" placeholder="<?php echo $_SESSION[contact_email]; ?>"/>
                    </div>
                </div>

                <div class="updateButton">
                    <input type="submit" name="updateContEmail" required="required"  value="Update"/>
                </div>
            </form>       
                
                
            <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST" id="inputform3" class="inputform">
                
                <input type="button" type = "image" id = "close_input3" src = "close.png" class="close_input">
                
                <h4> Enter your company contact's name: </h4>
                
                <div class="updateOrg">
                    <div class="ui input">
                        <input type="text" name="organization"  placeholder="<?php echo $_SESSION[contact_name]; ?>"/>
                    </div>
                </div>

                <div class="updateButton">
                    <input type="submit" name="contact_name"  value="Update"/>
                </div>
            </form>       
                
                
 
            <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST" id="inputform4" class="inputform">
                
                <input type="button" type = "image" id = "close_input4" src = "close.png" class="close_input">
                
                <h4> Enter your company size: </h4>
                
                <div class="updateCode">
                    <div class="ui input">
                        <input type="text" name="coding_languages" placeholder="<?php echo $_SESSION[biz_size]; ?>"/>
                    </div>
                </div>

                <div class="updateButton">
                    <input type="submit" name="updateSize" value="Update"/>
                </div>
            </form>       
                
 
            <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST" id="inputform5" class="inputform">
                
                <input type="button" type = "image" id = "close_input5" src = "close.png" class="close_input">
                
                
                <div class="updateBio">
                    <div class="ui input">
                        <textarea rows="5" cols="40" name="bio"  required="required" > <?php echo $_SESSION[product]; ?> </textarea>
                    </div>
                </div>

                <div class="updateButton">
                    <input type="submit" name="updateProduct" value="Update"/>
                </div>
            </form>    
                
             <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST" id="inputform4" class="inputform">
                
                <input type="button" type = "image" id = "close_input4" src = "close.png" class="close_input">
                
                <h4> Enter number of openings: </h4>
                
                <div class="updateCode">
                    <div class="ui input">
                        <input type="text" name="coding_languages" placeholder="<?php echo $_SESSION[openings]; ?>"/>
                    </div>
                </div>

                <div class="updateButton">
                    <input type="submit" name="updateCode" value="Update"/>
                </div>
            </form>     
                
                
                
            </div>        
                   
        </div>

            <?php 


            if($_SESSION[isEditable]){
            printSmallModule($_SESSION[name]); ?>
            <?php if($_SESSION[uid] == $_SESSION[uIDnum]) {?>
                <input type="button" id="show_input1" value="Edit">
            <?php } ?>
            <?php printSmallModule($_SESSION[contact_email]); ?>
            <?php if($_SESSION[uid] == $_SESSION[uIDnum]) {?>
                <input type="button" id="show_input2" value="Edit">
            <?php } ?>
            <?php printSmallModule($_SESSION[contact_name]); ?>
            <?php if($_SESSION[uid] == $_SESSION[uIDnum]) {?>
                <input type="button" id="show_input3" value="Edit">
            <?php } ?>
              <?php printSmallModule($_SESSION[biz_size]); ?>
            <?php if($_SESSION[uid] == $_SESSION[uIDnum]) {?>
                <input type="button" id="show_input3" value="Edit">
            <?php } ?>
              <?php printSmallModule($_SESSION[product]); ?>
            <?php if($_SESSION[uid] == $_SESSION[uIDnum]) {?>
                <input type="button" id="show_input3" value="Edit">
            <?php } ?>
            <?php printSmallModule($_SESSION[openings]); ?>
            <?php if($_SESSION[uid] == $_SESSION[uIDnum]) {?>
                <input type="button" id="show_input4" value="Edit">
            <?php } 
            }
            
            ?>
        
            <?php       
            if($_SESSION[isEditable]==false){
            printSmallModule($buis[name]); ?>
            <?php if($_SESSION[uid] == $_SESSION[uIDnum]) {?>

            <?php } ?>
            <?php printSmallModule($buis[contact_email]); ?>
            <?php if($buis[uid] == $buis[uIDnum]) {?>

            <?php } ?>
            <?php printSmallModule($buis[contact_name]); ?>
            <?php if($_SESSION[uid] == $_SESSION[uIDnum]) {?>
        
            <?php } ?>
            <?php printSmallModule($buis[biz_size]); ?>
            <?php if($buis[uid] == $buis[uIDnum]) {?>
        
            <?php } ?>
            <?php printSmallModule($buis[product]); ?>
            <?php if($buis[uid] == $buis[uIDnum]) {?>

            <?php } ?>
            <?php printSmallModule($buis[openings]); ?>
            <?php if($_SESSION[uid] == $_SESSION[uIDnum]) {?>

            <?php } 

            }
            ?>

        
        
    </div>
<!--
    div class="col-lg-8" style="padding-left: 2em">
        
        
        <h3>About Us:</h3>
        <div class = "aboutText">
        <?php /*
        if($_SESSION[isEditable]){
            echo $_SESSION[bio];
        }
        if($_SESSION[isEditable]==false){
            echo $user[bio];            
        }
        echo " ";
            
        //printBigModule("")
        ?>
        </div>
        
        <?php if($_SESSION[uid] == $_SESSION[uIDnum]) {
            if($_SESSION[isEditable]){ ?>
                <input type="button" id="show_input5" value="Edit">
        <?php
            }   
        } */ ?>
        
    </div>
-->
     

</div>   


    
</html>    