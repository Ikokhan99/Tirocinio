<html lang="en">
<head>
    <title>
    Questionnaire
    </title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div style="text-align: center;">
<form action="ultima.php" method="post">
<table class="center">
<tr><td>
</div>
<table class="table80"><tr class="color-admin tr10" ><td>
	<b>Time dedicated to videogames (smartphone, PC, console) on average in a day:</b><br><br><br>
            <label>
                <input type="radio" name="playtime" value="never">
            </label> Never <br><br>
            <label>
                <input type="radio" name="playtime" value="low">
            </label> Less than 1 hour <br><br>
            <label>
                <input type="radio" name="playtime" value="mid">
            </label> Between 1 and 2 hours <br><br>
            <label>
                <input type="radio" name="playtime" value="high">
            </label> Between 2 and 4 hours <br><br>
            <label>
                <input type="radio" name="playtime" value="veryhigh" required>
            </label> More than 4 hours <br><br>
	</tr></table>
	<br>
<table class="q"><tr><td colspan='2'>
	<b>Enter one or two of your current favorite video games (if you have any) and indicate for each one the degree of perceived sexism (from 0 to 5):</b><br>
	</tr><tr><td> <br>
	1. <label>
                <input type="text" name="game1">
            </label>
        </td><td>
        Absent sexism <label>
                <input type="range" name="sexism1" min=1 max=5>
            </label>
            Very present sexism
	</td></tr> 
	<tr><td>
	2. <label>
                <input type="text" name="game2">
            </label>
        </td><td>
        Absent sexism <label>
                <input type="range" name="sexism2" min=1 max=5>
            </label>
            Very present sexism
	</td></tr></table><br><br>
	<table class="table70"><tr><td style="width=100%">
	<div style="text-align: center;">
	<input type="submit" name="fine" Value="fine">
	</div>
	</tr>
</table>
</body>
</html>