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
    $text = "<div class='t1'>You will be presented with various pairs of avatars that you might use in a video game.</div>
		<div class='t2'>For each couple, we ask you to choose your favourite avatar by pressing the <b>right</b> (&#8594) or <b>left</b> (&#8592) from the keyboard to select the avatar you prefer. </div><div class='t3'> (<b>right arrow = right avatar </b> & <b> left arrow = left avatar</b>).</div>";
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

    echo "<div class='wrap'>
            <div class='main-container'>";
            echo "<div class='title-section'><div class='title'> " .$title. "</div></div>";
            echo "<div class='text-section'> ".$text. "<div class='t4'>Take all the time you need and when you are ready ".$f." click the button \"Start\" placed at the bottom.</div>";
            echo "</div>";
            echo "<div class='button-section'> <a href='choice.php' class='btn btn-primary'>Start</a></div>
            </div>
          </div>";

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
    An error has occurred. Don't worry, it's our fault, your Prolific reputation won't be affected.
   </pre>";
}

?>

<style>
    @media only screen and ( max-width: 360px ) {

        .main-container {
            margin: 0 auto;
            padding: 1em;
            display: grid;
            grid-gap: 2px;
            grid-template-columns: 100%;
            font-size: x-small;
            text-align: center;

        }

        .button-section{
            margin: 0 auto;
            padding: 0;
            display: grid;
            grid-gap: 2px;
            grid-template-columns: 1fr 2fr 1fr;
        }
        .text-section {
            margin: 0 auto;
            padding: 1em;
            display: grid;
            grid-gap: 2px;
            grid-template-columns: auto auto auto;


        }

        .title-section {
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
        .title{
            font-size: large;
        }

    }

    @media only screen and ( min-width: 360px ) {

        .main-container {
            margin: 0 auto;
            padding: 1em;
            display: grid;
            grid-gap: 2px;
            grid-template-columns: 100%;
            font-size: x-small;

        }

        .button-section{
            margin: 0 auto;
            padding: 0;
            display: grid;
            grid-gap: 2px;
            grid-template-columns: 1fr 2fr 1fr;
        }
        .text-section {
            margin: 0 auto;
            padding: 1em;
            display: grid;
            grid-gap: 2px;
            grid-template-columns: auto auto auto;


        }

        .title-section {
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
        .title{
            font-size: large;
        }
    }


    @media only screen and (min-width: 480px) {

        .main-container {
            margin: 0 auto;
            padding: 1em;
            display: grid;
            grid-gap: 2px;
            grid-template-columns: 30px 400px 30px;
            font-size: small;

        }

        .button-section{
            margin: 0 auto;
            padding: 0;
            grid-column: 2;
            display: grid;
            grid-gap: 2px;
            grid-template-columns: 1fr 2fr 1fr;

        }
        .text-section {
            margin: 0 auto;
            padding: 1em;
            grid-column: 2;
            display: grid;
            grid-gap: 2px;
            grid-template-columns: 100%;


        }

        .btn{
            width: fit-content;
        }

        .title-section {
            margin: 0 auto;
            padding: 1em;
            grid-column: 2;
            display: grid;
            grid-gap: 2px;
            grid-template-columns: 100%;
        }
        .title{
            font-size: x-large;
        }

    }
    @media only screen and (min-width: 760px) {

        .main-container {
            margin: 0 auto;
            padding: 1em;
            display: grid;
            grid-gap: 2px;
            grid-template-columns: 1fr 2fr 1fr;
            font-size: large;

        }


        .btn{
            width: 170px;
        }


        .title{
            font-size: xxx-large;
        }

    }


    @media only screen and (min-height: 360px) {
        .main-container {
            grid-template-rows: 60px 170px 60px ;
        }
        .button-section{
            grid-row: 3;
            grid-template-rows: 100%;
        }
        .text-section {
            grid-row: 2;
            grid-template-rows: 1fr 1fr 1fr 1fr ;
        }
        .title-section {
            grid-row: 1;
            grid-template-rows: 100%;
        }
        .btn{
            height: fit-content;
            font-size: large;
            grid-row: 1;
            grid-column: 2;
        }

    }
    @media only screen and (min-height: 560px) {
        .main-container {
            grid-template-rows: 120px 270px 100px ;
        }
        .button-section{
            grid-row: 3;
            grid-template-rows: 100%;
        }
        .text-section {
            grid-row: 2;
            grid-template-rows: 1fr 1fr 1fr 1fr ;
        }
        .title-section {
            grid-row: 1;
            grid-template-rows: 100%;
        }
        .btn{
            height: fit-content;
            font-size: xx-large;
            grid-row: 1;
            grid-column: 2;
        }

    }



    @media only screen and (min-height: 640px) {
        .main-container {
            grid-template-rows: 140px 350px 110px ;
        }

    }

    @media only screen and (min-height: 650px) {
        .main-container {
            grid-template-rows: 150px 350px 110px ;

        }

    }

    @media only screen and (min-height: 720px) {
        .main-container {
            grid-template-rows: 145px 400px 120px ;

        }

    }

    @media only screen and (min-height: 850px) {
        .main-container {
            grid-template-rows: 200px 400px 200px ;
            text-align: center;
        }
    }

    @media only screen and (min-height: 1080px) {
        .main-container {
            grid-template-rows: 251px 552px 251px ;
            font-size: x-large;

        }
    }
    @media only screen and (min-height: 1300px) {
        .main-container {
            grid-template-rows: 251px 752px 251px ;
            font-size: x-large;

        }
    }

    .t1{
        grid-column: 1;
        grid-row: 1;
    }
    .t2{
        grid-column: 1;
        grid-row: 2;
    }
    .t3{
        grid-column: 1;
        grid-row: 3;
    }
    .t4{
        grid-column: 1;
        grid-row: 4;
    }

</style>
