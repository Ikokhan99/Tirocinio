<?php
if(debug)
{
    echo "<p> DEBUG: ";
    print_r($_SESSION['at']);
    echo "</p>";
    echo "<p> DEBUG: ";
    print_r($_SESSION['Q'][$_SESSION['at']]);
    echo "</p>";
    echo $_GET;
}
include_once "layout_head.php";
if(user_error) {
    if (empty($_GET) || (!isset($_GET['s']) || $_GET['s'] !== '0')) {

        header("Location: " . home_url . "user_error.php?error=common");
        exit;

    }
}