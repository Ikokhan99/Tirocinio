<?php
// core configuration
include_once "config/core.php";

include_once 'config/database.php';
include_once 'objects/user.php';
include_once 'objects/q4.php';

// page title
$order = range(0,10);
shuffle($order);

$page_title = "Survey";

include_once 'config/database.php';
$database = new Database();
$db = $database->getConnection();
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if(debug)
    var_dump($_POST);

if (!empty($_POST)) {
    if(!fast_debug) {
        $q4 = new Q4($db,$_SESSION['user-id']);
        $q4->control_questions = array(check_int($_POST["control1"],1,5));
        $q4->questions = array(check_int($_POST["Q1"],1,5),
            check_int($_POST["Q2"],1,5),
            check_int($_POST["Q3"],1,5),
            check_int($_POST["Q4"],1,5),
            check_int($_POST["Q5"],1,5),
            check_int($_POST["Q6"],1,5),
            check_int($_POST["Q7"],1,5),
            check_int($_POST["Q8"],1,5),
            check_int($_POST["Q9"],1,5),
            check_int($_POST["Q10"],1,5)
        );

        if (!$q4->create()) {
            die();
        }
    }
    header("Location: ".home_url."Q1.php?action=goto");

}
if(debug)
{
    echo "<p> DEBUG: ";
    print_r($_SESSION['at']);
    echo "</p>";
    echo "<p> DEBUG: ";
    print_r($_SESSION['Q'][$_SESSION['at']]);
    echo "</p>";
}
include_once "layout_head.php";
?>
<!-- TODO: fix css e capire da dove spunta il > -->
<div style='text-align: center;'>
<form action='Q4.php' method='post'>
<p style= 'font-weight: 1000;'>
Here are some statements about the relationship between men and women in society. Please indicate your
agreement on a scale: from 1 = disagree strongly to 5 = agree strongly.
 </p>
<table class='center'>
    <tr>
        <td> </td>
        <td style= 'font-weight: 1000;'>Disagree strongly</td>
        <td>Disagree </td>
        <td>Agree to some extent </td>
        <td>Agree </td>
        <td style= 'font-weight: 1000;'>Agree strongly</td>
    </tr>
    <?php

