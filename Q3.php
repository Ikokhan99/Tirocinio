<?php
// core configuration
include_once "config/core.php";

include_once 'config/database.php';
include_once 'objects/user.php';
include_once 'objects/q3.php';

// page title
$order = range(0,23);
shuffle($order);
$page_index = 'q3';
$page_title = "Survey";

include_once 'config/database.php';
$database = new Database();
$db = $database->getConnection();
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//TODO
if (!empty($_POST)) {
    if(!fast_debug) {
        //TODO
        $q3 = new Q3($db,$_SESSION['user-id']);
        $q3->control_questions = array(check_int($_POST["control1"],0,5),check_int($_POST["control2"],0,5));
        $q3->questions = array(check_int($_POST["Q1"],0,5),
            check_int($_POST["Q2"],0,5),
            check_int($_POST["Q3"],0,5),
            check_int($_POST["Q4"],0,5),
            check_int($_POST["Q5"],0,5),
            check_int($_POST["Q6"],0,5),
            check_int($_POST["Q7"],0,5),
            check_int($_POST["Q8"],0,5),
            check_int($_POST["Q9"],0,5),
            check_int($_POST["Q10"],0,5),
            check_int($_POST["Q11"],0,5),
            check_int($_POST["Q12"],0,5),
            check_int($_POST["Q13"],0,5),
            check_int($_POST["Q14"],0,5),
            check_int($_POST["Q15"],0,5),
            check_int($_POST["Q16"],0,5),
            check_int($_POST["Q17"],0,5),
            check_int($_POST["Q18"],0,5),
            check_int($_POST["Q19"],0,5),
            check_int($_POST["Q20"],0,5),
            check_int($_POST["Q21"],0,5),
            check_int($_POST["Q22"],0,5)
        );
        if(debug)
            var_dump($q3);
        
        if (!$q3->create()) {
            die();
        }
    }
    header("Location: ".home_url."Q1.php?action=goto");
}
include_once 'q_common.php';
$_SESSION['visited_pages']['q3'] = true;
?>
<div style="text-align: center;">
<form action="Q3.php" method="post">


    <p style= "font-weight: 1000;">
Below is a series of statements concerning men and women and their
relationships in contemporary society. Please indicate the degree to
which you agree or disagree with each statement using the following
scale: 0 = disagree strongly; 1 = disagree somewhat; 2 = disagree
slightly; 3 = agree slightly; 4 = agree somewhat; 5 = agree strongly.
</p>

<table class="center">
    <tr>
        <td> </td>
        <td style= "font-weight: 1000;">disagree strongly</td>
        <td style= "font-weight: 1000;">disagree somewhat</td>
        <td style= "font-weight: 1000;">disagree slightly</td>
        <td style= "font-weight: 1000;">agree slightly</td>
        <td style= "font-weight: 1000;">agree somewhat</td>
        <td style= "font-weight: 1000;">agree strongly</td>
    </tr>
