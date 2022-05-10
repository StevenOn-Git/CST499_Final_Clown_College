<?php
	error_reporting(E_ALL ^ E_NOTICE);

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title> Courses: Clown College </title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link href="../Style/CST499.css" rel="stylesheet" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-3.5.1.js" crossorigin="anonymous"></script>
	<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"	crossorigin="anonymous"></script>
	<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js" crossorigin="anonymous"></script>
</head>
<script type="text/javascript">
	$(document).ready(function() {
    	$('#example').DataTable();

    	var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
		var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
			return new bootstrap.Popover(popoverTriggerEl)
		})

	} );
</script>
<body>
	<?php require '../master.php';?>
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
		<h2>Clown College Courses</h2>
	</div>
	<hr size="1">
	<!-- Login Form -->
	<form method="post" action="index.php">
		<div class="container">
			<!-- jquery Datatable -->	
			<table id="example" class="table table-dark table-striped" style="width:100%; ">
			        <thead>
			            <tr>
			                <th>Number</th>
			                <th>Name</th>
			                <th>Description</th>
			                <th>Credit</th>
							<th>Pre-Req.</th>			                
			            </tr>
			        </thead>
			        <tbody>
						<!-- PHP code -->
						<?php 
							// Insert class object into database
							try{
								# returns a PDOStatement object
								$sqlConnect = new mySQLDBConnection();
								$pdo = $sqlConnect->start_SQLConn();
								$result = $sqlConnect->get_table($pdo, 'courseslist_v');

								# fetch records for Degree list
								$rowCount = $result->rowCount();
								if ($rowCount > 0){
									# loop through the dataset
									while ($row = $result->fetch()){
										// the keys match the field names from the table
							            echo '<tr>';
							            echo '	<td>' . $row['courseid'] . '</td>';
							            echo '	<td>' . $row['name'] . '</td>';
							            echo '	<td>' . $row['description'] . '</td>';
							            echo '	<td>' . $row['credit'] . '</td>';
							            echo '	<td>' . $row['PR'] . '</td>';							            
							            echo '</tr>';
									}					
								}
								else{
									echo '<script type="text/javascript">';
									echo 'alert("No degrees found!")';
									echo '</script>';
								}

								# close the connection
								$sqlConnect->close_SQLConn($pdo);
							}
							catch (PDOException $e){
								echo $e->getMessage();
							}				
						?>			        	
			        </tbody>
			    </table>
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