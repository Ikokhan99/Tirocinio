<?php

include_once "config/core.php";
include_once 'config/permutations.php';//used for male and female order
$action = '';
$page_title="Start";
include_once 'layout_head.php';


//Here we're going to set the order of everything, it should be faster than making lots of db queries
//NB: everything should be taken in one session, as the PM request

//experiment order
$exp_order = range(1,2); // 1 = male, 2 = female
shuffle($exp_order);
$_SESSION['exp'] = $exp_order; //saving in session
array_push($_SESSION['exp'],3); //the mix should always be last
//questionnaires order
$q_order = range(1,4);
shuffle($q_order);
$_SESSION['Q'] = $q_order;
//male order
$result = iterator_to_array(permutations(range(1,16), 2));
shuffle($result);
$_SESSION['p_male'] = $result;
//female order
shuffle($result);
$_SESSION['p_female'] = $result;
//the mix order will be made only from chosen avatars, so it will be in SceltaAvatar.php
//now, time for the avatar's img


if(fast_debug)
{
    $m_img = array(   "avatars/01_m".IMG_EXT,
        "avatars/02_m".IMG_EXT,
        "avatars/03_m".IMG_EXT,
        "avatars/04_m".IMG_EXT,
        "avatars/05_m".IMG_EXT,
        "avatars/06_m".IMG_EXT,
        "avatars/07_m".IMG_EXT,
        "avatars/08_m".IMG_EXT,
        "avatars/09_m".IMG_EXT,
        "avatars/010_m".IMG_EXT,
        "avatars/011_m".IMG_EXT,
        "avatars/012_m".IMG_EXT,
        "avatars/013_m".IMG_EXT,
        "avatars/014_m".IMG_EXT,
        "avatars/015_m".IMG_EXT,
        "avatars/016_m".IMG_EXT);
    $f_img = array(   "avatars/01_f".IMG_EXT,
    "avatars/02_f".IMG_EXT,
    "avatars/03_f".IMG_EXT,
    "avatars/04_f".IMG_EXT,
    "avatars/05_f".IMG_EXT,
    "avatars/06_f".IMG_EXT,
    "avatars/07_f".IMG_EXT,
    "avatars/08_f".IMG_EXT,
    "avatars/09_f".IMG_EXT,
    "avatars/010_f".IMG_EXT,
    "avatars/011_f".IMG_EXT,
    "avatars/012_f".IMG_EXT,
    "avatars/013_f".IMG_EXT,
    "avatars/014_f".IMG_EXT,
    "avatars/015_f".IMG_EXT,
    "avatars/016_f".IMG_EXT);
} else {
    include_once 'config/database.php';
    $database = new Database();
    $db = $database->getConnection();
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $m_img = array();
    $f_img = array();

    //male
    $q = "SELECT pic from avatar where sex=:sex";
    $stmt = $db->prepare($q);
    //male
    $stmt->bindParam(':sex', 0);
    $result = $stmt->execute();
    for($i = 0; $m_img[$i] = mysqli_fetch_assoc($result); $i++) ;
    // Delete last empty one
    array_pop($array);
    //female
    $stmt->bindParam(':sex', 1);
    $result = $stmt->execute();
    for($i = 0; $f_img[$i] = mysqli_fetch_assoc($result); $i++) ;
    // Delete last empty one
    array_pop($array);
    if(debug)
    {
        echo "<p>Imagini avatar maschili  </p>";
        print_r($m_img);
        echo "<p>Imagini avatar femminili  </p>";
        print_r($f_img);
    }
}
$_SESSION['i_male'] = $m_img;
$_SESSION['i_female'] = $f_img;




$_SESSION['at'] = 0;
if(debug){
    echo "<p>Ordine questionari:  </p>";
    print_r($_SESSION['Q']);
    echo "<p>Ordine esperimento:  </p>";
    print_r($_SESSION['exp']);
}


if(!fast_debug){
    //start transaction
    //include_once 'config/database.php';
    //$database = new Database();
    //$db = $database->getConnection();
    $db->exec('DECLARE `_rollback` BOOL DEFAULT 0;');
    $db->exec('DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET `_rollback` = 1;');
}


// create the user and start transaction
if((isset($db)&& $db->beginTransaction())|| fast_debug)
{
    if(!fast_debug){
        include_once 'objects/user.php';
        $user = new User($db);
        $user->create();

    }



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

