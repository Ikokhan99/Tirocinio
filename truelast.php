<?php
include_once "config/core.php";
if(!isset($_SESSION['prolific'])) {
    exit("Esperimento di prova terminato");
}
if(debug){
    echo ("Final url: ") . $_SESSION["final_url"];
    exit();
}
header("Location:" . $_SESSION["final_url"]);/* Redirect browser *//* Make sure that code below does not get executed when we redirect. */
session_destroy();
exit;