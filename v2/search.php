<html>
<head>
<meta charset="UTF-8" />
<title>Search Results</title>
<!-- Range slider-->
<?php include 'price-range-js.php' ?>
<!-- Range slider-->  
  	<!--<script>
  		$(function(){
  			$("#searchBarContainer").load("searchbar.html");
  		});
  	</script>-->
	<link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">	
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
<?php	
$criteria = "";		
$db = new PDO('sqlite:db/photopeoples.sqlite');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
				
				
$searchKeyword = $_POST['keyword'];
if ($searchKeyword!=""){
	$criteria .= "AND (name like '%".$searchKeyword."%' OR nationalty like '%".$searchKeyword."%' OR style like '%".$searchKeyword."%') ";
}

$searchPho_name = $_POST['pho_name'];
if ($searchPho_name!=""){
	$criteria .= " AND (name like '%".$searchPho_name."%') ";
}
$searchDestination = $_POST['destination'];
if ($searchDestination!=""){
	$criteria .= " AND (nationalty like '%".$searchDestination."%') ";
}
//$searchDate = $_POST['date'];
//$searchType = $_POST['type'];


$query = "select pho_id, name, nationalty, experience, style from PHOTOGRAPHER ";
if ($criteria!=""){
	$query.=" where 1=1 ".$criteria;
}


$stmt = $db->prepare($query);

$stmt->execute();
$result = $stmt->fetchAll();

$username = "";
$count =0;
foreach($result as $row) {
  $count++;
  
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
	
?>  
				<a class="event_href" href="event_details.php?pho_id=<?php echo $row['pho_id']?>">
				<?php if ($count%3==0){ ?>
				<div class="event event_left">
				<?php }else{?>
					<div class="event">
				<?php }?>	
						<img src="images/temp1.jpg"><br />
						<span class="heading_city"><?php echo $row['style']?> - <?php echo $row['nationalty']?></span><br />
						<span class="heading_subject"><?php echo $row['experience']; ?></span><br />
						<span class="heading_price">$<?php echo $hourrate ;?> per hour</span><br />					
						<div class="rating rating4">
							<?php if ($row2[0]>=1) {?><svg viewBox="0 0 1000 1000" role="presentation" aria-hidden="true" focusable="false" style="height: 1em; width: 1em; display: block; fill: currentcolor;"><path d="M971.5 379.5c9 28 2 50-20 67L725.4 618.6l87 280.1c11 39-18 75-54 75-12 0-23-4-33-12l-226.1-172-226.1 172.1c-25 17-59 12-78-12-12-16-15-33-8-51l86-278.1L46.1 446.5c-21-17-28-39-19-67 8-24 29-40 52-40h280.1l87-278.1c7-23 28-39 52-39 25 0 47 17 54 41l87 276.1h280.1c23.2 0 44.2 16 52.2 40z"></path></svg><?php }?>
							<?php if ($row2[0]>=2) {?><svg viewBox="0 0 1000 1000" role="presentation" aria-hidden="true" focusable="false" style="height: 1em; width: 1em; display: block; fill: currentcolor;"><path d="M971.5 379.5c9 28 2 50-20 67L725.4 618.6l87 280.1c11 39-18 75-54 75-12 0-23-4-33-12l-226.1-172-226.1 172.1c-25 17-59 12-78-12-12-16-15-33-8-51l86-278.1L46.1 446.5c-21-17-28-39-19-67 8-24 29-40 52-40h280.1l87-278.1c7-23 28-39 52-39 25 0 47 17 54 41l87 276.1h280.1c23.2 0 44.2 16 52.2 40z"></path></svg><?php }?>
							<?php if ($row2[0]>=3) {?><svg viewBox="0 0 1000 1000" role="presentation" aria-hidden="true" focusable="false" style="height: 1em; width: 1em; display: block; fill: currentcolor;"><path d="M971.5 379.5c9 28 2 50-20 67L725.4 618.6l87 280.1c11 39-18 75-54 75-12 0-23-4-33-12l-226.1-172-226.1 172.1c-25 17-59 12-78-12-12-16-15-33-8-51l86-278.1L46.1 446.5c-21-17-28-39-19-67 8-24 29-40 52-40h280.1l87-278.1c7-23 28-39 52-39 25 0 47 17 54 41l87 276.1h280.1c23.2 0 44.2 16 52.2 40z"></path></svg><?php }?>
							<?php if ($row2[0]>=4) {?><svg viewBox="0 0 1000 1000" role="presentation" aria-hidden="true" focusable="false" style="height: 1em; width: 1em; display: block; fill: currentcolor;"><path d="M971.5 379.5c9 28 2 50-20 67L725.4 618.6l87 280.1c11 39-18 75-54 75-12 0-23-4-33-12l-226.1-172-226.1 172.1c-25 17-59 12-78-12-12-16-15-33-8-51l86-278.1L46.1 446.5c-21-17-28-39-19-67 8-24 29-40 52-40h280.1l87-278.1c7-23 28-39 52-39 25 0 47 17 54 41l87 276.1h280.1c23.2 0 44.2 16 52.2 40z"></path></svg><?php }?>
							<?php if ($row2[0]>=5) {?><svg viewBox="0 0 1000 1000" role="presentation" aria-hidden="true" focusable="false" style="height: 1em; width: 1em; display: block; fill: currentcolor;"><path d="M971.5 379.5c9 28 2 50-20 67L725.4 618.6l87 280.1c11 39-18 75-54 75-12 0-23-4-33-12l-226.1-172-226.1 172.1c-25 17-59 12-78-12-12-16-15-33-8-51l86-278.1L46.1 446.5c-21-17-28-39-19-67 8-24 29-40 52-40h280.1l87-278.1c7-23 28-39 52-39 25 0 47 17 54 41l87 276.1h280.1c23.2 0 44.2 16 52.2 40z"></path></svg><?php }?>
							<?php if (fmod($row2[0],'1') != 0) {?><svg viewBox="0 0 1000 1000" role="presentation" aria-hidden="true" focusable="false" style="height: 1em; width: 1em; display: block; fill: currentcolor;"><path d="M510.2 23.3l1 767.3-226.1 172.2c-25 17-59 12-78-12-12-16-15-33-8-51l86-278.1L58 447.5c-21-17-28-39-19-67 8-24 29-40 52-40h280.1l87-278.1c7.1-23.1 28.1-39.1 52.1-39.1z"></path></svg><?php }?>
						
						</div>
						<!--<span class="rating_number"><?php if ($row2[1]!=0)echo $row2[1];?></span>-->
					</div>
				</a>  
<?php
	}  
}	
?>		
	
				<div class="clear"></div>	
				
				
