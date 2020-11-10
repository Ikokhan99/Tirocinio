<?php
if(fast_debug)
{
    header("Location: /Q1.php");
}
include_once "config/core.php";
$action = '';
$page_title="Experiment";

//insert previous choice in db                                              240
if ( isset($_POST['id']) && $_SESSION['permutation'] < TOTAL_PERMUTATIONS) {
    //permutations starts at 0

    //insering previous result at db
    include_once 'objects/experiment.php';
    include_once 'config/database.php';
    $database = new Database();
    $db = $database->getConnection();
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $exp = new Experiment($db,$_SESSION['uid']);
    $exp->entry = $_SESSION['permutation']+1;
    if($_SESSION['exp'][$_SESSION['at']] == 1) //male case
    {
        $exp->type = 0;
    } elseif($_SESSION['exp'][$_SESSION['at']] == 2) // female case
    {
        $exp->type = 1;
    } else {
        $exp->type = 3;
    }
    $exp->chosen = $_POST['id'];
    $exp->time = $_POST['time'];
    $exp->a1 = $_POST['a1'];
    $exp->a2 = $_POST['a2'];
    $exp->create();


    $_SESSION['permutation'] += 1;
} elseif ($_SESSION['permutation'] == TOTAL_PERMUTATIONS){
    $_SESSION['permutation'] = 0;
    $_SESSION['at'] +=1;
}
//                          4
if($_SESSION['at'] == n_experiment+1)
{
    header("Location: /Q1.php");
}

include_once 'layout_head.php';

//----------------------------------------------------------------------------------------------------------------------------

		
		
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

<?php

    include_once 'layout_foot.php';
    ?>