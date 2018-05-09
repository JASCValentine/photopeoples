<?php session_start(); ?>
<?php


$reservationContent="";

$db = new PDO('sqlite:db/photopeoples.sqlite');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
				
$stmt = $db->prepare("SELECT app_id, pho_id, status,payment_status,  start, strftime('%Y', start) as startY, strftime('%m', start) as startM, strftime('%d', start) as startD, end FROM appointments WHERE cust_id= :cust_id");

$stmt->bindParam(':cust_id', $_SESSION['cust_id'] );

$stmt->execute();
$result = $stmt->fetchAll();

foreach($result as $row) {
$app_id = $row['app_id'];
$pho_id = $row['pho_id'];
$pieces = explode("/", $row['start']);
$Sday = $pieces[0]; // piece1
$Smonth = $pieces[1]; // piece2
$temp = $pieces[2]; // piece2
$pieces2 = explode(" ", $temp);
$Syear = $pieces2[0];
$temp2 = $pieces2[1];
$pieces3 = explode(":", $temp2);
$Shour = $pieces3[0];
$Smin = $pieces3[1];
$Sampm  = $pieces2[2];

$reservationContent.="<div class=css_tr>\n";
$reservationContent.="<div class=css_td>".$app_id."</div>\n";
	$stmt2 = $db->prepare("SELECT name from photographer where pho_id=:pho_id");
	$stmt2->bindParam(':pho_id', $pho_id );
	$stmt2->execute();
	$result2 = $stmt2->fetchAll();

	foreach($result2 as $row2) {
		$pho_name = $row2['name'];
	}
$reservationContent.="<div class=css_td>".$pho_name."</div>\n";
$reservationContent.="<div class=css_td>".$row['start']."</div>\n";
$reservationContent.="<div class=css_td>".$row['end']."</div>\n";
$reservationContent.="<div class=css_td>".$row['status']."</div>\n";
$reservationContent.="<div class=css_td>".$row['payment_status']."</div>\n";
//$reservationContent.="<div class=css_td><a href=\"message.php?app_id=".$app_id."\">Send Message To Photographer</a></div>\n";
$reservationContent.="</div>\n";

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
	<style>
	#css_table {
      display:table;
  }
.css_tr {
      display: table-row;
  }
.css_td {
      display: table-cell;
      padding:5px;
      border-bottom:1px solid #C7C7C7;
  }
.css_th {
      display: table-cell;
      font-weight:bold;
      background-color:#C7C7C7;
      padding:5px;
}  
	
	}
	</style>
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
<h2>My Reservation</h2>
<div id="css_table">
	<div class=css_tr>
		<div class=css_th>Reservation ID</div>
		<div class=css_th>Photographer</div>
		<div class=css_th>From</div>
		<div class=css_th>To</div>
		<div class=css_th>Status</div>
		<div class=css_th>Payment Status</div>
		
	</div>
<?php echo $reservationContent; ?>
</div>
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