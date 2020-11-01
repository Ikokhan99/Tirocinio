<?php

//TODO: da modificare

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

function rip_tags($string) 
{ 
  //  echo "inside rip_tags: $string ->";
    // ----- remove HTML TAGs ----- 
    $string = preg_replace ('/<[^>]*>/', ' ', $string); 
  //  echo " $string ->";
    // ----- remove control characters ----- 
    $string = str_replace("\r", '', $string);    // --- replace with empty space
    $string = str_replace("\n", '', $string);   // --- replace with empty space
    $string = str_replace("\t", '', $string);   // --- replace with empty space
  //  echo " $string ->";
    // ----- remove multiple spaces ----- 
    $string = trim(preg_replace('/ {2,}/', ' ', $string));
  //  echo "$string <- inside rip_tags";
    return $string; 

}//strip tags non funziona

function test_input($data) 
{
  //$data = trim($data); // toglie spazi, tabs e newline extra
  
  $data = rip_tags($data);//rimuove i tag html
  //$data = stripslashes($data);
  //$data = preg_replace("/&#?[a-z0-9]{2,8};/i","",$data);
  
  //$data = mysqli_real_escape_string($data); // aiuta a prevenire sql injection, ma la parte consistente sono le parameterized queries
  return $data;
}


//----------------------------------------------------------------------------------------------------------------------------------------------
//da qui a ---- le funzioni ritornano null se è tutto ok, un messaggio di errore se qualcosa non va


function validate_password($data)
{
	$data = test_input($data);
	$error = "La password deve:";
	// check delle caratteristiche della password
	$uppercase = preg_match("@[A-Z]@", $data);
	$lowercase = preg_match("@[a-z]@", $data);
	$number    = preg_match("@[0-9]@", $data);
	//$specialChars = preg_match("@[^\w]@", $data);
	if(strlen($data) < 8 || strlen($data)>20)
		$length = false;
	else
		$length = true;

	if(!$uppercase || !$lowercase || !$number || !$length)
		{
		 if(!$uppercase)
			 $error .= "contenere almeno una lettera maiuscola";
		 if(!$lowercase)
			 $error .= ", contenere almeno una lettera minuscola";
		 if(!$number)
			 $error .= ", contenere almeno un numero";
		 if(!$length)
			 $error .= ", avere una lunghezza compresa tra 8 e 20";
		 str_replace(":,",$error,":");
		 $error .= ".";
		
		}
	else{
			$error=null;
		}
		if($data==null || $data=="")
			$error = "Il campo password non può essere vuoto";
	return $error;
}



?>