<?php			
$db = new PDO('sqlite:db/photopeoples.sqlite');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
				
$query = "select pho_id, name, nationalty, experience, style from PHOTOGRAPHER";
$query = "select * from appointments";

$stmt = $db->prepare($query);

$stmt->execute();
$result = $stmt->fetchAll();

$username = "";
$count =0;
foreach($result as $row) {
  $count++;
  echo $row['name']."<br />";
/*  
  $query2 = "select AVG(rating), COUNT(rating) from review where pho_id= ".$row['pho_id'];
  $stmt2 = $db->prepare($query2);

	$stmt2->execute();
	$result2 = $stmt2->fetchAll();
	foreach($result2 as $row2) {
	
	$query3 = "select price from price where price_type=1 and pho_id= ".$row['pho_id'];
  $stmt3 = $db->prepare($query3);

	$stmt3->execute();
	$result3 = $stmt3->fetchAll();
	foreach($result3 as $row3) {
		$hourrate=$row3['price'];
	}
*/
}	
?>  