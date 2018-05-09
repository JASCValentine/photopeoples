<?php session_start(); ?>
<?php
$cust_id = $_SESSION['cust_id'];

$db = new PDO('sqlite:db/photopeoples.sqlite');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

$stmt = $db->prepare("SELECT * FROM message WHERE cust_id= :cust_id group by pho_id");

$stmt->bindParam(':cust_id', $cust_id );

$stmt->execute();
$result = $stmt->fetchAll();

foreach($result as $row) {
$pho_id= $row['pho_id'];

$messageContent.="<div class=css_tr>\n";
if ($row['sender']=="customer"){
$messageContent.="<div class=css_td>To</div>\n";
}else{
$messageContent.="<div class=css_td>From</div>\n";
}
	$stmt2 = $db->prepare("SELECT name from photographer where pho_id=:pho_id");
	$stmt2->bindParam(':pho_id', $pho_id );
	$stmt2->execute();
	$result2 = $stmt2->fetchAll();

	foreach($result2 as $row2) {
		$pho_name = $row2[name];
	}
$messageContent.="<div class=css_td>".$pho_name."</div>\n";
$messageContent.="<div class=css_td>".$row['content']."</div>\n";
$messageContent.="<div class=css_td>".$row['last_mod_date']."</div>\n";
$messageContent.="<div class=css_td><a href=\"message.php?pho_id=".$pho_id."\">Send Message To Photographer</a></div>\n";
$messageContent.="</div>\n";
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
			<h2>My Message</h2>
<div id="css_table">
	<div class=css_tr>
		<div class=css_th>From/To</div>
		<div class=css_th>Photographer</div>
		<div class=css_th>message</div>		
		<div class=css_th>Send Date</div>		
		<div class=css_th></div>		
	</div>
<?php echo $messageContent; ?>
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