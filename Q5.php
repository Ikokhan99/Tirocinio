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