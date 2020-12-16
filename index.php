<?php

include_once "config/core.php";
include_once 'config/permutations.php';//used for male and female order
$action = '';
$page_title="Start";
include_once 'layout_head.php';


//Here we're going to set the order of everything, it should be faster than making lots of db queries. And this is totally not one on the previous author.
//NB: everything should be taken in one session, as the PM request. Also, the user must not change page inside the experiment (e.g. The user is in Q2 and goes to Q3
$_SESSION["visited_pages"] = array('index'=>true,
    'Scelta1'=>false,
    'Scelta2'=>false,
    'Scelta3'=>false,
    'q1'=>false,
    'q2'=>false,
    'q3'=>false,
    'q4'=>false,
    'q5'=>false,
    'error'=>false);
$_SESSION["time"] = time();

//experiment order
$exp_order = range(1,2); // 1 = male, 2 = female
shuffle($exp_order);
$_SESSION['exp'] = $exp_order; //saving in session
array_push($_SESSION['exp'],3); //the mix should always be last

$q_order = range(3,5);

shuffle($q_order);
array_push($q_order,2) ;
$_SESSION['Q'] = $q_order;
//male order
$_SESSION['p_male'] = array();
exec_combine(2,range(1,16),1);
shuffle($_SESSION['p_male']);
//female order
$_SESSION['p_female'] = array();
exec_combine(2,range(1,16),2);
shuffle($_SESSION['p_female']);
//the mix order will be made only from chosen avatar, so it will be in SceltaAvatar.php
//Q3 questions order.  0 and 23 are the control questions
$q_order = range(0,23);

shuffle($q_order);
$_SESSION['Q3'] = $q_order;
//Q4 questions order.  0 and 11 are the control questions
$q_order = range(0,11);

shuffle($q_order);
$_SESSION['Q4'] = $q_order;
//Q5 questions order.  TODO: creare il nuovo questionario
//TODO: $q_order = range(0,11); 

shuffle($q_order);
$_SESSION['Q5'] = $q_order;

//db
if(!fast_debug)
{
include_once 'objects/user.php';
/** @var  $db, declared and initialized in head */
$user = new User($db);
$error = !$user->create();
}


//now, time for the avatar's img
//if(fast_debug)
//{
$m_img = array(   "avatar/01_m".IMG_EXT,
        "avatar/02_m".IMG_EXT,
        "avatar/03_m".IMG_EXT,
        "avatar/04_m".IMG_EXT,
        "avatar/05_m".IMG_EXT,
        "avatar/06_m".IMG_EXT,
        "avatar/07_m".IMG_EXT,
        "avatar/08_m".IMG_EXT,
        "avatar/09_m".IMG_EXT,
        "avatar/10_m".IMG_EXT,
        "avatar/11_m".IMG_EXT,
        "avatar/12_m".IMG_EXT,
        "avatar/13_m".IMG_EXT,
        "avatar/14_m".IMG_EXT,
        "avatar/15_m".IMG_EXT,
        "avatar/16_m".IMG_EXT);
$f_img = array(   "avatar/01_f".IMG_EXT,
    "avatar/02_f".IMG_EXT,
    "avatar/03_f".IMG_EXT,
    "avatar/04_f".IMG_EXT,
    "avatar/05_f".IMG_EXT,
    "avatar/06_f".IMG_EXT,
    "avatar/07_f".IMG_EXT,
    "avatar/08_f".IMG_EXT,
    "avatar/09_f".IMG_EXT,
    "avatar/10_f".IMG_EXT,
    "avatar/11_f".IMG_EXT,
    "avatar/12_f".IMG_EXT,
    "avatar/13_f".IMG_EXT,
    "avatar/14_f".IMG_EXT,
    "avatar/15_f".IMG_EXT,
    "avatar/16_f".IMG_EXT);
/*} else {
    include_once 'config/database.php';
    $m_img = array();
    $f_img = array();

    $default=0;

    //male
    $q = "SELECT pic from avatar where sex=:sex";
    $stmt = $_SESSION['db']->prepare($q);
    //male
    $stmt->bindParam(':sex', $default);
    $result = $stmt->execute();
    for($i = 0; $m_img[$i] = mysqli_fetch_assoc($result); $i++) ;
    // Delete last empty one
    array_pop($array);
    //female
    $default=1;
    $stmt->bindParam(':sex', $default);
    $result = $stmt->execute();
    for($i = 0; $f_img[$i] = mysqli_fetch_assoc($result); $i++) ;
    // Delete last empty one
    array_pop($array);
    //TODO:add extension
    if(debug)
    {
        echo "<p>Imagini avatar maschili  </p>";
        print_r($m_img);
        echo "<p>Imagini avatar femminili  </p>";
        print_r($f_img);
    }
}*/
$_SESSION['i_male'] = $m_img;
$_SESSION['i_female'] = $f_img;




$_SESSION['at'] = 0;
if(debug){
    echo "<p>Ordine questionari:  </p>";
    print_r($_SESSION['Q']);
    echo "<p>Ordine esperimento:  </p>";
    print_r($_SESSION['exp']);
    echo "<p>Ordine male:  </p>";
    print_r($_SESSION['i_male']);
    echo "<p>Ordine female:  </p>";
    print_r($_SESSION['i_female']);
    echo "<p>Perm male:  </p>";
    print_r($_SESSION['p_male']);
    echo "<p>Perm female:  </p>";
    print_r($_SESSION['p_female']);
    echo "<p>Temporary User Id  </p>";
    print_r($_SESSION['user-id']);
}

/*
if(!fast_debug){
    //start transaction
    $_SESSION['db']->exec('DECLARE `_rollback` BOOL DEFAULT 0;');
    $_SESSION['db']->exec('DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET `_rollback` = 1;');
}*/


// create the user and start transaction
if((isset($error)&& $error === false)|| fast_debug)
{

echo "
        <div class='container'>
            <div class='row'>
                <div class=\"jumbotron\">
                    <h1 class=\"display-4\">Experiment</h1>
                    <p class=\"lead\">		In this experiment, we ask you to choose between two images. We ask you not to be in haste to complete the experiment and to pay attention to which image you choose (take it easy and be concentrated). After this task, you will take a survey. </p>
                    <hr class=\"my-4\">
                     <p class=\"lead\">
                    Before starting we inform you that <strong >you will not be allowed </strong> to reload the web page, 
                    close the browser or start the experiment and finish it after some time.  
                    </p>
                    <p class=\"lead\">
                    <form action='SceltaAvatar.php' method='post'>
                        <input type='submit' class='btn btn-primary btn-lg' name='submit' id='submit' value=\"Let's go!\">
                        <input type='hidden' name='navigation' id='navigation' value='safe'>
                    </form>   
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
    An error have occurred. Don't worry, it's our fault, your Prolific reputation won't be inficiated.
   </pre>";
}

// footer HTML and JavaScript codes
include 'layout_foot.php';

