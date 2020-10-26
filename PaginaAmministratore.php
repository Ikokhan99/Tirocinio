<html lang="en">
<head>
    <title>
        Administrator page
    </title>
    <link rel="stylesheet" href="style.css">
</head>
<body>



<?php
require "ConnectionParameters.php";

$link = mysqli_connect(DATABASE_HOST, DATABASE_USERNAME, DATABASE_PASSWORD, DATABASE_NAME);
$sql = "SELECT * FROM resulttotali WHERE avatarcode = '01_f'"; //DA CAMBIARE IN resulttotali
$result = mysqli_query($link, $sql) or die(mysqli_error());
$row = mysqli_fetch_array($result);
$f1 = $row['choicesT'];
$fchoicesF1 = $row['choicesF'];
$fchoicesM1 = $row['choicesM'];
$SwipeMF1 = $row['SwipeMF'];

$sql = "SELECT * FROM resulttotali WHERE avatarcode = '02_f'"; //DA CAMBIARE IN resulttotali
$result = mysqli_query($link, $sql) or die(mysqli_error());
$row = mysqli_fetch_array($result);
$f2 = $row['choicesT'];
$fchoicesF2 = $row['choicesF'];
$fchoicesM2 = $row['choicesM'];
$SwipeMF2 = $row['SwipeMF'];

$sql = "SELECT * FROM resulttotali WHERE avatarcode = '03_f'"; //DA CAMBIARE IN resulttotali
$result = mysqli_query($link, $sql) or die(mysqli_error());
$row = mysqli_fetch_array($result);
$f3 = $row['choicesT'];
$fchoicesF3 = $row['choicesF'];
$fchoicesM3 = $row['choicesM'];
$SwipeMF3 = $row['SwipeMF'];

$sql = "SELECT * FROM resulttotali WHERE avatarcode = '04_f'"; //DA CAMBIARE IN resulttotali
$result = mysqli_query($link, $sql) or die(mysqli_error());
$row = mysqli_fetch_array($result);
$f4 = $row['choicesT'];
$fchoicesF4 = $row['choicesF'];
$fchoicesM4 = $row['choicesM'];
$SwipeMF4 = $row['SwipeMF'];

$sql = "SELECT * FROM resulttotali WHERE avatarcode = '05_f'"; //DA CAMBIARE IN resulttotali
$result = mysqli_query($link, $sql) or die(mysqli_error());
$row = mysqli_fetch_array($result);
$f5 = $row['choicesT'];
$fchoicesF5 = $row['choicesF'];
$fchoicesM5 = $row['choicesM'];
$SwipeMF5 = $row['SwipeMF'];

$sql = "SELECT * FROM resulttotali WHERE avatarcode = '06_f'"; //DA CAMBIARE IN resulttotali
$result = mysqli_query($link, $sql) or die(mysqli_error());
$row = mysqli_fetch_array($result);
$f6 = $row['choicesT'];
$fchoicesF6 = $row['choicesF'];
$fchoicesM6 = $row['choicesM'];
$SwipeMF6 = $row['SwipeMF'];

$sql = "SELECT * FROM resulttotali WHERE avatarcode = '07_f'"; //DA CAMBIARE IN resulttotali
$result = mysqli_query($link, $sql) or die(mysqli_error());
$row = mysqli_fetch_array($result);
$f7 = $row['choicesT'];
$fchoicesF7 = $row['choicesF'];
$fchoicesM7 = $row['choicesM'];
$SwipeMF7 = $row['SwipeMF'];

$sql = "SELECT * FROM resulttotali WHERE avatarcode = '08_f'"; //DA CAMBIARE IN resulttotali
$result = mysqli_query($link, $sql) or die(mysqli_error());
$row = mysqli_fetch_array($result);
$f8 = $row['choicesT'];
$fchoicesF8 = $row['choicesF'];
$fchoicesM8 = $row['choicesM'];
$SwipeMF8 = $row['SwipeMF'];

$sql = "SELECT * FROM resulttotali WHERE avatarcode = '09_f'"; //DA CAMBIARE IN resulttotali
$result = mysqli_query($link, $sql) or die(mysqli_error());
$row = mysqli_fetch_array($result);
$f9 = $row['choicesT'];
$fchoicesF9 = $row['choicesF'];
$fchoicesM9 = $row['choicesM'];
$SwipeMF9 = $row['SwipeMF'];

