<?php
require "ConnectionParameters.php";
session_start();

$link = mysqli_connect(DATABASE_HOST, DATABASE_USERNAME, DATABASE_PASSWORD, DATABASE_NAME);

mysqli_select_db($link, 'EmployeeDB');  
  
$setSql = "SELECT usercode, gender, age, playtime, game1, game2, sexism1, sexism2, sexor, password, userID, startwith FROM user";  
$setRec = mysqli_query($link, $setSql);  
  
$columnHeader = '';  
$columnHeader = "usercode" . "\t" . "gender" . "\t" . "age" . "\t" . "playtime" . "\t" . "game1" . "\t" . "game2" . "\t" . "sexism1" . "\t". "sexism2" . "\t" . "sexor" . "\t". "password" . "\t". "userID" . "\t". "startwith" . "\t";  
  
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
header("Content-Disposition: attachment; filename=User.xls");  
header("Pragma: no-cache");  
header("Expires: 0");  
  
echo ucwords($columnHeader) . "\n" . $setData . "\n";  
