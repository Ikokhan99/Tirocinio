<?php
	require "ConnectionParameters.php";
	
	session_start();
	
	$_SESSION['reverse'] = TRUE;
	$gender = $_SESSION['avatargender'];
	$username = $_SESSION['user'];
	$link = mysqli_connect(DATABASE_HOST, DATABASE_USERNAME, DATABASE_PASSWORD, DATABASE_NAME);
	$sql = "SELECT * FROM useravatar WHERE usercode = '$username' AND gender='m' order by nchoices desc";
	
	$riga= mysqli_query($link, $sql) or die ('Query non valida ' . mysql_error());
	$tmp = mysqli_fetch_array($riga);

	$nextentryno = 1;
	
	$sql = "SELECT * FROM choicebuffermix WHERE usercode = '$username'";
	$result = mysqli_query($link, $sql) or die(mysqli_error());
	$num_rows = mysqli_num_rows($result);
	if ($num_rows !== 0)
	{
		header("Location:GenerateRandomImgMix.php");
	}
	else {
		header("Location:Questionario.php");
	}
	
	
	// Insert most clicked avatars in two different Arrays
	$Top5FemaleAvatar = array("","","","","");
	$Top5MaleAvatar = array("","","","","");
	
	// start insert records
	
	// Find Most choosen Female Avatars
	$useravatarsql = "SELECT * FROM useravatar WHERE gender = 'f' ORDER BY nchoices DESC";
	$useravatarresult = mysqli_query($link, $useravatarsql) or die(mysqli_error($link));
	$i = 0;
	while($row = mysqli_fetch_array($useravatarresult))
	{
		$Top5FemaleAvatar[$i] = $row['avatarcode'];
		$i = $i + 1;
		if ($i == 5)
		{
			break;
		}
	}	

	// Find Most choosen Male Avatars
	$useravatarsql = "SELECT * FROM useravatar WHERE gender = 'm' ORDER BY nchoices DESC";
	$useravatarresult = mysqli_query($link, $useravatarsql) or die(mysqli_error($link));
	$i = 0;
	while($row = mysqli_fetch_array($useravatarresult))
	{
		$Top5MaleAvatar[$i] = $row['avatarcode'];
		$i = $i + 1;
		if ($i == 5)
		{
			break;
		}
	}	
	
	// Insert Combinations in choice buffer
	$i = 0;
	while ($i < 5)
	{
		$j = 0;
		while ($j < 5)
		{
			// Insert new row
			$choicebuffinssql = "INSERT INTO choicebuffermix (usercode, avatarMcode, avatarFcode, entry_no) VALUES ('$username','$Top5FemaleAvatar[$i]','$Top5MaleAvatar[$j]',$nextentryno)";
			$choicebuffinsresult = mysqli_query($link, $choicebuffinssql) or die(mysqli_error($link));
			$nextentryno = $nextentryno + 1;
			$j = $j + 1;
		}
		$i = $i + 1;
	}
	header("Location:GenerateRandomImgMix.php");	


?>