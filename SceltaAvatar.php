<?php
include_once "config/core.php";
if(!empty($_POST) && (!isset($_POST['navigation']) || $_POST['navigation'] !== 'safe')){
    if($_SESSION['visited_pages']['error']) {
        header("Location: ".home_url."user_error.php");
    }
}

$action = '';
$page_title="Start";

include_once 'config/Foes.php';

include_once 'config/database.php';
if(isset($page_title)&& ($page_title!="Experiment" || $page_title!="Survey")){
    $database = new Database();
    $db = $database->getConnection();
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}

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
           
            include_once 'objects/user.php';
            /** @var $db, declared in head */
            $user = new User($db);
            $user->create();
        }
        $page_index = 'Scelta1';

    } elseif ($_SESSION['at'] == 1){
        $page_index = 'Scelta2';
    }
    elseif ($_SESSION['at'] == 2){
        $page_index = 'Scelta3';
        //mix case
        if(!fast_debug) {
            //getting most chosen avatars
            
            $mix_av = array();
//
//select chosen from choice where type = 0 AND user_id = 'dummyFYGkMfNP3B5CLt7YC965wjazS' group by chosen order by count(*) desc limit 5;

            //5 most frequent choices for males
            $q = "select chosen from choice where type = :type AND user_id = '".$_SESSION['user-id']."' group by chosen order by count(*) desc limit 5;";
            $type=0;
            $k =0;
            /** @var $db, declared in head */
            $stmt = $db->prepare($q);
           // $stmt->bindParam(':id', $_SESSION['user-id']);
            $stmt->bindParam(':type', $type);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
            for($i = 0; $i< count($result);$i++)
            {
                $result[$i] = strval($result[$i]) . "m";
            }
            if(debug)
               print_r($result);
            //5 most frequent choices for females
            $type=1;
           // $stmt->bindParam(':id', $_SESSION['user-id']);
            $stmt->bindParam(':type', $type);
            $stmt->execute();
            $result2 = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
            for($i = 0; $i< count($result2);$i++)
            {
                $result2[$i] = strval($result2[$i]) . "f";
            }
            $result = array_merge($result, $result2 );


            if(debug){
                print_r($q);
                //var_dump($db);
                echo "<p>Avatar scelti  </p>";
                var_dump($result);

            }

            //probabilmente è più comodo farlo a mano
           /* $_SESSION['p_mix'] = array(
            0=>array(0=>$result[0],1=>$result[5]),
                1=>array(0=>$result[0],1=>$result[6]),
                2=>array(0=>$result[0],1=>$result[7]),
                3=>array(0=>$result[0],1=>$result[8]),
                4=>array(0=>$result[0],1=>$result[9]),
            6=>array(0=>$result[1],1=>$result[5]),
                7=>array(0=>$result[1],1=>$result[6]),
                8=>array(0=>$result[1],1=>$result[7]),
                9=>array(0=>$result[1],1=>$result[8]),
                10=>array(0=>$result[1],1=>$result[9]),
            11=>array(0=>$result[2],1=>$result[5]),
                12=>array(0=>$result[2],1=>$result[6]),
                13=>array(0=>$result[2],1=>$result[7]),
                14=>array(0=>$result[2],1=>$result[8]),
                15=>array(0=>$result[2],1=>$result[9]),
            16=>array(0=>$result[3],1=>$result[5]),
                17=>array(0=>$result[3],1=>$result[6]),
                18=>array(0=>$result[3],1=>$result[7]),
                19=>array(0=>$result[3],1=>$result[8]),
                20=>array(0=>$result[3],1=>$result[9]),
            21=>array(0=>$result[4],1=>$result[5]),
                22=>array(0=>$result[4],1=>$result[6]),
                23=>array(0=>$result[4],1=>$result[7]),
                24=>array(0=>$result[4],1=>$result[8]),
                25=>array(0=>$result[4],1=>$result[9])
            );
            shuffle($_SESSION['p_mix']);*/
            //shuffle order

            //permutazioni?
            include_once "config/permutations.php";
            $_SESSION['p_mix'] = array();
            exec_combine(2,$result,3);
            shuffle($_SESSION['p_mix']);
            if(debug)
            {
                echo "<p>Mix:  </p>";
                print_r($_SESSION['p_mix']);
            }

            //delete delle coppie same sex
            foreach ($_SESSION['p_mix'] as $key => $couple){
                if($couple[0][strlen($couple[0])-1] === $couple[1][strlen($couple[1])-1]){
                    unset($_SESSION['p_mix'][$key]);
                }
            }
            //safe indexing
            $safe_array=array();
            $i = 0;
            foreach ($_SESSION['p_mix'] as $couple)
            {

                $safe_array[$i] = $couple;
                $i++;
            }
            $_SESSION['p_mix'] = equal_array($safe_array);
            unset($safe_array);

            foreach ($_SESSION['p_mix'] as $key => $couple){
                if(debug)
                {
                    echo "<script>console.log(\"Shuffling ".implode("-",$couple)."\")</script>";
                }
                shuffle($couple);
                $_SESSION['p_mix'][$key] = $couple;
            }
            if(debug)
            {
                echo "<p>Mix after same sex delete:  </p>";
                print_r($_SESSION['p_mix']);
            }

        }
        else{
            echo "<pre>
    FAST DEBUG: skipping mixed section
   </pre>";
        }
    }


    include_once 'layout_head.php';
    switch($_SESSION['at']){
        case 0:default:
        {$_SESSION['visited_pages']['Scelta1'] = true;break;}
        case 1:{$_SESSION['visited_pages']['Scelta2'] = true;break;}
        case 2:{$_SESSION['visited_pages']['Scelta3'] = true;break;}
    }

    echo "<table class='center'><tr><td><table class='table80-3'><tr><td>";
    echo "<h1>" .$title. "</h1><br>";
    echo $text. "Take the time you need and when you are ready ".$f." click the button \"Start\" placed at the bottom.";
    echo "<br><br><br>";
    echo "<a href='choice.php' class='btn btn-primary'>Start</a>";

    if(debug){
        print_r($_SESSION["at"]);
    }
    if(skip_experiment){
        echo "<pre>
    Warning: skipping experiment!
   </pre>";
    }


} else {
    echo "<pre>
    An error have occurred. Don't worry, it's our fault, your Prolific reputation won't be inficiated.
   </pre>";
}

