<?php
session_start();
ob_start();

if (!isset($_SESSION["email"])) {
	header('Location: ./login.php');
	echo "please login!!";
}

$num1  = rand(0,50);
$num2 = rand(0,50);
$addOrSubtract = rand(0,1);
$add;
$msg;
//Checking if the answer was correct when you clicked submit

if(isset($_POST["answer"]) && $_SESSION["total"] == $_POST['total']){
	
    if(!is_numeric($_POST["answer"])) {
        $msg = "Input should be a number!";		
	
    }
	
	
    else if ($_SESSION["correctAnswer"] == $_POST["answer"]){
		
		$_SESSION['total']++;
        $_SESSION['score']++;
		
		$msg = "Correct";		
    }
    else {
       $_SESSION["total"] ++;
	   
	   $msg = "Incorrect," . " ". $_SESSION["numberOne"] ." " 
	   . $_SESSION['operator']." ". $_SESSION["numberTwo"] . " is " . $_SESSION["correctAnswer"];
	   	   
    }
		   $_SESSION['calc'] = $msg;


}

//Prepare the answer for next time you click submit

$_SESSION["numberOne"] = $num1;
$_SESSION["numberTwo"] = $num2;

if($addOrSubtract == 0){
	$add = "+";
	$answer = $num1 + $num2;
	
	$_SESSION["correctAnswer"] = $answer;
	
}else if($addOrSubtract == 1){
	$add = "-";
	$answer = $num1 - $num2;
	
	$_SESSION["correctAnswer"] = $answer;
}
$_SESSION['operator'] = $add;

?>

<!DOCTYPE HTML>
<html lang="en">

<head>
	<title>Math Game | Play</title>
    <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" href="Style/styles.css" type="text/css" />
  <meta charset="utf-8" />
</head>
<body>
    <div class="container">
<form action="index.php" method="post" class="form-horizontal">
    
	<div class="row">
        <div class="col-sm-4 col-sm-offset-4"><h1>Math Game</h1></div>
        <div class="col-sm-4"><a href="logout.php" class="btn btn-default btn-sm">Logout</a></div>
    </div>
	
    <div class="row" id="output">
            <label class="col-sm-2 col-sm-offset-3"><?php echo $num1; ?></label>
            <label class="col-sm-2"><?php echo $add ?></label>
            <label class="col-sm-2"><?php echo $num2; ?></label>
            <div class="col-sm-3"></div>
    </div>

	<input type="hidden" name="score" value= "<?php echo $_SESSION['score'] ?>" />
    <input type="hidden" name="total" value= "<?php echo $_SESSION['total'] ?>" />

    <div class="form-group">
        <div class="col-sm-3 col-sm-offset-4">
            <input type="text" class="form-control" placeholder="Enter your answer" size="6" id="answer" name="answer">
        </div>
        <div class="col-sm-5"></div>
    </div>
	
    <div class="row">
        <div class="col-sm-3 col-sm-offset-4">
            <div class="wrapper">
            <button type="submit" class="btn btn-primary btn-sm" name="submit">Submit</button>
        </div>
        </div>
        <div class="col-sm-3"></div>
    </div>
</form>
<hr />
<div class="row">
    <div class="col-sm-4 col-sm-offset-4">
            </div>
    <div class="col-sm-4"></div>
</div>
<div class="row">
    <div class="col-sm-4 col-sm-offset-4">Score: <?php echo $_SESSION["score"] ?> / <?php echo $_SESSION["total"] ?></div>
	<div class="col-sm-4 col-sm-offset-4"><?php print $_SESSION['calc'] ?> </div>
</div>
    </div>
</body>
</html>