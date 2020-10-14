<html>
<head>
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

echo "<center> <form action=\"PaginaAmministratore.php\" method=\"post\">";
echo "<table width=\"100%\" height=\"100%\">";
echo "<tr><td>";
echo "<center>";

echo "<table  width=80% align='center' cellspacing='10'>";
echo "<tr><th colspan='10' bgcolor='#E5EDF5'><h2><br>Risultati complessivi</h2></th></tr>";
echo "</thead>";
echo "</table><table width=80% height=80%><tr><td colspan='5' align='center' bgcolor='#B1E1FC'><h3><br> Avatar Maschi</h3></td><td colspan='5' align='center' bgcolor='#D7DDFC'><h3><br>Avatar Femmine</h3></td>";
echo "<tr align='center'>";


echo "<td width=10%><b>CodiceF</b></td><td  width= 10%><b>ChoicesT</b></td> </td><td width=10%><b>ChoicesM</b></td> <td  width=10%><b>ChoicesF</b></td> <td  width=10%><b>SwipeFM</b></td>";
echo "<td width=10%><b>CodiceM</b></td><td  width= 10%><b>ChoicesT</b></td> </td><td width=10%><b>ChoicesF</b></td> <td  width=10%><b>ChoicesM</b></td> <td  width=10%><b>SwipeMF</b></td></tr>";

