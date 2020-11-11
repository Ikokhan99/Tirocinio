<?php
error_reporting(E_ALL);
 
session_start();

date_default_timezone_set('Europe/Rome');
 
// home page url
//TODO: da modificare
const home_url="http://localhost/tirocinio/";

//constants
const IMG_EXT = '.jpg';
//const TOTAL_PERMUTATIONS = 240; //nPr = n! / (n - r)!, where n=16 and r = 2 <--permutations
const TOTAL_PERMUTATIONS = 120; //nPr = n! / (n - r)!, where n=16 and r = 2   <--combinations
const max_avatar_choices = 2;
const n_experiment = 3; //number of experiment cases, in our case we have  male, female and mix

const debug = false; //outputs the various thing that you as a debugger would like to see
const fast_debug = true; //fast debug skips all db interactions, set it at true if you want to see just the structure
const skip_experiment = false;



