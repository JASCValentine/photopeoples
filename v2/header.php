<?php if (session_status() == PHP_SESSION_NONE) {
	session_start();
} ?>
				<div id=logoContainer>
					<a href="index.php"><div id=logo></div></a>
				</div>
				<div id="menuContainer">
					<div id="menuTop" style="background-color:#FFFFFF;height:55px;">
						<div id="menu2" style="padding: 5px 5px 0 0 ">
							
<?php	

	if (isset($_SESSION['username'])){
    	echo "Hello, ".htmlspecialchars($_SESSION['username']);
    	echo " | <a href=\"myreservation.php\">My Reservation</a>";
    	echo " | <a href=\"mymessage.php\">My Message</a>";
    	echo " | <form action=\"logout.php\" method=\"POST\" style=\"display: inline\"><a href=\"#\" onclick=\"$(this).closest('form').submit()\">Logout</a></form>";
    	echo "<div class=\"clear\"></div>";
    }else{
?>
	<a id="btn_register" href="#" ></a>
	<a id="btn_login" href="login.php?ref=<?php echo htmlspecialchars($_SERVER['REQUEST_URI']) ?>"></a>
	
	<a href="pho_login.php">Photographer login</a> |
		<div class="clear"></div>
<?php    
    }             
?> 							
							
						<a href="#" style="float:right;padding-top:10px;">Language</a>
						</div>
						<!--<br/ >
						<div id="menu3">
							<a href="#">Language</a>
						</div>-->
					</div>				
					<div id="menuBottom" style="position:relative;background-color:#FFFFFF;height:30px;">
						<ul style="position: absolute;bottom: 0;margin-bottom:10px;">
							<li ><a href="aboutus.php">About Us</a></li>
							<li ><a href="#">Contact Us</a></li>
						</ul>
						<!--<div id="menu1">
							<a href="#">About Us</a>
							<a href="#">Contact Us</a>
						</div>-->
					</div>	

				</div>