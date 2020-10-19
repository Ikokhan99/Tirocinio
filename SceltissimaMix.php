<?php
	require "ConnectionParameters.php";
	session_start();
	$entryno = $_SESSION['choicebuffer_entryno'];
	$username = $_SESSION['user'];

	// da assegnare nella funzione
	$avatarchoice = 0;
	
	$link = mysqli_connect(DATABASE_HOST, DATABASE_USERNAME, DATABASE_PASSWORD, DATABASE_NAME);
	
	$selectchoicesql = "SELECT * FROM choicebuffermix WHERE entry_no = '$entryno' AND usercode = '$username'";
	$selectchoiceresult = mysqli_query($link, $selectchoicesql) or die(mysqli_error($link));
	$selectchoicerow = mysqli_fetch_array($selectchoiceresult);
	$avatar1 = $selectchoicerow['avatarFcode'];
	$avatar2 = $selectchoicerow['avatarMcode'];
	
	$loguseravatarsql = "SELECT * FROM resultmix WHERE usercode = '$username' AND avatarFcode = '$avatar1' AND avatarMcode = '$avatar2'";
	$loguseravatarresult = mysqli_query($link, $loguseravatarsql) or die(mysqli_error($link));	
	$loguseravatarrow = mysqli_fetch_array($loguseravatarresult);
	
	if ($avatarchoice == 0)
	{
		$choosenavatar = $avatar1;
	}
	else
	{
		$choosenavatar = $avatar2;
	}
	
	$updatelogusersql = "UPDATE resultmix SET avatarchoosencode = '$choosenavatar' WHERE usercode = '$username' AND avatarFcode = '$avatar1' AND avatarMcode = '$avatar2'";
	$updateloguserresult = mysqli_query($link, $updatelogusersql) or die(mysqli_error($link));	
	
	$selectuseravatarsql = "SELECT * FROM useravatarmix WHERE usercode = '$username' AND avatarcode = '$choosenavatar'";
	$selectuseravatarresult = mysqli_query($link, $selectuseravatarsql) or die(mysqli_error($link));
	$selectuseravatarrow = mysqli_fetch_array($selectuseravatarresult);
	if ($selectuseravatarrow == 0)
	{
		// find avatar gender
		$avatarsql = "SELECT * FROM avatar WHERE avatarcode = '$choosenavatar'";
		$avatarresult = mysqli_query($link, $avatarsql) or die(mysqli_error($link));
		$avatarrow = mysqli_fetch_array($avatarresult);
		$avatargender = $avatarrow['AGender'];
		
		// insert new row
		$insertuseravatarsql = "INSERT INTO useravatarmix (usercode, avatarcode, nchoices, AGender) VALUES ('$username','$choosenavatar',1,'$avatargender')";
		$insertuseravatarresult = mysqli_query($link, $insertuseravatarsql) or die(mysqli_error($link));		
	}
	else
	{
		// update useravatar
		$nchoices = $selectuseravatarrow['nchoices'] + 1;
		$updateuseravatarsql = "UPDATE useravatarmix SET nchoices = '$nchoices' WHERE usercode = '$username' AND avatarcode = '$choosenavatar'";
		$updateuseravatarresult = mysqli_query($link, $updateuseravatarsql) or die(mysqli_error($link));		
	}
	
	$delbuffsql	= "DELETE FROM choicebuffermix WHERE entry_no = $entryno AND usercode = '$username'";
	$delbufferresult = mysqli_query($link, $delbuffsql) or die(mysqli_error($link));
	
	header("Location:GenerateRandomImgMix.php");
