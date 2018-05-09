<?php
require_once '_db.php';
echo $_GET['id'];
$insert = "UPDATE events SET name='Reserved' WHERE id = :id";

$stmt = $db->prepare($insert);

$stmt->bindParam(':id', $_GET['id']);

$stmt->execute();
/*
class Result {}

$response = new Result();
$response->result = 'OK';
$response->message = 'Update reserved successful';

header('Content-Type: application/json');
echo json_encode($response);
*/

echo "<script>window.top.location.href=\"bookingsuccess.php?id=".$_GET['id']."\"</script>";
//header ('Location:/photopeoples/search.html?id='.$_POST['id']);

?>