$sql = "SELECT * FROM resulttotali WHERE avatarcode = '10_f'"; //DA CAMBIARE IN resulttotali
$result = mysqli_query($link, $sql) or die(mysqli_error());
$row = mysqli_fetch_array($result);
$f10 = $row['choicesT'];
$fchoicesF10 = $row['choicesF'];
$fchoicesM10 = $row['choicesM'];
$SwipeMF10 = $row['SwipeMF'];

$sql = "SELECT * FROM resulttotali WHERE avatarcode = '11_f'"; //DA CAMBIARE IN resulttotali
$result = mysqli_query($link, $sql) or die(mysqli_error());
$row = mysqli_fetch_array($result);
$f11 = $row['choicesT'];
$fchoicesF11 = $row['choicesF'];
$fchoicesM11 = $row['choicesM'];
$SwipeMF11 = $row['SwipeMF'];

$sql = "SELECT * FROM resulttotali WHERE avatarcode = '12_f'"; //DA CAMBIARE IN resulttotali
$result = mysqli_query($link, $sql) or die(mysqli_error());
$row = mysqli_fetch_array($result);
$f12 = $row['choicesT'];
$fchoicesF12 = $row['choicesF'];
$fchoicesM12 = $row['choicesM'];
$SwipeMF12 = $row['SwipeMF'];

$sql = "SELECT * FROM resulttotali WHERE avatarcode = '13_f'"; //DA CAMBIARE IN resulttotali
$result = mysqli_query($link, $sql) or die(mysqli_error());
$row = mysqli_fetch_array($result);
$f13 = $row['choicesT'];
$fchoicesF13 = $row['choicesF'];
$fchoicesM13 = $row['choicesM'];
$SwipeMF13 = $row['SwipeMF'];

$sql = "SELECT * FROM resulttotali WHERE avatarcode = '14_f'"; //DA CAMBIARE IN resulttotali
$result = mysqli_query($link, $sql) or die(mysqli_error());
$row = mysqli_fetch_array($result);
$f14 = $row['choicesT'];
$fchoicesF14 = $row['choicesF'];
$fchoicesM14 = $row['choicesM'];
$SwipeMF14 = $row['SwipeMF'];

$sql = "SELECT * FROM resulttotali WHERE avatarcode = '15_f'"; //DA CAMBIARE IN resulttotali
$result = mysqli_query($link, $sql) or die(mysqli_error());
$row = mysqli_fetch_array($result);
$f15 = $row['choicesT'];
$fchoicesF15 = $row['choicesF'];
$fchoicesM15 = $row['choicesM'];
$SwipeMF15 = $row['SwipeMF'];

$sql = "SELECT * FROM resulttotali WHERE avatarcode = '16_f'"; //DA CAMBIARE IN resulttotali
$result = mysqli_query($link, $sql) or die(mysqli_error());
$row = mysqli_fetch_array($result);
$f16 = $row['choicesT'];
$fchoicesF16 = $row['choicesF'];
$fchoicesM16 = $row['choicesM'];
$SwipeMF16 = $row['SwipeMF'];

$sql = "SELECT * FROM resulttotali WHERE avatarcode = '01_m'"; //DA CAMBIARE IN resulttotali
$result = mysqli_query($link, $sql) or die(mysqli_error());
$row = mysqli_fetch_array($result);
$m1 = $row['choicesT'];
$mchoicesF1 = $row['choicesF'];
$mchoicesM1 = $row['choicesM'];
$SwipeFM1 = $row['SwipeFM'];

$sql = "SELECT * FROM resulttotali WHERE avatarcode = '02_m'"; //DA CAMBIARE IN resulttotali
$result = mysqli_query($link, $sql) or die(mysqli_error());
$row = mysqli_fetch_array($result);
$m2 = $row['choicesT'];
$mchoicesF2 = $row['choicesF'];
$mchoicesM2 = $row['choicesM'];
$SwipeFM2 = $row['SwipeFM'];

