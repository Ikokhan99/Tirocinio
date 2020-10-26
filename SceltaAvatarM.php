<html lang="en">
<head>
    <title>
			Choice male avatar
    </title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php 
require "ConnectionParameters.php";
session_start();
$_SESSION['avatargender'] = 0;
$username = $_SESSION['user'];

$link = mysqli_connect(DATABASE_HOST, DATABASE_USERNAME, DATABASE_PASSWORD, DATABASE_NAME);
$sql = "SELECT * FROM result WHERE usercode = '$username'";
$result = mysqli_query($link, $sql) or die(mysqli_error());
$num_rows = mysqli_num_rows($result);
	
	// Start 2017.11.01
	if ($num_rows == 0)
	{
		$titolo="Begin test";
		$frase="to start ";
		$inizio="Imagine that you have just started a new video game and find yourself having to choose your personal avatar.<br>
		<br>You will be faced with various pairs of avatars; for each couple choose your favorite avatar by pressing the <b>right arrow</b> (&#8594) or <b>left</b> (&#8592) from the keyboard to select the corresponding avatar. <br><br>(<b>right arrow = right avatar </b> & <b> left arrow = left avatar</b>).<br><br><br>";
	
	}
	else 
	{
		$titolo="Continue Test";
		$frase="to continue";
		$inizio="";
	}
echo "<table class='center'><tr><td><table class='table80-3'><tr><td>";
echo "<h1>" .$titolo. "</h1><br>";
echo $inizio. "Take the time you need and when you are ready".$frase."click the button \"Start\" placed at the bottom.";
echo "<br><br><br>";
?>
<form action="FillChoiceBuffer.php" method="POST">
<table border: 1px solid black;> <td> </td></table>
<table border: 1px solid black;> <td> </td></table>
<table border: 1px solid black;> <td> </td></table> <br>
<input type="submit" value="Start" name="submit">
</form>
</td></tr></table> </td></tr></table>

</body>

</html>