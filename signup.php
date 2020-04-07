<?php
$errors=[];

if (isset($_POST['submit'])) {
	//post var
	$name=$_POST['name'];
	$email=$_POST['email'];
	$Password=$_POST['Password'];
	//name validtion
	if (empty(trim($name))) {
		$errors['name']="Name can't be empty";
	}else{
		if(!preg_match('/^[a-zA-Z]{2,16}$/' , $name)) {
			$errors['name']="Name not valid: name must be at least 2 caracters long, can contain any lower case and uper case character from a-z and not more than 16 caracters long";
		}
	}
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
		$sql="INSERT INTO user (name, email, password, time) VALUES ('$name', '$email', '$Password', 'nill')";
		$query=mysqli_query($conn, $sql);
		if ($query) {
			header("Location: login.php");
		}else{
			$error=  "not successful"." ". mysqli_error($conn);
		}
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>register</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="container">
<center>
<form method="post">
	<h4>Register</h4>


	<label>
		Name
	</label><br>
	<input type="text" name="name">
	<div class="errors"><?php echo $errors['name']?? '';  ?></div>
	<label>
		Email
	</label><br>
	<input type="text" name="email">
	<div class="errors"><?php echo $errors['email']?? '' ;  ?></div>

	<label>
		Password
	</label><br>
	<input type="Password" name="Password">
	<div class="errors"><?php echo $errors['password'] ?? '';  ?></div>

	<button type="submit" name="submit">Register</button>
</form>


have account? <a href="login.php"> login` </a>
</center>
</div>
</body>
</html>