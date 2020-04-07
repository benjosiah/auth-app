<?php
session_start();
if (empty($_SESSION)) {
	header("location: login.php");
}


$user=$_SESSION;
?>

<!DOCTYPE html>
<html>
<head>
	<title>register</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div><h2>Dashboard</h2></div>
<a href="logout.php"> Log out </a>
<div class="container">
	<div class="info">
		Name:<?php echo $user['name'] ;   ?><br>
		Email:<?php echo $user['email'];   ?><br>
		Last login:
		<?php 
			if ($user['time']=='nill') {
				echo "first login";
			}else{
				echo $user['time'];
			}
		?><br>

	</div>
</div>

</body>
</html>