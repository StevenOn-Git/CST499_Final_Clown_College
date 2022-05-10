<?php
	error_reporting(E_ALL ^ E_NOTICE);

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title> Registration: Clown College </title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link href="../Style/CST499.css" rel="stylesheet" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>	
</head>
<body>
	<?php require '../master.php';?>
	<!-- PHP code -->
	<!-- PHP code -->
	<?php 
		// Insert class object into database
		if(isset($_POST['submit'])){
			// page variables
			$email = $_POST['email'];
			$username = $_POST['username'];
			$firstname = $_POST['firstname'];
			$lastname = $_POST['lastname'];
			$phone = $_POST['phone'];
			$password = $_POST['password'];

			try{
				# set up connection string reading from config.php
				$sqlConnect = new mySQLDBConnection();
				$pdo = $sqlConnect->start_SQLConn();
				$result = $sqlConnect->post_newUser($pdo,$email,$username,$firstname,$lastname,$phone,$password);
				if($result==1){
					echo "Success!";
					# set the session user
					session_start();
					if(!isset($_SESSION["user"])) {
						$_SESSION["user"] = $username;	
					}

					#send user to login page
					echo "<script type=text/javascript>";
					echo 'var url = "../Profile";';
					echo 'window.open(url, "_self");';
					echo "</script>";			
				}
				else{
					# login failed
				}

				# close the connection
				$sqlConnect->close_SQLConn($pdo);
			}
			catch (PDOException $e){
				echo $e->getMessage();
			}				
		}
	?>	
	<!-- Login Page -->
	<div class="container-fluid" style="text-align: center; padding-top: 25px;">
		<h2>Create your Clown College Account</h2>
	</div>
	<hr size="1">
	<!-- Login Form -->
	<form method="post" action="index.php">
		<div class="container">
			<div class="form-floating mb-3">
				<input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="email">
				<label for="floatingInput">Email address</label>
			</div>
			<div class="form-floating mb-3">
				<input type="userName" class="form-control" id="floatingInput" placeholder="Pennywise" name="username">
				<label for="floatingInput">Username</label>
			</div>
			<div class="form-floating mb-3">
				<input type="firstName" class="form-control" id="floatingInput" placeholder="John" name="firstname">
				<label for="floatingInput">First name</label>
			</div>
			<div class="form-floating mb-3">
				<input type="lastName" class="form-control" id="floatingInput" placeholder="Doe" name="lastname">
				<label for="floatingInput">Last name</label>
			</div>
			<div class="form-floating mb-3">
				<input type="tel" class="form-control" id="floatingInput" placeholder="9161111111" name="phone">
				<label for="floatingInput">Mobile phone number (optional)</label>
			</div>									
			<div class="form-floating">
				<input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password">
				<label for="floatingPassword">Password</label>
			</div>
			<hr size="1">			
			<button name="submit" type="submit" class="btn btn-outline-dark btn-lg form-control">Create account</button>
			<hr size="1">			
			<button type="button" class="btn btn-outline-light btn-lg form-control" onclick="window.location.href='../Login';">Or sign in</button>
		</div>
	</form>

	<hr size=1/>

	<?php require_once '../footer.php';?>
</body>
</html>