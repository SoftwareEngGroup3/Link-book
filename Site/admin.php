<html>
<head>
    <title>Linkbook &mdash; Administration</title>
    <?php include("header.php");?> 
    <script src="//d3js.org/d3.v3.min.js"></script>    
<style>

.chart div {
  font: 10px sans-serif;
  background-color: steelblue;
  text-align: right;
  padding: 3px;
  margin: 1px;
  color: white;
}

</style>
</head>
<body>
<?php
session_start();
if($_SESSION["username"] != "Admin") {
    header("Location: home.php");
}
include("navbar.php");
include("profileController.php");

?>
<div>
    <h1>Welcome <?php echo $_SESSION["username"] ?>
</div>

<div class="chart"></div>
<?php
include("../secure/secure.php");
$link = mysqli_connect($site, $user, $pass, $db) or die("Connect Error " . mysqli_error($link));

if (!$link) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

if ($stmt = mysqli_prepare($link, "SELECT users.uIDnum , count( status.uIDnum ) AS count FROM users , status where users.uIDnum = status.uIDnum group by status.uIDnum;")) {
    mysqli_stmt_execute($stmt);

    /* bind variables to prepared statement */
    mysqli_stmt_bind_result($stmt, $userID, $count);
    $data= array();
    /* fetch values*/ 
  while(mysqli_stmt_fetch($stmt)){
  printf("%d %d\n", $userID, $count);
    }


}

/*
mysqli_prepare($stmt, $query);
//echo $stmt;
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $userID, $count);
mysqli_stmt_fetch($stmt);
*/
?>


</body>
</html>
