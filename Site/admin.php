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
printf("got here");
//$stmt = mysqli_stmt_init($link);
$status = "status.uIDnum";
//$query = 'SELECT users.uIDnum , count( status.uIDnum ) AS count FROM `users` , `status` where users.uIDnum = ? group by status.uIDnum';

    $stmt = $link->stmt_init();
    if ($stmt->prepare("SELECT users.uIDnum , count( status.uIDnum ) AS count FROM users , status where users.uIDnum = ? group by status.uIDnum")) {
            $stmt->bind_param("s", $status);
        }
        $stmt->execute();
        $result = $stmt->get_result();
    } else {
        echo "Prepare issue" . $stmt->error;
    }
?>


</body>
</html>
