<?php
include_once "config/core.php";
$action = '';
$page_title="Experiment";


if(skip_experiment)
{
    $_SESSION['at']=0;
    header("Location: ".home_url."Q1.php");
}
if(fast_debug && $_SESSION['at']==2)
{
    $_SESSION['at']=0;
    header("Location: ".home_url."Q1.php");
}

//prolific academic
//this checks if the user has refreshed the page during the experiment  TODO:wip
if($_SESSION['permutation']>0)
{
    if($_SESSION['last_chosen'] === (strval($_POST['a1']).strval($_POST['a2'])))
    {
        if(user_error)
            header("Location: ".home_url."user_error.php?error=refresh");
    } else {
        $_SESSION['last_chosen'] = strval($_POST['a1']).strval($_POST['a2']);
    }
} else {
    $_SESSION['last_chosen']="0";
}


//insert previous choice in db                                120 rn
if ( isset($_POST['id']) && $_SESSION['permutation'] < TOTAL_PERMUTATIONS) {
    //permutations starts at 0

    if(!fast_debug) {
        if(debug){
            var_dump($_POST);
        }
        //insering previous result at db
        include_once 'objects/experiment.php';
        include_once 'config/database.php';
        $database = new Database();
        $db = $database->getConnection();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $exp = new Experiment($db, $_SESSION['user-id']);
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
        $exp->key = $_POST['key'] == 0?0:1;
        if($exp->type == 3){
            $exp->a1 = substr($_POST['a1'],0,-1);
            $exp->a2 = substr($_POST['a2'],0,-1);
        } else{
            $exp->a1 = $_POST['a1'];
            $exp->a2 = $_POST['a2'];
        }

        if(debug)
        {
            print_r($exp);
        }
        $exp->create();
    }


    $_SESSION['permutation'] += 1;
}
if($_SESSION['exp'][$_SESSION['at']]!=3){
    if ($_SESSION['permutation'] >= TOTAL_PERMUTATIONS){
        $_SESSION['permutation'] = 0;
        $_SESSION['at'] +=1;
        header("Location: ".home_url."SceltaAvatar.php");
    }
} else {
    if ($_SESSION['permutation'] >= 25){
       unset( $_SESSION['permutation'] );
        $_SESSION['at'] =0;
        header("Location: ".home_url."Q1.php?s=0");
    }
}
//                          3
/*if($_SESSION['at'] == n_experiment)
{
    header("Location: ".home_url."Q.php");
}*/

include_once 'layout_head.php';

//----------------------------------------------------------------------------------------------------------------------------
//TODO:resize immagini
//TODO:fix tempo
echo "<div style='cursor: none' class='centered'>";
echo "<table class='default-table'><tr>";
echo "<form action=\"choice.php\" method=\"post\"  id=\"form\">
        <td class='half'>";
