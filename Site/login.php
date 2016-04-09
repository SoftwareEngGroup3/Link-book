<html>
<head>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
          integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css"
          integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"
            integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS"
            crossorigin="anonymous"></script>
    <title>Linkbook &mdash; Login</title>
</head>
<body>
<form class="ui large form" action="<?= $_SERVER['PHP_SELF'] ?>" method='POST'>
    <div class="container">
        <div class="row" style="padding-bottom: 2%">
            <!-- This will eventually contain a blank toolbar -->
        </div>
        <div class="row" style="padding-bottom: 3%">
            <h2>Link-Book</h2>
        </div>
        <div class="row" style="padding-bottom: 3%">
            <div class="col-lg-2"></div>
            <div class="col-lg-4">
                Username: <input required type="text" name="username" placeholder="Username"/>
            </div>
        </div>
        <div class="row" style="padding-bottom: 3%">
            <div class="col-lg-2"></div>
            <div class="col-lg-4">
                Password: <input required type="password" name="password" placeholder="Password"/>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-2">
            </div>
            <div class="col-lg-8 pull-right">
                <input class="ui blue fluid large submit button" type="submit" name="submit" value="Login"/>
            </div>
        </div>
</form>

<?php/*
//check to make sure address is using https
/*if($_SERVER["HTTPS"] != "on"){
        header("Location: https://babbage.cs.missouri.edu/~jtbc7d/cs3380/lab8/index.php");
    }
//connect to database
include("../secure/database.php");
 $dbconn = pg_connect(HOST." ".DBNAME." ".USERNAME." ".PASSWORD)
    or die('Could not connect: ' . pg_last_error());

//if the user is already logged in, redirect to homepage
    if(isset($_SESSION['login_user'])){
        header("location: home.php");
    }
*/
if (isset($_POST['submit'])) {
    //query the stored salt and hashed password from database
    $result = pg_prepare($dbconn, "lookup", 'SELECT salt, password_hash FROM lab8.authentication WHERE username = $1');

    $result = pg_execute($dbconn, "lookup", array($_POST['username']));

    $row = pg_fetch_assoc($result);

    $localhash = sha1($row['salt'] . $_POST['password']);


    //if passwords match, log user in
    if ($localhash == $row['password_hash']) {
        session_start();
        $_SESSION['login_user'] = $_POST['username'];

        header("location:  https://babbage.cs.missouri.edu/~jtbc7d/cs3380/lab8/home.php");

        $query = 'INSERT INTO lab8.log (username, ip_address, action) VALUES(\'' . $_POST['username'] . '\', \'' . $_SERVER['REMOTE_ADDR'] . '\', \'' . login . '\');';
        pg_prepare($dbconn, "log", $query);
        pg_execute($dbconn, "log", array()) or die('Query failed: ' . pg_last_error());

    } //if password does not match, redirect user
    else
        echo "Please Enter Your Login Information Again";

}

?>
<div class="row">
    <div class="col-lg-3">
        Need an account? <a href="register.php">Register here</a>
        <hr/>
        Having trouble logging in?<br/> <a href="password_reset.php">Reset your password</a>.
    </div>
</div>
</div>
</body>
</html>
