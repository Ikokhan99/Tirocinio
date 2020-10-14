<?php
	require "ConnectionParameters.php";
	
	session_start();
	
	$_SESSION['reverse'] = TRUE;
	$gender = $_SESSION['avatargender'];
	$username = $_SESSION['user'];
	$link = mysqli_connect(DATABASE_HOST, DATABASE_USERNAME, DATABASE_PASSWORD, DATABASE_NAME);
	// Set default values
	$nextentryno = 1;
	
	$minvalue = 0;
	$maxvalue = 0;
	
	if ($gender == 0) //male
	{
		$minvalue = 17;
		$maxvalue = 33;
	}
	else if ($gender == 1) //female
	{
		$minvalue = 1;
		$maxvalue = 17;
	}
	
	$sql = "SELECT * FROM choicebuffer WHERE usercode = '$username'";
	$result = mysqli_query($link, $sql) or die(mysqli_error());
	$num_rows = mysqli_num_rows($result);
	if ($num_rows !== 0)
	{
		header("Location:GenerateRandomImg.php");
	}

	// start insert records
	$i = $minvalue;
	while ($i < $maxvalue)
	{
		// search first avatar to insert
		$avatar1sql = "SELECT * FROM avatar WHERE ID = $i";
		$avatar1result = mysqli_query($link, $avatar1sql) or die(mysqli_error($link));
		$avatar1row = mysqli_fetch_array( $avatar1result);
		$avatar1 = $avatar1row['avatarcode'];
		
		// search second avatar to insert (inserisco le coppie di avatar in questo modo:
		//	utente, avatar01, avatar02.... utente, avatar01, avatar03... etc... utente, avatar01, avatar14....
		//  utente, avatar02, avatar03.... utente, avatar02, avatar04... etc... utente, avatar02, avatar14)
		$j = $minvalue;
		while ($j < $maxvalue)
		{
			if ($j !== $i)
			{
				$avatar2sql = "SELECT * FROM avatar WHERE ID = $j";
				$avatar2result = mysqli_query($link, $avatar2sql) or die(mysqli_error($link));
				$avatar2row = mysqli_fetch_array( $avatar2result);						
				$avatar2 = $avatar2row['avatarcode'];
				
				// non deve essere possibile inserire la combinazione utente, avatar1, avatar2 se esiste già
				// la combinazione utente, avatar2, avatar1 --> solo se questa combinazione non è stata inserita
				// allora procedo con l'inserimento del record
				$nullvalue = FALSE;
				$choicebuffsql = "SELECT * FROM choicebuffer WHERE usercode = '$username' AND avatar1code = '$avatar2' AND avatar2code = '$avatar1'";
				$choicebuffresult = mysqli_query($link, $choicebuffsql) or die(mysqli_error($link));	
				if (mysqli_num_rows($choicebuffresult)==0)
				{
					// Insert new row
					$choicebuffinssql = "INSERT INTO choicebuffer (usercode, avatar1code, avatar2code, entry_no) VALUES ('$username','$avatar1','$avatar2',$nextentryno)";
					$choicebuffinsresult = mysqli_query($link, $choicebuffinssql) or die(mysqli_error($link));
					$nextentryno = $nextentryno + 1;
				}				
			}
			$j = $j + 1;
			
		}
		$i = $i + 1;
	}
	
	header("Location:GenerateRandomImg.php");	


?>