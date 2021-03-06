<?php session_start(); ?>

<?php

$pho_id = $_POST['pho_id'];
$cust_id = $_POST['cust_id'];
$from = $_POST['from'];
$to = $_POST['to'];

$db = new PDO('sqlite:db/photopeoples.sqlite');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
				

$stmt = $db->prepare('SELECT name FROM customer WHERE cust_id= :cust_id');
$stmt->bindParam(':cust_id', $cust_id);
$stmt->execute();
$result = $stmt->fetchAll();
foreach($result as $row) {
	$cust_name =$row['name'];
}

$stmt = $db->prepare('SELECT name FROM photographer WHERE pho_id= :pho_id');
$stmt->bindParam(':pho_id', $pho_id);
$stmt->execute();
$result = $stmt->fetchAll();
foreach($result as $row) {
	$pho_name =$row['name'];
}

?>
<html>
<head>
<meta charset="UTF-8" />
<title>index</title>
<!-- Range slider-->
<?php include 'price-range-js.php' ?>
<!-- Range slider-->  
  	<!--<script>
  		$(function(){
  			$("#searchBarContainer").load("searchbar.html");
  		});
  	</script>-->
	<link rel="stylesheet" href="css/style.css?v=1">
	<script>
	$( document ).ready(function() {
		$('#button_doubleconfirm').click(function(){
			$("#bookingtype").val("doubleconfirm");
			$("#bookingForm").submit();
		});

		$("#button_direct").click(function(){
			$("#bookingtype").val("direct");
			$("#bookingForm").submit();
		});
	});
	</script>
</head>
<body>

	<div id="container">
		<div id="mainContainer">
			<div id="header">
			<?php include 'header_simple.php' ?>
			<div class="clear"></div>
			</div>
			<!-- End of header -->
			<!-- Search Bar -->
			<div id="searchBarContainer" style="display:none">
				<?php include 'searchbar.php' ?>
			</div>
			<!-- End of Search Bar -->
			<div id="mainContent">
<h1> Confirm Appointment Details</h1>
Photographer: <?php echo $pho_name; ?><br />
Customer: <?php echo $cust_name; ?><br />
From: <?php echo $from; ?><br />
To: <?php echo $to; ?><br />
Extra Services:<br />
<?php


?>
<br /><br />
	<button id="button_direct" style="float:left;padding:10px;margin-right:30px">Direct Booking</button>

	<button id="button_doubleconfirm" style="float:celeftnter;padding:10px">Double confirm with Photographer</button>

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
	<form action="booking_process.php" method="post" id="bookingForm">
		<input type="hidden" name="bookingtype" id="bookingtype">
		<input type="hidden" name="from" id="from" value="<?php echo $from; ?>">
		<input type="hidden" name="to" id="to" value="<?php echo $to; ?>">
		<input type="hidden" name="cust_id" id="cust_id" value="<?php echo $_SESSION['cust_id']; ?>">			
		<input type="hidden" name="pho_id" id="pho_id" value="<?php echo $pho_id; ?>">					
	</form>
	
</body>
</html>