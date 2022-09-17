<?php
	error_reporting(E_ALL ^ E_NOTICE);
	session_start();
	if(isset($_SESSION['user'])){
		// User is logged in
		$userName = $_SESSION['user'];
	}
	else{
		// if the user is guest, they cannot access profile page
		header("Refresh:0, url=../Home");
	}
?>
<!DOCTYPE html>
<html lang="en" >
<head>
	<title> Profile Page </title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link href="../Style/CST499.css" rel="stylesheet" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>	
</head>
<style>
	.card {
	    max-height: 350px;
	    max-width: 300px;
	    overflow: hidden;
	}
</style>
<body>
	<div class="container-fluid" style="text-align: center; padding-top: 25px;">
		<!-- Welcome -->
		<?php require '../master.php';?>
		<h1><?php echo "Welcome!" . " " . $userName;?></h1>
		<!-- Profile -->
		<?php require_once 'info.php';?>
	</div>

	<!-- course list -->
	<hr size="1" />
	<h2>Your Registered Courses</h2>
	<div class="container-fluid" style="padding: 20px;">
		<div class="row">
				<?php
					try{
						# returns a PDOStatement object
						$sqlConnect = new mySQLDBConnection();
						$pdo = $sqlConnect->start_SQLConn();
						
						$res = $sqlConnect->get_userInfo($pdo, $_SESSION['user']);
						# fetch records for user info.
						$rowCount1 = $res->rowCount();
						if ($rowCount1 > 0){
							# get single record
							$row1 = $res->fetch(PDO::FETCH_ASSOC);

							// get semesters info
							$result = $sqlConnect->get_StudentSchedule($pdo, $row1['id']);

							# fetch records for Degree list
							$rowCount = $result->rowCount();
							if ($rowCount > 0){
								#alternating rows
								$start = 0;
								# loop through the dataset
								while ($row = $result->fetch()){
									// display registered courses
									echo '<div class="col-sm-3">';
									if ($start == 0){
										echo '	<div class="card text-white bg-danger mb-3">';
										$start = 1;
									} 
									elseif($start == 1){
										echo '	<div class="card text-white bg-secondary mb-3">';
										$start = 2;
									}
									elseif($start == 2){
										echo '	<div class="card text-white bg-primary mb-3">';
										$start = 3;
									}
									else{
										echo '	<div class="card text-white bg-success mb-3">';
										$start = 0;										
									}
								    echo '		<div class="card-header">' . $row['semester'] . ' ' . $row['courseid'] . '</div>';
								    echo '  		<div class="card-body">';
								    echo '    		<h5 class="card-title">' . $row['CourseName'] . '</h5>';
								    echo '				<ul class="list-group list-group-flush">';
									echo '					<li class="list-group-item">Professor ' . $row['professor'] . '</li>';
									echo '					<li class="list-group-item">' . trim(str_replace('"',"",$row['classDays']), "[]") . ": " . $row['class_start'] . "-" . $row['class_end'] . '</li>';
									echo '					<li class="list-group-item">Section: ' . $row['Section'] . '</li>';
									echo '				</ul>';
								    echo '  		</div>';
								    echo '		<div class="card-footer">';
								    echo '			<a href="unregister.php?' . $row['secID'] . '" class="btn btn-warning" style="width: 100%;">Remove Course</a>';
								    echo '		</div>';
									echo '	</div>';
									echo '</div>';
								}
							}	
						}
						# close the connection
						$sqlConnect->close_SQLConn($pdo);
					}
					catch (PDOException $e){
						echo $e->getMessage();
					}											
				?>
		</div>
	</div>

	<!-- register -->
	<div class="container-fluid">
		<hr size="1" />					
		<h2>Available Courses</h2>
		<!-- Course Registration -->	
		<form  method="post" action="index.php">
				<?php
					try{
						# returns a PDOStatement object
						$sqlConnect = new mySQLDBConnection();
						$pdo = $sqlConnect->start_SQLConn();
						
						$res = $sqlConnect->get_userInfo($pdo, $_SESSION['user']);
						# fetch records for user info.
						$rowCount1 = $res->rowCount();
						if ($rowCount1 > 0){
							# get single record
							$row1 = $res->fetch(PDO::FETCH_ASSOC);
							# get semesters info
							$result = $sqlConnect->get_Register($pdo, $row1['id']);
							# fetch records for Degree list
							$rowCount = $result->rowCount();
							if ($rowCount > 0){
								$date_now = new DateTime();
								#alternating rows
								$startRow = 0;
								# loop through the dataset
								while ($row = $result->fetch()){
									// check registration dates
									$startDate = new DateTime($row['regStart']);
									$endDate = new DateTime($row['regEnd']);
									if($date_now >= $startDate and $date_now <= $endDate){
											echo '<div class="input-group mb-3">';
											if ($startRow == 0){
										  		echo 	'<div class="input-group-text btn-light"  style="width:100%;">';
		  										$startRow = 1;								
											}
											else{
										  		echo 	'<div class="input-group-text  btn-info"  style="width:100%;">';
												$startRow = 0;	
											}
									    	echo 		'<div class="container-fluid" style="text-align:left; padding-top: 5px;">';
									    	echo 			'<h5>' . $row['semester'] . ': ' . $row['courseid'] . ' - ' . $row['CourseName'] . '</h5>';
									    	echo 			'<div class="input-group mb-3">';
									    	echo 				'<span class="input-group-text" id="basic-addon1">Section</span>';
									    	echo 				'<input name="SecName" type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" disabled value="'. $row['Section'] .'">';
									    	$strArr = trim(str_replace('"',"",$row['classDays']), "[]");
									    	echo 				'<span class="input-group-text" id="basic-addon1">' . $strArr . '</span>';
									    	echo 				'<span class="input-group-text" id="basic-addon1">' . $row['class_start'] . '</span>';
									    	echo 				'<span class="input-group-text" id="basic-addon1">' . $row['class_end'] . '</span>';
									    	echo 			'</div>';
									    	echo 			'<div class="input-group mb-3">';
									    	echo 				'<span class="input-group-text" id="basic-addon1">Professor</span>';
									    	echo 				'<input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" disabled value="'. $row['professor'] .'">';
									    	echo 				'<span class="input-group-text" id="basic-addon1">Roster: ' . $row['roster_cap'] . '</span>';
									    	echo 				'<span class="input-group-text" id="basic-addon1">Waitlist: ' . $row['waitlist_cap'] . '</span>';
									    	echo 				'<span class="input-group-text" id="basic-addon1">Credit: ' . $row['credit'] . '</span>';
									    	echo 			'</div>';								    	
									    	echo 		'</div>';
											echo 		'<a href="Register.php?'. $row['secID'] . '" class="btn btn-outline-primary" id="button-addon1" style="height:100%;">Register</a>';									  	
										  	echo 	'</div>';
										  	echo '</div>';		
									}								
								}	
							}
							else{
								echo '<script type="text/javascript">';
								echo 'alert("No sections found!")';
								echo '</script>';
							}
						}
						# close the connection
						$sqlConnect->close_SQLConn($pdo);
					}
					catch (PDOException $e){
						echo $e->getMessage();
					}											
				?>				
		</form>	
	</div>

	<?php require_once '../footer.php';?>
</body>
</html>