foreach ($order as $num ) {
    switch ($num) {
        case 0:
//TODO:set q names
            echo "
    <tr>
    <td> Lots of men have a full consideration of five, which is the answer of this statement </td>
        <td style='text-align: center'>
            <input type='radio' name='control1' value='1' id = 'one'>
            <label  for='one'> 
                1
            </label>
        </td>
        <td style='text-align: center'>
        <input type='radio' name='control1' value='2' id = 'two'>
            <label for='two'> 
                2
            </label> 
        </td>
        <td style='text-align: center'> 
        <input type='radio' name='control1' value='3' id = 'three'>
            <label for='three'> 
                3
            </label>
        </td>
        <td style='text-align: center'>  <input type='radio' name='control1' value='4' id = 'four'>
            <label for='four'> 
                4
            </label>
        </td>
        <td style='text-align: center'>
        <input type='radio' name='control1' value='5' id = 'five'>
            <label for='five'> 
                5
            </label>
        </td>
    </tr>
    ";
            break;
        case 1:
        default:
//TODO:set q names
            echo "
    <tr>
    <td> When approaching a woman, most men think more about what that
    women can do to please him than what he can do to please her. </td>
        <td style='text-align: center'>
            <input type='radio' name='Q1' value='1' id = 'one'>
            <label  for='one'> 
                1
            </label>
        </td>
        <td style='text-align: center'>
        <input type='radio' name='Q1' value='2' id = 'two'>
            <label for='two'> 
                2
            </label> 
        </td>
        <td style='text-align: center'> 
        <input type='radio' name='Q1' value='3' id = 'three'>
            <label for='three'> 
                3
            </label>
        </td>
        <td style='text-align: center'>  <input type='radio' name='Q1' value='4' id = 'four'>
            <label for='four'> 
                4
            </label>
        </td>
        <td style='text-align: center'>
        <input type='radio' name='Q1' value='5' id = 'five'>
            <label for='five'> 
                5
            </label>
        </td>
    </tr>
    ";
            break;
        case 2:
            echo "
    <tr>
    <td> Most men tend to approach a woman only when they want to have sex with her. </td>
        <td style='text-align: center'>
            <input type='radio' name='Q2' value='1' id = 'one'>
            <label for='one'> 
                1
            </label>
        </td>
        <td style='text-align: center'>
        <input type='radio' name='Q2' value='2' id = 'two'>
            <label for='two'> 
                2
            </label> 
        </td>
        <td style='text-align: center'> 
        <input type='radio' name='Q2' value='3' id = 'three'>
            <label for='three'> 
                3
            </label>
        </td>
        <td style='text-align: center'>  
            <input type='radio' name='Q2' value='4' id = 'four'>
            <label for='four'> 
                4
            </label>
        </td>
        <td style='text-align: center'>
        <input type='radio' name='Q2' value='5' id = 'five'>
            <label for='five'> 
                5
            </label>
        </td>
    </tr>";
            break;
        case 3:
            echo "
    <tr>
    <td> Most men are interested in women’s feelings because they want to  be close to women.</td>
        <td style='text-align: center'>
            <input type='radio' name='Q3' value='1' id = 'one'>
            <label for='one'> 
                1
            </label>
        </td>
        <td style='text-align: center'>
        <input type='radio' name='Q3' value='2' id = 'two'>
            <label for='two'> 
                2
            </label> 
        </td>
        <td style='text-align: center'> 
        <input type='radio' name='Q3' value='3' id = 'three'>
            <label for='three'> 
                3
            </label>
        </td>
        <td style='text-align: center'>  
        <input type='radio' name='Q3' value='4' id = 'four'>
            <label for='four'> 
                4
            </label>
        </td>
        <td style='text-align: center'>
        <input type='radio' name='Q3' value='5' id = 'five'>
            <label for='five'> 
                5
            </label>
        </td>
    </tr>";
            break;
        case 4:
            echo "
    <tr>
    <td> When a man flatters a woman, it is because he wants to have sex with her. </td>
        <td style='text-align: center'>
            <input type='radio' name='Q4' value='1' id = 'one'>
            <label for='one'> 
                1
            </label>
        </td>
        <td style='text-align: center'>
        <input type='radio' name='Q4' value='2' id = 'two'>
            <label for='two'> 
                2
            </label> 
        </td>
        <td style='text-align: center'> 
        <input type='radio' name='Q4' value='3' id = 'three'>
            <label for='three'> 
                3
            </label>
        </td>
        <td style='text-align: center'>  
        <input type='radio' name='Q4' value='4' id = 'four'>
            <label for='four'> 
                4
            </label>
        </td>
        <td style='text-align: center'>
        <input type='radio' name='Q4' value='5' id = 'five'>
            <label for='five'> 
                5
            </label>
        </td>
    </tr>";
            break;
        case 5:
            echo "
    <tr>
    <td> A man is likely to be interested in a woman to the extent to which she can satisfy his sexual appetite. </td>
        <td style='text-align: center'>
            <input type='radio' name='Q5' value='1' id = 'one'>
            <label for='one'> 
                1
            </label>
        </td>
        <td style='text-align: center'>
        <input type='radio' name='Q5' value='2' id = 'two'>
            <label for='two'> 
                2
            </label> 
        </td>
        <td style='text-align: center'> 
        <input type='radio' name='Q5' value='3' id = 'three'>
            <label for='three'> 
                3
            </label>
        </td>
        <td style='text-align: center'>  
        <input type='radio' name='Q5' value='4' id = 'four'>
            <label for='four'> 
                4
            </label>
        </td>
        <td style='text-align: center'>
        <input type='radio' name='Q5' value='5' id = 'five'>
            <label for='five'> 
                5
            </label>
        </td>
    </tr>";
            break;
        case 6:
            echo "
    <tr>
    <td> Most men consider women sexual objects. </td>
        <td style='text-align: center'>
            <input type='radio' name='Q6' value='1' id = 'one'>
            <label for='one'> 
                1
            </label>
        </td>
        <td style='text-align: center'>
        <input type='radio' name='Q6' value='2' id = 'two'>
            <label for='two'> 
                2
            </label> 
        </td>
        <td style='text-align: center'> 
        <input type='radio' name='Q6' value='3' id = 'three'>
            <label for='three'> 
                3
            </label>
        </td>
        <td style='text-align: center'>  
        <input type='radio' name='Q6' value='4' id = 'four'>
            <label for='four'> 
                4
            </label>
        </td>
        <td style='text-align: center'>
        <input type='radio' name='Q6' value='5' id = 'five'>
            <label for='five'> 
                5
            </label>
        </td>
    </tr>";
            break;
        case 7:
            echo "
    <tr>
    <td>Most relationships between a man and a woman are based on closeness and affection. </td>
        <td style='text-align: center'>
            <input type='radio' name='Q7' value='1' id = 'one'>
            <label for='one'> 
                1
            </label>
        </td>
        <td style='text-align: center'>
        <input type='radio' name='Q7' value='2' id = 'two'>
            <label for='two'> 
                2
            </label> 
        </td>
        <td style='text-align: center'> 
        <input type='radio' name='Q7' value='3' id = 'three'>
            <label for='three'> 
                3
            </label>
        </td>
        <td style='text-align: center'>  
        <input type='radio' name='Q7' value='4' id = 'four'>
            <label for='four'> 
                4
            </label>
        </td>
        <td style='text-align: center'>
        <input type='radio' name='Q7' value='5' id = 'five'>
            <label for='five'> 
                5
            </label>
        </td>
    </tr>";
            break;
        case 8:
            echo "
    <tr>
    <td> When his sexual desire weakens, a man will likely lose interest in a woman. </td>
        <td style='text-align: center'>
            <input type='radio' name='Q8' value='1' id = 'one'>
            <label for='one'> 
                1
            </label>
        </td>
        <td style='text-align: center'>
        <input type='radio' name='Q8' value='2' id = 'two'>
            <label for='two'> 
                2
            </label> 
        </td>
        <td style='text-align: center'> 
        <input type='radio' name='Q8' value='3' id = 'three'>
            <label for='three'> 
                3
            </label>
        </td>
        <td style='text-align: center'>  
        <input type='radio' name='Q8' value='4' id = 'four'>
            <label for='four'> 
                4
            </label>
        </td>
        <td style='text-align: center'>
        <input type='radio' name='Q8' value='5' id = 'five'>
            <label for='five'> 
                5
            </label>
        </td>
    </tr>";
            break;
        case 9:
            echo "
    <tr>
    <td> When it comes to sex, for most men a woman equals another as long as she satisfies his sexual needs. </td>
        <td style='text-align: center'>
            <input type='radio' name='Q9' value='1' id = 'one'>
            <label for='one'> 
                1
            </label>
        </td>
        <td style='text-align: center'>
        <input type='radio' name='Q9' value='2' id = 'two'>
            <label for='two'> 
                2
            </label> 
        </td>
        <td style='text-align: center'> 
        <input type='radio' name='Q9' value='3' id = 'three'>
            <label for='three'> 
                3
            </label>
        </td>
        <td style='text-align: center'>  
        <input type='radio' name='Q9' value='4' id = 'four'>
            <label for='four'> 
                4
            </label>
        </td>
        <td style='text-align: center'>
        <input type='radio' name='Q9' value='5' id = 'five'>
            <label for='five'> 
                5
            </label>
        </td>
    </tr>";
            break;
        case 10:
            echo "
    <tr>
    <td> Most men have a full consideration of women as persons. </td>
        <td style='text-align: center'>
            <input type='radio' name='Q10' value='1' id = 'one'>
            <label for='one'> 
                1
            </label>
        </td>
        <td style='text-align: center'>
        <input type='radio' name='Q10' value='2' id = 'two'>
            <label for='two'> 
                2
            </label> 
        </td>
        <td style='text-align: center'> 
        <input type='radio' name='Q10' value='3' id = 'three'>
            <label for='three'> 
                3
            </label>
        </td>
        <td style='text-align: center'>  
        <input type='radio' name='Q10' value='4' id = 'four'>
            <label for='four'> 
                4
            </label>
        </td>
        <td style='text-align: center'>
        <input type='radio' name='Q10' value='5' id = 'five'>
            <label for='five'> 
                5
            </label>
        </td>
    </tr>";
    }
}
    ?>
</table>
    <p></p>
    <p></p>
    <input type="submit" name="action" id="action-q2" tabindex="4" class="form-control btn" value="Continue">
</form>
</div>

<style>
table {
  border-collapse: collapse;
  background-color: #F8F8F8;
}

table, td, th {
  border: 1px solid black;
  padding: 15px;
  text-align: left;
}
td {
  height: 50px;
  vertical-align: bottom;
}

</style>
<?php

// footer HTML and JavaScript codes
include_once "layout_foot.php";
