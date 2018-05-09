<?php
require_once 'cal/_db.php';

echo $_POST['start'];
echo "<br />";
echo $_POST['end'];


/*
$insert = "INSERT INTO events (name, start, end) VALUES (:name, :start, :end)";

$stmt = $db->prepare($insert);

$stmt->bindParam(':start', $_POST['start']);
$stmt->bindParam(':end', $_POST['end']);
$stmt->bindParam(':name', $_POST['name']);


$stmt->execute();

//class Result {}

//$response = new Result();
//$response->result = 'OK';
//$response->message = 'Created with id: '.$db->lastInsertId();

$response = $db->lastInsertId();

header('Content-Type: application/json');
echo json_encode($response);
*?
?>