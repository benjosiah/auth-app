<?php
$errors=[];
if (isset($_POST['submit'])) {
	//post var
	
	$email=$_POST['email'];
	$Password=$_POST['Password'];
	
	//email validation
	if (empty(trim($email))) {
		$errors['email']="Email can't be empty";
	}else{
		if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
			
		}else{
			$errors['email']="Not a valid email";
		}
	}

	//password validation
	if (empty(trim($Password))) {
		$errors['password']="Password can't be empty";
	}else{
		if (!preg_match("/^[a-zA-Z0-9]{6,16}$/", $Password)) {
			$errors['password']="Password not valid : Password must be at least 6 caracters long, can contain any lower case and uper case character from a-z and any number from 0-9";
		}else{
			
		}
	}
	//error filter
	if (empty($errors)) {
		$conn= mysqli_connect('localhost', 'root', '', 'auth_app');
		$sql="SELECT * FROM user WHERE email='$email' AND password='$Password'";
		$query=mysqli_query($conn, $sql);
		if ($query) {
			print_r(mysqli_num_rows($query));
			if (mysqli_num_rows($query)>0) {
				$user=mysqli_fetch_assoc($query);
				$user_id=$user['id'];
				echo $user_id;
				$time=date('Y-m-d H:i:s');
				$sql2="UPDATE user SET time='$time' WHERE id='$user_id'";
				$query2=mysqli_query($conn, $sql2);
				session_start();
				$_SESSION=$user;
				$_SESSION['email']=$user['email'];
				header("location: dash.php");
			 } 
			
		}else{
			echo  "not successful". mysqli_error($conn);
		}
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="style.css">
	<title>Login</title>
</head>
<body>
<div class="container" >
<center>
	<form method="post">
		<h4>Login</h4>
	
	<label>
		Email 
	</label><br>
	<input type="text" name="email">
	<div class="error"><?php echo $errors['email']?? '' ;  ?></div>

	<label>
		Password
	</label><br>
	<input type="Password" name="Password">
	<div class="error"><?php echo $errors['password'] ?? '';  ?></div>

	<button type="submit" name="submit">Login</button>
</form>

don't have account? <a href="signup.php"> register </a>
</center>
</div>
</body>
</html>