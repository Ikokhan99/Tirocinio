<?php
// core configuration
include_once "config/core.php";

include_once 'config/database.php';
include_once 'objects/user.php';

// page title
$order = range(1,10);
shuffle($order);

$page_title = "Survey";
include_once "layout_head.php";

if (!empty($_POST)) {

    if(!fast_debug) {
        //TODO
        $q2 = new Q2($_SESSION['db'],$_SESSION['uid']);
        $q2->playtime = $_POST['playtime'];
        $q2->sexor = $_POST['user-sexor'];
        $q2->sex = $_POST['user-sex'];
        $q2->age = $_POST['user-age'];
        if ($_SESSION['Q_ORDERED'])
            $q2->q_order = 0;
        else
            $q2->q_order = 1;
        if (!$q2->create()) {
            $q2->showError();
            die();
        }
    }
    header("Location: ".home_url."Q1.php?action=goto");
}
if(debug) {
    echo "<p> DEBUG: ";
    print_r($_SESSION['at']);
    echo "</p>";
    echo "<p> DEBUG: ";
    print_r($_SESSION['Q'][$_SESSION['at']]);
    echo "</p>";
}
?>
<!-- TODO: fix css e capire da dove spunta il > -->
<div style='text-align: center;'>
    <form action='Q5.php' method='post'>
        <p style= 'font-weight: 1000;'>
            TODO
        </p>
        <table class='center'>

        </table>
        <p></p>
        <p></p>
        <input type="submit" name="action" id="action-q2" tabindex="4" class="form-control btn btn-register" value="Continue">
</div>

    <style>
        table {
            border-collapse: collapse;
            background-color: #F8F8F8;
        }

        table, td, th {
            border: 1px solid black;
            padding: 15px;
            text-align: left;
        }
        td {
            height: 50px;
            vertical-align: bottom;
        }

    </style>
<?php

// footer HTML and JavaScript codes
include_once "layout_foot.php";


/*
We are interested in how people think about their bodies. The questions below identify 10 different body
attributes. We would like you to rank order these body attributes from that which has the greatest impact

on your physical self-concept (rank this a "9"), to that which has the least impact on your physical self-
concept (rank this a "0").

Note: It does not matter how you describe yourself in terms of each attribute. For example, fitness level
can have a great impact on your physical self-concept regardless of whether you consider yourself to be
physically fit, not physically fit, or any level in between.
Please first consider all attributes simultaneously, and record your rank ordering by writing the ranks in
the rightmost column.
IMPORTANT: Do Not Assign The Same Rank To More Than One Attribute


9 = greatest impact
8 = next greatest impact
1 = next to least impact
0 = least impact


When considering your physical self-concept...
1.what rank do you assign to physical coordination ?
2.what rank do you assign to health?
3.what rank do you assign to weight?
4.what rank do you assign to strength ?
5.what rank do you assign to sex appeal?
6.what rank do you assign to physical attractiveness ?
7.what rank do you assign to energy level (e.g., stamina)?
8.what rank do you assign to fimffsculpted muscles ?
9.what rank do you assign to physical fitness level?
10.what rank do you assign to measurements (e.g., chest, waist, hips)? 
*/