$sql = "SELECT * FROM resulttotali WHERE avatarcode = '03_m'"; //DA CAMBIARE IN resulttotali
$result = mysqli_query($link, $sql) or die(mysqli_error());
$row = mysqli_fetch_array($result);
$m3 = $row['choicesT'];
$mchoicesF3 = $row['choicesF'];
$mchoicesM3 = $row['choicesM'];
$SwipeFM3 = $row['SwipeFM'];

$sql = "SELECT * FROM resulttotali WHERE avatarcode = '04_m'"; //DA CAMBIARE IN resulttotali
$result = mysqli_query($link, $sql) or die(mysqli_error());
$row = mysqli_fetch_array($result);
$m4 = $row['choicesT'];
$mchoicesF4 = $row['choicesF'];
$mchoicesM4 = $row['choicesM'];
$SwipeFM4 = $row['SwipeFM'];

$sql = "SELECT * FROM resulttotali WHERE avatarcode = '05_m'"; //DA CAMBIARE IN resulttotali
$result = mysqli_query($link, $sql) or die(mysqli_error());
$row = mysqli_fetch_array($result);
$m5 = $row['choicesT'];
$mchoicesF5 = $row['choicesF'];
$mchoicesM5 = $row['choicesM'];
$SwipeFM5 = $row['SwipeFM'];

$sql = "SELECT * FROM resulttotali WHERE avatarcode = '06_m'"; //DA CAMBIARE IN resulttotali
$result = mysqli_query($link, $sql) or die(mysqli_error());
$row = mysqli_fetch_array($result);
$m6 = $row['choicesT'];
$mchoicesF6 = $row['choicesF'];
$mchoicesM6 = $row['choicesM'];
$SwipeFM6 = $row['SwipeFM'];

$sql = "SELECT * FROM resulttotali WHERE avatarcode = '07_m'"; //DA CAMBIARE IN resulttotali
$result = mysqli_query($link, $sql) or die(mysqli_error());
$row = mysqli_fetch_array($result);
$m7 = $row['choicesT'];
$mchoicesF7 = $row['choicesF'];
$mchoicesM7 = $row['choicesM'];
$SwipeFM7 = $row['SwipeFM'];

$sql = "SELECT * FROM resulttotali WHERE avatarcode = '08_m'"; //DA CAMBIARE IN resulttotali
$result = mysqli_query($link, $sql) or die(mysqli_error());
$row = mysqli_fetch_array($result);
$m8 = $row['choicesT'];
$mchoicesF8 = $row['choicesF'];
$mchoicesM8 = $row['choicesM'];
$SwipeFM8 = $row['SwipeFM'];

$sql = "SELECT * FROM resulttotali WHERE avatarcode = '09_m'"; //DA CAMBIARE IN resulttotali
$result = mysqli_query($link, $sql) or die(mysqli_error());
$row = mysqli_fetch_array($result);
$m9 = $row['choicesT'];
$mchoicesF9 = $row['choicesF'];
$mchoicesM9 = $row['choicesM'];
$SwipeFM9 = $row['SwipeFM'];

$sql = "SELECT * FROM resulttotali WHERE avatarcode = '10_m'"; //DA CAMBIARE IN resulttotali
$result = mysqli_query($link, $sql) or die(mysqli_error());
$row = mysqli_fetch_array($result);
$m10 = $row['choicesT'];
$mchoicesF10 = $row['choicesF'];
$mchoicesM10 = $row['choicesM'];
$SwipeFM10 = $row['SwipeFM'];

$sql = "SELECT * FROM resulttotali WHERE avatarcode = '11_m'"; //DA CAMBIARE IN resulttotali
$result = mysqli_query($link, $sql) or die(mysqli_error());
$row = mysqli_fetch_array($result);
$m11 = $row['choicesT'];
$mchoicesF11 = $row['choicesF'];
$mchoicesM11 = $row['choicesM'];
$SwipeFM11 = $row['SwipeFM'];

$sql = "SELECT * FROM resulttotali WHERE avatarcode = '12_m'"; //DA CAMBIARE IN resulttotali
$result = mysqli_query($link, $sql) or die(mysqli_error());
$row = mysqli_fetch_array($result);
$m12 = $row['choicesT'];
$mchoicesF12 = $row['choicesF'];
$mchoicesM12 = $row['choicesM'];
$SwipeFM12 = $row['SwipeFM'];