if(debug){
    echo $_SESSION['exp'][$_SESSION['at']];
}
switch ($_SESSION['exp'][$_SESSION['at']]) {
    case 1:default:{ //male
        echo "<button type= \"submit\" name=\"id\" id=\"chosenL\" value='".strval($_SESSION['p_male'][$_SESSION['permutation']][0])."' style=\"border:none; background:none; padding:0; visibility:hidden\">";
        echo "<img src=\"".$_SESSION['i_male'][$_SESSION['p_male'][$_SESSION['permutation']][0]-1]."\">";
        echo "</button>";
        echo "<input type='hidden' id='key' name='key' value='' >";
        echo "<input type='hidden' id='time' name='time' value='0' >";
        echo "<input type='hidden' id='a1' name='a1' value='".strval($_SESSION['p_male'][$_SESSION['permutation']][0])."'>";
        echo "<input type='hidden' id='a2' name='a2' value='".strval($_SESSION['p_male'][$_SESSION['permutation']][1])."'>";
        echo "</td><td class='very-small' ><h3>+</h3></td><td class='half'>";
        echo "<button type= \"submit\" name=\"id\" id=\"chosenR\" value='".strval($_SESSION['p_male'][$_SESSION['permutation']][1])."' style=\"border:none; background:none; padding:0; visibility:hidden\">";
    echo "<img src=\"".$_SESSION['i_male'][$_SESSION['p_male'][$_SESSION['permutation']][1]-1]."\">";


        break;
    }
    case 2:{//female
        echo "<button type= \"submit\" name=\"id\" id=\"chosenL\" value='".strval($_SESSION['p_female'][$_SESSION['permutation']][0])."' style=\"border:none; background:none; padding:0; visibility:hidden\">";
        echo "<img src=\"".$_SESSION['i_female'][$_SESSION['p_female'][$_SESSION['permutation']][0]-1]."\">";
        echo "</button>";
        echo "<input type='hidden' id='key' name='key' value='' >";
        echo "<input type='hidden' id='time' name='time' value='0' >";
        echo "<input type='hidden' id='a1' name='a1' value='".strval($_SESSION['p_female'][$_SESSION['permutation']][0])."'>";
        echo "<input type='hidden' id='a2' name='a2' value='".strval($_SESSION['p_female'][$_SESSION['permutation']][1])."'>";
        echo "</td><td class='very-small' ><h3>+</h3></td><td class='half'>";
        echo "<button type= \"submit\" name=\"id\" id=\"chosenR\" value='".strval($_SESSION['p_female'][$_SESSION['permutation']][1])."' style=\"border:none; background:none; padding:0; visibility:hidden\">";
        echo "<img src=\"".$_SESSION['i_female'][$_SESSION['p_female'][$_SESSION['permutation']][1]-1]."\">";
        break;

    }
    case 3:{//mix
        if(debug){
            print_r( $_SESSION['p_mix'][$_SESSION['permutation']]);
      echo $_SESSION['p_mix'][$_SESSION['permutation']][0][strlen($_SESSION['p_mix'][$_SESSION['permutation']][1])-1];
        }

        echo "<button type= \"submit\" name=\"id\" id=\"chosenL\" value='".$_SESSION['p_mix'][$_SESSION['permutation']][0]."' style=\"border:none; background:none; padding:0; visibility:hidden\">";
        //the values inside  $_SESSION['p_mix']  are like "xxs" or "xs", where x is a number and s is either "m" or "f"
        if($_SESSION['p_mix'][$_SESSION['permutation']][0][strlen($_SESSION['p_mix'][$_SESSION['permutation']][0])-1] === "m"){
            echo "<img src=\"".$_SESSION['i_male'][ substr($_SESSION['p_mix'][$_SESSION['permutation']][0],0,-1 )]."\">";
        } else {
            echo "<img src=\"".$_SESSION['i_female'][ substr($_SESSION['p_mix'][$_SESSION['permutation']][0],0,-1 )]."\">";
        }

        echo "</button>";
        echo "<input type='hidden' id='time' name='time' value='0' >";
        echo "<input type='hidden' id='key' name='key' value='' >";
        echo "<input type='hidden' id='a1' name='a1' value='".strval($_SESSION['p_mix'][$_SESSION['permutation']][0])."'>";
        echo "<input type='hidden' id='a2' name='a2' value='".strval($_SESSION['p_mix'][$_SESSION['permutation']][1])."'>";
        echo "</td><td class='very-small' ><h3>+</h3></td><td class='half'>";
        echo "<button type= \"submit\" name=\"id\" id=\"chosenR\" value='".$_SESSION['p_mix'][$_SESSION['permutation']][1]."' style=\"border:none; background:none; padding:0; visibility:hidden\">";
        //the values inside  $_SESSION['p_mix']  are like "xxs" or "xs", where x is a number and s is either "m" or "f"
        if($_SESSION['p_mix'][$_SESSION['permutation']][1][strlen($_SESSION['p_mix'][$_SESSION['permutation']][1])-1] === "m"){
            echo "<img src=\"".$_SESSION['i_male'][ substr($_SESSION['p_mix'][$_SESSION['permutation']][1],0,-1 )]."\">";
        } else {
            echo "<img src=\"".$_SESSION['i_female'][ substr($_SESSION['p_mix'][$_SESSION['permutation']][1],0,-1 )]."\">";
        }

        echo "</button>";
        break;
    }
}

echo    "</button>
        </td>
    </form>
    </table>
    </div>";
?>



<script type="text/javascript" >
    //TODO: controllare la cosa del tempo, forse è meglio usare php
    document.body.style.cursor = 'none';
    //const tempo1 = Math.round(+new Date() / 1000);
    const tempo = Date.now(); //ms

    setTimeout( "document.forms[0].elements['chosenL'].style.visibility = 'visible'", 600 );
    setTimeout( "document.forms[0].elements['chosenR'].style.visibility = 'visible'", 600 );

    console.log(document.forms[0]);


    function click()
    {
        document.onkeydown = function (e) //when the key is pressed down
        {
            switch (e.key) //the logical place of the keyboard, .code for the phisical
            {
                case 'ArrowLeft':
                {
                        button_click(0)
                        break;
                }
                case 'ArrowRight':
                    {
                        button_click(1)
                        break;
                    }
                default:{break;}

            }
        }
    }

    function button_click(n){
        let button;
        let time =  Date.now() - tempo;
        document.getElementById('time').setAttribute("value",time.toString());
        if(n===0)
        {
             button= document.getElementById("chosenL");
             document.getElementById('key').setAttribute("value","0");
        } else {
             button= document.getElementById("chosenR");
             document.getElementById('key').setAttribute("value","1");
        }

        button.click();
    }

window.setTimeout("click()", 1000);

function loadCSS(filename){

let file = document.createElement("link");
file.setAttribute("rel", "stylesheet");
file.setAttribute("type", "text/css");
file.setAttribute("href", filename);
document.head.appendChild(file);

}

loadCSS("libs/CSS/choice.css");


</script>

<?php
    include_once 'layout_foot.php';
    ?>