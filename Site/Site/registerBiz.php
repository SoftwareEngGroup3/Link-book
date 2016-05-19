<head>
    <title>Link-Book: Business Registration</title>
    <?php include("header.php");?>
</head>
<body>
<?php
include("navbar.php");
include("checksession.php");
include("profileController.php");    
$user = getUserData($_GET[uid]);
?>
    
<!--
CREATE TABLE linkbook.business
(
uIDnum INT,
bIDnum INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
name VARCHAR(30),
contact_email VARCHAR(30),
contact_name VARCHAR(30),
biz_size INT,
product VARCHAR(30),
openings INT,
photo VARCHAR(30),
-- PRIMARY KEY (uIDnum, bIDnum),
FOREIGN KEY (uIDnum) REFERENCES linkbook.users(uIDnum)
);
-->
    
        
		<div class="container">
            
			<div class="row">
				<div class="col-md-4 col-sm-4 col-xs-3"></div>
				<div class="col-md-4 col-sm-4 col-xs-6">                  
                    
                <h3 class="row form-group" >Register as a Buisness</h3> 
                <p style="text-color: red">WARNING: This will permenantly turn your current profile into a businness profile.
                    This cannot be undone.</p>
                <p>You will log into your business profile with your current username and password.</p>
                    
				<form action="<?=$_SERVER['PHP_SELF']?>" method="POST">                 

  				 <div class="row form-group">
                    <div class="ui input">
                        <input type="text" name="name" required="required" placeholder="Business Name"/>
                    </div>
                </div>
				 <div class="row form-group">
                    <div class="ui input">
                        <input type="text" name="contact_name" required="required" placeholder="Contact Name"/>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="ui input">
                        <input type="email" name="contact_email" required="required" placeholder="Contact Email"/>
                    </div>
                </div>
   
						<div class="row form-group">
								<input class='form-control' type="text" name="biz_size" required="required" placeholder="Business Size">
						</div>
						<div class="row form-group">
								<input class='form-control' type="text" name="product" required="required" placeholder="password">
						</div>
						<div class="row form-group">
								<input class=" btn btn-default" type="submit" name="submit"  required="required" value="Register"/>
						</div>

					</form>
                       
				</div>
			</div>
			<?php
				if(isset($_POST['submit'])) { // Was the form submitted?
        
                    /*
                    CREATE TABLE linkbook.business
                    (
                    uIDnum INT,
                    bIDnum INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
                    name VARCHAR(30),
                    contact_email VARCHAR(30),
                    contact_name VARCHAR(30),
                    biz_size INT,
                    product VARCHAR(30),
                    openings INT,
                    photo VARCHAR(30),
                    -- PRIMARY KEY (uIDnum, bIDnum),
                    FOREIGN KEY (uIDnum) REFERENCES linkbook.users(uIDnum)
                    );
                    
              
					*/
                    
                    //Grab session variables
                    $contact_name = $user[fName].' '.$user[lName];
                    $contact_email = $user[email];
                    $uid = $user[uIDnum];
                    
                    include("../secure/secure.php");

                    $link = mysqli_connect($site, $user, $pass, $db) or die("Connect Error " . mysqli_error($link));
        
                    $sql = "INSERT INTO business(uIDnum, name, contact_email, contact_name, biz_size, product, openings, photo) VALUES(?,?,?,?,?,?,?,?)";
                    
                    $sql2 = "UPDATE users
                            SET isBusiness=1 
                            WHERE uIDnum=’current uIDnum’;"
                        ;
                                    
        
					
        //Prepare and execure  insert statement
                if ($stmt = mysqli_prepare($link, $sql)) 
                {


                    $uIDnum = $uid;

                    $name = $_POST['name'];
                    $contact_name = $_POST['contact_name'];
                    $contact_email = $_POST['contact_email'];
                    $biz_size = $_POST['biz_size'];
                    $product = $_POST['product'];
                    $openings = $_POST['openings'];
                    $pic = "empty";
    

                    mysqli_stmt_bind_param($stmt, "isssisis", $uIDnum, $Name, $contact_name, $contact_email, $biz_size, $product, $openings, $pic) or die("bind param");
                    
                    
                    

                    //mysqli_stmt_bind_param($stmt, "sss", $user, $salt, $hpass) or die("bind param");

                    if (mysqli_stmt_execute($stmt)) 
                    {
                        echo "<h4>Success</h4>";
                    } 
                    else 
                    {
                        echo "<h4>Failed</h4>";
                    }
                    //$result = mysqli_stmt_get_result($stmt);
                } 

                else 
                {
                    die("prepare failed");
                }
                }
        
        //Prepare and execure update statement
                if ($stmt2 = mysqli_prepare($link, $sql2)) 
                {


                    $isBusiness = 1;
    

                   //vim mysqli_stmt_bind_param($stmt, "i", isBusiness) or die("bind param");
     

                    if (mysqli_stmt_execute($stmt)) 
                    {
                        echo "<h4>Success</h4>";
                    } 
                    else 
                    {
                        echo "<h4>Failed</h4>";
                    }
                    
                } 

                else 
                {
                    die("prepare failed");
                }
                          
            
                    
			?>
                <div class="field">
                    <a href="index.php" class="ui fluid button">Go back</a>
                </div>
		</div>
	</body>
</html>