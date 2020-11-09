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