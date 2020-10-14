<?php
require "ConnectionParameters.php";
session_start();
$ID=$_POST['user'];
$pass=$_POST['pass'];

if(($ID == "Admi")&($pass == "SquiAmministratore"))
{
	Header("Location:PaginaAmministratore.php");
}
else
{
	$connection = mysqli_connect(DATABASE_HOST, DATABASE_USERNAME, DATABASE_PASSWORD, DATABASE_NAME);
	$bo = "SELECT * FROM user WHERE usercode = $ID";
	$riga= mysqli_query($connection, $bo) or die ('Query non valida ' . mysql_error());
	$tmp = mysqli_fetch_array($riga);
		
	if ($tmp['password'] == $pass)
		{
			// valutazione utente
			$_SESSION['user'] = $ID;
			$_SESSION['step'] = 0; //// da valorizzare poi in base a tutte le verifiche che vai a fare
			$IntID = intval($ID);
			if ($IntID % 2 == 0)
			{
				$_SESSION['reverseID'] = 0;
				$reverse = 0;
				$_SESSION['startwith'] = "f";
			}
			else
			{
				$_SESSION['reverseID'] = 1;
				$reverse = 1;
				$_SESSION['startwith'] = "m";
			}

			// Caso 1 ---> result vuoto
			$Selectresult1= "SELECT * FROM result WHERE usercode = $ID";
			$riga1= mysqli_query($connection, $Selectresult1) or die ('Query non valida ' . mysql_error());
			$row1 = mysqli_fetch_array($riga1);
			$num_rows1 = mysqli_num_rows($riga1);
			$scelto = $row1['avatarchoosencode'];

			if ($num_rows1 == 0)
			{
				$_SESSION['step'] = 0;	//Inizio inizio
			}
			else if (($num_rows1 > 0)&($num_rows1 < 240))
			{
				$_SESSION['step'] = 1;	//Femmine o maschi già iniziato
			}
			else if (($num_rows1 == 240)&($scelto !== ''))
			{
				
				// caso 2 --> dati nel result mix
				//METTO STEP = 2
				// se hai dati nel choicebuffermix --> allora lanci il sceltaavatarmix
				// altrimenti ---> se ha già fatto il questionario, allora scrivi test completato, altrimenti lancia questionario
				$Selectresultmix = "SELECT * FROM resultmix WHERE usercode = $ID";
				$riga2= mysqli_query($connection, $Selectresultmix) or die ('Query non valida ' . mysql_error());
				$row = mysqli_fetch_array($riga2);
				$num_rows = mysqli_num_rows($riga2);
				$sceltomix = $row['avatarchoosencode']
				;
				$SelectUser = "SELECT * FROM user WHERE usercode = $ID";
				$rigaU= mysqli_query($connection, $SelectUser) or die ('Query non valida ' . mysql_error());
				$rowU = mysqli_fetch_array($rigaU);
				$userID = $rowU['userID'];
				$age = $rowU['age'];
	
				
				if ($num_rows == 0)
				{
					$_SESSION['step'] = 2;	//MIX
				}
				else if ($num_rows !== 0)		
				{
					if (($num_rows == 25) & ($sceltomix !== ''))	
					{
						if (($userID == '')&($age == 0))
						{	
							$_SESSION['step'] = 3;	//QUESTIONARIO
						}
						else if (($userID !== '')&($age !== 0))
						{	
							$_SESSION['step'] = 4;	//L'ESPERIMENTo è finito
						}
					}
					else
					{
						$_SESSION['step'] = 2;	//MIX
					}
				}
			}
			
			//FUNZIONA
			if ($_SESSION['step'] == 0)
			{
				if ($reverse == 0)
				{
					Header("Location:SceltaAvatarF.php");
				}
				else if ($reverse == 1)
				{
					Header("Location:SceltaAvatarM.php");
				}
			}
			
			//IN TEORIA FUNZIONA
			else if ($_SESSION['step'] == 1)	
			{
				$CercaFemmine = "SELECT * FROM result WHERE usercode = $ID AND (avatar1code like '%%%f') AND (avatar2code like '%%%f') AND avatarchoosencode != ''";
				$rigaa1= mysqli_query($connection, $CercaFemmine) or die ('Query non valida 1' . mysql_error());
				$righefemmineComplete = mysqli_num_rows($rigaa1);
				
				$CercaMaschi = "SELECT * FROM result WHERE usercode = $ID AND (avatar1code like '%%%m') AND (avatar2code like '%%%m') AND avatarchoosencode != ''";
				$rigaa2= mysqli_query($connection, $CercaMaschi) or die ('Query non valida 2' . mysql_error());
				$righemaschiComplete = mysqli_num_rows($rigaa2);
			
				if ($reverse == 0)
				{
				
					if ($righefemmineComplete < 120)
					{
						$_SESSION['step'] = 0;
						Header("Location:SceltaAvatarF.php");
					}
					else if($righemaschiComplete < 120)
					{		
						Header("Location:SceltaAvatarM.php");
					}
				}
				else if ($reverse == 1)
				{
					if ($righemaschiComplete < 120)
					{
						$_SESSION['step'] = 0;
						Header("Location:SceltaAvatarM.php");
					}
					else if($righefemmineComplete < 120)
					{
						Header("Location:SceltaAvatarF.php");
					}
				}	
			}
			
			// FUNZIONA
			else if ($_SESSION['step'] == 2)
			{
				Header("Location:SceltaAvatarMix.php");
			}
			
			else if ($_SESSION['step'] == 3)
			{
				Header("Location:Questionario.php");
			}
			
			else if ($_SESSION['step'] == 4)
			{
				Header("Location:ultimissima.php");
			}
			
			//echo $num_rows1 . "<br>";
			//echo $_SESSION['step'];
		}
	else {
		echo "Password Errata";
		}
}	
?>

