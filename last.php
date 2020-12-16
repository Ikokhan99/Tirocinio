<?php

include_once "config/core.php";
include_once "layout_head.php";
echo "<table class='center'><tr><td>
        <table class='table80'>
        <tr><td>";
echo "
<h3 style='align-content: center'>The experiment is over, thanks for your participation!</h3>
</td></tr></table></td></tr></table>";


include_once 'config/database.php';
$database = new Database();
$db = $database->getConnection();
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$time = time() - $_SESSION['time'];
$q = "UPDATE user SET time = ".$time."where id= '".$_SESSION['user_id']."' ";
$stmt = $db->prepare($q);
if(debug){
    var_dump($stmt);
}
$stmt->execute();

//todo: redirect a prolific

session_destroy();
include_once "layout_foot.php";
