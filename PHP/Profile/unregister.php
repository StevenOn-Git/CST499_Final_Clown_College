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
<style>
	#floatingInput{
		background-color: white;
		height: 100%;
	}
</style>
<body>
	<?php require '../master.php';?>
	<!-- PHP code -->
	<?php 
		// GLOBAL Variables
		$courseName = "";
		$description = "";
		$professor = "";
		$section = "";
		$schedule = "";

		// Grab course section information
		# grab URL parameter and parse
		$url= $_SERVER['REQUEST_URI'];
		$sectionID = parse_url($url, PHP_URL_QUERY);
		if($sectionID >0){
			try{
				$sqlConn = new mySQLDBConnection();
				$pdo1 = $sqlConn->start_SQLConn();
				$res = $sqlConn->get_SectionInfo($pdo1, $sectionID);
				# fetch records for user info.
				$rCount = $res->rowCount();
				if ($rCount > 0){
					# get single record
					$row1 = $res->fetch(PDO::FETCH_ASSOC);
					$courseName = $row1['semester'] . ": " . $row1['courseid'] . "-" . $row1['CourseName'];
					$description = $row1['description'];
					$professor = $row1['professor'];
					$section = $row1['Section'];
					$schedule = trim(str_replace('"',"",$row1['classDays']), "[]") . ": " . $row1['class_start'] . "-" . $row1['class_end'];

				}
				# close the connection
				$sqlConn->close_SQLConn($pdo1);
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
		}


		// Insert class object into database
		if(isset($_POST['submit'])){
			// page variables
			try{
				# set up connection string reading from config.php
				$sqlConnect = new mySQLDBConnection();
				$pdo = $sqlConnect->start_SQLConn();
				# get student ID
				$res = $sqlConnect->get_userInfo($pdo, $_SESSION['user']);
				# fetch records for user info.
				$rowCount1 = $res->rowCount();
				if ($rowCount1 > 0){
					# get single record
					$row1 = $res->fetch(PDO::FETCH_ASSOC);
					#get sectionID
					$url= $_SERVER['REQUEST_URI'];
					$sectionID = parse_url($url, PHP_URL_QUERY);
					if($sectionID >0){
						$result = $sqlConnect->post_UnRegRoster($pdo,$sectionID,$row1['id']);
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
							echo "error!";
						}
						# close the connection
						$sqlConnect->close_SQLConn($pdo);							
					}
				
				}
			}
			catch (PDOException $e){
				echo $e->getMessage();
			}				
		}
	?>	
	<!-- Login Page -->
	<div class="container-fluid" style="text-align: center; padding-top: 25px;">
		<h2>Do you want to unregister from this course?</h2>
	</div>
	<hr size="1">
	<!-- Login Form -->
	<form method="post" action="unregister.php?<?php $url= $_SERVER['REQUEST_URI']; echo parse_url($url, PHP_URL_QUERY);?>">
		<div class="container">
			<div class="row">
				<div class="col-6">
					<div class="form-floating mb-3">
						<input type="courseName" class="form-control" id="floatingInput" placeholder="" name="courseName" value="<?php echo $courseName;?>" disabled>
						<label for="floatingInput">Semester: Course Name</label>
					</div>
				</div>				
				<div class="col-3">
					<div class="form-floating mb-3">
						<input type="section" class="form-control" id="floatingInput" placeholder="John" name="section" value="<?php echo $section;?>" disabled>
						<label for="floatingInput">Section</label>
					</div>					
				</div>				
				<div class="col-3">
					<div class="form-floating mb-3">
						<input type="professor" class="form-control" id="floatingInput" placeholder="John" name="professor" value="<?php echo $professor;?>" disabled>
						<label for="floatingInput">Professor</label>
					</div>					
				</div>
			</div>			
			<div class="form-floating mb-3">
				<textarea type="description" class="form-control" id="floatingInput" name="description" disabled><?php echo $description;?></textarea>
				<label for="floatingInput">Course Description</label>
			</div>
			<div class="form-floating mb-3">
				<input type="schedule" class="form-control" id="floatingInput" placeholder="" name="schedule" value="<?php echo $schedule;?>" disabled>
				<label for="floatingInput">Schedule</label>
			</div>									
			<hr size="1">			
			<button name="submit" type="submit" class="btn btn-danger btn-lg form-control">Remove Course</button>
			<hr size="1">			
			<button type="button" class="btn btn-outline-light btn-lg form-control" onclick="window.location.href='../Profile';">Back To Profile Page</button>
		</div>
	</form>

	<hr size=1/>

	<?php require_once '../footer.php';?>
</body>
</html>