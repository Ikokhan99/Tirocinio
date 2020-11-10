<?php
include_once 'config/permutations.php';

$result = iterator_to_array(permutations(range(1,16), 2));
shuffle($result);
print_r($result);