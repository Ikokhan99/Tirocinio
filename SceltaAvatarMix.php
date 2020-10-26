<html lang="en">
<head>
    <title>
        Pause
    </title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
session_start();
$_SESSION['avatargender'] = 1;
?>
echo "<table class='center'><tr><td><table class='table80-3'><tr><td>";
<h1> Continue the Test</h1><br>
Take the time you need and when you are ready to continue click the button "\Start\" placed at the bottom.
<br><br><br>
<form action="FillChoiceBufferMix.php" method="POST">
<table border: 1px solid black;> <td> </td></table>
<table border: 1px solid black;> <td> </td></table> <br>
<input type="submit" value="Start Test" name="submit">
</body>
</center>
</html>