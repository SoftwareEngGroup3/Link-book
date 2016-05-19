<?php
session_start();
if(!isset($_SESSION["loggedin"])){
    header("Location: index.php");
}
else {
    if($_SESSION[username] == "Admin"){
        header("Location: admin.php");
    }
}
?>
