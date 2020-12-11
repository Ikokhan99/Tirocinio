<?php

//TODO: da modificare

//push for associative arrays TODO:controllare se serve
function array_push_assoc($array, $key, $value)
{
	$array[$key] = $value;
	return $array;
}

function equal_array($arr)
{
	$ArrayObject = new ArrayObject($arr);
	return $ArrayObject->getArrayCopy();  
}

function test_input($string)
{
    // ----- remove HTML TAGs -----
    $string = preg_replace ('/<[^>]*>/', ' ', $string);

    // ----- remove control characters -----
    $string = str_replace("\r", '', $string);    // --- replace with empty space
    $string = str_replace("\n", '', $string);   // --- replace with empty space
    $string = str_replace("\t", '', $string);   // --- replace with empty space

    // ----- remove multiple spaces -----
    $string = trim(preg_replace('/ {2,}/', ' ', $string));

    return $string;
}
function check_int(int $val, int $min,int $max)
{
    if($val < $min || $val > $max)
    {
        return $min -1;
    }
    else{
        return $val;
    }
}
function generateRandomID($length = 10): string
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return "dummy".$randomString;
}