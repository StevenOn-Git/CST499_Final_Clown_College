<?php
	error_reporting(E_ALL ^ E_NOTICE);

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title> Login: Clown College </title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link href="../Style/CST499.css" rel="stylesheet" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>	
</head>
<body>
	<?php require '../master.php';?>
	<!-- PHP code -->
	<?php 
		// Insert class object into database
		if(isset($_POST['submit'])){
			// page variables
			$email = $_POST['email'];
			$password = $_POST['password'];

			try{
				# returns a PDOStatement object
				$sqlConnect = new mySQLDBConnection();
				$pdo = $sqlConnect->start_SQLConn();
				$result = $sqlConnect->get_userLogin($pdo, $email, $password);

				# fetch records
				$rowCount = $result->rowCount();
				if ($rowCount > 0){
					# loop through the dataset
					while ($row = $result->fetch()){
						// the keys match the field names from the table
						if ($row['paswrd'] == $password && ($row['email'] == $email || $row['username'] == $email)){
							# user is found in the database!
							echo "Success!";
							# set the session user
							session_start();
							if(!isset($_SESSION["user"])) {
								$_SESSION["user"] = $row['username'];
							}

							#send user to login page
							echo "<script type=text/javascript>";
							echo 'var url = "../Profile";';
							echo 'window.open(url, "_self");';
							echo "</script>";
							break;							
						}
					}					
				}
				else{
					echo '<script type="text/javascript">';
					echo 'alert("Invalid Username, Email, or Password!")';
					echo '</script>';
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
		<h2>Sign into your Clown College account</h2>
	</div>
	<hr size="1">

	<form method="post" action="index.php">
		<div class="container">
			<div class="form-floating mb-3">
				<input name="email" class="form-control" id="floatingInput" placeholder="name@example.com">
				<label for="floatingInput">Email address or Username</label>
			</div>
			<div class="form-floating">
				<input name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password">
				<label for="floatingPassword">Password</label>
			</div>
			<hr size="1">			
			<button name="submit" type="submit" class="btn btn-outline-warning btn-lg form-control">Submit</button>
			<hr size="1">			
			<button type="button" class="btn btn-outline-light btn-lg form-control" onclick="window.location.href='../Registration';">Create your Clown College account</button>
		</div>
	</form>

	<hr size=1/>

	<?php require_once '../footer.php';?>
</body>
</html>