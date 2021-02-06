<?php
include_once 'config/core.php';
include_once 'config/database.php';

echo "Page was refreshed or reloaded. Bad user";
$_SESSION['visited_pages']['error'] = true;

$database = new Database();
$db = $database->getConnection();
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$q = "UPDATE user SET trusted = 1 where id='".$_SESSION['user-id']."';";
$stmt = $db->prepare($q);
$stmt->execute();

//user error page ok, TODO:debug