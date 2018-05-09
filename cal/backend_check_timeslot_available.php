<?php
require_once '_db.php';
//echo "select id from events WHERE (end >= ".$_GET['newStart'].") OR  (start <= ".$_GET['newEnd']." and end >= ".$_GET['newEnd'].")";
//echo "<Br />";
//$insert = "select id from events WHERE (end >= :start) OR  (start <= :end and end >= :end)";

$insert = "select id from events WHERE pho_id=".$_GET['pho_id'];
$insert .= "(start<:end and end>:end) ";
$insert .= "OR (start<=:start and end<=:end and end > :start) ";
$insert .= "OR (start<:end and start>=:start and end>=:end) ";
$insert .= "OR (start<:end and start<= :start and end >:start) ";
$insert .= "OR (start<=:start and end>=:end)";
$insert .= "OR (start >=:start and end <=:end)";

$stmt = $db->prepare($insert);

$stmt->bindParam(':start', $_POST['start']);
$stmt->bindParam(':end', $_POST['end']);


$stmt->execute();
$result = $stmt->fetchAll();

class Result {}

$response = new Result();
//$response->result = 'OK';
$available = "YES";
foreach($result as $row) {
  //$response->result = 'NO';
  //echo $response.result;
  $available = "NO";
}

$response->message = 'Query successful';

header('Content-Type: application/json');
//echo json_encode($response);

$check = "select id from events WHERE ";
$check .= "(start<".$_POST['end']." and end>".$_POST['end'].") ";
$check .= "OR (start<=".$_POST['start']." and end<=".$_POST['end'].") ";
$check .= "OR (start<=".$_POST['end']." and start>=".$_POST['start']." and end>=".$_POST['end'].") ";
$check .= "OR (start<".$_POST['end']." and start<=".$_POST['start']." and end>".$_POST['start'].") ";
$check .= "OR (start<=".$_POST['start']." and end>=".$_POST['end'].")";
$check .= "OR (start>=".$_POST['start']." and end<=".$_POST['end'].")";

echo json_encode($available);

?>