<?php
foreach ($order as $num )
{
    switch ($num) {
        case 0:{
            echo "<tr>
    <td> It's important that you pay attention to this study. Please, tick 5  </td>
        <td style= \"text-align: center\">
            <input type=\"radio\" name=\"control1\" value=\"0\" id = \"zero\" required >
            <label  for=\"zero\"> 
                0
            </label>
        </td>
        <td style=\"text-align: center\">
            <input type=\"radio\" name=\"control1\" value=\"1\" id = \"one\">
            <label  for=\"one\"> 
                1
            </label>
        </td>
        <td style=\"text-align: center\">
        <input type=\"radio\" name=\"control1\" value=\"2\" id = \"two\">
            <label for=\"two\"> 
                2
            </label> 
        </td>
        <td style=\"text-align: center\"> 
        <input type=\"radio\" name=\"control1\" value=\"3\" id = \"three\">
            <label for=\"three\"> 
                3
            </label>
        </td>
        <td style=\"text-align: center\">  
        <input type=\"radio\" name=\"control1\" value=\"4\" id = \"four\">
            <label for=\"four\"> 
                4
            </label>
        </td>
        <td style=\"text-align: center\">
        <input type=\"radio\" name=\"control1\" value=\"5\" id = \"five\">
            <label for=\"five\"> 
                5
            </label>
        </td>
    </tr>";
            break;
        }
        case 23:{
            echo '<tr>
    <td> It\'s important that you pay attention to this study. Please, tick 0</td>
        <td style= "text-align: center">
            <input type="radio" name="control2" value="0" id = "zero" required >
            <label  for="zero"> 
                0
            </label>
        </td>
        <td style="text-align: center">
            <input type="radio" name="control2" value="1" id = "one">
            <label  for="one"> 
                1
            </label>
        </td>
        <td style="text-align: center">
        <input type="radio" name="control2" value="2" id = "two">
            <label for="two"> 
                2
            </label> 
        </td>
        <td style="text-align: center"> 
        <input type="radio" name="control2" value="3" id = "three">
            <label for="three"> 
                3
            </label>
        </td>
        <td style="text-align: center">  
        <input type="radio" name="control2" value="4" id = "four">
            <label for="four"> 
                4
            </label>
        </td>
        <td style="text-align: center">
        <input type="radio" name="control2" value="5" id = "five">
            <label for="five"> 
                5
            </label>
        </td>
    </tr>';
            break;
        }
        case 1:default:

    echo '<tr>
    <td> No matter how accomplished is, a man is not truly complete as a person unless he has the love of a woman. </td>
        <td style= "text-align: center">
            <input type="radio" name= "Q1" value="0" id = "zero" required >
            <label  for="zero"> 
                0
            </label>
        </td>
        <td style="text-align: center">
            <input type="radio" name= "Q1" value="1" id = "one">
            <label  for="one"> 
                1
            </label>
        </td>
        <td style="text-align: center">
        <input type="radio" name= "Q1" value="2" id = "two">
            <label for="two"> 
                2
            </label> 
        </td>
        <td style="text-align: center"> 
        <input type="radio" name= "Q1" value="3" id = "three">
            <label for="three"> 
                3
            </label>
        </td>
        <td style="text-align: center">  
        <input type="radio" name= "Q1" value="4" id = "four">
            <label for="four"> 
                4
            </label>
        </td>
        <td style="text-align: center">
        <input type="radio" name= "Q1" value="5" id = "five">
            <label for="five"> 
                5
            </label>
        </td>
    </tr>'; break;
        case 2:
    echo '<tr>
    <td> Many women are actually seeking special favours, such as hiring policies that favour them over men, under the guise of asking for "equality." </td>
        <td style="text-align: center">
            <input type="radio" name= "Q2" value="0" id = "zero" required >
            <label  for="zero"> 
                0
            </label>
        </td>
        <td style="text-align: center">
            <input type="radio" name= "Q2" value="1" id = "one">
            <label  for="one"> 
                1
            </label>
        </td>
        <td style="text-align: center">
        <input type="radio" name= "Q2" value="2" id = "two">
            <label for="two"> 
                2
            </label> 
        </td>
        <td style="text-align: center"> 
        <input type="radio" name= "Q2" value="3" id = "three">
            <label for="three"> 
                3
            </label>
        </td>
        <td style="text-align: center"> 
        <input type="radio" name= "Q2" value="4" id = "four">
            <label for="four"> 
                4
            </label>
        </td>
        <td style="text-align: center">
        <input type="radio" name= "Q2" value="5" id = "five">
            <label for="five"> 
                5
            </label>
        </td>
    </tr>'; break;
        case 3:
    echo '<tr>
    <td> In a disaster, women ought not necessarily to be rescued before men. </td>
        <td style="text-align: center">
            <input type="radio" name= "Q3" value="0" id = "zero" required >
            <label  for="zero"> 
                0
            </label>
        </td>
        <td style="text-align: center">
            <input type="radio" name= "Q3" value="1" id = "one">
            <label  for="one"> 
                1
            </label>
        </td>
        <td style="text-align: center">
        <input type="radio" name= "Q3" value="2" id = "two">
            <label for="two"> 
                2
            </label> 
        </td>
        <td style="text-align: center"> 
        <input type="radio" name= "Q3" value="3" id = "three">
            <label for="three"> 
                3
            </label>
        </td>
        <td style="text-align: center">  
        <input type="radio" name= "Q3" value="4" id = "four">
            <label for="four"> 
                4
            </label>
        </td>
        <td style="text-align: center">
        <input type="radio" name= "Q3" value="5" id = "five">
            <label for="five"> 
                5
            </label>
        </td>
    </tr>'; break;
        case 4:
    echo '<tr>
    <td> Most women interpret innocent remarks or acts as being sexist. </td>
        <td style="text-align: center">
            <input type="radio" name= "Q4" value="0" id = "zero" required >
            <label  for="zero"> 
                0
            </label>
        </td>
        <td style="text-align: center">
            <input type="radio" name= "Q4" value="1" id = "one">
            <label  for="one"> 
                1
            </label>
        </td>
        <td style="text-align: center">
        <input type="radio" name= "Q4" value="2" id = "two">
            <label for="two"> 
                2
            </label> 
        </td>
        <td style="text-align: center"> 
        <input type="radio" name= "Q4" value="3" id = "three">
            <label for="three"> 
                3
            </label>
        </td>
        <td style="text-align: center">  
        <input type="radio" name= "Q4" value="4" id = "four">
            <label for="four"> 
                4
            </label>
        </td>
        <td style="text-align: center">
        <input type="radio" name= "Q4" value="5" id = "five">
            <label for="five"> 
                5
            </label>
        </td>
    </tr>'; break;
        case 5:
    echo '<tr>
        <td> Women are too easily offended. </td>
        <td style="text-align: center">
            <input type="radio" name= "Q5" value="0" id = "zero" required >
            <label  for="zero"> 
                0
            </label>
        </td>
        <td style="text-align: center">
            <input type="radio" name= "Q5" value="1" id = "one">
            <label  for="one"> 
                1
            </label>
        </td>
        <td style="text-align: center">
        <input type="radio" name= "Q5" value="2" id = "two">
            <label for="two"> 
                2
            </label> 
        </td>
        <td style="text-align: center"> 
        <input type="radio" name= "Q5" value="3" id = "three">
            <label for="three"> 
                3
            </label>
        </td>
        <td style="text-align: center">  
        <input type="radio" name= "Q5" value="4" id = "four">
            <label for="four"> 
                4
            </label>
        </td>
        <td style="text-align: center">
        <input type="radio" name= "Q5" value="5" id = "five">
            <label for="five"> 
                5
            </label>
        </td>
    </tr>'; break;
        case 6:
    echo '<tr>
        <td> People are often truly happy in life without being romantically involved with a member of the other sex.</td>
        <td style="text-align: center">
            <input type="radio" name= "Q6" value="0" id = "zero" required >
            <label  for="zero"> 
                0
            </label>
        </td>
        <td style="text-align: center">
            <input type="radio" name= "Q6" value="1" id = "one">
            <label  for="one"> 
                1
            </label>
        </td>
        <td style="text-align: center">
        <input type="radio" name= "Q6" value="2" id = "two">
            <label for="two"> 
                2
            </label> 
        </td>
        <td style="text-align: center"> 
        <input type="radio" name= "Q6" value="3" id = "three">
            <label for="three"> 
                3
            </label>
        </td>
        <td style="text-align: center">  
        <input type="radio" name= "Q6" value="4" id = "four">
            <label for="four"> 
                4
            </label>
        </td>
        <td style="text-align: center">
        <input type="radio" name= "Q6" value="5" id = "five">
            <label for="five"> 
                5
            </label>
        </td>
    </tr>'; break;
        case 7:
    echo '<tr>
        <td> Feminists are not seeking for women to have more power than men.</td>
        <td style="text-align: center">
            <input type="radio" name= "Q7" value="0" id = "zero" required >
            <label  for="zero"> 
                0
            </label>
        </td>
        <td style="text-align: center">
            <input type="radio" name= "Q7" value="1" id = "one">
            <label  for="one"> 
                1
            </label>
        </td>
        <td style="text-align: center">
        <input type="radio" name= "Q7" value="2" id = "two">
            <label for="two"> 
                2
            </label> 
        </td>
        <td style="text-align: center"> 
        <input type="radio" name= "Q7" value="3" id = "three">
            <label for="three"> 
                3
            </label>
        </td>
        <td style="text-align: center">  
        <input type="radio" name= "Q7" value="4" id = "four">
            <label for="four"> 
                4
            </label>
        </td>
        <td style="text-align: center">
        <input type="radio" name= "Q7" value="5" id = "five">
            <label for="five"> 
                5
            </label>
        </td>
    </tr>'; break;
        case 8:
    echo '<tr>
        <td> Many women have a quality of purity that few men possess.</td>
        <td style="text-align: center">
            <input type="radio" name= "Q8" value="0" id = "zero" required >
            <label  for="zero"> 
                0
            </label>
        </td>
        <td style="text-align: center">
            <input type="radio" name= "Q8" value="1" id = "one">
            <label  for="one"> 
                1
            </label>
        </td>
        <td style="text-align: center">
        <input type="radio" name= "Q8" value="2" id = "two">
            <label for="two"> 
                2
            </label> 
        </td>
        <td style="text-align: center"> 
        <input type="radio" name= "Q8" value="3" id = "three">
            <label for="three"> 
                3
            </label>
        </td>
        <td style="text-align: center">  
        <input type="radio" name= "Q8" value="4" id = "four">
            <label for="four"> 
                4
            </label>
        </td>
        <td style="text-align: center">
        <input type="radio" name= "Q8" value="5" id = "five">
            <label for="five"> 
                5
            </label>
        </td>
    </tr>'; break;
        case 9:
    echo '<tr>
        <td> Women should be cherished and protected by men.</td>
        <td style="text-align: center">
            <input type="radio" name= "Q9" value="0" id = "zero" required >
            <label  for="zero"> 
                0
            </label>
        </td>
        <td style="text-align: center">
            <input type="radio" name= "Q9" value="1" id = "one">
            <label  for="one"> 
                1
            </label>
        </td>
        <td style="text-align: center">
        <input type="radio" name= "Q9" value="2" id = "two">
            <label for="two"> 
                2
            </label> 
        </td>
        <td style="text-align: center"> 
        <input type="radio" name= "Q9" value="3" id = "three">
            <label for="three"> 
                3
            </label>
        </td>
        <td style="text-align: center">  
        <input type="radio" name= "Q9" value="4" id = "four">
            <label for="four"> 
                4
            </label>
        </td>
        <td style="text-align: center">
        <input type="radio" name= "Q9" value="5" id = "five">
            <label for="five"> 
                5
            </label>
        </td>
    </tr>'; break;
        case 10:
    echo '<tr>
        <td> Most women fail to appreciate fully all that men do for them.</td>
        <td style="text-align: center">
            <input type="radio" name= "Q10" value="0" id = "zero" required >
            <label  for="zero"> 
                0
            </label>
        </td>
        <td style="text-align: center">
            <input type="radio" name= "Q10" value="1" id = "one">
            <label  for="one"> 
                1
            </label>
        </td>
        <td style="text-align: center">
        <input type="radio" name= "Q10" value="2" id = "two">
            <label for="two"> 
                2
            </label> 
        </td>
        <td style="text-align: center"> 
        <input type="radio" name= "Q10" value="3" id = "three">
            <label for="three"> 
                3
            </label>
        </td>
        <td style="text-align: center">  
        <input type="radio" name= "Q10" value="4" id = "four">
            <label for="four"> 
                4
            </label>
        </td>
        <td style="text-align: center">
        <input type="radio" name= "Q10" value="5" id = "five">
            <label for="five"> 
                5
            </label>
        </td>
    </tr>'; break;
        case 11:
    echo '<tr>
        <td> Women seek to gain power by getting control over men.</td>
        <td style="text-align: center">
            <input type="radio" name= "Q11" value="0" id = "zero" required >
            <label  for="zero"> 
                0
            </label>
        </td>
        <td style="text-align: center">
            <input type="radio" name= "Q11" value="1" id = "one">
            <label  for="one"> 
                1
            </label>
        </td>
        <td style="text-align: center">
        <input type="radio" name= "Q11" value="2" id = "two">
            <label for="two"> 
                2
            </label> 
        </td>
        <td style="text-align: center"> 
        <input type="radio" name= "Q11" value="3" id = "three">
            <label for="three"> 
                3
            </label>
        </td>
        <td style="text-align: center">  
        <input type="radio" name= "Q11" value="4" id = "four">
            <label for="four"> 
                4
            </label>
        </td>
        <td style="text-align: center">
        <input type="radio" name= "Q11" value="5" id = "five">
            <label for="five"> 
                5
            </label>
        </td>
    </tr>'; break;
        case 12:
    echo '<tr>
        <td> Every man ought to have a woman whom he adores.</td>
        <td style="text-align: center">
            <input type="radio" name= "Q12" value="0" id = "zero" required >
            <label  for="zero"> 
                0
            </label>
        </td>
        <td style="text-align: center">
            <input type="radio" name= "Q12" value="1" id = "one">
            <label  for="one"> 
                1
            </label>
        </td>
        <td style="text-align: center">
        <input type="radio" name= "Q12" value="2" id = "two">
            <label for="two"> 
                2
            </label> 
        </td>
        <td style="text-align: center"> 
        <input type="radio" name= "Q12" value="3" id = "three">
            <label for="three"> 
                3
            </label>
        </td>
        <td style="text-align: center">  
        <input type="radio" name= "Q12" value="4" id = "four">
            <label for="four"> 
                4
            </label>
        </td>
        <td style="text-align: center">
        <input type="radio" name= "Q12" value="5" id = "five">
            <label for="five"> 
                5
            </label>
        </td>
    </tr>'; break;
        case 13:
    echo '<tr>
        <td> Men are complete without women.</td>
        <td style="text-align: center">
            <input type="radio" name= "Q13" value="0" id = "zero" required >
            <label  for="zero"> 
                0
            </label>
        </td>
        <td style="text-align: center">
            <input type="radio" name= "Q13" value="1" id = "one">
            <label  for="one"> 
                1
            </label>
        </td>
        <td style="text-align: center">
        <input type="radio" name= "Q13" value="2" id = "two">
            <label for="two"> 
                2
            </label> 
        </td>
        <td style="text-align: center"> 
        <input type="radio" name= "Q13" value="3" id = "three">
            <label for="three"> 
                3
            </label>
        </td>
        <td style="text-align: center">  
        <input type="radio" name= "Q13" value="4" id = "four">
            <label for="four"> 
                4
            </label>
        </td>
        <td style="text-align: center">
        <input type="radio" name= "Q13" value="5" id = "five">
            <label for="five"> 
                5
            </label>
        </td>
    </tr>'; break;
        case 14:
    echo '<tr>
        <td> Women exaggerate problems they have at work.</td>
        <td style="text-align: center">
            <input type="radio" name= "Q14" value="0" id = "zero" required >
            <label  for="zero"> 
                0
            </label>
        </td>
        <td style="text-align: center">
            <input type="radio" name= "Q14" value="1" id = "one">
            <label  for="one"> 
                1
            </label>
        </td>
        <td style="text-align: center">
        <input type="radio" name= "Q14" value="2" id = "two">
            <label for="two"> 
                2
            </label> 
        </td>
        <td style="text-align: center"> 
        <input type="radio" name= "Q14" value="3" id = "three">
            <label for="three"> 
                3
            </label>
        </td>
        <td style="text-align: center">  
        <input type="radio" name= "Q14" value="4" id = "four">
            <label for="four"> 
                4
            </label>
        </td>
        <td style="text-align: center">
        <input type="radio" name= "Q14" value="5" id = "five">
            <label for="five"> 
                5
            </label>
        </td>
    </tr>'; break;
        case 15:
    echo '<tr>
        <td> Once a woman gets a man to commit to her, she usually tries to put him on a tight leash.</td>
        <td style="text-align: center">
            <input type="radio" name= "Q15" value="0" id = "zero" required >
            <label  for="zero"> 
                0
            </label>
        </td>
        <td style="text-align: center">
            <input type="radio" name= "Q15" value="1" id = "one">
            <label  for="one"> 
                1
            </label>
        </td>
        <td style="text-align: center">
        <input type="radio" name= "Q15" value="2" id = "two">
            <label for="two"> 
                2
            </label> 
        </td>
        <td style="text-align: center"> 
        <input type="radio" name= "Q15" value="3" id = "three">
            <label for="three"> 
                3
            </label>
        </td>
        <td style="text-align: center">  
        <input type="radio" name= "Q15" value="4" id = "four">
            <label for="four"> 
                4
            </label>
        </td>
        <td style="text-align: center">
        <input type="radio" name= "Q15" value="5" id = "five">
            <label for="five"> 
                5
            </label>
        </td>
    </tr>'; break;
        case 16:
    echo '<tr>
        <td> When women lose to men in a fair competition, they typically complain about being discriminated against.</td>
        <td style="text-align: center">
            <input type="radio" name= "Q16" value="0" id = "zero" required >
            <label  for="zero"> 
                0
            </label>
        </td>
        <td style="text-align: center">
            <input type="radio" name= "Q16" value="1" id = "one">
            <label  for="one"> 
                1
            </label>
        </td>
        <td style="text-align: center">
        <input type="radio" name= "Q16" value="2" id = "two">
            <label for="two"> 
                2
            </label> 
        </td>
        <td style="text-align: center"> 
        <input type="radio" name= "Q16" value="3" id = "three">
            <label for="three"> 
                3
            </label>
        </td>
        <td style="text-align: center">  
        <input type="radio" name= "Q16" value="4" id = "four">
            <label for="four"> 
                4
            </label>
        </td>
        <td style="text-align: center">
        <input type="radio" name= "Q16" value="5" id = "five">
            <label for="five"> 
                5
            </label>
        </td>
    </tr>'; break;
        case 17:
    echo '<tr>
        <td> A good woman should be set on a pedestal by her man</td>
        <td style="text-align: center">
            <input type="radio" name= "Q17" value="0" id = "zero" required >
            <label  for="zero"> 
                0
            </label>
        </td>
        <td style="text-align: center">
            <input type="radio" name= "Q17" value="1" id = "one">
            <label  for="one"> 
                1
            </label>
        </td>
        <td style="text-align: center">
        <input type="radio" name= "Q17" value="2" id = "two">
            <label for="two"> 
                2
            </label> 
        </td>
        <td style="text-align: center"> 
        <input type="radio" name= "Q17" value="3" id = "three">
            <label for="three"> 
                3
            </label>
        </td>
        <td style="text-align: center">  
        <input type="radio" name= "Q17" value="4" id = "four">
            <label for="four"> 
                4
            </label>
        </td>
        <td style="text-align: center">
        <input type="radio" name= "Q17" value="5" id = "five">
            <label for="five"> 
                5
            </label>
        </td>
    </tr>'; break;
        case 18:
    echo '<tr>
        <td> There are actually very few women who get a kick out of teasing men by seeming sexually available and then refusing male advances. </td>
        <td style="text-align: center">
            <input type="radio" name= "Q18" value="0" id = "zero" required >
            <label  for="zero"> 
                0
            </label>
        </td>
        <td style="text-align: center">
            <input type="radio" name= "Q18" value="1" id = "one">
            <label  for="one"> 
                1
            </label>
        </td>
        <td style="text-align: center">
        <input type="radio" name= "Q18" value="2" id = "two">
            <label for="two"> 
                2
            </label> 
        </td>
        <td style="text-align: center"> 
        <input type="radio" name= "Q18" value="3" id = "three">
            <label for="three"> 
                3
            </label>
        </td>
        <td style="text-align: center">  
        <input type="radio" name= "Q18" value="4" id = "four">
            <label for="four"> 
                4
            </label>
        </td>
        <td style="text-align: center">
        <input type="radio" name= "Q18" value="5" id = "five">
            <label for="five"> 
                5
            </label>
        </td>
    </tr>'; break;
        case 19:
    echo '<tr>
        <td> Women, compared to men, tend to have a superior moral sensibility. </td>
        <td style="text-align: center">
            <input type="radio" name= "Q19" value="0" id = "zero" required >
            <label  for="zero"> 
                0
            </label>
        </td>
        <td style="text-align: center">
            <input type="radio" name= "Q19" value="1" id = "one">
            <label  for="one"> 
                1
            </label>
        </td>
        <td style="text-align: center">
        <input type="radio" name= "Q19" value="2" id = "two">
            <label for="two"> 
                2
            </label> 
        </td>
        <td style="text-align: center"> 
        <input type="radio" name= "Q19" value="3" id = "three">
            <label for="three"> 
                3
            </label>
        </td>
        <td style="text-align: center">  
        <input type="radio" name= "Q19" value="4" id = "four">
            <label for="four"> 
                4
            </label>
        </td>
        <td style="text-align: center">
        <input type="radio" name= "Q19" value="5" id = "five">
            <label for="five"> 
                5
            </label>
        </td>
    </tr>'; break;
        case 20:
    echo '<tr>
        <td> Men should be willing to sacrifice their own well-being in order to provide financially for the women in their lives. </td>
        <td style="text-align: center">
            <input type="radio" name= "Q20" value="0" id = "zero" required >
            <label  for="zero"> 
                0
            </label>
        </td>
        <td style="text-align: center">
            <input type="radio" name= "Q20" value="1" id = "one">
            <label  for="one"> 
                1
            </label>
        </td>
        <td style="text-align: center">
        <input type="radio" name= "Q20" value="2" id = "two">
            <label for="two"> 
                2
            </label> 
        </td>
        <td style="text-align: center"> 
        <input type="radio" name= "Q20" value="3" id = "three">
            <label for="three"> 
                3
            </label>
        </td>
        <td style="text-align: center">  
        <input type="radio" name= "Q20" value="4" id = "four">
            <label for="four"> 
                4
            </label>
        </td>
        <td style="text-align: center">
        <input type="radio" name= "Q20" value="5" id = "five">
            <label for="five"> 
                5
            </label>
        </td>
    </tr>'; break;
        case 21:
    echo '<tr>
        <td> Feminists are making entirely reasonable demands of men.</td>
        <td style="text-align: center">
            <input type="radio" name= "Q21" value="0" id = "zero" required >
            <label  for="zero"> 
                0
            </label>
        </td>
        <td style="text-align: center">
            <input type="radio" name= "Q21" value="1" id = "one">
            <label  for="one"> 
                1
            </label>
        </td>
        <td style="text-align: center">
        <input type="radio" name= "Q21" value="2" id = "two">
            <label for="two"> 
                2
            </label> 
        </td>
        <td style="text-align: center"> 
        <input type="radio" name= "Q21" value="3" id = "three">
            <label for="three"> 
                3
            </label>
        </td>
        <td style="text-align: center">  
        <input type="radio" name= "Q21" value="4" id = "four">
            <label for="four"> 
                4
            </label>
        </td>
        <td style="text-align: center">
        <input type="radio" name= "Q21" value="5" id = "five">
            <label for="five"> 
                5
            </label>
        </td>
    </tr>'; break;
        case 22:
    echo '<tr>
        <td> Women, as compared to men, tend to have a more refined sense of culture and good taste.</td>
        <td style="text-align: center">
            <input type="radio" name= "Q22" value="0" id = "zero" required >
            <label  for="zero"> 
                0
            </label>
        </td>
        <td style="text-align: center">
            <input type="radio" name= "Q22" value="1" id = "one">
            <label  for="one"> 
                1
            </label>
        </td>
        <td style="text-align: center">
        <input type="radio" name= "Q22" value="2" id = "two">
            <label for="two"> 
                2
            </label> 
        </td>
        <td style="text-align: center"> 
        <input type="radio" name= "Q22" value="3" id = "three">
            <label for="three"> 
                3
            </label>
        </td>
        <td style="text-align: center">  
        <input type="radio" name= "Q22" value="4" id = "four">
            <label for="four"> 
                4
            </label>
        </td>
        <td style="text-align: center">
        <input type="radio" name= "Q22" value="5" id = "five">
            <label for="five"> 
                5
            </label>
        </td>
    </tr>';
    }
}
?>
</table>
<p></p>
<p></p>
    <input type="submit" name="action" id="action-q3" tabindex="4" class="form-control btn btn-register" value="Continue">
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

