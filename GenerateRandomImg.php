<html lang="it">
<head>
    <title>
        Experiment
    </title>
    <link rel="stylesheet" href="style.css">
</head>
<body onload="initSubmit();">
<?php
	require "ConnectionParameters.php";
	session_start();
	
	$reverse = $_SESSION['reverse'];
	$username = $_SESSION['user'];
	$step = $_SESSION['step'];
	$reverseID = $_SESSION['reverseID'];
	
	// Setta inversione
	if ($reverse)
	{
		$reverse = FALSE;
	}
	else
	{
		$reverse = TRUE;
	}
	$_SESSION['reverse'] = $reverse;
	
	$link = mysqli_connect(DATABASE_HOST, DATABASE_USERNAME, DATABASE_PASSWORD, DATABASE_NAME);
	$sql = "SELECT * FROM choicebuffer WHERE usercode = '$username'";
	$result = mysqli_query($link, $sql) or die(mysqli_error());
	$num_rows = mysqli_num_rows($result);
	
	// Start 2017.11.01
	if ($num_rows == 0)
	{
		$step = $step + 1;
		$_SESSION['step'] = $step;
		if ($step == 1)
		{
			if ($reverseID == 0)
			{
				header("Location:SceltaAvatarM.php");
			}
			else
			{
				header("Location:SceltaAvatarF.php");
			}
		}
		else if ($step == 2)
		{
			header("Location:SceltaAvatarMix.php");
		}
	}
	
	// Generate a random number
	$randomnum = rand(1, $num_rows);
	
	// Find the researched row:
	$rowid = 0;
	while($row = mysqli_fetch_array($result))
	{
	  $rowid = $rowid + 1; 
	  if($rowid == $randomnum)
	  {
		$avatar1 = $row['avatar1code'];
		$avatar2 = $row['avatar2code'];
		$entryno = $row['entry_no'];
		
		$loguseravatarselsql = "SELECT * FROM result WHERE usercode = '$username' AND avatar1code = '$avatar1' AND avatar2code = '$avatar2'";
		$loguseravatarselresult = mysqli_query($link, $loguseravatarselsql) or die(mysqli_error($link));	
		if (mysqli_num_rows($loguseravatarselresult)==0)
		{
			$loguseravatarsql = "INSERT INTO result (usercode, avatar1code, avatar2code, avatarchoosencode, Rensptime) VALUES ('$username','$avatar1','$avatar2','',0)";
			$loguseravatarresult = mysqli_query($link, $loguseravatarsql) or die(mysqli_error($link));
		}
		
		// Search the first avatar image
		$avatar1sql = "SELECT * FROM avatar WHERE avatarcode = '$avatar1'";
		$avatar1result = mysqli_query($link, $avatar1sql) or die(mysqli_error($link));
		$avatar1row = mysqli_fetch_array( $avatar1result);
		
		// search the second avatar image
		$avatar2sql = "SELECT * FROM avatar WHERE avatarcode = '$avatar2'";
		$avatar2result = mysqli_query($link, $avatar2sql) or die(mysqli_error($link));
		$avatar2row = mysqli_fetch_array( $avatar2result);
		
		$pic1=$avatar1row['pic'];
		$pic2=$avatar2row['pic'];
		
		$message = "<img style='max-width:90%; max-height:90%' src='avatar/";
		$message2 =".jpg'>";
		
		$avatar1ID = $avatar1row['ID'];
		$avatar2ID= $avatar2row['ID'];
			
		$_SESSION['choicebuffer_entryno'] = $entryno;
		
		
		if ($reverse)
		{
			echo "<table class='default-table'><tr>";
			echo "<td class='half'>";
			echo "<form action=\"Sceltissima2.php\" method=\"post\"  align=\"right\"  id=\"form1\">";
			echo "<button type= \"submit\" name=\"avatarsx1\" id=\"avatarsx1\"style=\"border:none; background:none; padding:0; visibility:hidden\">";
			echo "<div id=\"pic1\">";
			echo $message .$pic2. $message2 . "</img></div>";
			echo "</button></form>";
			echo "</td><td class='very-small'><h3>+</h3></td><td class='half'>";
			echo "<form action=\"Sceltissima.php\" method=\"post\" id=\"form2\" align=\"left\">";
			echo "<button type= \"submit\" name=\"avatarsx1\" id=\"avatardx1\" style=\"border:none; background:none; padding:0; visibility:hidden\">";
			echo "<div id=\"pic2\">";
			echo $message .$pic1. $message2 . "</img>";
			echo "</div>";
			echo "</button></form></table></tr>";
			echo "</td>";
		}
		else
		{
			echo "<table class='default-table'><tr>";
			echo "<td class='half'>";
			echo "<form action=\"Sceltissima.php\" method=\"post\" align=\"right\" id=\"form1\">";
			echo "<button type= \"submit\" name=\"avatarsx\" id=\"avatarsx1\" style=\"border:none; background:none; padding:0; visibility:hidden \">";
			echo "<div id=\"pic1\">";
			echo $message .$pic1. $message2 . "</img></div>";
			echo "</button></form>";
			echo "</td><td class='very-small' ><h3>+</h3></td><td class='half'>";
			echo "<form action=\"Sceltissima2.php\" method=\"post\" align=\"left\" id=\"form2\">";
			echo "<button type= \"submit\" name=\"avatardx\" id=\"avatardx1\" style=\"border:none; background:none; padding:0; visibility:hidden\">";
			echo "<div id=\"pic2\">";
			echo $message .$pic2. $message2 . "</img></div>";
			echo "</div>";
			echo "</button></form></table></tr>";
			echo "</td>";
		}

	  }
	}	
