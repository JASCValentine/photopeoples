<?php
	if (isset($_POST['register'])) {
		$msg = '';
		
		$name = $_POST['name'];
		$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
		$email = $_POST['email'];
		$file = $_FILES['profile_pic'];
		
		//print_r($file);
		
		if (is_uploaded_file($file['tmp_name'])) {
			$profile_pic = basename($file['name']);
			//echo "file is uploaded to $file[tmp_name]";
			// TODO https://secure.php.net/manual/en/features.file-upload.post-method.php
		} else {
			$profile_pic = NULL;
			//echo 'No upload';
		}
		
		// check email address
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$msg = 'Email is invalid';
		} else {
			$db = new PDO('sqlite:db/photopeoples.sqlite');
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
			
			$query = 'SELECT NULL FROM customer WHERE name = :name';
			$stmt = $db->prepare($query);
			$stmt->bindParam(':name', $name);
			
			$stmt->execute();
			if ($stmt->fetch()) {
				$msg = 'Name is unavailable';
			} else {
				$query = 'INSERT INTO customer VALUES (NULL, :name, :password, :email, \'active\', :reg_date, :last_mod_date, :profile_pic)';
				
				$time = time();
				
				$stmt = $db->prepare($query);
				
				$stmt->bindParam(':name', $name);
				$stmt->bindParam(':password', $password);
				$stmt->bindParam(':email', $email);
				$stmt->bindParam(':reg_date', $time);
				$stmt->bindParam(':last_mod_date', $time);
				$stmt->bindParam(':profile_pic', $profile_pic); //TODO
				
				$stmt->execute();
				if ($stmt->rowCount() === 1) {
					header('Refresh: 0; URL = index.php');
				} else {
					$msg = 'Failed to register';
				}
			}
		}
	 }
?>
<html>
<head>
<meta charset="UTF-8" />
<title>Register</title>
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
			<div id="searchBarContainer">
				<?php include 'searchbar.php' ?>
			</div>
			<!-- End of Search Bar -->
			<div id="mainContent">
				<form name="registerForm" enctype="multipart/form-data" action="<?=htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST">
					<div><input type="text" name="name" placeholder="Username" required /></div>
					<div><input type="password" name="password" placeholder="Password" required /></div>
					<div><input type="email" name="email" placeholder="Email" required /></div>
					<div><input type="file" name="profile_pic" accept="image/*" /></div>
					<div><button type="submit" name="register">Register</button></div>
					<?php if (!empty($msg)) {
						echo "<div>$msg</div>";
					} ?>
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