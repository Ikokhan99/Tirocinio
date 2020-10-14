<?php
require "ConnectionParameters.php";
session_start();

$link = mysqli_connect(DATABASE_HOST, DATABASE_USERNAME, DATABASE_PASSWORD, DATABASE_NAME);

mysqli_select_db($link, 'EmployeeDB');  
  
$setSql = "SELECT avatarcode, sex, pow, exp, val, AGender, choicesT, choicesM, choicesF, SwipeMF, SwipeFM FROM resulttotali";  
$setRec = mysqli_query($link, $setSql);  
  
$columnHeader = '';  
$columnHeader = "avatarcode" . "\t" . "sex" . "\t" . "pow" . "\t" . "exp" . "\t" . "val" . "\t" . "AGender" . "\t" . "choicesT" . "\t". "choicesM" . "\t". "choicesF" . "\t". "SwipeMF" . "\t". "SwipeFM" . "\t";  
  
$setData = '';  
  
while ($rec = mysqli_fetch_row($setRec)) {  
    $rowData = '';  
    foreach ($rec as $value) {  
        $value = '"' . $value . '"' . "\t";  
        $rowData .= $value;  
    }  
    $setData .= trim($rowData) . "\n";  
}  
  
  
header("Content-type: application/octet-stream");  
header("Content-Disposition: attachment; filename=ResultTotali.xls");  
header("Pragma: no-cache");  
header("Expires: 0");  
  
echo ucwords($columnHeader) . "\n" . $setData . "\n";  
?> 