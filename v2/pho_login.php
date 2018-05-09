<?php
   ob_start();
   session_start();
   $db_exists = file_exists("db/photopeoples.sqlite");
   
   /*echo $_SERVER['DOCUMENT_ROOT']."/photopeoples/cal/daypilot.sqlite"."<br />";
   echo "X".$db_exists."X";
   if ($db_exists){
   echo "A";
   }else{
   echo "B";
   }*/
   

?>

<?
   // error_reporting(E_ALL);
   // ini_set("display_errors", 1);
?>


<html>
<head>
<meta charset="UTF-8" />
<title>Photographer login</title>
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
			<?php include 'header_simple.php' ?>
			<div class="clear"></div>
			</div>
			<!-- End of header -->
			<!-- Search Bar -->
			<!--<div id="searchBarContainer">
				<?php include 'searchbar.php' ?>
			</div>-->
			<!-- End of Search Bar -->
			<div id="mainContent">

      <link href = "css/bootstrap.min.css" rel = "stylesheet">
      
      <style>
         /*body {
            padding-top: 40px;
            padding-bottom: 40px;
            background-color: #ADABAB;
         }*/
         
         .form-signin {
            max-width: 330px;
            padding: 15px;
            margin: 0 auto;
            color: #017572;
         }
         
         .form-signin .form-signin-heading,
         .form-signin .checkbox {
            margin-bottom: 10px;
         }
         
         .form-signin .checkbox {
            font-weight: normal;
         }
         
         .form-signin .form-control {
            position: relative;
            height: auto;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
            padding: 10px;
            font-size: 16px;
         }
         
         .form-signin .form-control:focus {
            z-index: 2;
         }
         
         .form-signin input[type="email"] {
            margin-bottom: -1px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
            border-color:#017572;
         }
         
         .form-signin input[type="password"] {
            margin-bottom: 10px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
            border-color:#017572;
         }
         
         h2{
            text-align: center;
            color: #017572;
         }
      </style>
      
   </head>
	
   <body>
      <h1>Photographer Login</h1>
      <h2>Enter Username and Password</h2> 
      <div class = "container form-signin">
         
         <?php
            $msg = '';
            
            if (isset($_POST['login']) && !empty($_POST['username']) 
               && !empty($_POST['password'])) {
				
$db_exists = file_exists("db/photopeoples.sqlite");
$db = new PDO('sqlite:db/photopeoples.sqlite');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
				
$query = "select name, pho_id from photographer where name=:name and password=:password";

$stmt = $db->prepare($query);

$stmt->bindParam(':name', $_POST['username']);
$stmt->bindParam(':password', $_POST['password']);
$stmt->execute();
$result = $stmt->fetchAll();

$username = "";

foreach($result as $row) {
  $pho_name = $row['name'];
  $pho_id = $row['pho_id'];  
}
				
               if ($pho_name!="") {
                  $_SESSION['valid'] = true;
                  $_SESSION['timeout'] = time();
                  $_SESSION['pho_name'] = $pho_name;
                  $_SESSION['pho_id'] = $pho_id;                  
                 
				//echo "<script>window.location.replace('event_details.php?ref=".$_POST['ref']."')</script>";
				echo "<script>window.location.replace('manageReservation.php')</script>";

                  
                  //echo 'You have entered valid use name and password';
               }else {
                  $msg = 'Wrong username or password';
               }
            }
         ?>
      </div> <!-- /container -->
      
      <div class = "container">
      
         <form class = "form-signin" role = "form" 
            action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); 
            ?>" method = "post">
            
            <h4 class = "form-signin-heading"><?php echo $msg; ?></h4>
            <input type = "text" class = "form-control" 
               name = "username" placeholder = "Username" 
               required autofocus></br>
            <input type = "password" class = "form-control"
               name = "password" placeholder = "Password" required>
               <br />
            <button class = "btn btn-lg btn-primary btn-block" type = "submit" 
               name = "login">Login</button>
               <input type="hidden" name=ref id=ref value="<?php echo $_GET['ref'];?>">
         </form>
			
         
         
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