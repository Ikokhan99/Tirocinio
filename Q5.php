<?php
// core configuration
include_once "config/core.php";

include_once 'config/database.php';
include_once 'objects/user.php';
include_once 'objects/q5.php';

// page title
$order = range(1,10);
shuffle($order);
$page_index = 'q5';


$page_title = "Survey";
include_once 'config/database.php';
$database = new Database();
$db = $database->getConnection();
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (!empty($_POST)) {
    if(!fast_debug) {
        $q5 = new Q5($db,$_SESSION['user-id']);
        $q5->questions = array(check_int($_POST["R1"],0,9),
            check_int($_POST["R2"],0,9),
            check_int($_POST["R3"],0,9),
            check_int($_POST["R4"],0,9),
            check_int($_POST["R5"],0,9),
            check_int($_POST["R6"],0,9),
            check_int($_POST["R7"],0,9),
            check_int($_POST["R8"],0,9),
            check_int($_POST["R9"],0,9),
            check_int($_POST["R10"],0,9)
        );

        if (!$q5->create()) {
            die();
        }
    }
    header("Location: ".home_url."Q1.php?action=goto");

}
include_once 'q_common.php';
$_SESSION['visited_pages']['q5'] = true;
?>
<!-- TODO: fix css e capire da dove spunta il > -->
<div style='text-align: center;'>
<form action='Q5.php' method='post'>
<div style= 'font-weight: 1000;'>
    We are interested in how people think about their bodies. The questions below identify 10 different body
    attributes. We would like you to rank order these body attributes from that which has the greatest impact
    on your physical self-concept (rank this a "9"), to that which has the least impact on your physical self-
    concept (rank this a "0").<p></p>
    Note: It does not matter how you describe yourself in terms of each attribute. For example, fitness level
    can have a great impact on your physical self-concept regardless of whether you consider yourself to be
    physically fit, not physically fit, or any level in between.
    Please first consider all attributes simultaneously, and record your rank ordering by writing the ranks in
    the rightmost column.<p></p>
    IMPORTANT: Do Not Assign The Same Rank To More Than One Attribute
    9 = greatest impact
    8 = next greatest impact
    1 = next to least impact
    0 = least impact
    <p></p>
 </div>
<table class='center'>
    <tr>
        <td> When considering your physical self-concept... </td>
        <td style= 'font-weight: 1000;'>Rating</td>
    </tr>
    <?php

foreach ($order as $num ) {
    switch ($num) {
        case 1:
        default:
//TODO:set q names
        echo "
    <tr>
    <td> What rank do you assign to physical coordination ? </td>
        <td style='text-align: center'>
            <input type='number' min='0' max='9' name='R1' value='' id = 'R1' onchange='check(this)' onblur='boi(this)' required >
        </td>
    </tr>
    ";break;
        case 2:
            echo "
    <tr>
    <td> What rank do you assign to health?</td>
        <td style='text-align: center'>
            <input type='number' min='0' max='9' name='R2' value='' id = 'R2' onchange='check(this)' onblur='boi(this)' required >
        </td>
    </tr>
    ";break;
        case 3:
            echo "
    <tr>
    <td> what rank do you assign to weight? </td>
        <td style='text-align: center'>
            <input type='number' min='0' max='9' name='R3' value='' id = 'R3' onchange='check(this)' onblur='boi(this)' required >
        </td>
    </tr>
    ";break;
        case 4:
            echo "
    <tr>
    <td> What rank do you assign to strength? </td>
        <td style='text-align: center'>
            <input type='number' min='0' max='9' name='R4' value='' id = 'R4' onchange='check(this)' onblur='boi(this)' required >
        </td>
    </tr>
    ";break;
        case 5:
            echo "
    <tr>
    <td> What rank do you assign to sex appeal? </td>
        <td style='text-align: center'>
            <input type='number' min='0' max='9' name='R5' value='' id = 'R5' onchange='check(this)' onblur='boi(this)' required >
        </td>
    </tr>
    ";break;
        case 6:
            echo "
    <tr>
    <td> What rank do you assign to physical attractiveness? </td>
        <td style='text-align: center'>
            <input type='number' min='0' max='9' name='R6' value='' id = 'R6' onchange='check(this)' onblur='boi(this)' required >
        </td>
    </tr>
    ";break;
        case 7:
            echo "
    <tr>
    <td> What rank do you assign to energy level (e.g., stamina)? </td>
        <td style='text-align: center'>
            <input type='number' min='0' max='9' name='R7' value='' id = 'R7' onchange='check(this)' onblur='boi(this)' required >
        </td>
    </tr>
    ";break;
        case 8:
            echo "
    <tr>
    <td> What rank do you assign to sculpted muscles? </td>
        <td style='text-align: center'>
            <input type='number' min='0' max='9' name='R8' value='' id = 'R8' onchange='check(this)' onblur='boi(this)' required >
        </td>
    </tr>
    ";break;
        case 9:
            echo "
    <tr>
    <td> What rank do you assign to physical fitness level? </td>
        <td style='text-align: center'>
            <input type='number' min='0' max='9' name='R9' value='' id = 'R9' onchange='check(this)' onblur='boi(this)' required >
        </td>
    </tr>
    ";break;
        case 10:
            echo "
    <tr>
    <td> What rank do you assign to measurements (e.g., chest, waist, hips)?  </td>
        <td style='text-align: center'>
            <input type='number' min='0' max='9' name='R10' value='' id = 'R10' onchange='check(this)' onblur='boi(this)'  required >
        </td>
    </tr>
    ";break;
    }
}
    ?>
</table>
    <p></p>
    <input type="submit" name="action" id="button" tabindex="4" class=" btn-register form-control btn" value="Continue" disabled>
</form>
</div>

<script>
    const err = -1;
    const max = 9;
    const min = 0;
    let ans = [err,err,err,err,err, err,err,err,err,err];
    function boi(element){
        if(element.value === ''){
            document.getElementById(element.id).focus();
        }
    }
    function check(element) {
        let n = parseInt(element.id.substring(1)) -1;
        ans[n] =err;
        if(ans.includes(element.value) || element.value > max || element.value < min)
        {
           document.getElementById(element.id).value = '';
        } else {
            ans[n] = element.value;
        }
        if(!ans.includes(err))
        {document.getElementById('button').removeAttribute('disabled');}

    }

    function loadCSS(filename){

            let file = document.createElement("link");
            file.setAttribute("rel", "stylesheet");
            file.setAttribute("type", "text/css");
            file.setAttribute("href", filename);
            document.head.appendChild(file);

    }

    loadCSS("libs/CSS/Q5.css");

</script>

<?php

// footer HTML and JavaScript codes
include_once "layout_foot.php";








