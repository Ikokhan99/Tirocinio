<html lang="it">
<head>
    <title>
        Scelta avatar Femminile
    </title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php 
require "ConnectionParameters.php";
session_start();
$_SESSION['avatargender'] = 1;
$username = $_SESSION['user'];

$link = mysqli_connect(DATABASE_HOST, DATABASE_USERNAME, DATABASE_PASSWORD, DATABASE_NAME);
$sql = "SELECT * FROM result WHERE usercode = '$username'";
$result = mysqli_query($link, $sql) or die(mysqli_error());
$num_rows = mysqli_num_rows($result);
	
	// Start 2017.11.01
	if ($num_rows == 0)
	{
		$titolo="Inizia il Test";
		$frase="ad iniziare ";
		$inizio="Immagina di aver appena iniziato un nuovo videogioco e di trovarti a dover scegliere il tuo avatar personale.<br>
		<br>Ti troverai davanti varie coppie di avatar; per ogni coppia scegli il tuo avatar preferito premendo la <b>freccia destra</b> (&#8594) o <b>sinistra</b> (&#8592) da tastiera per selezionare l'avatar corrispondente. <br><br>(<b>freccia destra = avatar a destra </b> & <b> freccia sinistra = avatar a sinistra</b>).<br><br><br>";
	
	}
	else 
	{
		$titolo="Continua il Test";
		$frase="a continuare ";
		$inizio="";
	}
echo "<table class='center'><tr><td><table class='table80-3'><tr><td>";
echo "<h1>" .$titolo. "</h1><br>";
echo $inizio. "Prenditi il tempo di cui hai bisogno e quando sei pronto ".$frase."clicca il tasto \"Start\" posto in basso.";
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
</center>
</html>