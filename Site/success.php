<?php
/*
	if (!isset($_SERVER['HTTPS']) || !$_SERVER['HTTPS']) { // if request is not secure, redirect to secure url
	   $url = 'https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	   header('Location: ' . $url);
	    //exit;
	}
    */
?>

<html>
	<head>
		<!--  I USE BOOTSTRAP BECAUSE IT MAKES FORMATTING/LIFE EASIER -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"><!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css"><!-- Optional theme -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script><!-- Latest compiled and minified JavaScript -->
	</head>
	<body>
		<div class="container">
			<div class="row">
				<div class="col-md-4 col-sm-4 col-xs-3"></div>
				<div class="col-md-4 col-sm-4 col-xs-6">
					<h2>Logged in!</h2>
					<form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
						<div class="row form-group">
								<input class=" btn btn-default" type="submit" name="logout" value="Logout"/>
						</div>
					</form>
				</div>
			</div>
			<?php
				if(isset($_POST['logout'])) {
                    header("Location: http://swe-group3.centralus.cloudapp.azure.com/bdbb54/index.php");
                }
			?>
		</div>
	</body>
</html>