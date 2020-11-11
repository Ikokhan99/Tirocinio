<?php

include_once "config/core.php";
$action = '';
$page_title="Start";
include_once 'layout_head.php';


if(isset($_SESSION['at']))
{
    $_SESSION['permutation'] = 0;
    $text = "Imagine that you have just started a new video game and find yourself having to choose your personal avatar.<br>
		<br>You will be faced with various pairs of avatars; for each couple choose your favorite avatar by pressing the <b>right arrow</b> (&#8594) or <b>left</b> (&#8592) from the keyboard to select the corresponding avatar. <br><br>(<b>right arrow = right avatar </b> & <b> left arrow = left avatar</b>).<br><br><br>";
    $title="Continue Test";
    $f="to continue";
    if($_SESSION['at'] == 0)
    {
        //fist part
        $title="Begin test";
        $f="to start ";

        if(!fast_debug)
        {
            include_once 'config/database.php';
            include_once 'objects/user.php';

            $database = new Database();
            $db = $database->getConnection();

            $user = new User($db);
            $user->create();
        }



    } elseif ($_SESSION['at'] == 2){
        if(!fast_debug) {
            //getting chosen avatars
            include_once 'config/database.php';
            $database = new Database();
            $db = $database->getConnection();
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $mix_av = array();


            $q = "SELECT DISTINCT a.id AS id,a.pic AS pic,a.sex AS sex from avatar AS a INNER JOIN choice AS c ON (a.id = c.chosen)where c.user_id=:id";
            $stmt = $db->prepare($q);
            $stmt->bindParam(':id', $_SESSION['uid']);
            $result = $stmt->execute();
            for ($i = 0; $mix_av[$i] = mysqli_fetch_assoc($result); $i++) ;
            // Delete last empty one
            array_pop($mix_av);
            if (debug) {
                echo "<p>Avatar scelti  </p>";
                print_r($mix_av);
            }
            //permutazioni?
            $_SESSION['p_mix'] = array();
            exec_combine(2,range(1,16),3);
            shuffle($_SESSION['p_male']);
            if(debug)
            {
                print_r($result);
            }

            //TODO: delete delle coppie same sex?
            foreach ($result as $k => $value) {
                if($value[0]['sex'] == $value[1]['sex']){
                    unset($result[$k]);
                }
            }

            $_SESSION['p_mix'] = $result;

        }
        else{
            echo "<pre>
    FAST DEBUG: skipping mixed section
   </pre>";
        }
    }
    echo "<table class='center'><tr><td><table class='table80-3'><tr><td>";
    echo "<h1>" .$title. "</h1><br>";
    echo $text. "Take the time you need and when you are ready ".$f." click the button \"Start\" placed at the bottom.";
    echo "<br><br><br>";
    echo "<a href='choice.php' class='btn btn-primary'>Start</a>";

    if(debug){
        print_r($_SESSION["at"]);
    }


} else {
    echo "<pre>
    Spiacenti, si è verificato un errore
   </pre>";
}

