<html>
<head>
    <title>Linkbook &mdash; Login</title>
</head>
<body>
    <div class="ui middle aligned center aligned grid">
    <div class="column">
        <h2 class="ui header">
            <div class="content">Welcome, please log in</div>
        </h2>
        <form class="ui large form" action="<?=$_SERVER['PHP_SELF']?>" method='POST'>
            <div class="ui stacked segment">
                <div class="field">
                    <div class="ui left icon input">
                        <i class="user icon"></i>
                        <input required type="text" name="username" placeholder="Username"/>
                    </div>
                </div>
                <div class="field">
                    <div class="ui left icon input">
                        <i class="lock icon"></i>
                        <input required type="password" name="password" placeholder="Password"/>
                    </div>
                </div>
                <input class="ui blue fluid large submit button" type="submit" name="submit" value="Login"/>
            </div>
        </form>
<?php
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
	if(isset($_POST['submit'])){
 //query the stored salt and hashed password from database
		$result = pg_prepare($dbconn, "lookup", 'SELECT salt, password_hash FROM lab8.authentication WHERE username = $1');
 
		$result = pg_execute($dbconn, "lookup", array($_POST['username']));
 
		$row = pg_fetch_assoc($result);
 
		$localhash = sha1( $row['salt'] . $_POST['password'] );
 
 
	//if passwords match, log user in
	if ($localhash == $row['password_hash']){
		session_start();
		$_SESSION['login_user'] = $_POST['username'];
		
		header("location:  https://babbage.cs.missouri.edu/~jtbc7d/cs3380/lab8/home.php");
		
		$query = 'INSERT INTO lab8.log (username, ip_address, action) VALUES(\''.$_POST['username'].'\', \''.$_SERVER['REMOTE_ADDR'] .'\', \''.login.'\');';
		pg_prepare($dbconn, "log", $query);
		pg_execute($dbconn, "log", array()) or die('Query failed: ' . pg_last_error());
		
	}
	//if password does not match, redirect user
	else
		echo "Please Enter Your Login Information Again";

}

?>
<div class="ui message">Need an account? <a href="register.php">Register here</a><hr/>
                <p>Having trouble logging in? <a href="password_reset.php">Reset your password</a>.</p>
        </div>
    </div>
    </div>
</body>
</html>
