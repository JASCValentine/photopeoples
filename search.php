<html>
<head>
<meta charset="UTF-8" />
<title>index</title>
<!-- Range slider-->
<link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="https://jqueryui.com/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {  
    $( "#slider-range" ).slider({
      range: true,
      min: 0,
      max: 5000,
      values: [ 0, 1000 ],
      swipeThreshold: 500,
      slide: function( event, ui ) {
        $( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
      }
    });
    $( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) +
      " - $" + $( "#slider-range" ).slider( "values", 1 ) );
  } );
  </script>  
<!-- Range slider-->  
  	<!--<script>
  		$(function(){
  			$("#searchBarContainer").load("searchbar.html");
  		});
  	</script>-->
	<style>
		body{
			font-size:12px;color:#757575;
		}
		a{font-size:12px;color:#757575;text-decoration:none;}
		a:hover{text-decoration:underline;}
		.clear{clear:both;}
		#mainContainer{
			margin-left:auto;
			margin-right:auto;
			width:1000px;
			/*background-color:#00FF00;*/
		}
		#footer{
			border-top:2px solid #84CABA;
			padding:10px;
		}
		#header{
		border-bottom:2px solid #84CABA;
		}
		#logoContainer{
			display:block;
			float:left;
			width:170px;
			height:9px;
		}
		#logo{
			margin-left:auto;
			margin-right:auto;
			margin-top:5px;
			width:116px;
			height:70px;
			background-image: url("images/logo.jpg");
   			background-color: #FFFFFF;	
		}
		#menuContainer{
			float:left;
			display:block;
			width:828px;
		}
		#menuContainer a{font-size:12px;color:#757575;text-decoration:none;}
		#menuContainer a:hover{text-decoration:underline;}
		#menuLeft{float:left;position: relative;}
		#menuRight{float:right;}
		#menuBottom ul {
    			list-style-type: none;
    			margin: 0;
    			padding: 0;
		}
		#menuBottom li { float:left;}
		#menuBottom li a {
    		display: block;
    		width: 60px;
		}
		/*#menu1{
			margin-top:30px;
			margin-left:50px;
			float:left;
		}
		#menu1 a{margin-left:20px;}*/
		#menu2{
			display:block;
			float:right;
		}
		#btn_register{
			display:block;
			cursor:pointer;
			float:right;
			height:25px;
			width:65px;
			background: url("images/btn_register.jpg") no-repeat scroll 0 0 ;;
		}
		#btn_login{
			display:block;
			cursor:pointer;
			float:right;
			height:25px;
			width:65px;
			background: url("images/btn_login.jpg") no-repeat scroll 0 0 ;;
		}		
		#menu3{
			float:right;
			margin-top:10px;
		}		
		#searchBarContainer{
			margin-top:10px;
			background-color:#84CABA;
			padding-top:3px;
			padding-bottom:3px;
			padding-left:20px;
		}
		#searchBarContainer input{
			margin-right:10px;
		}
		#searchBarContainer select{
			margin-right:10px;
		}	
		
		#mainContent{
			padding:10px 0 10px 0;
			height:auto;
		}
		#mainContent .event{float:left;display:block;margin-right:50px;margin-bottom:20px;margin-top:20px;}
		#mainContent .event_left{margin-right:0px;}
		#mainContent .event img {width:300px;margin-bottom:10px;}
		#mainContent .event .heading_city{font-size:16px;font-family:Arial;}
		#mainContent .event .heading_subject{font-size:20px;}
		#mainContent .event .heading_price{font-size: 14px;}
		#mainContent .event .rating{margin-top:5px;}
		#mainContent .event .rating svg{float:left;color:#f9df00;}
		#mainContent .event .rating_number{margin-left:10px;}
	</style>
</head>
<body>

	<div id="container">
		<div id="mainContainer">
			<div id="header">
			<?php include 'header.php' ?>
				<!--<div id=logoContainer>
					<div id=logo></div>
				</div>
				<div id="menuContainer">
					<div id="menuLeft">
						<div id="menu1">
							<a href="#">About Us</a>
							<a href="#">Contact Us</a>
						</div>
					</div>	
					<div id="menuRight">
						<div id="menu2">
							<button>Register</button>
							<button>Login</button>
							<div class="clear"></div>
						</div>
						<br/ >
						<div id="menu3">
							<a href="#">Language</a>
						</div>
					</div>
				</div>-->
			<div class="clear"></div>
			</div>
			<!-- End of header -->
			<!-- Search Bar -->
			<div id="searchBarContainer">
				<?php include 'searchbar.php' ?>
				<!--
				<input placeholder="Destination" />
				<input placeholder="Date" size="10" />
				<select name="Type">
					<option selected disabled>Type</option>
					<option value="travel">Travel</option>
					<option value="wedding">Wedding</option>
					<option value="others">Others</option>
				</select>
				<input placeholder="Photographer's name" />
				<input placeholder="Keyword" />

  <label for="amount">Price range:</label>
  <input type="text" id="amount" size="14" readonly style="border:0; color:#f6931f; font-weight:bold;">

 <div style="width:100px;display:inline:;padding-top:5px;float:right;margin-right:50px;">
	<div id="slider-range" ></div>
</div>
																
				<button>Search</button>
				-->
			</div>
			<!-- End of Search Bar -->
			<div id="mainContent">
<?php			
$db = new PDO('sqlite:cal/daypilot.sqlite');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
				
$query = "select pho_id, name, nationalty, experience, style from PHOTOGRAPHER";

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
						<span class="rating_number"><?php if ($row2[1]!=0)echo $row2[1];?></span>
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
						<span class="rating_number"><?php if ($row2[1]!=0)echo $row2[1];?></span>
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