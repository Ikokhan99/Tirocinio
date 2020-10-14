<html>
<head>
</head>
<body>
<center>
<form action="ultima.php" method="post">
<table width="100%" height="100%">
<tr><td>
<center>
<table cellpadding="5%" cellspacing=5 width="80%">
<tr><td bgcolor="#E5EDF5">
	<p align="right"><b>Codice partecipante:</b></p>
	</td><td bgcolor="#F6F9FF">
	<input type="text" name="userID" maxlength="6" required><br>
	</td><td width="2%"></td>
	<td bgcolor="#E5EDF5">
	<p align="right"><b>Genere: </b></p>
	</td><td bgcolor="#F6F9FF">
	<input type="radio" name="gender" value="m"> Maschio 
	<input type="radio" name="gender" value="f" required> Femmina <br>
	</td>	
<tr><td bgcolor="#E5EDF5">
	<p align="right"><b>Eta':</b></p>
	</td><td bgcolor="#F6F9FF">
	<input type="number" name="age" maxlength=2 required><br>
	</td><td width="2%"></td>
	<td bgcolor="#E5EDF5">
	<p align="right"><b>Orintamento sessuale:</b><br></p>
	</td><td bgcolor="#F6F9FF">
	<input type="radio" name="sexor" value="e"> Eterosessuale 
	<input type="radio" name="sexor" value="o"> Omosessuale 
	<input type="radio" name="sexor" value="b" required> Bisessuale <br>
	</td></table>
	<br>
<table width=80% cellpadding=10%><tr bgcolor="#F6F9FF" cellpadding="10%"><td>
	<b>Tempo dedicato ai videogiochi (smartphone, pc, console) in media in una giornata:</b><br><br><br>
	<input type="radio" name="playtime" value="never"> Mai <br><br>
	<input type="radio" name="playtime" value="low"> Meno di 1 ora <br><br>
	<input type="radio" name="playtime" value="mid"> Tra 1 e 2 ore <br><br>
	<input type="radio" name="playtime" value="high"> Tra 2 e 4 ore <br><br>
	<input type="radio" name="playtime" value="veryhigh" required> Più di 4 ore <br><br>
	</tr></table>
	<br>
<table bgcolor="#F6F9FF" cellspacing=0 cellpadding=10% width=80%><tr><td colspan='2'>
	<b>Inserisci uno o due dei tuoi attuali videogiochi preferiti (se ne hai) ed indica per ognuno il grado di sessismo percepito (da 0 a 5):</b><br>
	</tr><tr><td> <br>
	1. <input type="text" name="game1">
	</td><td>
	Sessismo Assente <input type="range" name="sexism1" min=1 max=5>
		Sessismo molto presente
	</td></tr> 
	<tr><td>
	2. <input type="text" name="game2">
	</td><td>
	Sessismo Assente <input type="range" name="sexism2" min=1 max=5>
		Sessismo molto presente
	</td></tr></table><br><br>
	<table width=70%><tr><td style="width=100%">
	<center>
	<input type="submit" name="fine" Value="fine">
	</center>
	</tr>
</table>
</center>
</td></tr></table>
</form>
</center>
</body>
</html>