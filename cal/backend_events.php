<?php
require_once '_db.php';
$pho_id=$GET['pho_id'];
$stmt = $db->prepare('SELECT * FROM events WHERE pho_id= :pho_id AND NOT ((end <= :start) OR (start >= :end))');

$stmt->bindParam(':start', $_POST['start']);
$stmt->bindParam(':end', $_POST['end']);
$stmt->bindParam(':pho_id', $_POST['pho_id']);

$stmt->execute();
$result = $stmt->fetchAll();

class Event {}
$events = array();

foreach($result as $row) {
  $e = new Event();
  $e->id = $row['id'];
  $e->text = $row['name'];
  $e->start = $row['start'];
  $e->end = $row['end'];
  $e->moveDisabled = true;
  $e->resizeDisabled = true;
  $events[] = $e;
}

header('Content-Type: application/json');
echo json_encode($events);

?>
