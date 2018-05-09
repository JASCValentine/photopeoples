<?php session_start(); ?>
<html>
<head>
<title>detail</title>
	<meta charset="UTF-8" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<!-- Range slider-->
	<link rel="stylesheet" href="./css/jquery.bxslider.css">
	<script src="./js/jquery.bxslider.js"></script>
<!-- Range slider-->
<!-- Fancybox-->
	<script src="./js/fancybox/jquery.fancybox.js"></script>
	<link rel="stylesheet" href="./css/fancybox/jquery.fancybox.css">
<!-- Fancybox-->

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
		#footer{
			border-top:2px solid #84CABA;
			padding:10px;
		}
		#header{
		border-bottom:2px solid #84CABA;
		}
		#logoContainer{
			float:left;
			width:100px;
			height:50px;
		}
		#logo{
			margin-left:auto;
			margin-right:auto;
			margin-top:5px;
			width:80px;
			height:40px;
			background-color:#84CABA;		
		}
		#menuContainer{
			display:block;
			width:100%;
		}
		#menuContainer a{font-size:12px;color:#757575;text-decoration:none;}
		#menuContainer a:hover{text-decoration:underline;}
		#menuLeft{float:left;}
		#menuRight{float:right;}
		#menu1{
			margin-top:30px;
			margin-left:50px;
			float:left;
		}
		#menu1 a{margin-left:20px;}
		#menu2{
			display:block;
			float:right;
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
			margin-right:20px;
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
		#mainContentRight .heading_price{font-size: 14px;}
		#mainContentRight .rating{margin-top:5px;}
		#mainContentRight .rating svg{float:left;color:#f9df00;}	
		#mainContentRight .rating_number{margin-left:10px;}	
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
    //$('.slider').bxSlider();
    
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
				<div id=logoContainer>
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
<?php	
	if ($_SESSION['username']!=""){					
    	echo "Hello, ".$_SESSION['username'];		
    	echo "<form action=logout.php><button>Logout</button></form>";
    }else{
?>
	<button>Register</button>
	<form action="login.php?ref=event.php"><button>Login</button></form>
<?php    
    }             
?>                  				

							<div class="clear"></div>
						</div>
						<br/ >
						<div id="menu3">
							<a href="#">Language</a>
						</div>
					</div>
				</div>
			<div class="clear"></div>
			</div>
			<!-- End of header -->
			<div id="searchBarContainer">
				<input placeholder="Destination" />
				<input placeholder="Date" />
				<input placeholder="Time" />
				<input placeholder="Type" />
				<button>Search</button>
			</div>

			<div id="mainContent" class="event_details">
				<div class="slider">
  					<div><img src="images/temp1.jpg" ></div>
  					<div><img src="images/temp1.jpg" ></div>
				</div>
				<div id="mainContentLeft">
					<section>
						<h1>Pre Wedding · Paris</h1>
						<h3>Paris · Get pictures in front of chic landmarks(Photographer Desc...)</h3>
					</section>
					<section>
						Entertainment experience<br />
						Hosted by Alex
						<br />			
						1 hour total<br />
						Equipment<Br />
						Offered in English<br />
					</section>																			
					<section>
						<h3>About your host, Alex</h3>
						I’m a professional photographer living and working in Paris. I studied photography at École des Beaux-Arts and my work has been selected for the Sony World Photography Awards and shown at the Somerset House in London.
					</section>
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
					<section>
						<h3>Reviews</h3>
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
						<span class="rating_number">271</span>
					</div>
				</a>
				
<div style="clear:both"></div>				
					</section>	
				</div>
				<div id="mainContentRight">
					
						<span class="heading_price">$793 per person</span><br />					
						<div class="rating rating4">
							<svg viewBox="0 0 1000 1000" role="presentation" aria-hidden="true" focusable="false" style="height: 1em; width: 1em; display: block; fill: currentcolor;"><path d="M971.5 379.5c9 28 2 50-20 67L725.4 618.6l87 280.1c11 39-18 75-54 75-12 0-23-4-33-12l-226.1-172-226.1 172.1c-25 17-59 12-78-12-12-16-15-33-8-51l86-278.1L46.1 446.5c-21-17-28-39-19-67 8-24 29-40 52-40h280.1l87-278.1c7-23 28-39 52-39 25 0 47 17 54 41l87 276.1h280.1c23.2 0 44.2 16 52.2 40z"></path></svg>
							<svg viewBox="0 0 1000 1000" role="presentation" aria-hidden="true" focusable="false" style="height: 1em; width: 1em; display: block; fill: currentcolor;"><path d="M971.5 379.5c9 28 2 50-20 67L725.4 618.6l87 280.1c11 39-18 75-54 75-12 0-23-4-33-12l-226.1-172-226.1 172.1c-25 17-59 12-78-12-12-16-15-33-8-51l86-278.1L46.1 446.5c-21-17-28-39-19-67 8-24 29-40 52-40h280.1l87-278.1c7-23 28-39 52-39 25 0 47 17 54 41l87 276.1h280.1c23.2 0 44.2 16 52.2 40z"></path></svg>
							<svg viewBox="0 0 1000 1000" role="presentation" aria-hidden="true" focusable="false" style="height: 1em; width: 1em; display: block; fill: currentcolor;"><path d="M971.5 379.5c9 28 2 50-20 67L725.4 618.6l87 280.1c11 39-18 75-54 75-12 0-23-4-33-12l-226.1-172-226.1 172.1c-25 17-59 12-78-12-12-16-15-33-8-51l86-278.1L46.1 446.5c-21-17-28-39-19-67 8-24 29-40 52-40h280.1l87-278.1c7-23 28-39 52-39 25 0 47 17 54 41l87 276.1h280.1c23.2 0 44.2 16 52.2 40z"></path></svg>
							<svg viewBox="0 0 1000 1000" role="presentation" aria-hidden="true" focusable="false" style="height: 1em; width: 1em; display: block; fill: currentcolor;"><path d="M971.5 379.5c9 28 2 50-20 67L725.4 618.6l87 280.1c11 39-18 75-54 75-12 0-23-4-33-12l-226.1-172-226.1 172.1c-25 17-59 12-78-12-12-16-15-33-8-51l86-278.1L46.1 446.5c-21-17-28-39-19-67 8-24 29-40 52-40h280.1l87-278.1c7-23 28-39 52-39 25 0 47 17 54 41l87 276.1h280.1c23.2 0 44.2 16 52.2 40z"></path></svg>
						</div>
						<span class="rating_number">271 reviews</span>
						<!--<button style="float:right;padding:10px">Book</button>-->

<a data-fancybox data-type="iframe" data-src="cal/index.php?pho_id=<?php echo $_GET['pho_id'];?>" href="javascript:;">
	<button style="float:right;padding:10px">Book</button>
</a>		</div>
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