$sql = "SELECT * FROM resulttotali WHERE avatarcode = '13_m'"; //DA CAMBIARE IN resulttotali
$result = mysqli_query($link, $sql) or die(mysqli_error());
$row = mysqli_fetch_array($result);
$m13 = $row['choicesT'];
$mchoicesF13 = $row['choicesF'];
$mchoicesM13 = $row['choicesM'];
$SwipeFM13 = $row['SwipeFM'];

$sql = "SELECT * FROM resulttotali WHERE avatarcode = '14_m'"; //DA CAMBIARE IN resulttotali
$result = mysqli_query($link, $sql) or die(mysqli_error());
$row = mysqli_fetch_array($result);
$m14 = $row['choicesT'];
$mchoicesF14 = $row['choicesF'];
$mchoicesM14 = $row['choicesM'];
$SwipeFM14 = $row['SwipeFM'];

$sql = "SELECT * FROM resulttotali WHERE avatarcode = '15_m'"; //DA CAMBIARE IN resulttotali
$result = mysqli_query($link, $sql) or die(mysqli_error());
$row = mysqli_fetch_array($result);
$m15 = $row['choicesT'];
$mchoicesF15 = $row['choicesF'];
$mchoicesM15 = $row['choicesM'];
$SwipeFM15 = $row['SwipeFM'];

$sql = "SELECT * FROM resulttotali WHERE avatarcode = '16_m'"; //DA CAMBIARE IN resulttotali
$result = mysqli_query($link, $sql) or die(mysqli_error());
$row = mysqli_fetch_array($result);
$m16 = $row['choicesT'];
$mchoicesF16 = $row['choicesF'];
$mchoicesM16 = $row['choicesM'];
$SwipeFM16 = $row['SwipeFM'];

echo "<form action=\"PaginaAmministratore.php\" method=\"post\">";
echo "<table class='default-table'>";
echo "<tr><td>";


echo "<table  >";
echo "<thead>";
echo "<tr class='color-admin center' ><td class='middle-admin' ><h1>Database & Result</h1><br></tr></td>";
echo "<tr ><td>";
echo "<form action=\"PaginaAmministratore.php\" method=\"post\">";
echo "<button input type='submit' name='Result'> Result </button>";
echo "</td><td>";
echo "<button input type='submit' name='ResultMix'> ResultMix </button>";
echo "</td><td>";
echo "<button input type='submit' name='ResultTotali'> ResultTotali</button>";
echo "</td><td>";
echo "<button input type='submit' name='User'> User</button>";
echo "</td><td>";
echo "<button input type='submit' name='UserAvatar'> UserAvatar</button>";
echo "</td><td>";
echo "<button input type='submit' name='UserAvatarMix'> UserAvatarMix</button>";
echo "</td><td>";
echo "<button input type='submit' name='Svuota'> Svuota tabelle<br>Choicebuffer Result User</button>";
echo "</td><td></td><td></td><td></td>";
echo "</form>";
echo "</tr>";
echo "<tr><th class='margin-admin'><h2><br>Risultati complessivi</h2></th></tr>";
echo "</thead>";
echo "</table><table class='table80'><tr><td class='admin-avatar-maschi'><h3><br> Avatar Maschi</h3></td><td class='admin-avatar-femmine'><h3><br>Avatar Femmine</h3></td>";
echo "<tr>";

if(isset($_POST['Result']))
{
	header("Location:RisultatiSingolo.php");
	exit;
}
else if(isset($_POST['ResultMix']))
{
	header("Location:RisultatiSingoloMix.php");
	exit;
}
else if(isset($_POST['ResultTotali']))
{
	header("Location:RisultatiComplessivi.php");
	exit;
}
else if(isset($_POST['User']))
{
	header("Location:Utenti.php");
	exit;
}
else if(isset($_POST['UserAvatar']))
{
	header("Location:UserAvatar.php");
	exit;
}
else if(isset($_POST['UserAvatarMix']))
{
	header("Location:UserAvatarMix.php");
	exit;
}
else if(isset($_POST['Svuota']))
{
	header("Location:SvuotaTabella.php");
}	

