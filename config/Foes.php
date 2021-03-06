<?php

function equal_array($arr): array
{
	$ArrayObject = new ArrayObject($arr);
	return $ArrayObject->getArrayCopy();  
}

function test_input($string): string
{
    $string = (string)$string;
    if(strlen($string) >100) {
        return "User bad input";
    }
    // ----- remove HTML TAGs -----
    $string = preg_replace ('/<[^>]*>/', ' ', $string);

    // ----- remove control characters -----
    $string = str_replace(array("\r", "\n", "\t"), '', $string);   // --- replace with empty space

    // ----- remove multiple spaces -----
    $string = trim(preg_replace('/ {2,}/', ' ', $string));

    return $string;
}
function check_int(int $val, int $min,int $max): int
{
    if($val < $min || $val > $max)
    {
        return $min -1;
    }

    return $val;
}
function generateRandomID($length = 10): string
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        try {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        } catch (Exception $e) {
        }
    }
    return "dummy".$randomString;
}