?>
<script type="text/javascript">

    const tempo1 = Math.round(+new Date() / 1000);

    function initSubmit()
	{
		setTimeout( "document.forms[0].elements['avatarsx1'].style.visibility = 'visible'", 600 );
		setTimeout( "document.forms[0].elements['avatardx1'].style.visibility = 'visible'", 600 );
		setTimeout( "document.forms[1].elements['avatarsx1'].style.visibility = 'visible'", 600 );
		setTimeout( "document.forms[1].elements['avatardx1'].style.visibility = 'visible'", 600 );
	}

	function click()
	{
		document.onkeydown = function (e) 
		{
            const reverse_let = '<?php echo $reverse; ?>';
            switch (e.keyCode)
			{
				case 37:
						if (reverse_let)
					{
						let tempo2 = Math.round(+new Date()/1000);
						let tempo = tempo2 - tempo1;
												
						window.location.href="./Sceltissima2.php?tempo=" + tempo;
					}
					else
					{
						let tempo2 = Math.round(+new Date()/1000);
						let tempo = tempo2 - tempo1;
					
						window.location.href="./Sceltissima.php?tempo=" + tempo;

					}	
					break;
				case 39:
					if (reverse_let)
					{
						let tempo2 = Math.round(+new Date()/1000);
						let tempo = tempo2 - tempo1;
						
						window.location.href="./Sceltissima.php?tempo=" + tempo;
					}
					else
					{
						let tempo2 = Math.round(+new Date()/1000);
						let tempo = tempo2 - tempo1;
						
						window.location.href="./Sceltissima2.php?tempo=" + tempo;
					}	
					break;
			}
		}
	};
  
 function disappearCursor() {
        mouseTimer = null;
		document.body.style.cursor = "url(data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==), pointer";
		document.getElementById('pic1').style.cursor = "url(data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==), pointer";
		document.getElementById('pic2').style.cursor = "url(data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==), pointer";
		cursorVisible = false;
		justhidden = true;
    }

window.setTimeout("click()", 1000); 
window.setTimeout("disappearCursor()", 0); 


</script>
</body>
</html>