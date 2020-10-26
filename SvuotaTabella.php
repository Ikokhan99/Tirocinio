<html lang="en">
<head>
    <title>
        Delete all data?
    </title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<table class="center">
<tr><td>

<table class="empty-table">
<tr><td colspan=2>
<div style="text-align: center;"><h2> Are you sure you want to delete All data added to the starting tables?</h2><br><br>
<form action="SvuotaTabella.php" method="post">
</td></tr><tr><td class="r">
<button type="submit" name=no value="NO">NO</button>
</td><td class="left">
<button type="submit" name=si value="SI">sYES</button>
            </form>
</td></tr>
</table>
    </td>
</tr>
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


</body>
</html>