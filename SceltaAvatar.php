<?php

include_once "config/core.php";
$action = '';
$page_title="Start";
include_once 'layout_head.php';


if(isset($_SESSION['at']))
{
    $_SESSION['permutation'] = 1;
    $text = "Imagine that you have just started a new video game and find yourself having to choose your personal avatar.<br>
		<br>You will be faced with various pairs of avatars; for each couple choose your favorite avatar by pressing the <b>right arrow</b> (&#8594) or <b>left</b> (&#8592) from the keyboard to select the corresponding avatar. <br><br>(<b>right arrow = right avatar </b> & <b> left arrow = left avatar</b>).<br><br><br>";
    $title="Continue Test";
    $f="to continue";
    if($_SESSION['at'] == 0)
    {
        //fist part
        $title="Begin test";
        $f="to start ";
        /** @var TYPE_NAME $fast_debug */
        if(!$fast_debug)
        {
            include_once 'config/database.php';
            include_once 'objects/user.php';

            $database = new Database();
            $db = $database->getConnection();

            $user = new User($db);
            $user->create();
        }



    }
echo "<table class='center'><tr><td><table class='table80-3'><tr><td>";
echo "<h1>" .$title. "</h1><br>";
echo $text. "Take the time you need and when you are ready".$f."click the button \"Start\" placed at the bottom.";
echo "<br><br><br>";
echo "<a href='choice.php' class='btn btn-primary'>Start</a>";


} else {
    echo "<pre>
    Spiacenti, si è verificato un errore
   </pre>";
}

