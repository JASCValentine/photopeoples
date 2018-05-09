				<div id=logoContainer>
					<a href="index.php"><div id=logo></div></a>
				</div>
				<div id="menuContainer">
					<div id="menuTop" style="background-color:#FFFFFF;height:55px;">
						<div id="menu2" style="padding: 5px 5px 0 0 ;display:none">
							
<?php	

	if ($_SESSION['username']!=""){					
    	echo "Hello, ".$_SESSION['username'];		
    	echo "<form action=logout.php><button>Logout</button></form>";
    }else{
?>
	<a id="btn_register" href="#" ></a>
	<a id="btn_login" href="login.php?ref=<?php echo $_SERVER[REQUEST_URI] ?>"></a>
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
						<ul style="position: absolute;bottom: 0;margin-bottom:10px;display:none">
							<li ><a href="aboutus.php">About Us</a></li>
							<li ><a href="#">Contact Us</a></li>
						</ul>
						<!--<div id="menu1">
							<a href="#">About Us</a>
							<a href="#">Contact Us</a>
						</div>-->
					</div>	

				</div>