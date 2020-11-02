<?php
include_once "config/InputCheckFoo.php";
include_once "config/pbkdf2.php";

$p=pbkdf2('sha3-512' , 'password','C?????=??',1000,100);
var_dump($p);