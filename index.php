<?php

include_once 'config/core.php';
include_once 'config/permutations.php';//used for male and female order
$action = '';
$page_title = 'Start';
include_once 'layout_head.php';


//Here we're going to set the order of everything, it should be faster than making lots of db queries. And this is totally not one on the previous author.
//NB: everything should be taken in one session, as the PM request. Also, the user must not change page inside the experiment (e.g. The user is in Q2 and goes to Q3
$_SESSION['visited_pages'] = array('index' => true,
    'Scelta1' => false,
    'Scelta2' => false,
    'Scelta3' => false,
    'q1' => false,
    'q2' => false,
    'q3' => false,
    'q4' => false,
    'q5' => false,
    'error' => false);
$_SESSION['time'] = time();

//experiment order
$exp_order = range(1, 2); // 1 = male, 2 = female
shuffle($exp_order);
$_SESSION['exp'] = $exp_order; //saving in session
array_push($_SESSION['exp'], 3); //the mix should always be last

$q_order = range(3, 5);

shuffle($q_order);
array_push($q_order, 2);
$_SESSION['Q'] = $q_order;
//male order
$_SESSION['p_male'] = array();
exec_combine(2, range(1, 16), 1);
shuffle($_SESSION['p_male']);
//female order
$_SESSION['p_female'] = array();
exec_combine(2, range(1, 16), 2);
shuffle($_SESSION['p_female']);
//the mix order will be made only from chosen avatar, so it will be in SceltaAvatar.php
//Q3 questions order.  0 and 23 are the control questions
$q_order = range(0, 23);

shuffle($q_order);
$_SESSION['Q3'] = $q_order;
//Q4 questions order.  0 and 11 are the control questions
$q_order = range(0, 11);

shuffle($q_order);
$_SESSION['Q4'] = $q_order;
//Q5 questions order.  TODO: creare il nuovo questionario
//TODO: $q_order = range(0,11); 

shuffle($q_order);
$_SESSION['Q5'] = $q_order;

//db
if (!fast_debug) {
    include_once 'objects/user.php';
    /** @var  $db , declared and initialized in head */
    $user = new User($db);
    $error = !$user->create();
}


//now, time for the avatar's img
//if(fast_debug)
//{
$m_img = array('avatar/01_m' . IMG_EXT,
    'avatar/02_m' . IMG_EXT,
    'avatar/03_m' . IMG_EXT,
    'avatar/04_m' . IMG_EXT,
    'avatar/05_m' . IMG_EXT,
    'avatar/06_m' . IMG_EXT,
    'avatar/07_m' . IMG_EXT,
    'avatar/08_m' . IMG_EXT,
    'avatar/09_m' . IMG_EXT,
    'avatar/10_m' . IMG_EXT,
    'avatar/11_m' . IMG_EXT,
    'avatar/12_m' . IMG_EXT,
    'avatar/13_m' . IMG_EXT,
    'avatar/14_m' . IMG_EXT,
    'avatar/15_m' . IMG_EXT,
    'avatar/16_m' . IMG_EXT);
$f_img = array('avatar/01_f' . IMG_EXT,
    'avatar/02_f' . IMG_EXT,
    'avatar/03_f' . IMG_EXT,
    'avatar/04_f' . IMG_EXT,
    'avatar/05_f' . IMG_EXT,
    'avatar/06_f' . IMG_EXT,
    'avatar/07_f' . IMG_EXT,
    'avatar/08_f' . IMG_EXT,
    'avatar/09_f' . IMG_EXT,
    'avatar/10_f' . IMG_EXT,
    'avatar/11_f' . IMG_EXT,
    'avatar/12_f' . IMG_EXT,
    'avatar/13_f' . IMG_EXT,
    'avatar/14_f' . IMG_EXT,
    'avatar/15_f' . IMG_EXT,
    'avatar/16_f' . IMG_EXT);
/*} else {
    include_once 'config/database.php';
    $m_img = array();
    $f_img = array();

    $default=0;

    //male
    $q = 'SELECT pic from avatar where sex=:sex';
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
        echo '<p>Imagini avatar maschili  </p>';
        print_r($m_img);
        echo '<p>Imagini avatar femminili  </p>';
        print_r($f_img);
    }
}*/
$_SESSION['i_male'] = $m_img;
$_SESSION['i_female'] = $f_img;


$_SESSION['at'] = 0;
if (debug) {
    echo '<p>Ordine questionari:  </p>';
    print_r($_SESSION['Q']);
    echo '<p>Ordine esperimento:  </p>';
    print_r($_SESSION['exp']);
    echo '<p>Ordine male:  </p>';
    print_r($_SESSION['i_male']);
    echo '<p>Ordine female:  </p>';
    print_r($_SESSION['i_female']);
    echo '<p>Perm male:  </p>';
    print_r($_SESSION['p_male']);
    echo '<p>Perm female:  </p>';
    print_r($_SESSION['p_female']);
    echo '<p>Temporary User Id  </p>';
    print_r($_SESSION['user-id']);
}

