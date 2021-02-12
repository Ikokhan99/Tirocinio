<?php
include_once "config/core.php";
if(!isset($_SESSION['prolific']))
    exit("Esperimento di prova terminato");
if($_SESSION['user-sex'] === 0)
{
    $m = true;
}
else
{
    $m = false;
}
session_destroy();

if($m)
{
    header("Location: https://app.prolific.co/submissions/complete?cc=CC4A225F"); /* Redirect browser */
    /* Make sure that code below does not get executed when we redirect. */
    exit;
}
else {
    header("Location: https://app.prolific.co/submissions/complete?cc=4F67FA61"); /* Redirect browser */
    /* Make sure that code below does not get executed when we redirect. */
    exit;
}