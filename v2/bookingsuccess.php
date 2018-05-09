<?php session_start(); ?>
<?php

$db = new PDO('sqlite:db/photopeoples.sqlite');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

$update = "UPDATE appointments SET status='Reserved', payment_status='Paid' WHERE app_id = :id";

$stmt = $db->prepare($update);

$stmt->bindParam(':id', $_GET['bookingid']);

$stmt->execute();

$stmt = $db->prepare('SELECT start, end, pho_id, cust_id, status, payment_status FROM appointments WHERE app_id= :app_id');
$stmt->bindParam(':app_id', $_GET['bookingid']);
$stmt->execute();
$result = $stmt->fetchAll();
foreach($result as $row) {
	$start =$row['start'];
	$end =$row['end'];
	$pho_id =$row['pho_id'];
	$cust_id =$row['cust_id'];
	$status =$row['status'];
	$payment_status =$row['payment_status'];					
}

$query = "select name from PHOTOGRAPHER where pho_id=:pho_id";

$stmt = $db->prepare($query);
$stmt->bindParam(':pho_id', $pho_id);

$stmt->execute();
$result = $stmt->fetchAll();
foreach($result as $row) {
  $pho_name=$row['name'];
}
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
			<div id="searchBarContainer">
				<?php include 'searchbar.php' ?>
			</div>
			<!-- End of Search Bar -->
			<div id="mainContent">
<h2>Booking Successful with booking id: <?php echo $_GET['bookingid']; ?></h2>
From: <?php echo $start; ?><br />
To: <?php echo $end; ?><br />
Photographer: <?php echo $pho_name; ?><br />
<!--cust_id: <?php echo $cust_id; ?><br />-->
Status: <?php echo $status; ?><br />
Payment Status: <?php echo $payment_status; ?><br />
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