echo "<td class='small'><b>CodiceF</b></td><td  class='small'><b>ChoicesT</b></td> </td><td class='small'><b>ChoicesM</b></td> <td  class='small'><b>ChoicesF</b></td> <td class='small'><b>SwipeFM</b></td>";
echo "<td class='small'><b>CodiceM</b></td><td  class='small'><b>ChoicesT</b></td> </td><td class='small'><b>ChoicesF</b></td> <td class='small'><b>ChoicesM</b></td> <td class='small'><b>SwipeMF</b></td></tr>";

echo "<td class='small m center'>01_m</td><td class='small center'>$m1</td> <td class='small center'>$mchoicesM1</td> <td  class='small center'>$mchoicesF1</td> <td  class='small center'>$SwipeFM1</td>";
echo "<td class='small center f'>01_f</td><td class='small center'>$f1</td> <tdclass='small center'>$fchoicesF1</td> <td  class='small center'>$fchoicesM1</td> <td  class='small center'>$SwipeMF1</td></tr>";
echo "<tr class='center'><td class='m'>02_m</td>  <td class='center'>$m2</td><td class='small'>$mchoicesM2</td> </td><td  class='small'>$mchoicesF2</td><td class='small'>$SwipeFM2</td>";
echo "<td class='f'>02_f</td><td class='center'>$f2</td>  <td class='small'>$fchoicesF2</td> </td><td class='small'>$fchoicesM2</td> <td class='small'>$SwipeMF2</td></tr>   ";
echo "<tr class='center'><td class='m'>03_m</td>  <td class='center'>$m3</td><td class='small'>$mchoicesM3</td> </td><td class='small'>$mchoicesF3</td> <td class='small'>$SwipeFM3</td>";
echo "<td class='f'>03_f</td><td class='center'>$f3</td><td class='small'>$fchoicesF3</td> </td><td class='small'>$fchoicesM3</td> <td class='small'>$SwipeMF3</td></tr>";
echo "<tr align='center'><td class='m'>04_m</td>  <td class='center'>$m4</td><td class='small'>$mchoicesM4</td> </td><td class='small'>$mchoicesF4</td> <td class='small'>$SwipeFM4</td>";
echo "<td class='f'>04_f</td><td class='center'>$f4</td><td class='small'>$fchoicesF4</td> </td><td class='small'>$fchoicesM4</td> <td class='small'>$SwipeMF4</td></tr>  ";
echo "<tr align='center'><td class='m'>05_m</td>  <td class='center'>$m5</td><td class='small'>$mchoicesM5</td> </td><td class='small'>$mchoicesF5</td> <td class='small'>$SwipeFM5</td>";
echo "<td class='f'>05_f</td><td class='center'>$f5</td><td class='small'>$fchoicesF5</td> </td><td class='small'>$fchoicesM5</td> <td class='small'>$SwipeMF5</td></tr>";
echo "<tr align='center'><td class='m'>06_m</td>  <td class='center'>$m6</td><td class='small'>$mchoicesM6</td> </td><td class='small'>$mchoicesF6</td> <td class='small'>$SwipeFM6</td>";
echo "<td class='f'>06_f</td><td class='center'>$f6</td><td class='small'>$fchoicesF6</td> </td><td class='small'>$fchoicesM6</td> <td class='small'>$SwipeMF6</td></tr> "; 
echo "<tr align='center'><td class='m'>07_m</td>  <td class='center'>$m7</td><td class='small'>$mchoicesM7</td> </td><td class='small'>$mchoicesF7</td> <td class='small'>$SwipeFM7</td>";
echo "<td class='f'>07_f</td><td class='center'>$f7</td><td class='small'>$fchoicesF7</td> </td><td class='small'>$fchoicesM7</td> <td class='small'>$SwipeMF7</td></tr>";
echo "<tr align='center'><td class='m'>08_m</td>  <td class='center'>$m8</td><td class='small'>$mchoicesM8</td> </td><td class='small'>$mchoicesF8</td> <td class='small'>$SwipeFM8</td>";
echo "<td class='f'>08_f</td><td class='center'>$f8</td><td class='small'>$fchoicesF8</td> </td><td class='small'>$fchoicesM8</td> <td class='small'>$SwipeMF8</td></tr>";
echo "<tr align='center'><td class='m'>09_m</td>  <td class='center'>$m9</td><td class='small'>$mchoicesM9</td> </td><td class='small'>$mchoicesF9</td> <td class='small'>$SwipeFM9</td>";
echo "<td class='f'>09_f</td><td class='center'>$f9</td><td class='small'>$fchoicesF9</td> </td><td class='small'>$fchoicesM9</td> <td class='small'>$SwipeMF9</td></tr>";
echo "<tr align='center'><td class='m'>10_m</td>  <td class='center'>$m10</td><td class='small'>$mchoicesM10</td> </td><td class='small'>$mchoicesF10</td> <td class='small'>$SwipeFM10</td>";
echo "<td class='f'>10_f</td><td class='center'>$f10</td><td class='small'>$fchoicesF10</td> </td><td class='small'>$fchoicesM10</td> <td class='small'>$SwipeMF10</td></tr>  ";
echo "<tr align='center'><td class='m'>11_m</td>  <td class='center'>$m11</td><td class='small'>$mchoicesM11</td> </td><td class='small'>$mchoicesF11</td> <td class='small'>$SwipeFM11</td>";
echo "<td class='f'>11_f</td><td class='center'>$f11</td><td class='small'>$fchoicesF11</td> </td><td class='small'>$fchoicesM11</td> <td class='small'>$SwipeMF11</td></tr>";
echo "<tr align='center'><td class='m'>12_m</td>  <td class='center'>$m12</td><td class='small'>$mchoicesM12</td> </td><td class='small'>$mchoicesF12</td> <td class='small'>$SwipeFM12</td>";
echo "<td class='f'>12_f</td><td class='center'>$f12</td><td class='small'>$fchoicesF12</td> </td><td class='small'>$fchoicesM12</td> <td class='small'>$SwipeMF12</td></tr>  "; 
echo "<tr align='center'><td class='m'>13_m</td>  <td class='center'>$m13</td><td class='small'>$mchoicesM13</td> </td><td class='small'>$mchoicesF13</td> <td class='small'>$SwipeFM13</td>";
echo "<td class='f'>13_f</td><td class='center'>$f13</td><td class='small'>$fchoicesF13</td> </td><td class='small'>$fchoicesM13</td> <td class='small'>$SwipeMF13</td></tr>";
echo "<tr align='center'><td class='m'>14_m</td>  <td class='center'>$m14</td><td class='small'>$mchoicesM14</td> </td><td class='small'>$mchoicesF14</td> <td class='small'>$SwipeFM14</td>";
echo "<td class='f'>14_f</td><td class='center'>$f14</td><td class='small'>$fchoicesF14</td> </td><td class='small'>$fchoicesM14</td> <td class='small'>$SwipeMF14</td></tr>  ";
echo "<tr align='center'><td class='m'>15_m</td>  <td class='center'>$m15</td><td class='small'>$mchoicesM15</td> </td><td class='small'>$mchoicesF15</td> <td class='small'>$SwipeFM15</td>";
echo "<td class='f'>15_f</td><td class='center'>$f15</td><td class='small'>$fchoicesF15</td> </td><td class='small'>$fchoicesM15</td> <td class='small'>$SwipeMF15</td></tr>";
echo "<tr align='center'><td class='m'>16_m</td>  <td class='center'>$m16</td><td class='small'>$mchoicesM16</td> </td><td class='small'>$mchoicesF16</td> <td class='small'>$SwipeFM16</td>";
echo "<td class='f'>16_f</td><td class='center'>$f16</td><td class='small'>$fchoicesF16</td> </td><td class='small'>$fchoicesM16</td> <td class='small'>$SwipeMF16</td></tr>";
echo "</center>";
echo "</table>";
echo "</center>";
echo "</td></tr></table>";
echo "</form>";
echo "</center>";

if(isset($_POST['RisultatiSingoli']))
{
	header("Location:RisultatiSingolo.php");
	exit;
}
else if(isset($_POST['RisultatiSingoloMix']))
{
	header("Location:RisultatiSingoloMix.php");
	exit;
}
else if(isset($_POST['RisultatiTotali']))
{
	header("Location:RisultatiComplessivi.php");
	exit;
}
else if(isset($_POST['Svuota']))
{
	header("Location:SvuotaTabella.php");
}	

?>
</body>
</html>