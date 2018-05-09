<?php session_start(); ?>
<?php
	$pho_id = $_GET['pho_id'];
	
	
	$db = new PDO('sqlite:db/photopeoples.sqlite');
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

	$query = "select * from PHOTOGRAPHER where pho_id=:pho_id";
	
	$stmt = $db->prepare($query);
	$stmt->bindParam(':pho_id', $pho_id);
	$stmt->execute();
	$result = $stmt->fetchAll();

	foreach($result as $row) {
		$name = $row['name'];
		$profile_pic = $row['profile_pic'];
		$gender = $row['gender'];
		$language = $row['language'];
		$location = $row['location'];
		$aboutme = $row['aboutme'];
		$category = $row['category'];
		$min_booking = $row['min_booking'];
		
	}
	
	$query = "select * from price where pho_id=:pho_id";
	
	$stmt = $db->prepare($query);
	$stmt->bindParam(':pho_id', $pho_id);
	$stmt->execute();
	$result = $stmt->fetchAll();

	foreach($result as $row) {
		if($row[price_type]==1){
			$hourlyRate = $row[price];
		}
		if($row[price_type]==2){
			$dailyRate = $row[price];
		}
	}
	/*
		echo $name ."<br />";
		echo $profile_pic."<br />";
		echo $gender."<br />";
		echo $language."<br />";
		echo $location."<br />";
		echo $aboutme."<br />";
		echo $category."<br />";
		echo $min_booking."<br />";
		*/
		
	$query = "select c.name, r.comment, strftime('%d/%m/%Y', r.last_mod_date) as reviewDate, c.profile_pic from review r, customer c where r.pho_id=:pho_id and c.cust_id=r.cust_id";
	
	$stmt = $db->prepare($query);
	$stmt->bindParam(':pho_id', $pho_id);	
	$stmt->execute();
	$result = $stmt->fetchAll();

	$reviewContent="";
	foreach($result as $row) {		
		$reviewContent.="<div style=\"display:block;border-bottom:1px solid #C0C0C0;padding:10px 0 20px 0\">\n";
		$reviewContent.="<img src=\"".$row[profile_pic]."\">\n";
		$reviewContent.="<span class=\"reviewerName\">".$row[name]."</span><br/>\n";
		$reviewContent.=$row[reviewDate]."<br /><br />\n";
		$reviewContent.=$row[comment]."\n";
		$reviewContent.="</div>\n";
	}	
	
	$query = "select AVG(rating), COUNT(rating) from review where pho_id= :pho_id";
  	$stmt = $db->prepare($query);
	$stmt->bindParam(':pho_id', $pho_id);	
	$stmt->execute();
	$result = $stmt->fetchAll();
	foreach($result as $row) {
		$rating = $row[0];
	}
?>
<html>
<head>
<title>detail</title>
	<meta charset="UTF-8" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<!-- Range slider-->
<?php include 'price-range-js.php' ?>
<!-- Range slider-->
<!-- Photo slide show-->
	<link rel="stylesheet" href="./css/jquery.bxslider.css">
	<script src="./js/jquery.bxslider.js"></script>
<!-- Photo slide show-->	
<!-- Fancybox-->
	<script src="./js/fancybox/jquery.fancybox.js"></script>
	<link rel="stylesheet" href="./css/fancybox/jquery.fancybox.css">
<!-- Fancybox-->
	<link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">	
<style>		
body{
			font-size:14px;color:#757575;
		}
		a{font-size:14px;color:#757575;text-decoration:none;}
		a:hover{text-decoration:underline;}
		.clear{clear:both;}
		#mainContainer{
			margin-left:auto;
			margin-right:auto;
			width:1000px;
			/*background-color:#00FF00;*/
		}