echo "<td width=10% bgcolor='DFF2FE' align='center'>01_m</td><td  align='center' width= 10%>$m1</td> <td align='center' width=10%>$mchoicesM1</td> <td  align='center' width=10%>$mchoicesF1</td> <td  align='center' width=10%>$SwipeFM1</td>";
echo "<td width=10% bgcolor='EEF1FE' align='center'>01_f</td><td  align='center' width= 10%>$f1</td> <td align='center' width=10%>$fchoicesF1</td> <td  align='center' width=10%>$fchoicesM1</td> <td  align='center' width=10%>$SwipeMF1</td></tr>";
echo "<tr align='center'><td bgcolor='DFF2FE'>02_m</td>  <td align='center'>$m2</td><td width=10%>$mchoicesM2</td> </td><td  width=10%>$mchoicesF2</td><td  width=10%>$SwipeFM2</td>";
echo "<td bgcolor='EEF1FE'>02_f</td><td align='center'>$f2</td>  <td width=10%>$fchoicesF2</td> </td><td width=10%>$fchoicesM2</td> <td  width=10%>$SwipeMF2</td></tr>   ";
echo "<tr align='center'><td bgcolor='DFF2FE'>03_m</td>  <td align='center'>$m3</td><td width=10%>$mchoicesM3</td> </td><td width=10%>$mchoicesF3</td> <td  width=10%>$SwipeFM3</td>";
echo "<td bgcolor='EEF1FE'>03_f</td><td align='center'>$f3</td><td width=10%>$fchoicesF3</td> </td><td width=10%>$fchoicesM3</td> <td width=10%>$SwipeMF3</td></tr>";
echo "<tr align='center'><td bgcolor='DFF2FE'>04_m</td>  <td align='center'>$m4</td><td width=10%>$mchoicesM4</td> </td><td width=10%>$mchoicesF4</td> <td  width=10%>$SwipeFM4</td>";
echo "<td bgcolor='EEF1FE'>04_f</td><td align='center'>$f4</td><td width=10%>$fchoicesF4</td> </td><td width=10%>$fchoicesM4</td> <td width=10%>$SwipeMF4</td></tr>  ";
echo "<tr align='center'><td bgcolor='DFF2FE'>05_m</td>  <td align='center'>$m5</td><td width=10%>$mchoicesM5</td> </td><td width=10%>$mchoicesF5</td> <td  width=10%>$SwipeFM5</td>";
echo "<td bgcolor='EEF1FE'>05_f</td><td align='center'>$f5</td><td width=10%>$fchoicesF5</td> </td><td width=10%>$fchoicesM5</td> <td width=10%>$SwipeMF5</td></tr>";
echo "<tr align='center'><td bgcolor='DFF2FE'>06_m</td>  <td align='center'>$m6</td><td width=10%>$mchoicesM6</td> </td><td width=10%>$mchoicesF6</td> <td  width=10%>$SwipeFM6</td>";
echo "<td bgcolor='EEF1FE'>06_f</td><td align='center'>$f6</td><td width=10%>$fchoicesF6</td> </td><td width=10%>$fchoicesM6</td> <td width=10%>$SwipeMF6</td></tr> "; 
echo "<tr align='center'><td bgcolor='DFF2FE'>07_m</td>  <td align='center'>$m7</td><td width=10%>$mchoicesM7</td> </td><td width=10%>$mchoicesF7</td> <td  width=10%>$SwipeFM7</td>";
echo "<td bgcolor='EEF1FE'>07_f</td><td align='center'>$f7</td><td width=10%>$fchoicesF7</td> </td><td width=10%>$fchoicesM7</td> <td width=10%>$SwipeMF7</td></tr>";
echo "<tr align='center'><td bgcolor='DFF2FE'>08_m</td>  <td align='center'>$m8</td><td width=10%>$mchoicesM8</td> </td><td width=10%>$mchoicesF8</td> <td  width=10%>$SwipeFM8</td>";
echo "<td bgcolor='EEF1FE'>08_f</td><td align='center'>$f8</td><td width=10%>$fchoicesF8</td> </td><td width=10%>$fchoicesM8</td> <td width=10%>$SwipeMF8</td></tr>";
echo "<tr align='center'><td bgcolor='DFF2FE'>09_m</td>  <td align='center'>$m9</td><td width=10%>$mchoicesM9</td> </td><td width=10%>$mchoicesF9</td> <td  width=10%>$SwipeFM9</td>";
echo "<td bgcolor='EEF1FE'>09_f</td><td align='center'>$f9</td><td width=10%>$fchoicesF9</td> </td><td width=10%>$fchoicesM9</td> <td width=10%>$SwipeMF9</td></tr>";
echo "<tr align='center'><td bgcolor='DFF2FE'>10_m</td>  <td align='center'>$m10</td><td width=10%>$mchoicesM10</td> </td><td width=10%>$mchoicesF10</td> <td  width=10%>$SwipeFM10</td>";
echo "<td bgcolor='EEF1FE'>10_f</td><td align='center'>$f10</td><td width=10%>$fchoicesF10</td> </td><td width=10%>$fchoicesM10</td> <td width=10%>$SwipeMF10</td></tr>  ";
echo "<tr align='center'><td bgcolor='DFF2FE'>11_m</td>  <td align='center'>$m11</td><td width=10%>$mchoicesM11</td> </td><td width=10%>$mchoicesF11</td> <td  width=10%>$SwipeFM11</td>";
echo "<td bgcolor='EEF1FE'>11_f</td><td align='center'>$f11</td><td width=10%>$fchoicesF11</td> </td><td width=10%>$fchoicesM11</td> <td width=10%>$SwipeMF11</td></tr>";
echo "<tr align='center'><td bgcolor='DFF2FE'>12_m</td>  <td align='center'>$m12</td><td width=10%>$mchoicesM12</td> </td><td width=10%>$mchoicesF12</td> <td  width=10%>$SwipeFM12</td>";
echo "<td bgcolor='EEF1FE'>12_f</td><td align='center'>$f12</td><td width=10%>$fchoicesF12</td> </td><td width=10%>$fchoicesM12</td> <td width=10%>$SwipeMF12</td></tr>  "; 
echo "<tr align='center'><td bgcolor='DFF2FE'>13_m</td>  <td align='center'>$m13</td><td width=10%>$mchoicesM13</td> </td><td width=10%>$mchoicesF13</td> <td  width=10%>$SwipeFM13</td>";
echo "<td bgcolor='EEF1FE'>13_f</td><td align='center'>$f13</td><td width=10%>$fchoicesF13</td> </td><td width=10%>$fchoicesM13</td> <td width=10%>$SwipeMF13</td></tr>";
echo "<tr align='center'><td bgcolor='DFF2FE'>14_m</td>  <td align='center'>$m14</td><td width=10%>$mchoicesM14</td> </td><td width=10%>$mchoicesF14</td> <td  width=10%>$SwipeFM14</td>";
echo "<td bgcolor='EEF1FE'>14_f</td><td align='center'>$f14</td><td width=10%>$fchoicesF14</td> </td><td width=10%>$fchoicesM14</td> <td width=10%>$SwipeMF14</td></tr>  ";
echo "<tr align='center'><td bgcolor='DFF2FE'>15_m</td>  <td align='center'>$m15</td><td width=10%>$mchoicesM15</td> </td><td width=10%>$mchoicesF15</td> <td  width=10%>$SwipeFM15</td>";
echo "<td bgcolor='EEF1FE'>15_f</td><td align='center'>$f15</td><td width=10%>$fchoicesF15</td> </td><td width=10%>$fchoicesM15</td> <td width=10%>$SwipeMF15</td></tr>";
echo "<tr align='center'><td bgcolor='DFF2FE'>16_m</td>  <td align='center'>$m16</td><td width=10%>$mchoicesM16</td> </td><td width=10%>$mchoicesF16</td> <td  width=10%>$SwipeFM16</td>";
echo "<td bgcolor='EEF1FE'>16_f</td><td align='center'>$f16</td><td width=10%>$fchoicesF16</td> </td><td width=10%>$fchoicesM16</td> <td width=10%>$SwipeMF16</td></tr>";
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