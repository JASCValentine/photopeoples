<?php session_start(); ?>
<?php

$reservationContent="";

$db = new PDO('sqlite:db/photopeoples.sqlite');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

$isSend = $_POST['isSend'];
$pho_id = $_GET['pho_id'];
$cust_id = $_SESSION['cust_id'];

if ($isSend){
//$app_id = $_POST['app_id'];

$insert = "INSERT INTO message (pho_id, cust_id, content, sender) values (:pho_id, :cust_id, :content, :sender)";	

$stmt = $db->prepare($insert);

$sender = "customer";
$payment_status = "pending";

$stmt->bindParam(':pho_id', $pho_id);
$stmt->bindParam(':cust_id', $cust_id);
$stmt->bindParam(':content', $_POST['message']);
$stmt->bindParam(':sender', $sender);

$stmt->execute();


}

	$stmt2 = $db->prepare("SELECT name from photographer where pho_id=:pho_id");
	$stmt2->bindParam(':pho_id', $pho_id );
	$stmt2->execute();
	$result2 = $stmt2->fetchAll();

	foreach($result2 as $row2) {
		$pho_name = $row2['name'];
	}


$dialog = "";
$stmt = $db->prepare("SELECT * FROM message WHERE cust_id= :cust_id and pho_id=:pho_id");

$stmt->bindParam(':cust_id', $cust_id );
$stmt->bindParam(':pho_id', $pho_id );

$stmt->execute();
$result = $stmt->fetchAll();

foreach($result as $row) {
	if ($row['sender']=="customer"){
	$dialog.="<p style=width:300px;text-align:right;font-size:14px;margin-bottom:5px>me</p>";
	$dialog.="<div class=\"container\">\n";
	$dialog.="  <div class=\"arrowRight\">\n";
	$dialog.="    <div class=\"outer\"></div>\n";
	$dialog.="    <div class=\"inner\"></div>\n";
	$dialog.="  </div>\n";
	$dialog.="  <div class=\"message-body\">\n";
	$dialog.="    <p>".$row['content']."</p>\n";
	$dialog.="  </div>\n";
	$dialog.="</div>\n";
	$dialog.="<div style=clear:both></div>\n";
	$dialog.="<p style=width:350px;text-align:right;font-size:12px;>".$row['last_mod_date']."</p>";
	}else{
	$dialog.="<div class=\"container\">\n";
	$dialog.="  <div class=\"arrowLeft\">\n";
	$dialog.="    <div class=\"outer\"></div>\n";
	$dialog.="    <div class=\"inner\"></div>\n";
	$dialog.="  </div>\n";
	$dialog.="  <div class=\"message-body\">\n";
	$dialog.="    <p>".$row['content']."</p>\n";
	$dialog.="  </div>\n";
	$dialog.="</div>\n";
	$dialog.="<div style=clear:both></div>\n";
	$dialog.="<p style=width:350px;text-align:right;font-size:12px;>".$row['last_mod_date']."</p>";
	}
}
?>
<html>
<head>
<meta charset="UTF-8" />
<title>Message to Photographer</title>
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

/* Message box starts here */
.container {
  clear: both;
  position: relative;
}
.container .arrowLeft {
  width: 12px;
  height: 20px;
  overflow: hidden;
  position: relative;
  float: left;
  top: 6px;
  right: -1px;
}

.container .arrowLeft .outer {
  width: 0;
  height: 0;
  border-right: 20px solid #000000;
  border-top: 10px solid transparent;
  border-bottom: 10px solid transparent;
  position: absolute;
  top: 0;
  left: 0;
}

.container .arrowLeft .inner {
  width: 0;
  height: 0;
  border-right: 20px solid #ffffff;
  border-top: 10px solid transparent;
  border-bottom: 10px solid transparent;
  position: absolute;
  top: 0;
  left: 2px;
}


.container .arrowRight {
  width: 17px;
  height: 20px;
  overflow: hidden;
  position: relative;
  float: left;
  top: 6px;
  right: -304px;
}

.container .arrowRight .outer {
  width: 0;
  height: 0;
  border-left: 20px solid #000000;
  border-top: 10px solid transparent;
  border-bottom: 10px solid transparent;
  position: absolute;
  top: 0;
  left: -2px;
}

.container .arrowRight .inner {
  width: 0;
  height: 0;
  border-left: 20px solid #ffffff;
  border-top: 10px solid transparent;
  border-bottom: 10px solid transparent;
  position: absolute;
  top: 0;
  left: -4px;
}

.container .message-body {
  float: left;
  width: 270px;
  height: auto;
  border: 1px solid #CCC;
  background-color: #ffffff;
  border: 1px solid #000000;
  padding: 6px 8px;
  -webkit-border-radius: 5px;
  -moz-border-radius: 5px;
  -o-border-radius: 5px;
  border-radius: 5px;
}

.container .message-body p {
  margin: 0;
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
			<div id="searchBarContainer" style="display:none">
				<?php include 'searchbar.php' ?>
			</div>
			<!-- End of Search Bar -->
			<div id="mainContent">
			<h2>Message to Photographer (<a style="font-size:24px;"  href="event_details.php?pho_id=<?php echo $pho_id; ?>"><?php echo $pho_name; ?></a>)</h2>
<?php echo $reservationContent; ?>
<h3>Dialog</h3>
<?php echo $dialog; ?>
<div style="clear:both"></div>
<br /><br />
<form action="message.php?pho_id=<?php echo $pho_id; ?>" method="post">
Message:
<textarea name="message" ></textarea>
<input type="hidden" name="isSend" id="isSend" value="true">
<input type="submit" value="Send">
</form>
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