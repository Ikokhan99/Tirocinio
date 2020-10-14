<?php
require "ConnectionParameters.php";
session_start();

$link = mysqli_connect(DATABASE_HOST, DATABASE_USERNAME, DATABASE_PASSWORD, DATABASE_NAME);

mysqli_select_db($link, 'EmployeeDB');  
  
$setSql = "SELECT usercode, startwith, avatar1code, avatar2code, avatarchoosencode, rensptime FROM result";  
$setRec = mysqli_query($link, $setSql);  
  
$columnHeader = '';  
$columnHeader = "usercode" . "\t" . "startwith" . "\t" . "avatar1code" . "\t" . "avatar2code" . "\t" . "avatarchoosencode" . "\t" . "rensptime" . "\t";  
  
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
header("Content-Disposition: attachment; filename=Result.xls");  
header("Pragma: no-cache");  
header("Expires: 0");  
  
echo ucwords($columnHeader) . "\n" . $setData . "\n";  
?> 