<?php

include_once 'config/core.php';
include_once 'config/permutations.php';//used for male and female order
$action = '';
$page_title = 'Start';
include_once 'layout_head.php';

if(isset($_GET['PROLIFIC_PID']))
    {
        $_SESSION['prolific'] = true;
        // $_SESSION['user-id'] = $_GET['PROLIFIC_PID'];  already set in user create
        $id = $_GET['PROLIFIC_PID'];
        if($_GET['STUDY_ID'] === 'Mavatar') {
            $_SESSION['user-sex'] = 0;
            $_SESSION['final_url'] = "https://app.prolific.co/submissions/complete?cc=CC4A225F";
        } // male participants
        else {
            $_SESSION['user-sex'] = 1;
            $_SESSION['final_url'] = "https://app.prolific.co/submissions/complete?cc=4F67FA61";
        } // female participants
    }
else{
    $id = null;
}



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
$_SESSION['exp'][] = 3; //the mix should always be last

$q_order = range(3, 5);

shuffle($q_order);
$q_order[] = 2;
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
//Q5 questions order.

$q_order = range(1, 10);
shuffle($q_order);
$_SESSION['Q5'] = $q_order;

//db
if (!fast_debug) {
    include_once 'objects/user.php';
    /** @var  $db , declared and initialized in head */
    $user = new User($db);
    if(isset($_SESSION['user-sex'])) {
        $user->sex = $_SESSION['user-sex'];
    }
    else {
        try {
            $user->sex = random_int(0, 1);
        } catch (Exception $e) {
            $error = true;
        }
    }
    $error = !$user->create($id);
}

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


if ((isset($error) && $error === false) || fast_debug) {

    echo "
        <div class='wrap'>
            <div class='main-container'>
            
                <img src='img/exp-max.png' style='grid-row: 1; grid-column: 1' alt='experiment-example-image'>
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

    <script type="text/javascript">
        loadCSS("libs/CSS/index.css");
    </script>

<?php

} else {
    echo "<pre>
    An error has occurred. Don't worry, it's our fault, your Prolific reputation won't be affected.
   </pre>";
}

// footer HTML and JavaScript codes
include "layout_foot.php";

