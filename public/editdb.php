<?php



$db_host = $_POST['db_host'];
$db_name = $_POST['db_name'];
$db_user = $_POST['db_user'];
$db_pass = $_POST['db_pass'];

$jsonString = file_get_contents('database_tv.json');
$data = json_decode($jsonString, true);

$data['db_host'] = $db_host;
$data['db_name'] = $db_name;
$data['db_user'] = $db_user;
$data['db_pass'] = $db_pass;

$newJsonString = json_encode($data);
file_put_contents('database_tv.json', $newJsonString);

header('Location: file-data.php');
