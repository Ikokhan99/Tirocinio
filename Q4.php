<?php
// core configuration
include_once "config/core.php";

include_once 'config/database.php';
include_once 'objects/user.php';

// page title
$order = range(1,10);
shuffle($order);

$page_title = "Survey";
include_once "layout_head.php";

if (!empty($_POST)) {
    if(!fast_debug) {
        //TODO
        $q2 = new Q4($_SESSION['db'],$_SESSION['uid']);
        $q2->playtime = $_POST['playtime'];
        $q2->sexor = $_POST['user-sexor'];
        $q2->sex = $_POST['user-sex'];
        $q2->age = $_POST['user-age'];
        if ($_SESSION['Q_ORDERED'])
            $q2->q_order = 0;
        else
            $q2->q_order = 1;
        if (!$q2->create()) {
            $q2->showError();
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
        case 1:
        default:
//TODO:set q names
            echo "
    <tr>
    <td> When approaching a woman, most men think more about what that
    women can do to please him than what he can do to please her. </td>
        <td style='text-align: center'>
            <input type='radio' name='please' value='1' id = 'one'>
            <label  for='one'> 
                1
            </label>
        </td>
        <td style='text-align: center'>
        <input type='radio' name='please' value='2' id = 'two'>
            <label for='two'> 
                2
            </label> 
        </td>
        <td style='text-align: center'> 
        <input type='radio' name='please' value='3' id = 'three'>
            <label for='three'> 
                3
            </label>
        </td>
        <td style='text-align: center'>  <input type='radio' name='please' value='4' id = 'four'>
            <label for='four'> 
                4
            </label>
        </td>
        <td style='text-align: center'>
        <input type='radio' name='please' value='5' id = 'five'>
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
            <input type='radio' name='approach' value='1' id = 'one'>
            <label for='one'> 
                1
            </label>
        </td>
        <td style='text-align: center'>
        <input type='radio' name='approach' value='2' id = 'two'>
            <label for='two'> 
                2
            </label> 
        </td>
        <td style='text-align: center'> 
        <input type='radio' name='approach' value='3' id = 'three'>
            <label for='three'> 
                3
            </label>
        </td>
        <td style='text-align: center'>  
            <input type='radio' name='approach' value='4' id = 'four'>
            <label for='four'> 
                4
            </label>
        </td>
        <td style='text-align: center'>
        <input type='radio' name='approach' value='5' id = 'five'>
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
            <input type='radio' name='interested' value='1' id = 'one'>
            <label for='one'> 
                1
            </label>
        </td>
        <td style='text-align: center'>
        <input type='radio' name='interested' value='2' id = 'two'>
            <label for='two'> 
                2
            </label> 
        </td>
        <td style='text-align: center'> 
        <input type='radio' name='interested' value='3' id = 'three'>
            <label for='three'> 
                3
            </label>
        </td>
        <td style='text-align: center'>  
        <input type='radio' name='interested' value='4' id = 'four'>
            <label for='four'> 
                4
            </label>
        </td>
        <td style='text-align: center'>
        <input type='radio' name='interested' value='5' id = 'five'>
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
            <input type='radio' name='flatters' value='1' id = 'one'>
            <label for='one'> 
                1
            </label>
        </td>
        <td style='text-align: center'>
        <input type='radio' name='flatters' value='2' id = 'two'>
            <label for='two'> 
                2
            </label> 
        </td>
        <td style='text-align: center'> 
        <input type='radio' name='flatters' value='3' id = 'three'>
            <label for='three'> 
                3
            </label>
        </td>
        <td style='text-align: center'>  
        <input type='radio' name='flatters' value='4' id = 'four'>
            <label for='four'> 
                4
            </label>
        </td>
        <td style='text-align: center'>
        <input type='radio' name='flatters' value='5' id = 'five'>
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
            <input type='radio' name='appetite' value='1' id = 'one'>
            <label for='one'> 
                1
            </label>
        </td>
        <td style='text-align: center'>
        <input type='radio' name='appetite' value='2' id = 'two'>
            <label for='two'> 
                2
            </label> 
        </td>
        <td style='text-align: center'> 
        <input type='radio' name='appetite' value='3' id = 'three'>
            <label for='three'> 
                3
            </label>
        </td>
        <td style='text-align: center'>  
        <input type='radio' name='appetite' value='4' id = 'four'>
            <label for='four'> 
                4
            </label>
        </td>
        <td style='text-align: center'>
        <input type='radio' name='appetite' value='5' id = 'five'>
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
            <input type='radio' name='objects' value='1' id = 'one'>
            <label for='one'> 
                1
            </label>
        </td>
        <td style='text-align: center'>
        <input type='radio' name='objects' value='2' id = 'two'>
            <label for='two'> 
                2
            </label> 
        </td>
        <td style='text-align: center'> 
        <input type='radio' name='objects' value='3' id = 'three'>
            <label for='three'> 
                3
            </label>
        </td>
        <td style='text-align: center'>  
        <input type='radio' name='objects' value='4' id = 'four'>
            <label for='four'> 
                4
            </label>
        </td>
        <td style='text-align: center'>
        <input type='radio' name='objects' value='5' id = 'five'>
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
            <input type='radio' name='relationships' value='1' id = 'one'>
            <label for='one'> 
                1
            </label>
        </td>
        <td style='text-align: center'>
        <input type='radio' name='relationships' value='2' id = 'two'>
            <label for='two'> 
                2
            </label> 
        </td>
        <td style='text-align: center'> 
        <input type='radio' name='relationships' value='3' id = 'three'>
            <label for='three'> 
                3
            </label>
        </td>
        <td style='text-align: center'>  
        <input type='radio' name='relationships' value='4' id = 'four'>
            <label for='four'> 
                4
            </label>
        </td>
        <td style='text-align: center'>
        <input type='radio' name='relationships' value='5' id = 'five'>
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
            <input type='radio' name='weakens' value='1' id = 'one'>
            <label for='one'> 
                1
            </label>
        </td>
        <td style='text-align: center'>
        <input type='radio' name='weakens' value='2' id = 'two'>
            <label for='two'> 
                2
            </label> 
        </td>
        <td style='text-align: center'> 
        <input type='radio' name='weakens' value='3' id = 'three'>
            <label for='three'> 
                3
            </label>
        </td>
        <td style='text-align: center'>  
        <input type='radio' name='weakens' value='4' id = 'four'>
            <label for='four'> 
                4
            </label>
        </td>
        <td style='text-align: center'>
        <input type='radio' name='weakens' value='5' id = 'five'>
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
            <input type='radio' name='sex' value='1' id = 'one'>
            <label for='one'> 
                1
            </label>
        </td>
        <td style='text-align: center'>
        <input type='radio' name='sex' value='2' id = 'two'>
            <label for='two'> 
                2
            </label> 
        </td>
        <td style='text-align: center'> 
        <input type='radio' name='sex' value='3' id = 'three'>
            <label for='three'> 
                3
            </label>
        </td>
        <td style='text-align: center'>  
        <input type='radio' name='sex' value='4' id = 'four'>
            <label for='four'> 
                4
            </label>
        </td>
        <td style='text-align: center'>
        <input type='radio' name='sex' value='5' id = 'five'>
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
            <input type='radio' name='consideration' value='1' id = 'one'>
            <label for='one'> 
                1
            </label>
        </td>
        <td style='text-align: center'>
        <input type='radio' name='consideration' value='2' id = 'two'>
            <label for='two'> 
                2
            </label> 
        </td>
        <td style='text-align: center'> 
        <input type='radio' name='consideration' value='3' id = 'three'>
            <label for='three'> 
                3
            </label>
        </td>
        <td style='text-align: center'>  
        <input type='radio' name='consideration' value='4' id = 'four'>
            <label for='four'> 
                4
            </label>
        </td>
        <td style='text-align: center'>
        <input type='radio' name='consideration' value='5' id = 'five'>
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
