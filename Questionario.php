<html lang="it">
<head>
    <title>
        Questionario
    </title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div style="text-align: center;">
<form action="ultima.php" method="post">
<table class="center">
<tr><td>
</div>
<table class="table80-2" >
<tr><td class="q1">
	<p class="right"><b>Codice partecipante:</b></p>
	</td><td class="q2">
        <label>
            <input type="text" name="userID" maxlength="6" required>
        </label><br>
	</td><td class="extra-small"></td>
	<td class="q1">
	<p class="right"><b>Genere: </b></p>
	</td><td class="q2">
        <label>
            <input type="radio" name="gender" value="m">
        </label> Maschio
        <label>
            <input type="radio" name="gender" value="f" required>
        </label> Femmina <br>
	</td>
    </tr>
<tr><td class="q1">
	<p class="right"><b>Eta':</b></p>
	</td><td class="q2">
        <label>
            <input type="number" name="age" maxlength=2 required>
        </label><br>
	</td><td class="extra-small" "></td>
	<td class="q1">
	<p class="right"><b>Orintamento sessuale:</b><br></p>
	</td><td class="q2">
        <label>
            <input type="radio" name="sexor" value="e">
        </label> Eterosessuale
        <label>
            <input type="radio" name="sexor" value="o">
        </label> Omosessuale
        <label>
            <input type="radio" name="sexor" value="b" required>
        </label> Bisessuale <br>
	</td>
</tr></table>
	<br>
<table class="table80"><tr class="color-admin tr10" ><td>
	<b>Tempo dedicato ai videogiochi (smartphone, pc, console) in media in una giornata:</b><br><br><br>
            <label>
                <input type="radio" name="playtime" value="never">
            </label> Mai <br><br>
            <label>
                <input type="radio" name="playtime" value="low">
            </label> Meno di 1 ora <br><br>
            <label>
                <input type="radio" name="playtime" value="mid">
            </label> Tra 1 e 2 ore <br><br>
            <label>
                <input type="radio" name="playtime" value="high">
            </label> Tra 2 e 4 ore <br><br>
            <label>
                <input type="radio" name="playtime" value="veryhigh" required>
            </label> Più di 4 ore <br><br>
	</tr></table>
	<br>
<table class="q"><tr><td colspan='2'>
	<b>Inserisci uno o due dei tuoi attuali videogiochi preferiti (se ne hai) ed indica per ognuno il grado di sessismo percepito (da 0 a 5):</b><br>
	</tr><tr><td> <br>
	1. <label>
                <input type="text" name="game1">
            </label>
        </td><td>
	Sessismo Assente <label>
                <input type="range" name="sexism1" min=1 max=5>
            </label>
            Sessismo molto presente
	</td></tr> 
	<tr><td>
	2. <label>
                <input type="text" name="game2">
            </label>
        </td><td>
	Sessismo Assente <label>
                <input type="range" name="sexism2" min=1 max=5>
            </label>
            Sessismo molto presente
	</td></tr></table><br><br>
	<table class="table70"><tr><td style="width=100%">
	<div style="text-align: center;">
	<input type="submit" name="fine" Value="fine">
	</div>
	</tr>
</table>
</body>
</html>