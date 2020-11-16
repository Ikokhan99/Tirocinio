<?php
include_once "config/core.php";
$action = '';
$page_title="Experiment";

if(skip_experiment)
{
    header("Location: ".home_url."Q1.php");
}
if(fast_debug && $_SESSION['at']==2)
{
    header("Location: ".home_url."Q1.php");
}

//insert previous choice in db                                120 rn
if ( isset($_POST['id']) && $_SESSION['permutation'] < TOTAL_PERMUTATIONS) {
    //permutations starts at 0

    if(!fast_debug) {
        //insering previous result at db
        include_once 'objects/experiment.php';
        include_once 'config/database.php';
        $database = new Database();
        $db = $database->getConnection();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $exp = new Experiment($db, $_SESSION['uid']);
        $exp->entry = $_SESSION['permutation'] + 1;
        if ($_SESSION['exp'][$_SESSION['at']] == 1) //male case
        {
            $exp->type = 0;
        } elseif ($_SESSION['exp'][$_SESSION['at']] == 2) // female case
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
    }


    $_SESSION['permutation'] += 1;
}
if ($_SESSION['permutation'] >= TOTAL_PERMUTATIONS){
    $_SESSION['permutation'] = 0;
    $_SESSION['at'] +=1;
    header("Location: ".home_url."SceltaAvatar.php");
}
//                          3
if($_SESSION['at'] == n_experiment)
{
    header("Location: ".home_url."Q1.php");
}

include_once 'layout_head.php';

//----------------------------------------------------------------------------------------------------------------------------
//TODO:resize immagini
echo "<div style='cursor: none'>";
echo "<table class='default-table'><tr>";
echo "<form action=\"choice.php\" method=\"post\"  id=\"form\">
        <td class='half'>";
if(debug){
    echo $_SESSION['exp'][$_SESSION['at']];
}
switch ($_SESSION['exp'][$_SESSION['at']]) {
    case 1:default:{ //male
        echo "<button type= \"submit\" name=\"id\" id=\"chosenL\" value='".strval($_SESSION['p_male'][$_SESSION['permutation']][0]-1)."' style=\"border:none; background:none; padding:0; visibility:hidden\">";
        echo "<img src=\"".$_SESSION['i_male'][$_SESSION['p_male'][$_SESSION['permutation']][0]-1]."\">";
        echo "</button>";
        echo "<input type='hidden' id='time' name='time' value='0' >";
        echo "<input type='hidden' id='a1' name='a1' value='".strval($_SESSION['p_male'][$_SESSION['permutation']][0]-1)."'>";
        echo "<input type='hidden' id='a2' name='a2' value='".strval($_SESSION['p_male'][$_SESSION['permutation']][1]-1)."'>";
        echo "</td><td class='very-small' ><h3>+</h3></td><td class='half'>";
        echo "<button type= \"submit\" name=\"id\" id=\"chosenR\" value='".strval($_SESSION['p_male'][$_SESSION['permutation']][1]-1)."' style=\"border:none; background:none; padding:0; visibility:hidden\">";
    echo "<img src=\"".$_SESSION['i_male'][$_SESSION['p_male'][$_SESSION['permutation']][1]-1]."\">";


        break;
    }
    case 2:{//female
        echo "<button type= \"submit\" name=\"id\" id=\"chosenL\" value='".strval($_SESSION['p_female'][$_SESSION['permutation']][0]-1)."' style=\"border:none; background:none; padding:0; visibility:hidden\">";
        echo "<img src=\"".$_SESSION['i_female'][$_SESSION['p_female'][$_SESSION['permutation']][0]-1]."\">";
        echo "</button>";
        echo "<input type='hidden' id='time' name='time' value='0' >";
        echo "<input type='hidden' id='a1' name='a1' value='".strval($_SESSION['p_female'][$_SESSION['permutation']][0]-1)."'>";
        echo "<input type='hidden' id='a2' name='a2' value='".strval($_SESSION['p_female'][$_SESSION['permutation']][1]-1)."'>";
        echo "</td><td class='very-small' ><h3>+</h3></td><td class='half'>";
        echo "<button type= \"submit\" name=\"id\" id=\"chosenR\" value='".strval($_SESSION['p_female'][$_SESSION['permutation']][1]-1)."' style=\"border:none; background:none; padding:0; visibility:hidden\">";
        echo "<img src=\"".$_SESSION['i_female'][$_SESSION['p_female'][$_SESSION['permutation']][1]-1]."\">";
        break;

    }
    case 3:{//mix
        echo "<button type= \"submit\" name=\"id\" id=\"chosenL\" value='".strval($_SESSION['p_mix'][$_SESSION['permutation']][0]-1)."' style=\"border:none; background:none; padding:0; visibility:hidden\">";
        echo "<img src=\"".$_SESSION['i_mix'][$_SESSION['p_mix'][$_SESSION['permutation']][0]-1]."\">";
        echo "</button>";
        echo "<input type='hidden' id='time' name='time' value='0' >";
        echo "<input type='hidden' id='a1' name='a1' value='".strval($_SESSION['p_mix'][$_SESSION['permutation']][0]-1)."'>";
        echo "<input type='hidden' id='a2' name='a2' value='".strval($_SESSION['p_mix'][$_SESSION['permutation']][1]-1)."'>";
        echo "</td><td class='very-small' ><h3>+</h3></td><td class='half'>";
        echo "<button type= \"submit\" name=\"id\" id=\"chosenR\" value='".strval($_SESSION['p_mix'][$_SESSION['permutation']][1]-1)."' style=\"border:none; background:none; padding:0; visibility:hidden\">";
        echo "<img src=\"".$_SESSION['i_mix'][$_SESSION['p_mix'][$_SESSION['permutation']][1]-1]."\">";
        break;
    }
}

echo    "</button>
        </td>
    </form>
    </table>
    </div>";
?>


<style>
    /* todo: il mouse si vede*/
    
    button {
        cursor: none;
    }

    img {
  max-width: 76%;
  max-height: 76%;
  object-fit: contain;
    }

</style>
<script type="text/javascript" >
    document.body.style.cursor = 'none';
    const tempo1 = Math.round(+new Date() / 1000);

    setTimeout( "document.forms[0].elements['chosenL'].style.visibility = 'visible'", 600 );
    setTimeout( "document.forms[0].elements['chosenR'].style.visibility = 'visible'", 600 );


    function click()
    {
        document.onkeydown = function (e) //when the key is pressed down
        {
            switch (e.key) //the logical place of the keyboard, .code for the phisical
            {
                case 'ArrowLeft':
                {
                        let tempo2 = Math.round(+new Date()/1000);
                        let tempo = tempo2 - tempo1;

                        //TODO
                        button_click(0)
                        break;
                }
                case 'ArrowRight':
                    {
                        let tempo2 = Math.round(+new Date()/1000);
                        let tempo = tempo2 - tempo1;

                        button_click(1)
                        break;
                    }
                default:{break;}

            }
        }
    }

    function button_click(n){
        let button;
        if(n===0)
        {
             button= document.getElementById("chosenL");
        } else {
             button= document.getElementById("chosenR");
        }

        button.click();
    }

window.setTimeout("click()", 1000);

</script>

<?php
    include_once 'layout_foot.php';
    ?>