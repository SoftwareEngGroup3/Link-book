<html>
<head>
    <title>Linkbook &mdash; Administration</title>
    <?php include("header.php");?> 
    <script src="//d3js.org/d3.v3.min.js"></script> 
    <!--<script src="/js/fusioncharts.js"></script> 
    <script src="/js/fusioncharts.charts.js"></script>-->  
<style>

.chart div {
  font: 10px sans-serif;
  background-color: steelblue;
  text-align: right;
  padding: 25px;
  margin: 25px;
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
    <h2> Number of Statuses for each user</h2>
</div>


<?php
include("../secure/secure.php");
//include("includes/fusioncharts.php");
$link = mysqli_connect($site, $user, $pass, $db) or die("Connect Error " . mysqli_error($link));

if (!$link) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
$stmt = mysqli_stmt_init($link);

if (mysqli_stmt_prepare($stmt, "SELECT users.fName , count( status.uIDnum ) AS count FROM users , status WHERE users.uIDnum = status.uIDnum GROUP BY status.uIDnum;")) {
    //printf("<br>in the if stmt\n");
    
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $user, $count);
     while (mysqli_stmt_fetch($stmt))
        {
          $rows[]= $count;
          echo"<br>";
          printf("The users who have posts are %s\n", $user); 
        }
}
else {
  echo "Prepare Error : ". mysqli_error($link);
}
?>
<div class="chart"></div>

<script>
var data = [<?=implode(',', $rows);?>];
console.log(data);


var x = d3.scale.linear()
    .domain([0, d3.max(data)])
    .range([0, 420]);

d3.select(".chart")
  .selectAll("div")
    .data(data)
  .enter().append("div")
    .style("width", function(d) { return x(d) + "px"; })
    .text(function(d) { return d; });
</script>

</body>
</html>
