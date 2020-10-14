<?php
	require "ConnectionParameters.php";
	session_start();
	$entryno = $_SESSION['choicebuffer_entryno'];
	$username = $_SESSION['user'];
	$start = $_SESSION['startwith'];
	$_GET['tempo'];
	$tempo=$_GET['tempo'];
	
	// da assegnare nella funzione
	$avatarchoice = 1;
	
	$link = mysqli_connect(DATABASE_HOST, DATABASE_USERNAME, DATABASE_PASSWORD, DATABASE_NAME);
	
	$selectchoicesql = "SELECT * FROM choicebuffer WHERE entry_no = '$entryno' AND usercode = '$username'";
	$selectchoiceresult = mysqli_query($link, $selectchoicesql) or die(mysqli_error($link));
	$selectchoicerow = mysqli_fetch_array($selectchoiceresult);
	$avatar1 = $selectchoicerow['avatar1code'];
	$avatar2 = $selectchoicerow['avatar2code'];
	
	$loguseravatarsql = "SELECT * FROM result WHERE usercode = '$username' AND avatar1code = '$avatar1' AND avatar2code = '$avatar2'";
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
	
	$updatelogusersql = "UPDATE result SET avatarchoosencode = '$choosenavatar', rensptime='$tempo', startwith='$start' WHERE usercode = '$username' AND avatar1code = '$avatar1' AND avatar2code = '$avatar2'";
	$updateloguserresult = mysqli_query($link, $updatelogusersql) or die(mysqli_error($link));	
	
	$selectuseravatarsql = "SELECT * FROM useravatar WHERE usercode = '$username' AND avatarcode = '$choosenavatar'";
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
		$insertuseravatarsql = "INSERT INTO useravatar (usercode, avatarcode, nchoices, gender) VALUES ('$username','$choosenavatar',1,'$avatargender')";
		$insertuseravatarresult = mysqli_query($link, $insertuseravatarsql) or die(mysqli_error($link));		
	}
	else
	{
		// update useravatar
		$nchoices = $selectuseravatarrow['nchoices'] + 1;
		$updateuseravatarsql = "UPDATE useravatar SET nchoices = '$nchoices' WHERE usercode = '$username' AND avatarcode = '$choosenavatar'";
		$updateuseravatarresult = mysqli_query($link, $updateuseravatarsql) or die(mysqli_error($link));		
	}
	
	$delbuffsql	= "DELETE FROM choicebuffer WHERE entry_no = $entryno AND usercode = '$username'";
	$delbufferresult = mysqli_query($link, $delbuffsql) or die(mysqli_error($link));
	
	
	$risultatitotali = "SELECT * FROM resulttotali WHERE avatarcode ='$choosenavatar'";
	$resulttotali = mysqli_query($link, $risultatitotali) or die(mysqli_error($link));
	
	$resulttotaliarray = mysqli_fetch_array($resulttotali);
	$choicesT = $resulttotaliarray['choicesT'] + 1;
	
	$updateresult = "UPDATE resulttotali SET choicesT = '$choicesT' WHERE avatarcode = '$choosenavatar'";
	$updateresulttotali = mysqli_query($link, $updateresult) or die(mysqli_error($link));
	
	header("Location:GenerateRandomImg.php");
?>