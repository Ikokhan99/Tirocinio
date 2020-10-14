<html>
<head>
</head>
<body>
<?php
session_start();
$_SESSION['avatargender'] = 1;
?>
<center><table width=100% height=100%><tr><td><center><table width=80% height=80%><tr><td><center>
<h1> Continua il Test</h1><br>
Prenditi il tempo di cui hai bisogno e quando sei pronto a continuare clicca il tasto \"Start\" posto in basso.
<br><br><br>
<form action="FillChoiceBufferMix.php" method="POST">
<table border: 1px solid black;> <td> </td></table>
<table border: 1px solid black;> <td> </td></table> <br>
<input type="submit" value="Start Test" name="submit">
</body>
</center>
</html>