<!-- Recommendation -->				
<h2>Recommendation</h2>	
<?php			

$query = "select pho_id, name, nationalty, experience, style from PHOTOGRAPHER limit 3";

$stmt = $db->prepare($query);

$stmt->execute();
$result = $stmt->fetchAll();

$username = "";
$count =0;
foreach($result as $row) {
  $count++;
  
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
	
?>  
				<a class="event_href" href="event_details.php?pho_id=<?php echo $row['pho_id']?>">
				<?php if ($count%3==0){ ?>
				<div class="event event_left">
				<?php }else{?>
					<div class="event">
				<?php }?>	
						<img src="images/temp2.jpg"><br />
						<span class="heading_city"><?php echo $row['style']?> - <?php echo $row['nationalty']?></span><br />
						<span class="heading_subject"><?php echo $row['experience']; ?></span><br />
						<span class="heading_price">$<?php echo $hourrate ;?> per hour</span><br />					
						<div class="rating rating4">
							<?php if ($row2[0]>=1) {?><svg viewBox="0 0 1000 1000" role="presentation" aria-hidden="true" focusable="false" style="height: 1em; width: 1em; display: block; fill: currentcolor;"><path d="M971.5 379.5c9 28 2 50-20 67L725.4 618.6l87 280.1c11 39-18 75-54 75-12 0-23-4-33-12l-226.1-172-226.1 172.1c-25 17-59 12-78-12-12-16-15-33-8-51l86-278.1L46.1 446.5c-21-17-28-39-19-67 8-24 29-40 52-40h280.1l87-278.1c7-23 28-39 52-39 25 0 47 17 54 41l87 276.1h280.1c23.2 0 44.2 16 52.2 40z"></path></svg><?php }?>
							<?php if ($row2[0]>=2) {?><svg viewBox="0 0 1000 1000" role="presentation" aria-hidden="true" focusable="false" style="height: 1em; width: 1em; display: block; fill: currentcolor;"><path d="M971.5 379.5c9 28 2 50-20 67L725.4 618.6l87 280.1c11 39-18 75-54 75-12 0-23-4-33-12l-226.1-172-226.1 172.1c-25 17-59 12-78-12-12-16-15-33-8-51l86-278.1L46.1 446.5c-21-17-28-39-19-67 8-24 29-40 52-40h280.1l87-278.1c7-23 28-39 52-39 25 0 47 17 54 41l87 276.1h280.1c23.2 0 44.2 16 52.2 40z"></path></svg><?php }?>
							<?php if ($row2[0]>=3) {?><svg viewBox="0 0 1000 1000" role="presentation" aria-hidden="true" focusable="false" style="height: 1em; width: 1em; display: block; fill: currentcolor;"><path d="M971.5 379.5c9 28 2 50-20 67L725.4 618.6l87 280.1c11 39-18 75-54 75-12 0-23-4-33-12l-226.1-172-226.1 172.1c-25 17-59 12-78-12-12-16-15-33-8-51l86-278.1L46.1 446.5c-21-17-28-39-19-67 8-24 29-40 52-40h280.1l87-278.1c7-23 28-39 52-39 25 0 47 17 54 41l87 276.1h280.1c23.2 0 44.2 16 52.2 40z"></path></svg><?php }?>
							<?php if ($row2[0]>=4) {?><svg viewBox="0 0 1000 1000" role="presentation" aria-hidden="true" focusable="false" style="height: 1em; width: 1em; display: block; fill: currentcolor;"><path d="M971.5 379.5c9 28 2 50-20 67L725.4 618.6l87 280.1c11 39-18 75-54 75-12 0-23-4-33-12l-226.1-172-226.1 172.1c-25 17-59 12-78-12-12-16-15-33-8-51l86-278.1L46.1 446.5c-21-17-28-39-19-67 8-24 29-40 52-40h280.1l87-278.1c7-23 28-39 52-39 25 0 47 17 54 41l87 276.1h280.1c23.2 0 44.2 16 52.2 40z"></path></svg><?php }?>
							<?php if ($row2[0]>=5) {?><svg viewBox="0 0 1000 1000" role="presentation" aria-hidden="true" focusable="false" style="height: 1em; width: 1em; display: block; fill: currentcolor;"><path d="M971.5 379.5c9 28 2 50-20 67L725.4 618.6l87 280.1c11 39-18 75-54 75-12 0-23-4-33-12l-226.1-172-226.1 172.1c-25 17-59 12-78-12-12-16-15-33-8-51l86-278.1L46.1 446.5c-21-17-28-39-19-67 8-24 29-40 52-40h280.1l87-278.1c7-23 28-39 52-39 25 0 47 17 54 41l87 276.1h280.1c23.2 0 44.2 16 52.2 40z"></path></svg><?php }?>
							<?php if (fmod($row2[0],'1') != 0) {?><svg viewBox="0 0 1000 1000" role="presentation" aria-hidden="true" focusable="false" style="height: 1em; width: 1em; display: block; fill: currentcolor;"><path d="M510.2 23.3l1 767.3-226.1 172.2c-25 17-59 12-78-12-12-16-15-33-8-51l86-278.1L58 447.5c-21-17-28-39-19-67 8-24 29-40 52-40h280.1l87-278.1c7.1-23.1 28.1-39.1 52.1-39.1z"></path></svg><?php }?>
						
						</div>
						<!--<span class="rating_number"><?php if ($row2[1]!=0)echo $row2[1];?></span>-->
					</div>
				</a>  
<?php
	}  
}	
?>	
<!-- End of Recommendation -->		
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