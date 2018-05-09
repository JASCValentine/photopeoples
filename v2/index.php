<?php session_start(); ?>
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
<style>
#indexSearch {
   position: relative;
}
#indexSearch:after {
    content : "";
    display: block;
    position: absolute;
    top: 0;
    left: 0;
    background-image: url('images/index_bg.jpg'); 
    width: 100%;
    height: 100%;
    opacity : 0.7;
    z-index: -1;
}
</style>	
<!-- For search box-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>

#indexSearchContent input[type=text] {
  padding: 6px;
  margin-top: 8px;
  font-size: 17px;
  border: none;
}
#indexSearchContent button {
  float: right;
  padding: 6px 10px;
  margin-top: 8px;
  margin-right: 16px;
  background: #ddd;
  font-size: 17px;
  border: none;
  cursor: pointer;
}
#indexSearchContent button:hover {
  background: #ccc;
}
#indexSearchContent a, #indexSearchContent input[type=text], #indexSearchContent button {
    float: none;
    float: left;    
    display: block;
    text-align: left;
    width: 90%;
    margin: 0;
    padding: 14px;
  }
#indexSearchContent input[type=text] {
    border: 1px solid #ccc;  
  }
 #indexSearchContent button {
 float:right;
 width:10%;
 height:50px;

    
 } 
</style>
<!-- For search box-->	
				<div id="indexSearch" style="width:1000px;height:600px;/*background:url('images/index_bg.jpg');*/">
					<div id="indexSearchContent" style="width:500px;padding-top:100px;margin-left:auto;margin-right:auto">
<span style="font-size:70px;color:#84CABA;">PhotoPeoples</span><br />
<span style="font-size:30px;color:#FFFFFF">Connect People with Photos</span>
	<form action="search.php" method="post">
      <input type="text" placeholder="Search.." name="keyword">
      <button type="submit"><i class="fa fa-search"></i></button>
    </form>
					</div>
				</div>
<!-- Recommendation -->				
<h2>Recommendation</h2>	
<?php			
$db = new PDO('sqlite:db/photopeoples.sqlite');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

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