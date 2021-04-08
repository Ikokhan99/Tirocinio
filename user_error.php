<?php
include_once 'config/core.php';
include_once 'config/Database.php';

$error = '';
switch($_GET['error']){
    case 'error':{
        $error = 'Error page was already visited';
        break;
    }
    case 'already_visited':{
        $error = 'The previous page has already been visited';
        break;
    }
    case 'navigation':{
        $error = 'The navigation was altered (refresh or reload)';
        break;
    }
    case 'avatar':{
        $error = 'The 2 last avatar couples presented were identical, so the page has been reloaded';
        if(debug)
        {
            var_dump($_SESSION['p_male']);
            var_dump($_SESSION['p_female']);
            error_log("User ".$_SESSION['user-id'] . "has encountered an identical couple.\n\tPermutations: ".print_r($_SESSION['p_male']) ."\n\n".print_r($_SESSION['p_male']));
        }
        break;

    }
}

//include_once "layout_head.php";
echo $error;
error_log("USER ".$_SESSION["user-id"].": $error\n ");
$_SESSION['visited_pages']['error'] = true;

$database = new Database();
$db = $database->getConnection();
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$q = "UPDATE user SET trusted = 1 where id='".$_SESSION['user-id']."';";
$stmt = $db->query($q);
die(0);

//include_once "layout_foot.php";
//user error page ok, TODO:debug