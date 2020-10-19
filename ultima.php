<?php
	require "ConnectionParameters.php";
	session_start();
	$username = $_SESSION['user'];
	
	$link = mysqli_connect(DATABASE_HOST, DATABASE_USERNAME, DATABASE_PASSWORD, DATABASE_NAME);
	$selectuserasql = "SELECT * FROM user WHERE usercode = '$username'";
	$selectuser = mysqli_query($link, $selectuserasql) or die(mysqli_error($link));
	$selectuserrow = mysqli_fetch_array($selectuser);
		
	$usercode = $selectuserrow['usercode'];
	$pass = $selectuserrow['password'];
	
	$username = $_SESSION['user'];
	$startwith = $_SESSION['startwith'];
	
	
	$userID = $_POST['userID'];
	$gender = $_POST['gender'];
	$age = $_POST['age'];
	$sexor = $_POST['sexor'];
	$playtime = $_POST['playtime'];


	$game1 = $_POST['game1'];
	$game2 = $_POST['game2'];

	$game1 = addslashes($game1);
	$game2 = addslashes($game2);

	
	$sexism1 = $_POST['sexism1'];
	$sexism2 = $_POST['sexism2'];
	
	$updateusersql = "UPDATE user SET 
									userID = '$userID', 
									gender = '$gender',
									sexor = '$sexor',
									age = '$age',
									playtime = '$playtime',
									game1 = '$game1',
									game2 = '$game2',
									sexism1 = '$sexism1',
									sexism2 = '$sexism2',
									startwith= '$startwith'
									WHERE usercode = '$username'";
	$updateuser = mysqli_query($link, $updateusersql) or die(mysqli_error($link));
	
	
	// UPDATE ALL
	$Selectuseravatarmix = "SELECT * FROM useravatarmix WHERE usercode = '$usercode'";
	$m1b = mysqli_query($link, $Selectuseravatarmix)or die(mysqli_error($link));
	while ($useravatarmixArray = mysqli_fetch_array($m1b))
	{
		$AGender = $useravatarmixArray['AGender'];
		$AvatarcodeMix = $useravatarmixArray['avatarcode'];
		$nchoicesMix = $useravatarmixArray['nchoices'];
		
		//CAMBIA SWIPE IN USERAVATARMIX
		if ($gender == $AGender)			//NON VA!!!
		{	
			$updateSwipe = "UPDATE useravatarmix SET Swipe='no', UGender='$gender' WHERE usercode = '$usercode' AND avatarcode = '$AvatarcodeMix'";
			$m3b = mysqli_query($link, $updateSwipe) or die(mysqli_error($link));
		}
		else 
		{
			$updateSwipe = "UPDATE useravatarmix SET Swipe='yes', UGender='$gender' WHERE usercode = '$usercode' AND avatarcode = '$AvatarcodeMix'";
			$m3b = mysqli_query($link, $updateSwipe) or die(mysqli_error($link));
		}
	}
	
	//Aggiunge Scelte da parte di maschi per quel determinato avatar nei risultati
	$Selectuseravatar = "SELECT * FROM useravatar WHERE usercode = '$usercode'";
	$m4b = mysqli_query($link, $Selectuseravatar)or die(mysqli_error($link));
	while ($useravatarArray = mysqli_fetch_array($m4b))
	{
		$Avatarcode = $useravatarArray['avatarcode'];
		$nchoices = $useravatarArray['nchoices'];
			
		$Selectresulttolali = "SELECT * FROM resulttotali WHERE avatarcode = '$Avatarcode'";
		$m5b = mysqli_query($link, $Selectresulttolali)or die(mysqli_error($link));
		$resulttotaliArray = mysqli_fetch_array($m5b);	
		if ($gender == 'm')
		{
			$choicesM = $resulttotaliArray['choicesM']+ $nchoices;
			
			$Updateresulttotali = "UPDATE resulttotali SET choicesM ='$choicesM' WHERE avatarcode = '$Avatarcode'";
			$selectuserm2 = mysqli_query($link, $Updateresulttotali) or die(mysqli_error($link));
		}
		else
		{
			$choicesF = $resulttotaliArray['choicesF']+ $nchoices;
			
			$Updateresulttotali = "UPDATE resulttotali SET choicesF ='$choicesF' WHERE avatarcode = '$Avatarcode'";
			$selectuserm2 = mysqli_query($link, $Updateresulttotali) or die(mysqli_error($link));			
		}
	
	}
	
	if ($gender == 'm')
	{
		//Aggiunge in SwipeMF le scelte del maschio
		$Selectuseravatarmix2 = "SELECT * FROM useravatarmix WHERE usercode = '$usercode' AND AGender='f'";	//NON VA!!! Va solo
		$m4b = mysqli_query($link, $Selectuseravatarmix2)or die(mysqli_error($link));
		while ($Selectuseravatarmix2Array = mysqli_fetch_array($m4b))
		{	
			$Avatarcode2 = $Selectuseravatarmix2Array['avatarcode'];
			$sexutentem3 = $Selectuseravatarmix2Array['nchoices'];
			
			$selectuserasqlm = "SELECT * FROM resulttotali WHERE avatarcode = '$Avatarcode2'";
			$selectuserm = mysqli_query($link, $selectuserasqlm)or die(mysqli_error($link));
			$selectuserrowm = mysqli_fetch_array($selectuserm);
			$SwipeMF = $selectuserrowm['SwipeMF'] + $sexutentem3;
			
			$selectuserasqm4 = "UPDATE resulttotali SET SwipeMF='$SwipeMF' WHERE avatarcode = '$Avatarcode2'";
			$selectuserm4 = mysqli_query($link, $selectuserasqm4) or die(mysqli_error($link));
		}		
	}
	else if ($gender == 'f') 
	{
		//Aggiunge in SwipeFM le scelte della femmina
		$Selectuseravatarmix2 = "SELECT * FROM useravatarmix WHERE usercode = '$usercode' AND AGender='m'";	//NON VA!!! Va solo
		$m4b = mysqli_query($link, $Selectuseravatarmix2)or die(mysqli_error($link));
		while ($Selectuseravatarmix2Array = mysqli_fetch_array($m4b))
		{	
			$Avatarcode2 = $Selectuseravatarmix2Array['avatarcode'];
			$sexutentem3 = $Selectuseravatarmix2Array['nchoices'];
			
			$selectuserasqlm = "SELECT * FROM resulttotali WHERE avatarcode = '$Avatarcode2'";
			$selectuserm = mysqli_query($link, $selectuserasqlm)or die(mysqli_error($link));
			$selectuserrowm = mysqli_fetch_array($selectuserm);
			$SwipeFM = $selectuserrowm['SwipeFM'] + $sexutentem3;
			
			$selectuserasqm4 = "UPDATE resulttotali SET SwipeFM='$SwipeFM' WHERE avatarcode = '$Avatarcode2'";
			$selectuserm4 = mysqli_query($link, $selectuserasqm4) or die(mysqli_error($link));
		}			
	}		

	Header("Location:ultimissima.php");
