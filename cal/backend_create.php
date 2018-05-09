<?php
require_once '_db.php';



$insert = "INSERT INTO events (name, start, end, pho_id) VALUES (:name, :start, :end, :pho_id)";

$stmt = $db->prepare($insert);

$stmt->bindParam(':start', $_POST['start']);
$stmt->bindParam(':end', $_POST['end']);
$stmt->bindParam(':name', $_POST['name']);
$stmt->bindParam(':pho_id', $_POST['pho_id']);


$stmt->execute();

class Result {}

$response = new Result();
$response->result = 'OK';
$response->message = 'Created with id: '.$db->lastInsertId();

//$response = $db->lastInsertId();

header('Content-Type: application/json');
echo json_encode($response);

?>
