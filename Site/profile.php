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
$isEditable = false;
if($_SESSION[uid] == $_GET[uid]){
    $isEditable = true;
}
$picPath = $user[profile_picture];
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
       
      
    
</script>

    
<div class="container" style="margin-top: 3em">
    
    <div class="col-lg-2">
        <div class="row">
            <img src="<?php echo $picPath ?>" style="height: 15em; width: 13em">
            
            <div class="col-md-4 col-sm-4 col-xs-3"></div>
            <div class="col-md-4 col-sm-4 col-xs-6">
                
            <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST" id="inputform1" class="inputform">
                
                <input type = "image" id = "close_input1" src = "close.png" class="close_input">
                
                <div class="updateButton">
                    <div class="ui input">
                        <input type="text" name="firstname" required="required" placeholder="<?php echo $user[fName]; ?>" >
                    </div>
                </div>
                <div class="updateButton">
                    <div class="ui input">
                        <input type="text" name="lastname" required="required" placeholder="<?php echo $user[lName]; ?>"/>
                    </div>
                </div>

                <div class="updateButton">
                    <input class=" btn btn-default" type="submit" name="updateName" required="required" value="Update"/>
                </div>
            </form>
                
                
            <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST" id="inputform2" class="inputform">
                
                <input type = "image" id = "close_input2" src = "close.png" class="close_input">
                
                <div class="updateButton">
                    <div class="ui input">
                        <input type="email" name="email" required="required" placeholder="<?php echo $user[email]; ?>"/>
                    </div>
                </div>

                <div class="updateButton">
                    <input class=" btn btn-default" type="submit" name="updateEmail" required="required" value="Update"/>
                </div>
            </form>              
                
            </div>        
                   
        </div>
        
        
            <?php printSmallModule($user[fName]." ".$user[lName]); ?>
            <input type="button" id="show_input1" value="Edit">
            <?php printSmallModule($user[email]); ?>
            <input type="button" id="show_input2" value="Edit">
            <?php printSmallModule($user[organization]); ?>
            <input type="button" id="show_input3" value="Edit">
            <?php printSmallModule($user[coding_languages]); ?>
            <input type="button" id="show_input4" value="Edit">
        
        
    </div>
    <div class="col-lg-8" style="padding-left: 2em">
        <?php
        printBigModule("About Me", $user[bio]);
        //printBigModule("")
        ?>
        <input type="button" id="show_input5" value="Edit">
        
    </div>
    <div class="col-lg-2">
        
        <?php if($isEditable){?>
        <div class="row"><h5>Update Your Status:</h5></div>
        <div class="row">
            <textarea rows="5" placeholder="Status..."
                      style="height: 5em; resize: none; border-radius: 10px"></textarea>
        </div>
            <div class="row" style="margin-bottom: 2em"></div>
      <?php
        }       


            if (isset($_POST['updateName'])) {
                include("../secure/secure.php");
                $link = mysqli_connect($site, $user, $pass, $db) or die("Connect Error " . mysqli_error($link));
                
                $sql = "UPDATE users SET fName = ?, lName = ? WHERE uIDnum = ?";
                //$sql = "UPDATE users SET users(uIDnum, fName, lName, email, username, salt, hashed_pass, organization, bio, profile_picture, coding_languages) VALUES(?,?,?,?,?,?,?,?,?,?,?)";
                
                if ($stmt = mysqli_prepare($link, $sql)) {
                    
                    $fName = $_POST['firstname'];
                    $lName = $_POST['lastname'];     
                    $uIDnum = $_SESSION[uid];
                    
                    echo $fName;
                    mysqli_stmt_bind_param($stmt, "ssi", $fName, $lName, $uIDnum) or die("bind param");
                    
                    if (mysqli_stmt_execute($stmt)) {
                        echo "<h4>Success</h4>";
                    } 
                    else {
                        echo "<h4>Failed</h4>";
                    }
                } 
            }

            else if (isset($_POST['updateEmail'])) {
                include("../secure/secure.php");
                $link = mysqli_connect($site, $user, $pass, $db) or die("Connect Error " . mysqli_error($link));
                
                $sql = "UPDATE users SET email = ? WHERE uIDnum = ?";
                
                if ($stmt = mysqli_prepare($link, $sql)) {
                    
                    $email = $_POST['email']; 
                    $uIDnum = $_SESSION[uid];
                    
                    echo $fName;
                    mysqli_stmt_bind_param($stmt, "si", $email, $uIDnum) or die("bind param");
                    
                    if (mysqli_stmt_execute($stmt)) {
                        echo "<h4>Success</h4>";
                    } 
                    else {
                        echo "<h4>Failed</h4>";
                    }
                } 
            }




            
        
        ?>
        

    <?php 
        printStatusBlock($user[uIDnum], 3, 5);?>

    </div>
</div>
</body>