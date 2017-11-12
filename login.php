<?php 
	session_start();
	ob_start();
	$email = $_POST["email"];
	$password = $_POST["password"];
	// echo $email . $password;
	$found = false;
	if (isset($_POST["submit"])) {
	$handle = fopen("./credentials.config", "r");
	if ($handle) {
		    while (($line = fgets($handle)) !== false) {
		    	//echo $line;
		        $accounts = explode(",",$line);
		        $validUser = trim($accounts[0]);
		        $validPassword = trim($accounts[1]);

		        echo $validUser;
		        echo "<br>";
		        echo $validPassword;
		        
		        if (strcmp($email, $validUser) === 0 && strcmp($password, $validPassword) === 0 ) {
                    $_SESSION["total"] = 0;
                    $_SESSION["score"] = 0;
		        	echo $email;
		        	echo $password;
		        	$_SESSION["email"] = $email;
		        	$found = true;
		        	header("Location: ./index.php");
		        }
		    }
		    fclose($handle);
		    if ($found === false) {
		  	header("Location: login.php?error=Invalid Login credits!");

		    } 
		    
		} 
	}

?>


<!DOCTYPE HTML>
<html lang="en">

<head>

	<title>Math Game | Login</title>
    <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" href="Style/styles.css" type="text/css" />
  <meta charset="utf-8" />
</head>

<body>
    
    <div class="container">
        <div class="row">
    <div class="box">
    <div class="col-sm-10 col-sm-offset-1"><h2>Login to the Math Game</h2></div>
    <div class="col-sm-1"></div>
</div>
<form action="./login.php" method="post" role="form" class="form-horizontal">
    <div class="form-group">
        <div class="col-sm-4 text-right">Email:</div>
        <div class="col-sm-3">
            <input type="text" name="email" placeholder="Email" size="6" class="form-control" id="email">
        </div>
        <div class="col-sm-5"></div>
    </div>
    <div class="form-group">
        <div class="col-sm-4 text-right">Password:</div>
        <div class="col-sm-3">
            <input type="text" name="password" placeholder="Password" size="6" class="form-control" id="password" >
        </div>
        <div class="col-sm-5"></div>
    </div>
    <div class="row">
        <div class="col-sm-3 col-sm-offset-4">
            <button type="submit" name="submit" class="btn btn-primary">Login</button>
        </div>
    </div>
    </div>


    <div class="wrapper">
        <?php
        	if (isset($_GET["error"])):
        ?>
        	<div class="error">
        		<? echo $_GET["error"]; ?>

        	</div>

        <?php endif; ?>
    </div>


</form>

<div class="row">
</div>
    </div>
</body>
</html>