/*
if(!fast_debug){
    //start transaction
    $_SESSION['db']->exec('DECLARE `_rollback` BOOL DEFAULT 0;');
    $_SESSION['db']->exec('DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET `_rollback` = 1;');
}*/


// create the user and start transaction
if ((isset($error) && $error === false) || fast_debug) {

    echo "
        <div class='wrap'>
            <div class='main-container'>
            
                <img src='img/exp-max.png' style='grid-row: 1; grid-column: 1' >
                </img>
                <div class='mid-section' style='grid-row: 2 ;  grid-column: 1;'>
                     <div style='grid-column: 2;'>
                        <div class='t1'> In this experiment, we will present you with two images of avatars that you might use in a video game. Each time we will ask you to choose which avatar you prefer. <br></div>
                        <div class='t2'>You can take as much time as you want to make your choice.<br></div>
                        <div class='t3'>It is important that you always indicate the avatar you honestly like the most. <br></div>
                        <div class='t4'>After this task, you will be asked to respond to a survey.<br></div>
                    </div>
                </div>
                <div style=' grid-row: 3; grid-column: 1;'>
                    <div class='end-section'>
                         <div style='grid-row: 1 ;  grid-column: 1;' >
                         Before starting we inform you that <strong >you will not be allowed </strong> to reload the web page, 
                        close the browser or restart the experiment and finish it later.  
                        </div>
                        <div class='button-section' style='grid-row: 2 ;  grid-column: 1;'>
                            <form action='SceltaAvatar.php' method='post' style='grid-row: 1 ;  grid-column: 2;'>
                                <input type='submit' class='btn btn-primary btn-lg' name='submit' id='submit' value=\"Let's go!\">
                                <input type='hidden' name='navigation' id='navigation' value='safe'>
                            </form>   
                        </div>
                    </div>  
                </div>                  
            </div>
        </div>";
    ?>
    <style>

        @media only screen and ( max-width: 360px ) {

            .main-container {
                margin: 0 auto;
                padding: 1em;
                display: grid;
                grid-gap: 2px;
                grid-template-columns: 100%;
                font-size: smaller;

            }

            .button-section{
                margin: 0 auto;
                padding: 0;
                display: grid;
                grid-gap: 2px;
                grid-template-columns: 1fr 2fr 1fr;
            }
            .mid-section {
                margin: 0 auto;
                padding: 1em;
                display: grid;
                grid-gap: 2px;
                grid-template-columns: auto auto auto;
                text-align: justify-all;

            }

            .end-section {
                margin: 0 auto;
                padding: 1em;
                display: grid;
                grid-gap: 2px;
                grid-template-columns: 100%;
                align-content: center;
                align-items: center;
                vertical-align: center;
                text-align: center;
            }

        }

        @media only screen and ( min-width: 360px ) {

            .main-container {
                margin: 0 auto;
                padding: 1em;
                display: grid;
                grid-gap: 2px;
                grid-template-columns: 100%;

            }

            .button-section{
                margin: 0 auto;
                padding: 0;
                display: grid;
                grid-gap: 2px;
                grid-template-columns: 1fr 2fr 1fr;
            }
            .mid-section {
                margin: 0 auto;
                padding: 1em;
                display: grid;
                grid-gap: 2px;
                grid-template-columns: auto auto auto;
                text-align: justify-all;

            }

            .end-section {
                margin: 0 auto;
                padding: 1em;
                display: grid;
                grid-gap: 2px;
                grid-template-columns: 100%;
                align-content: center;
                align-items: center;
                vertical-align: center;
                text-align: center;
            }

        }
            
        
            @media only screen and (min-width: 480px) {

                .main-container {
                    margin: 0 auto;
                    padding: 1em;
                    display: grid;
                    grid-gap: 2px;
                    grid-template-columns: 100%;

                }

                .button-section{
                    margin: 0 auto;
                    padding: 0;
                    display: grid;
                    grid-gap: 2px;
                    grid-template-columns: 1fr 2fr 1fr;
                }
                .mid-section {
                    margin: 0 auto;
                    padding: 1em;
                    display: grid;
                    grid-gap: 2px;
                    grid-template-columns: auto auto auto;
                    text-align: justify-all;

                }

                .end-section {
                    margin: 0 auto;
                    padding: 1em;
                    display: grid;
                    grid-gap: 2px;
                    grid-template-columns: 100%;
                    align-content: center;
                    align-items: center;
                    vertical-align: center;
                    text-align: center;
                }
           
            }
        @media only screen and (min-width: 760px) {

            .main-container {
                font-size: medium;
                }

            }
          
            @media only screen and (min-width: 960px) {

             .main-container {
                margin: 0 auto;
                padding: 1em;
                display: grid;
                grid-gap: 2px;
                grid-template-columns: 100%;

            }

            .button-section{
                margin: 0 auto;
                padding: 0;
                display: grid;
                grid-gap: 2px;
                grid-template-columns: 1fr 2fr 1fr;

                }
            .mid-section {
                margin: 0 auto;
                padding: 1em;
                display: grid;
                grid-gap: 2px;
                grid-template-columns: 152px auto 152px;
                text-align: center;

                }

            .end-section {
                margin: 0 auto;
                padding: 1em;
                display: grid;
                grid-gap: 2px;
                grid-template-columns: 100%;
                align-content: center;
                align-items: center;
                vertical-align: center;
                text-align: center;
                }

            }

            @media only screen and (min-width: 1200px) {
            
            .main-container {
                margin: 0 auto;
                padding: 1em;
                display: grid;
                grid-gap: 2px;
                grid-template-columns: 100%;
        
            }

                .button-section{
                    margin: 0 auto;
                    padding: 0;
                    display: grid;
                    grid-gap: 2px;
                    grid-template-columns: 1fr 2fr 1fr;

                }
            .mid-section {
                margin: 0 auto;
                padding: 1em;
                display: grid;
                grid-gap: 2px;
                grid-template-columns: 152px auto 152px;

                }
                
            .end-section {
                margin: 0 auto;
                padding: 1em;
                display: grid;
                grid-gap: 2px;
                grid-template-columns: 100%;
                }

            
            }

            /*
            @media only screen and (min-width: 1440px) {
            
            .main-container {
        
            }
            
            .first-section{

                }
            .mid-section {

                }
                
            .end-section {

                }
                
            .jumbotron {

                 }
            }
            @media only screen and (min-width: 1920px) {
            
            .main-container {

        
            }
            
            .first-section{

                }
            .mid-section {

                }
                
            .end-section {

                }
                
            .jumbotron {

                 }

            }*/
            




  @media only screen and (min-height: 360px) {
            .main-container {
                grid-template-rows: 100px 120px 100px ;
                font-size: smaller;
            }
            .button-section{
                grid-template-rows: 100% ;
                }
            .mid-section {
                grid-template-rows: 100% ;
                text-align: center;
                }
            .end-section {
                grid-template-rows: 30px 62px;
                }
            .btn{
                height: 36px;
                font-size: small;
            }

  }
        @media only screen and (min-height: 560px) {
            .main-container {
                grid-template-rows: 220px 170px 150px ;
                font-size: smaller;
            }
            .button-section{
                grid-template-rows: auto auto auto ;
            }
            .mid-section {
                grid-template-rows: 100% ;
                text-align: center;
            }
            .end-section {
                grid-template-rows: 62px 60px;
            }
            .btn{
                height: 36px;
                font-size: small;
            }

        }



        @media only screen and (min-height: 640px) {
            .main-container {
                grid-template-rows: 300px 150px 130px ;
                font-size: smaller;
            }
            .button-section{
                grid-template-rows: auto auto auto ;
            }
            .mid-section {
                grid-template-rows: 100% ;
                text-align: center;
            }
            .end-section {
                grid-template-rows: 80px 40px;
            }
            .btn{
                height: 36px;
                font-size: small;
            }

        }

        @media only screen and (min-height: 650px) {
            .main-container {
                grid-template-rows: 220px 170px 150px ;
                font-size: smaller;
            }
            .button-section{
                grid-template-rows: 100% ;
            }
            .mid-section {
                grid-template-rows: 100% ;
                text-align: center;
            }
            .end-section {
                grid-template-rows: 65px 65px;
            }
            .btn{
                height: 36px;
                font-size: small;
            }

        }

        @media only screen and (min-height: 720px) {
            .main-container {
                grid-template-rows: 300px 200px 200px ;
                font-size: medium;
            }
            .button-section{
                grid-template-rows: auto auto auto ;
            }
            .mid-section {
                grid-template-rows: 100% ;
            }
            .end-section {
                grid-template-rows: 90px 90px;
            }

            .btn{
                height:50px;
                font-size: medium;
            }

        }
            
            @media only screen and (min-height: 850px) {
            .main-container {
                grid-template-rows: 450px 175px 150px ;
            }
            .button-section{
                grid-template-rows: auto auto auto ;
                }
            .mid-section {
                grid-template-rows: 100% ;
                } 
            .end-section {
                grid-template-rows: 70px 70px;
                }  

            }

      
            @media only screen and (min-height: 1080px) {
            .main-container {
                grid-template-rows: 600px 250px 200px ;
                font-size: large;
                text-align: left;
            }
            .button-section{
                grid-template-rows: auto auto auto ;
                }
            .mid-section {
                grid-template-rows: 100% ;
                } 
            .end-section {
                grid-template-rows: 50px 120px;
                }  

            }
        @media only screen and (min-height: 1300px) {
            .main-container {
                grid-template-rows: 800px 250px 200px ;
                font-size: larger;
                text-align: left;
            }
            .button-section{
                grid-template-rows: auto auto auto ;
            }
            .mid-section {
                grid-template-rows: 100% ;
            }
            .end-section {
                grid-template-rows: 60px 120px;
            }
            .btn{
                width: 170px;
                height:70px;
                font-size: larger;

            }

        }

            </style>
<?php

} else {
    echo "<pre>
    An error has occurred. Don't worry, it's our fault, your Prolific reputation won't be affected.
   </pre>";
}

// footer HTML and JavaScript codes
include "layout_foot.php";

