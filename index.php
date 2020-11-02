<?php

include_once "config/core.php";
$action = '';
$page_title="Home";
$require_login=true;
include_once "login_checker.php";
include_once 'layout_head.php';

//check


 
    // per prevenire undefined index notice
    $action = isset($_GET['action']) ? $_GET['action'] : "";
    include_once "home.php";

 

 
// footer HTML and JavaScript codes
include 'layout_foot.php';