#mainContent{
			padding:10px 0 10px 0;
			height:auto;
		}
		#mainContent #mainContentLeft{width:650px;margin-right:30px;float:left;}
		#mainContent #mainContentRight{width:320px;float:left;}
		.event_details section{border-bottom:1px solid #C0C0C0;padding:10px 0 10px 0;}
		.event_details section h1{font-size:40px;margin:10px 0 5px 0;}
		#mainContentRight img{margin-bottom:20px;}
		#mainContentLeft .heading_price{font-size: 14px;}
		#mainContentLeft .rating{margin-top:5px;}
		#mainContentLeft .rating svg{float:left;color:#f9df00;}	
		#mainContentLeft .rating_number{margin-left:10px;}	
		.reviewerName{font-weight:bold;}
		
		#mainContent .event{float:left;display:block;margin-right:50px;margin-bottom:20px;}
		#mainContent .event_left{margin-right:0px;}
		#mainContent .event img {width:300px;margin-bottom:10px;}
		#mainContent .event .heading_city{font-size:16px;font-family:Arial;}
		#mainContent .event .heading_subject{font-size:24px;}
		#mainContent .event .heading_price{font-size: 14px;}
		#mainContent .event .rating{margin-top:5px;}
		#mainContent .event .rating svg{float:left;color:#f9df00;}
		#mainContent .event .rating_number{margin-left:10px;}
/* Fancybox */	
	.fancy-slide--iframe .fancybox-content{
		width: 800px;
		height: 1000px;
		max-width: 80%;
		max-height: 100%;
		margin: 0px;
	}
/* Fancybox */
	</style>
	<script>
  $(document).ready(function(){
  	//photo slide show
    $('.slider').bxSlider({
    pause: 5000,
  		auto: true,
  		autoControls: true,
  		stopAutoOnClick: true,
  		pager: true
  		//slideWidth: 600
	});
	
	//fancybox
	$("[data-fancybox]").fancybox({
		iframe:{
			css:{height:'800px',margin:'10px'}
		}
	});
	
	
  });
</script>
</head>
<body>

	<div id="container">
		<div id="mainContainer">
			<div id="header">
			<?php include 'header.php' ?>
			<div class="clear"></div>
			</div>
			<!-- End of header -->
			<div id="searchBarContainer">
				<?php include 'searchbar.php' ?>
			</div>

			<div id="mainContent" class="event_details">
				<div class="slider">
  					<div><img src="images/temp1.jpg" ></div>
  					<div><img src="images/temp1.jpg" ></div>
				</div>
				<div id="mainContentLeft">
					<section>
						<h1><?php echo $category; ?> · <?php echo $location; ?></h1>
						<h3><?php echo $name; ?></h3>
						<span class="heading_price">$<?php echo $hourlyRate?> per hour</span><br />					
						<div class="rating rating4">
							<?php if ($rating>=1) {?><svg viewBox="0 0 1000 1000" role="presentation" aria-hidden="true" focusable="false" style="height: 1em; width: 1em; display: block; fill: currentcolor;"><path d="M971.5 379.5c9 28 2 50-20 67L725.4 618.6l87 280.1c11 39-18 75-54 75-12 0-23-4-33-12l-226.1-172-226.1 172.1c-25 17-59 12-78-12-12-16-15-33-8-51l86-278.1L46.1 446.5c-21-17-28-39-19-67 8-24 29-40 52-40h280.1l87-278.1c7-23 28-39 52-39 25 0 47 17 54 41l87 276.1h280.1c23.2 0 44.2 16 52.2 40z"></path></svg><?php }?>
							<?php if ($rating>=2) {?><svg viewBox="0 0 1000 1000" role="presentation" aria-hidden="true" focusable="false" style="height: 1em; width: 1em; display: block; fill: currentcolor;"><path d="M971.5 379.5c9 28 2 50-20 67L725.4 618.6l87 280.1c11 39-18 75-54 75-12 0-23-4-33-12l-226.1-172-226.1 172.1c-25 17-59 12-78-12-12-16-15-33-8-51l86-278.1L46.1 446.5c-21-17-28-39-19-67 8-24 29-40 52-40h280.1l87-278.1c7-23 28-39 52-39 25 0 47 17 54 41l87 276.1h280.1c23.2 0 44.2 16 52.2 40z"></path></svg><?php }?>
							<?php if ($rating>=3) {?><svg viewBox="0 0 1000 1000" role="presentation" aria-hidden="true" focusable="false" style="height: 1em; width: 1em; display: block; fill: currentcolor;"><path d="M971.5 379.5c9 28 2 50-20 67L725.4 618.6l87 280.1c11 39-18 75-54 75-12 0-23-4-33-12l-226.1-172-226.1 172.1c-25 17-59 12-78-12-12-16-15-33-8-51l86-278.1L46.1 446.5c-21-17-28-39-19-67 8-24 29-40 52-40h280.1l87-278.1c7-23 28-39 52-39 25 0 47 17 54 41l87 276.1h280.1c23.2 0 44.2 16 52.2 40z"></path></svg><?php }?>
							<?php if ($rating>=4) {?><svg viewBox="0 0 1000 1000" role="presentation" aria-hidden="true" focusable="false" style="height: 1em; width: 1em; display: block; fill: currentcolor;"><path d="M971.5 379.5c9 28 2 50-20 67L725.4 618.6l87 280.1c11 39-18 75-54 75-12 0-23-4-33-12l-226.1-172-226.1 172.1c-25 17-59 12-78-12-12-16-15-33-8-51l86-278.1L46.1 446.5c-21-17-28-39-19-67 8-24 29-40 52-40h280.1l87-278.1c7-23 28-39 52-39 25 0 47 17 54 41l87 276.1h280.1c23.2 0 44.2 16 52.2 40z"></path></svg><?php }?>
							<?php if ($rating>=5) {?><svg viewBox="0 0 1000 1000" role="presentation" aria-hidden="true" focusable="false" style="height: 1em; width: 1em; display: block; fill: currentcolor;"><path d="M971.5 379.5c9 28 2 50-20 67L725.4 618.6l87 280.1c11 39-18 75-54 75-12 0-23-4-33-12l-226.1-172-226.1 172.1c-25 17-59 12-78-12-12-16-15-33-8-51l86-278.1L46.1 446.5c-21-17-28-39-19-67 8-24 29-40 52-40h280.1l87-278.1c7-23 28-39 52-39 25 0 47 17 54 41l87 276.1h280.1c23.2 0 44.2 16 52.2 40z"></path></svg><?php }?>
							<?php if (fmod($rating,'1') != 0) {?><svg viewBox="0 0 1000 1000" role="presentation" aria-hidden="true" focusable="false" style="height: 1em; width: 1em; display: block; fill: currentcolor;"><path d="M510.2 23.3l1 767.3-226.1 172.2c-25 17-59 12-78-12-12-16-15-33-8-51l86-278.1L58 447.5c-21-17-28-39-19-67 8-24 29-40 52-40h280.1l87-278.1c7.1-23.1 28.1-39.1 52.1-39.1z"></path></svg><?php }?>
						</div>
						<!--<span class="rating_number">271 reviews</span>-->
						<!--<button style="float:right;padding:10px">Book</button>-->

<a href="booking.php?pho_id=<?php echo $pho_id; ?>">
	<button style="float:right;padding:10px">Book</button>
</a>		
<a href="message.php?pho_id=<?php echo $pho_id; ?>">
	<button style="float:right;padding:10px;margin-right:20px">Send Message To Photographer</button>
</a>
<div style="clear:both"></div>
					</section>
					<section>
						<h3>Experience<br />
						Hosted by <?php echo $name; ?></h3>
						<br />			
						Gender: <?php echo $gender; ?><br />
						Minimum time: <?php $min_booking; ?><br />
						Offered in <?php echo $language; ?><br />
						Hourly price: <?php echo $hourlyRate; ?><br />
						Daily price: <?php echo $dailyRate; ?><br />
					</section>																			
					<section>
						<h3>About your host, <?php echo $name; ?></h3>
						<?php echo $aboutme; ?>
					</section>
<!--					
					<section>
						<h3>What we’ll do</h3>
						We'll meet at a cafe near the Louvre Museum, then walk around the neighborhood to find perfect spots to take photos. You'll have Paris as your background for a series of pictures that I'll shoot. I'll…+ More
					</section>
					<section>
						<h3>What I’ll provide</h3>
						HD digital pictures<br />
						Between 50 and 100 HD digital pictures sent after the editing.
					</section>	
					<section>
						<h3>Who can come</h3>
						Guests of all ages can attend.
					</section>	
					<section>
						<h3>Notes</h3>
						- meeting point: outside cafe Le Fumoir. - We can meet at a different time of the day - private photo session (couple, family, friends, solo traveler) - price per person except for big groupe
					</section>
					<section>
						<h3>Where we’ll be</h3>
						We'll meet at Le Fumoir, a cafe near the Louvre Museum. We'll take photos in the surrounding Louvre neighborhood, which is located right in the heart of Paris and includes the beautiful Palais-Royal. Eiffel Tower is not included in this experience unless you ask to get there instead.
					</section>
-->					
					<section>
						<h3>Reviews</h3>
						<?php echo $reviewContent; ?>
<!--						
						<div style="display:block;border-bottom:1px solid #C0C0C0;padding:10px 0 20px 0">
						<img src="images/circle.jpg">
						<span class="reviewerName">Erlinda</span><br/>
						November 6, 2017<br /><br />
						This was my first Experience, on Airbnb and I would totally recommend it. I've been to Paris many times, and have never got s…
						<a href="#">+ More</a>
						</div>
						
						<div style="display:block;border-bottom:0px solid #C0C0C0;padding:10px 0 20px 0">
						<img src="images/circle.jpg">
						<span class="reviewerName">Name</span><br/>
						November 6, 2017<br /><br />
						This was my first Experience, on Airbnb and I would totally recommend it. I've been to Paris many times, and have never got s…
						<a href="#">+ More</a>
						</div>
					</section>
-->					
					<section>
						<h3>Similar listings</h3>
				<a class="event_href" href="event_details.html" style="float:left;display:block">
					<div class="event" >
						<img src="images/temp2.jpg"><br />
						<span class="heading_city">Urban Portrait Session - Paris</span><br />
						<span class="heading_subject">Urban Portrait Session</span><br />
						<span class="heading_price">$793 per person</span><br />					
						<div class="rating rating4">
							<svg viewBox="0 0 1000 1000" role="presentation" aria-hidden="true" focusable="false" style="height: 1em; width: 1em; display: block; fill: currentcolor;"><path d="M971.5 379.5c9 28 2 50-20 67L725.4 618.6l87 280.1c11 39-18 75-54 75-12 0-23-4-33-12l-226.1-172-226.1 172.1c-25 17-59 12-78-12-12-16-15-33-8-51l86-278.1L46.1 446.5c-21-17-28-39-19-67 8-24 29-40 52-40h280.1l87-278.1c7-23 28-39 52-39 25 0 47 17 54 41l87 276.1h280.1c23.2 0 44.2 16 52.2 40z"></path></svg>
							<svg viewBox="0 0 1000 1000" role="presentation" aria-hidden="true" focusable="false" style="height: 1em; width: 1em; display: block; fill: currentcolor;"><path d="M971.5 379.5c9 28 2 50-20 67L725.4 618.6l87 280.1c11 39-18 75-54 75-12 0-23-4-33-12l-226.1-172-226.1 172.1c-25 17-59 12-78-12-12-16-15-33-8-51l86-278.1L46.1 446.5c-21-17-28-39-19-67 8-24 29-40 52-40h280.1l87-278.1c7-23 28-39 52-39 25 0 47 17 54 41l87 276.1h280.1c23.2 0 44.2 16 52.2 40z"></path></svg>
							<svg viewBox="0 0 1000 1000" role="presentation" aria-hidden="true" focusable="false" style="height: 1em; width: 1em; display: block; fill: currentcolor;"><path d="M971.5 379.5c9 28 2 50-20 67L725.4 618.6l87 280.1c11 39-18 75-54 75-12 0-23-4-33-12l-226.1-172-226.1 172.1c-25 17-59 12-78-12-12-16-15-33-8-51l86-278.1L46.1 446.5c-21-17-28-39-19-67 8-24 29-40 52-40h280.1l87-278.1c7-23 28-39 52-39 25 0 47 17 54 41l87 276.1h280.1c23.2 0 44.2 16 52.2 40z"></path></svg>
							<svg viewBox="0 0 1000 1000" role="presentation" aria-hidden="true" focusable="false" style="height: 1em; width: 1em; display: block; fill: currentcolor;"><path d="M971.5 379.5c9 28 2 50-20 67L725.4 618.6l87 280.1c11 39-18 75-54 75-12 0-23-4-33-12l-226.1-172-226.1 172.1c-25 17-59 12-78-12-12-16-15-33-8-51l86-278.1L46.1 446.5c-21-17-28-39-19-67 8-24 29-40 52-40h280.1l87-278.1c7-23 28-39 52-39 25 0 47 17 54 41l87 276.1h280.1c23.2 0 44.2 16 52.2 40z"></path></svg>
						</div>
						<!--<span class="rating_number">271</span>-->
					</div>
				</a>
				
<div style="clear:both"></div>				
					</section>	
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