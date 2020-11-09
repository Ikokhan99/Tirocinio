<?php

include_once "config/core.php";
$action = '';
$page_title="Start";
include_once 'layout_head.php';


$exp_order = range(1,2); // 1 = male, 2 = female
$q_order = range(1,4); //end
shuffle($exp_order);
shuffle($q_order);
$_SESSION['exp'] = $exp_order;
array_push($_SESSION['exp'],3);
$_SESSION['Q'] = $q_order;
/** @var TYPE_NAME $debug */
$_SESSION['at'] = 0;
if($debug){
    echo "<p>Ordine questionari:  </p>";
    print_r($_SESSION['Q']);
    echo "<p>Ordine esperimento:  </p>";
    print_r($_SESSION['exp']);
}

/** @var TYPE_NAME $fast_debug */
if(!$fast_debug){
    //start transaction
    include_once 'config/database.php';
    $database = new Database();
    $db = $database->getConnection();
    $db->exec('DECLARE `_rollback` BOOL DEFAULT 0;');
    $db->exec('DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET `_rollback` = 1;');
}


// create the user and start transaction
if((isset($db)&& $db->beginTransaction())|| $fast_debug)
{



echo "
        <div class='container'>
            <div class='row'>
                <div class=\"jumbotron\">
                    <h1 class=\"display-4\">Experiment</h1>
                    <p class=\"lead\">Todo: modificare le scritte e la grafica</p>
                    <hr class=\"my-4\">
                    
                    <p class=\"lead\">
                        <a class=\"btn btn-primary btn-lg\" href=\"SceltaAvatar.php\" role=\"button\">Let's go!</a>
                    </p>
                </div>
            </div>
            
            <style>
    .jumbotron {
        background-image: url(./img/exp.png);
        background-size: cover;
        height: 100%;}
</style>";
}
else{
    echo "<pre>
    Spiacenti, si è verificato un errore
   </pre>";
}

// footer HTML and JavaScript codes
include 'layout_foot.php';

