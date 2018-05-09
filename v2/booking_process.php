<?php session_start(); ?>

<?php

$pho_id = $_POST['pho_id'];
$cust_id = $_POST['cust_id'];
$from = $_POST['from'];
$to = $_POST['to'];
$bookingtype = $_POST['bookingtype'];


$db = new PDO('sqlite:db/photopeoples.sqlite');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
				

if ($bookingtype=="direct"){
	$insert = "INSERT INTO appointments (start, end, pho_id, cust_id, status, payment_status) VALUES (:start, :end, :pho_id, :cust_id, :status, :payment_status)";

$stmt = $db->prepare($insert);

$status = "waiting payment complete";
$payment_status = "pending";

$stmt->bindParam(':start', $from);
$stmt->bindParam(':end', $to);
$stmt->bindParam(':pho_id', $pho_id);
$stmt->bindParam(':cust_id', $cust_id);
$stmt->bindParam(':status', $status);
$stmt->bindParam(':payment_status', $payment_status);
//$stmt->bindParam(':last_mod_date', $last_mod_date);


$stmt->execute();

echo "<a href=\"bookingsuccess.php?bookingid=".$db->lastInsertId()."\">Go to payment gateway</a>";
}


if ($bookingtype=="doubleconfirm"){
	$insert = "INSERT INTO appointments (start, end, pho_id, cust_id, status, payment_status) VALUES (:start, :end, :pho_id, :cust_id, :status, :payment_status)";

$stmt = $db->prepare($insert);

$status = "waiting photographer confirm";
$payment_status = "pending";

$stmt->bindParam(':start', $from);
$stmt->bindParam(':end', $to);
$stmt->bindParam(':pho_id', $pho_id);
$stmt->bindParam(':cust_id', $cust_id);
$stmt->bindParam(':status', $status);
$stmt->bindParam(':payment_status', $payment_status);
//$stmt->bindParam(':last_mod_date', "date('now')");


$stmt->execute();
?>
<html>
<head>
<meta charset="UTF-8" />
<title>Booking Successful</title>
<!-- Range slider-->
<?php include 'price-range-js.php' ?>
<!-- Range slider-->  
  	<!--<script>
  		$(function(){
  			$("#searchBarContainer").load("searchbar.html");
  		});
  	</script>-->
	<link rel="stylesheet" href="css/style.css?v=1">
</head>
<body>

	<div id="container">
		<div id="mainContainer">
			<div id="header">
			<?php include 'header.php' ?>
			<div class="clear"></div>
			</div>
			<!-- End of header -->
			<!-- Search Bar -->
			<div id="searchBarContainer" style="display:none">
				<?php include 'searchbar.php' ?>
			</div>
			<!-- End of Search Bar -->
			<div id="mainContent" style="text-align:center">
<?php			
echo "<h2>Waiting for photographer to confirm</h2>";
echo "Reservation ID: ".$db->lastInsertId()."<br />";
?>
<div class="clear"></div>																					
			</div>
			<div id="footer">
				PhotoPeoples Copywrite 2017
				<a href="#" style="float:right">Help</a>
			</div>
		<div>
		<!-- End of mainContainer -->
	</div>
	<!-- End of container -->
</body>
</html>
<?php
}
?>