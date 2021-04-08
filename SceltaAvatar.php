<?php
include_once "config/core.php";

$action = '';
$page_title="Start";

include_once 'config/Foes.php';
include_once 'config/Database.php';

$database = new Database();
$db = $database->getConnection();
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if(isset($_SESSION['at']))
{
    $_SESSION['permutation'] = 0;
    $text = "<div class='t1'>You will be presented with various pairs of avatars that you might use in a video game.</div>
		<div class='t2'>For each couple, we ask you to choose your favourite avatar by pressing the <b>right</b> (&#8594) or <b>left</b> (&#8592) from the keyboard to select the avatar you prefer. </div><div class='t3'> (<b>right arrow = right avatar </b> & <b> left arrow = left avatar</b>).</div>";
    $title="Continue Test";
    $f="to continue";
    if($_SESSION['at'] === 0)
    {
        //fist part
        $title="Begin test";
        $f="to start ";

        $page_index = 'Scelta1';

    } elseif ($_SESSION['at'] === 1)
    {
        $page_index = 'Scelta2';
    }
    elseif ($_SESSION['at'] === 2)
    {
        $page_index = 'Scelta3';
        //mix case

        //getting most chosen avatars

        $mix_av = array();
//
        //es: select chosen from choice where type = 0 AND user_id = 'dummyFYGkMfNP3B5CLt7YC965jazzS' group by chosen order by count(*) desc limit 5;

        //5 most frequent choices for males
        $q = "select chosen from choice where type = :type AND user_id = '".$_SESSION['user-id']."' group by chosen order by count(*) desc limit 5;";
        $type=0;
        $k =0;
        $stmt = $db->prepare($q);

        $stmt->bindParam(':type', $type);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);

        if(debug) {
           print_r($result);
        }
        //5 most frequent choices for females
        $type=1;
        $stmt->bindParam(':type', $type);
        $stmt->execute();
        $result2 = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
        $result = array_merge($result, $result2 );


        if(debug)
        {
            print_r($q);
            //var_dump($db);
            echo "<p>Avatar scelti  </p>";
            var_dump($result);

        }

        //permutations
        include_once "config/permutations.php";
        $_SESSION['p_mix'] = array();
        exec_combine(2,$result,3);
        shuffle($_SESSION['p_mix']);
        if(debug)
        {
            echo "<p>Mix:  </p>";
            print_r($_SESSION['p_mix']);
        }

       //deleting same sex couple
       foreach ($_SESSION['p_mix'] as $key => $couple){
           if(($couple[0] > 16) && ( $couple[1] > 16)){
               unset($_SESSION['p_mix'][$key]);
           } elseif (($couple[0] <= 16) && ( $couple[1] <= 16)){
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

    include_once 'layout_head.php';
    switch($_SESSION['at'])
    {
        case 0:default:
        {$_SESSION['visited_pages']['Scelta1'] = true;break;}
        case 1:{$_SESSION['visited_pages']['Scelta2'] = true;break;}
        case 2:{$_SESSION['visited_pages']['Scelta3'] = true;break;}
    }

    echo "<div class='wrap'>
            <div class='main-container'>";
            echo "<div class='title-section'><div class='title'> " .$title. "</div></div>";
            echo "<div class='text-section'> ".$text. "<div class='t4'>Take all the time you need and when you are ready ".$f." click the button \"Start\" placed at the bottom.</div>";
            echo "</div>";
            echo "<div class='button-section'> <a href='choice.php' class='btn btn-primary'>Start</a></div>
            </div>
          </div>";

    if(debug)
    {
        echo "AT: ";
        print_r($_SESSION["at"]);
    }
    if(skip_experiment)
    {
        echo "<pre>
    Warning: skipping experiment!
   </pre>";
    }


} else {
    echo "<pre>
    An error has occurred. Don't worry, it's our fault, your Prolific reputation won't be affected.
   </pre>";
    error_log("Session at not set: ". ($_SESSION['at']?? (string)isset($_SESSION['at']))."\n\t PAGE: SceltaAvatar.php");
}

?>
<script type="text/javascript">

    //just call a function to load your CSS
    //this path should be relative your HTML location
    loadCSS("libs/CSS/SceltaAvatar.css");

</script>
