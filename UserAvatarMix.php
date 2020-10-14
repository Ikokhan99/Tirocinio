<?php
require "ConnectionParameters.php";
session_start();

$link = mysqli_connect(DATABASE_HOST, DATABASE_USERNAME, DATABASE_PASSWORD, DATABASE_NAME);

mysqli_select_db($link, 'EmployeeDB');  
  
$setSql = "SELECT usercode, avatarcode, nchoices, AGender, Ugender, Swipe FROM useravatarmix";  
$setRec = mysqli_query($link, $setSql);  
  
$columnHeader = '';  
$columnHeader = "usercode" . "\t" . "avatarcode" . "\t" . "nchoices" . "\t" . "AGender" . "\t" . "Ugender" . "\t" . "Swipe" . "\t";  
  
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
header("Content-Disposition: attachment; filename=UserAvatarMix.xls");  
header("Pragma: no-cache");  
header("Expires: 0");  
  
echo ucwords($columnHeader) . "\n" . $setData . "\n";  
?> 