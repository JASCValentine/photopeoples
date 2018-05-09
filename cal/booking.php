<?php
require_once '_db.php';
echo "TEST<br />";
echo $_POST['start'];
echo "<br />";
echo $_POST['end'];
echo "<br />";

$start = $_POST['start'];
$end = $_POST['end'];



$query = "select id from events WHERE ";
$query .= " start =:start and end = :end and name = :name ";

$name = "Temp Hold";
$stmt = $db->prepare($query);

$stmt->bindParam(':start', $_POST['start']);
$stmt->bindParam(':end', $_POST['end']);
$stmt->bindParam(':name', $name);


$stmt->execute();
$result = $stmt->fetchAll();

foreach($result as $row) {
  $tempholdid = $row['id'];
}
echo "ID:".$tempholdid;

?>

<p><a href="directbooking.php?id=<? echo $tempholdid; ?>">Direct Booking<a></p>

<p><a href="doubleconfirm.php?id=<? echo $tempholdid; ?>">Double confirm with Photographer</a></p>