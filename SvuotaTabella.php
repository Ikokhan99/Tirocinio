<html>
<head>
</head>
<body>
<center>
<table width=100% height=100%>
<tr><td>
<center>
<table width=60% height=80% cellpadding="40%">
<tr><td colspan=2>
<center><h2> Sei sicuro di voler eliminare Tutti i dati aggiunti alle tabelle di partenza?</h2><br><br>
<form action="SvuotaTabella.php" method="post">
</td></tr><tr><td align='right'>
<button type="submit" name=no value="NO">NO</button>
</td><td align='left'>
<button type="submit" name=si value="SI">SI</button>
</td></tr>
</table>
</center>
</tr></td>
</table>
<?php
require "ConnectionParameters.php";
$link = mysqli_connect(DATABASE_HOST, DATABASE_USERNAME, DATABASE_PASSWORD, DATABASE_NAME);

if(isset($_POST['si']))
{
	mysqli_query($link,'TRUNCATE TABLE choicebuffer');
	mysqli_query($link,'TRUNCATE TABLE choicebuffermix');
	mysqli_query($link,'TRUNCATE TABLE result');
	mysqli_query($link,'TRUNCATE TABLE resultmix');
	mysqli_query($link,'TRUNCATE TABLE useravatar');
	mysqli_query($link,'TRUNCATE TABLE useravatarmix');
	
	$updateresult = "UPDATE resulttotali SET choicesT = '0', choicesM = '0', choicesF = '0', SwipeMF = '0', SwipeFM = '0'";
	$updateresulttotali = mysqli_query($link, $updateresult) or die(mysqli_error($link));
	
	$updateuser = "UPDATE user SET gender = 'm', age='0', playtime='0', game1='', game2='', sexism1='0', sexism2='0', sexor='e', userID='', startwith='m'";
	$updateusersql = mysqli_query($link, $updateuser) or die(mysqli_error($link));
	
	$updateuser = "UPDATE resulttotali SET gender = 'm', age='0', playtime='0', game1='', game2='', sexism1='0', sexism2='0', sexor='e', userID='', startwith='m'";
	$updateusersql = mysqli_query($link, $updateuser) or die(mysqli_error($link));
	
	header("Location:PaginaAmministratore.php");
}
else if (isset($_POST['no']))
{
	header("Location:PaginaAmministratore.php");
}	
?> 
</form>
</center>
</body>
</html>