<?php
// core configuration
include_once "config/core.php";

include_once 'config/database.php';
include_once 'objects/user.php';

// page title
$order = range(1,22);
shuffle($order);

$page_title = "Survey";
include_once "layout_head.php";

//TODO
if (!empty($_POST)) {
    if(!fast_debug) {
        //TODO
        $q2 = new Q2($_SESSION['db'],$_SESSION['uid']);
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
if(debug) {
    echo "<p> DEBUG: ";
    print_r($_SESSION['at']);
    echo "</p>";
    echo "<p> DEBUG: ";
    print_r($_SESSION['Q'][$_SESSION['at']]);
    echo "</p>";
}
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
        <td style= "font-weight: 1000;">agree slightly</td>>
        <td style= "font-weight: 1000;">agree somewhat</td>
        <td style= "font-weight: 1000;">agree strongly</td>
    </tr>
<?php
foreach ($order as $num )
{
    switch ($num) {case 1:default:

    echo '<tr>
    <td> No matter how accomplished is, a man is not truly complete as a person unless he has the love of a woman. </td>
        <td style= "text-align: center">
            <input type="radio" name="accomplished" value="0" id = "zero">
            <label  for="zero"> 
                0
            </label>
        </td>
        <td style="text-align: center">
            <input type="radio" name="accomplished" value="1" id = "one">
            <label  for="one"> 
                1
            </label>
        </td>
        <td style="text-align: center">
        <input type="radio" name="accomplished" value="2" id = "two">
            <label for="two"> 
                2
            </label> 
        </td>
        <td style="text-align: center"> 
        <input type="radio" name="accomplished" value="3" id = "three">
            <label for="three"> 
                3
            </label>
        </td>
        <td style="text-align: center">  
        <input type="radio" name="accomplished" value="4" id = "four">
            <label for="four"> 
                4
            </label>
        </td>
        <td style="text-align: center">
        <input type="radio" name="accomplished" value="5" id = "five">
            <label for="five"> 
                5
            </label>
        </td>
    </tr>'; break;
        case 2:
    echo '<tr>
    <td> Many women are actually seeking special favors, such as hiring policies that favor them overmen, under the guise of asking for "equality." </td>
        <td style="text-align: center">
            <input type="radio" name="special_favors" value="0" id = "zero">
            <label  for="zero"> 
                0
            </label>
        </td>
        <td style="text-align: center">
            <input type="radio" name="special_favors" value="1" id = "one">
            <label  for="one"> 
                1
            </label>
        </td>
        <td style="text-align: center">
        <input type="radio" name="special_favors" value="2" id = "two">
            <label for="two"> 
                2
            </label> 
        </td>
        <td style="text-align: center"> 
        <input type="radio" name="special_favors" value="3" id = "three">
            <label for="three"> 
                3
            </label>
        </td>
        <td style="text-align: center"> 
        <input type="radio" name="special_favors" value="4" id = "four">
            <label for="four"> 
                4
            </label>
        </td>
        <td style="text-align: center">
        <input type="radio" name="special_favors" value="5" id = "five">
            <label for="five"> 
                5
            </label>
        </td>
    </tr>'; break;
        case 3:
    echo '<tr>
    <td> In a disaster, women ought not necessarily to be rescued before men. </td>
        <td style="text-align: center">
            <input type="radio" name="disaster" value="0" id = "zero">
            <label  for="zero"> 
                0
            </label>
        </td>
        <td style="text-align: center">
            <input type="radio" name="disaster" value="1" id = "one">
            <label  for="one"> 
                1
            </label>
        </td>
        <td style="text-align: center">
        <input type="radio" name="disaster" value="2" id = "two">
            <label for="two"> 
                2
            </label> 
        </td>
        <td style="text-align: center"> 
        <input type="radio" name="disaster" value="3" id = "three">
            <label for="three"> 
                3
            </label>
        </td>
        <td style="text-align: center">  
        <input type="radio" name="disaster" value="4" id = "four">
            <label for="four"> 
                4
            </label>
        </td>
        <td style="text-align: center">
        <input type="radio" name="disaster" value="5" id = "five">
            <label for="five"> 
                5
            </label>
        </td>
    </tr>'; break;
        case 4:
    echo '<tr>
    <td> Most women interpret innocent remarks or acts as being sexist. </td>
        <td style="text-align: center">
            <input type="radio" name="innocent" value="0" id = "zero">
            <label  for="zero"> 
                0
            </label>
        </td>
        <td style="text-align: center">
            <input type="radio" name="innocent" value="1" id = "one">
            <label  for="one"> 
                1
            </label>
        </td>
        <td style="text-align: center">
        <input type="radio" name="innocent" value="2" id = "two">
            <label for="two"> 
                2
            </label> 
        </td>
        <td style="text-align: center"> 
        <input type="radio" name="innocent" value="3" id = "three">
            <label for="three"> 
                3
            </label>
        </td>
        <td style="text-align: center">  
        <input type="radio" name="innocent" value="4" id = "four">
            <label for="four"> 
                4
            </label>
        </td>
        <td style="text-align: center">
        <input type="radio" name="innocent" value="5" id = "five">
            <label for="five"> 
                5
            </label>
        </td>
    </tr>'; break;
        case 5:
    echo '<tr>
        <td> Women are too easily offended. </td>
        <td style="text-align: center">
            <input type="radio" name="offended" value="0" id = "zero">
            <label  for="zero"> 
                0
            </label>
        </td>
        <td style="text-align: center">
            <input type="radio" name="offended" value="1" id = "one">
            <label  for="one"> 
                1
            </label>
        </td>
        <td style="text-align: center">
        <input type="radio" name="offended" value="2" id = "two">
            <label for="two"> 
                2
            </label> 
        </td>
        <td style="text-align: center"> 
        <input type="radio" name="offended" value="3" id = "three">
            <label for="three"> 
                3
            </label>
        </td>
        <td style="text-align: center">  
        <input type="radio" name="offended" value="4" id = "four">
            <label for="four"> 
                4
            </label>
        </td>
        <td style="text-align: center">
        <input type="radio" name="offended" value="5" id = "five">
            <label for="five"> 
                5
            </label>
        </td>
    </tr>'; break;
        case 6:
    echo '<tr>
        <td> People are often truly happy in life without being romantically involved with a member of the other sex.</td>
        <td style="text-align: center">
            <input type="radio" name="romantically_involved" value="0" id = "zero">
            <label  for="zero"> 
                0
            </label>
        </td>
        <td style="text-align: center">
            <input type="radio" name="romantically_involved" value="1" id = "one">
            <label  for="one"> 
                1
            </label>
        </td>
        <td style="text-align: center">
        <input type="radio" name="romantically_involved" value="2" id = "two">
            <label for="two"> 
                2
            </label> 
        </td>
        <td style="text-align: center"> 
        <input type="radio" name="romantically_involved" value="3" id = "three">
            <label for="three"> 
                3
            </label>
        </td>
        <td style="text-align: center">  
        <input type="radio" name="romantically_involved" value="4" id = "four">
            <label for="four"> 
                4
            </label>
        </td>
        <td style="text-align: center">
        <input type="radio" name="romantically_involved" value="5" id = "five">
            <label for="five"> 
                5
            </label>
        </td>
    </tr>'; break;
        case 7:
    echo '<tr>
        <td> Feminists are not seeking for women to have more power than men.</td>
        <td style="text-align: center">
            <input type="radio" name="power" value="0" id = "zero">
            <label  for="zero"> 
                0
            </label>
        </td>
        <td style="text-align: center">
            <input type="radio" name="power" value="1" id = "one">
            <label  for="one"> 
                1
            </label>
        </td>
        <td style="text-align: center">
        <input type="radio" name="power" value="2" id = "two">
            <label for="two"> 
                2
            </label> 
        </td>
        <td style="text-align: center"> 
        <input type="radio" name="power" value="3" id = "three">
            <label for="three"> 
                3
            </label>
        </td>
        <td style="text-align: center">  
        <input type="radio" name="power" value="4" id = "four">
            <label for="four"> 
                4
            </label>
        </td>
        <td style="text-align: center">
        <input type="radio" name="power" value="5" id = "five">
            <label for="five"> 
                5
            </label>
        </td>
    </tr>'; break;
        case 8:
    echo '<tr>
        <td> Many women have a quality of purity that few men possess.</td>
        <td style="text-align: center">
            <input type="radio" name="purity" value="0" id = "zero">
            <label  for="zero"> 
                0
            </label>
        </td>
        <td style="text-align: center">
            <input type="radio" name="purity" value="1" id = "one">
            <label  for="one"> 
                1
            </label>
        </td>
        <td style="text-align: center">
        <input type="radio" name="purity" value="2" id = "two">
            <label for="two"> 
                2
            </label> 
        </td>
        <td style="text-align: center"> 
        <input type="radio" name="purity" value="3" id = "three">
            <label for="three"> 
                3
            </label>
        </td>
        <td style="text-align: center">  
        <input type="radio" name="purity" value="4" id = "four">
            <label for="four"> 
                4
            </label>
        </td>
        <td style="text-align: center">
        <input type="radio" name="purity" value="5" id = "five">
            <label for="five"> 
                5
            </label>
        </td>
    </tr>'; break;
        case 9:
    echo '<tr>
        <td> Women should be cherished and protected by men.</td>
        <td style="text-align: center">
            <input type="radio" name="cherished" value="0" id = "zero">
            <label  for="zero"> 
                0
            </label>
        </td>
        <td style="text-align: center">
            <input type="radio" name="cherished" value="1" id = "one">
            <label  for="one"> 
                1
            </label>
        </td>
        <td style="text-align: center">
        <input type="radio" name="cherished" value="2" id = "two">
            <label for="two"> 
                2
            </label> 
        </td>
        <td style="text-align: center"> 
        <input type="radio" name="cherished" value="3" id = "three">
            <label for="three"> 
                3
            </label>
        </td>
        <td style="text-align: center">  
        <input type="radio" name="cherished" value="4" id = "four">
            <label for="four"> 
                4
            </label>
        </td>
        <td style="text-align: center">
        <input type="radio" name="cherished" value="5" id = "five">
            <label for="five"> 
                5
            </label>
        </td>
    </tr>'; break;
        case 10:
    echo '<tr>
        <td> Most women fail to appreciate fully all that men do for them.</td>
        <td style="text-align: center">
            <input type="radio" name="appreciate" value="0" id = "zero">
            <label  for="zero"> 
                0
            </label>
        </td>
        <td style="text-align: center">
            <input type="radio" name="appreciate" value="1" id = "one">
            <label  for="one"> 
                1
            </label>
        </td>
        <td style="text-align: center">
        <input type="radio" name="appreciate" value="2" id = "two">
            <label for="two"> 
                2
            </label> 
        </td>
        <td style="text-align: center"> 
        <input type="radio" name="appreciate" value="3" id = "three">
            <label for="three"> 
                3
            </label>
        </td>
        <td style="text-align: center">  
        <input type="radio" name="appreciate" value="4" id = "four">
            <label for="four"> 
                4
            </label>
        </td>
        <td style="text-align: center">
        <input type="radio" name="appreciate" value="5" id = "five">
            <label for="five"> 
                5
            </label>
        </td>
    </tr>'; break;
        case 11:
    echo '<tr>
        <td> Women seek to gain power by getting control over men.</td>
        <td style="text-align: center">
            <input type="radio" name="seek" value="0" id = "zero">
            <label  for="zero"> 
                0
            </label>
        </td>
        <td style="text-align: center">
            <input type="radio" name="seek" value="1" id = "one">
            <label  for="one"> 
                1
            </label>
        </td>
        <td style="text-align: center">
        <input type="radio" name="seek" value="2" id = "two">
            <label for="two"> 
                2
            </label> 
        </td>
        <td style="text-align: center"> 
        <input type="radio" name="seek" value="3" id = "three">
            <label for="three"> 
                3
            </label>
        </td>
        <td style="text-align: center">  
        <input type="radio" name="seek" value="4" id = "four">
            <label for="four"> 
                4
            </label>
        </td>
        <td style="text-align: center">
        <input type="radio" name="seek" value="5" id = "five">
            <label for="five"> 
                5
            </label>
        </td>
    </tr>'; break;
        case 12:
    echo '<tr>
        <td> Every man ought to have a woman whom he adores.</td>
        <td style="text-align: center">
            <input type="radio" name="adores" value="0" id = "zero">
            <label  for="zero"> 
                0
            </label>
        </td>
        <td style="text-align: center">
            <input type="radio" name="adores" value="1" id = "one">
            <label  for="one"> 
                1
            </label>
        </td>
        <td style="text-align: center">
        <input type="radio" name="adores" value="2" id = "two">
            <label for="two"> 
                2
            </label> 
        </td>
        <td style="text-align: center"> 
        <input type="radio" name="adores" value="3" id = "three">
            <label for="three"> 
                3
            </label>
        </td>
        <td style="text-align: center">  
        <input type="radio" name="adores" value="4" id = "four">
            <label for="four"> 
                4
            </label>
        </td>
        <td style="text-align: center">
        <input type="radio" name="adores" value="5" id = "five">
            <label for="five"> 
                5
            </label>
        </td>
    </tr>'; break;
        case 13:
    echo '<tr>
        <td> Men are complete without women.</td>
        <td style="text-align: center">
            <input type="radio" name="complete" value="0" id = "zero">
            <label  for="zero"> 
                0
            </label>
        </td>
        <td style="text-align: center">
            <input type="radio" name="complete" value="1" id = "one">
            <label  for="one"> 
                1
            </label>
        </td>
        <td style="text-align: center">
        <input type="radio" name="complete" value="2" id = "two">
            <label for="two"> 
                2
            </label> 
        </td>
        <td style="text-align: center"> 
        <input type="radio" name="complete" value="3" id = "three">
            <label for="three"> 
                3
            </label>
        </td>
        <td style="text-align: center">  
        <input type="radio" name="complete" value="4" id = "four">
            <label for="four"> 
                4
            </label>
        </td>
        <td style="text-align: center">
        <input type="radio" name="complete" value="5" id = "five">
            <label for="five"> 
                5
            </label>
        </td>
    </tr>'; break;
        case 14:
    echo '<tr>
        <td> Women exaggerate problems they have at work.</td>
        <td style="text-align: center">
            <input type="radio" name="exaggerate" value="0" id = "zero">
            <label  for="zero"> 
                0
            </label>
        </td>
        <td style="text-align: center">
            <input type="radio" name="exaggerate" value="1" id = "one">
            <label  for="one"> 
                1
            </label>
        </td>
        <td style="text-align: center">
        <input type="radio" name="exaggerate" value="2" id = "two">
            <label for="two"> 
                2
            </label> 
        </td>
        <td style="text-align: center"> 
        <input type="radio" name="exaggerate" value="3" id = "three">
            <label for="three"> 
                3
            </label>
        </td>
        <td style="text-align: center">  
        <input type="radio" name="exaggerate" value="4" id = "four">
            <label for="four"> 
                4
            </label>
        </td>
        <td style="text-align: center">
        <input type="radio" name="exaggerate" value="5" id = "five">
            <label for="five"> 
                5
            </label>
        </td>
    </tr>'; break;
        case 15:
    echo '<tr>
        <td> Once a woman gets a man to commit to her, she usually tries to put him on a tight leash.</td>
        <td style="text-align: center">
            <input type="radio" name="leash" value="0" id = "zero">
            <label  for="zero"> 
                0
            </label>
        </td>
        <td style="text-align: center">
            <input type="radio" name="leash" value="1" id = "one">
            <label  for="one"> 
                1
            </label>
        </td>
        <td style="text-align: center">
        <input type="radio" name="leash" value="2" id = "two">
            <label for="two"> 
                2
            </label> 
        </td>
        <td style="text-align: center"> 
        <input type="radio" name="leash" value="3" id = "three">
            <label for="three"> 
                3
            </label>
        </td>
        <td style="text-align: center">  
        <input type="radio" name="leash" value="4" id = "four">
            <label for="four"> 
                4
            </label>
        </td>
        <td style="text-align: center">
        <input type="radio" name="leash" value="5" id = "five">
            <label for="five"> 
                5
            </label>
        </td>
    </tr>'; break;
        case 16:
    echo '<tr>
        <td> When women lose to men in a fair competition, they typically complain about being discriminated against.</td>
        <td style="text-align: center">
            <input type="radio" name="discriminated" value="0" id = "zero">
            <label  for="zero"> 
                0
            </label>
        </td>
        <td style="text-align: center">
            <input type="radio" name="discriminated" value="1" id = "one">
            <label  for="one"> 
                1
            </label>
        </td>
        <td style="text-align: center">
        <input type="radio" name="discriminated" value="2" id = "two">
            <label for="two"> 
                2
            </label> 
        </td>
        <td style="text-align: center"> 
        <input type="radio" name="discriminated" value="3" id = "three">
            <label for="three"> 
                3
            </label>
        </td>
        <td style="text-align: center">  
        <input type="radio" name="discriminated" value="4" id = "four">
            <label for="four"> 
                4
            </label>
        </td>
        <td style="text-align: center">
        <input type="radio" name="discriminated" value="5" id = "five">
            <label for="five"> 
                5
            </label>
        </td>
    </tr>'; break;
        case 17:
    echo '<tr>
        <td> A good woman should be set on a pedestal by her man</td>
        <td style="text-align: center">
            <input type="radio" name="pedestal" value="0" id = "zero">
            <label  for="zero"> 
                0
            </label>
        </td>
        <td style="text-align: center">
            <input type="radio" name="pedestal" value="1" id = "one">
            <label  for="one"> 
                1
            </label>
        </td>
        <td style="text-align: center">
        <input type="radio" name="pedestal" value="2" id = "two">
            <label for="two"> 
                2
            </label> 
        </td>
        <td style="text-align: center"> 
        <input type="radio" name="pedestal" value="3" id = "three">
            <label for="three"> 
                3
            </label>
        </td>
        <td style="text-align: center">  
        <input type="radio" name="pedestal" value="4" id = "four">
            <label for="four"> 
                4
            </label>
        </td>
        <td style="text-align: center">
        <input type="radio" name="pedestal" value="5" id = "five">
            <label for="five"> 
                5
            </label>
        </td>
    </tr>'; break;
        case 18:
    echo '<tr>
        <td> There are actually very few women who get a kick out of teasing men by seeming sexually available and then refusing male advances. </td>
        <td style="text-align: center">
            <input type="radio" name="teasing_men" value="0" id = "zero">
            <label  for="zero"> 
                0
            </label>
        </td>
        <td style="text-align: center">
            <input type="radio" name="teasing_men" value="1" id = "one">
            <label  for="one"> 
                1
            </label>
        </td>
        <td style="text-align: center">
        <input type="radio" name="teasing_men" value="2" id = "two">
            <label for="two"> 
                2
            </label> 
        </td>
        <td style="text-align: center"> 
        <input type="radio" name="teasing_men" value="3" id = "three">
            <label for="three"> 
                3
            </label>
        </td>
        <td style="text-align: center">  
        <input type="radio" name="teasing_men" value="4" id = "four">
            <label for="four"> 
                4
            </label>
        </td>
        <td style="text-align: center">
        <input type="radio" name="teasing_men" value="5" id = "five">
            <label for="five"> 
                5
            </label>
        </td>
    </tr>'; break;
        case 19:
    echo '<tr>
        <td> Women, compared to men, tend to have a superior moral sensibility. </td>
        <td style="text-align: center">
            <input type="radio" name="sensibility" value="0" id = "zero">
            <label  for="zero"> 
                0
            </label>
        </td>
        <td style="text-align: center">
            <input type="radio" name="sensibility" value="1" id = "one">
            <label  for="one"> 
                1
            </label>
        </td>
        <td style="text-align: center">
        <input type="radio" name="sensibility" value="2" id = "two">
            <label for="two"> 
                2
            </label> 
        </td>
        <td style="text-align: center"> 
        <input type="radio" name="sensibility" value="3" id = "three">
            <label for="three"> 
                3
            </label>
        </td>
        <td style="text-align: center">  
        <input type="radio" name="sensibility" value="4" id = "four">
            <label for="four"> 
                4
            </label>
        </td>
        <td style="text-align: center">
        <input type="radio" name="sensibility" value="5" id = "five">
            <label for="five"> 
                5
            </label>
        </td>
    </tr>'; break;
        case 20:
    echo '<tr>
        <td> Men should be willing to sacrifice their own well being in order to provide financially for the women in their lives. </td>
        <td style="text-align: center">
            <input type="radio" name="financially" value="0" id = "zero">
            <label  for="zero"> 
                0
            </label>
        </td>
        <td style="text-align: center">
            <input type="radio" name="financially" value="1" id = "one">
            <label  for="one"> 
                1
            </label>
        </td>
        <td style="text-align: center">
        <input type="radio" name="financially" value="2" id = "two">
            <label for="two"> 
                2
            </label> 
        </td>
        <td style="text-align: center"> 
        <input type="radio" name="financially" value="3" id = "three">
            <label for="three"> 
                3
            </label>
        </td>
        <td style="text-align: center">  
        <input type="radio" name="financially" value="4" id = "four">
            <label for="four"> 
                4
            </label>
        </td>
        <td style="text-align: center">
        <input type="radio" name="financially" value="5" id = "five">
            <label for="five"> 
                5
            </label>
        </td>
    </tr>'; break;
        case 21:
    echo '<tr>
        <td> Feminists are making entirely reasonable demands of men.</td>
        <td style="text-align: center">
            <input type="radio" name="demands" value="0" id = "zero">
            <label  for="zero"> 
                0
            </label>
        </td>
        <td style="text-align: center">
            <input type="radio" name="demands" value="1" id = "one">
            <label  for="one"> 
                1
            </label>
        </td>
        <td style="text-align: center">
        <input type="radio" name="demands" value="2" id = "two">
            <label for="two"> 
                2
            </label> 
        </td>
        <td style="text-align: center"> 
        <input type="radio" name="demands" value="3" id = "three">
            <label for="three"> 
                3
            </label>
        </td>
        <td style="text-align: center">  
        <input type="radio" name="demands" value="4" id = "four">
            <label for="four"> 
                4
            </label>
        </td>
        <td style="text-align: center">
        <input type="radio" name="demands" value="5" id = "five">
            <label for="five"> 
                5
            </label>
        </td>
    </tr>'; break;
        case 22:
    echo '<tr>
        <td> Women, as compared to men, tend to have a more refined sense of culture and good taste.</td>
        <td style="text-align: center">
            <input type="radio" name="good_taste" value="0" id = "zero">
            <label  for="zero"> 
                0
            </label>
        </td>
        <td style="text-align: center">
            <input type="radio" name="good_taste" value="1" id = "one">
            <label  for="one"> 
                1
            </label>
        </td>
        <td style="text-align: center">
        <input type="radio" name="good_taste" value="2" id = "two">
            <label for="two"> 
                2
            </label> 
        </td>
        <td style="text-align: center"> 
        <input type="radio" name="good_taste" value="3" id = "three">
            <label for="three"> 
                3
            </label>
        </td>
        <td style="text-align: center">  
        <input type="radio" name="good_taste" value="4" id = "four">
            <label for="four"> 
                4
            </label>
        </td>
        <td style="text-align: center">
        <input type="radio" name="good_taste" value="5" id = "five">
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
    <input type="submit" name="action" id="action-q2" tabindex="4" class="form-control btn btn-register" value="Continue">
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

