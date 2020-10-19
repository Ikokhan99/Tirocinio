<html lang="it">
<head>
    <title>
        Pausa
    </title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
session_start();
$_SESSION['avatargender'] = 1;
?>
echo "<table class='center'><tr><td><table class='table80-3'><tr><td>";
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