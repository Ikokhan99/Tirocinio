<?php
include_once 'config/permutations.php';

$_SESSION['p_male'] = array();
exec_combine(2,range(1,16),1);

print_r($_SESSION['p_male']);

