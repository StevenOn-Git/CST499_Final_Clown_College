<?php
	error_reporting(E_ALL ^ E_NOTICE);

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title> Degrees: Clown College </title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link href="../Style/CST499.css" rel="stylesheet" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>	
</head>
<style>
	#card{
		height: 100%;
		width:  100%;
	}
</style>
<body>
	<?php require '../master.php';?>
	
	<!-- Login Page -->
	<form method="post" action="index.php">
		<div class="container col-xxl-8 px-4 py-5">
		    <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
		      	<div class="col-10 col-sm-8 col-lg-6">
		        	<img src="https://www.modul.ac.ae/hubfs/9-grade-graduate-icon.png" class="d-block mx-lg-auto img-fluid" alt="Bootstrap Themes" width="700" height="500" loading="lazy">
		      	</div>
		      	<div class="col-lg-6">
		        	<h1 class="display-5 fw-bold lh-1 mb-3">Your path to comedy begins here!</h1>
		        	<p class="lead" >Quickly design and customize responsive mobile-first sites with Bootstrap, the world’s most popular front-end open source toolkit, featuring Sass variables and mixins, responsive grid system, extensive prebuilt components, and powerful JavaScript plugins.</p>
					<div class="btn-group dropend">
					  	<button name="submit" class="btn btn-info dropdown-toggle" type="submit" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">Degrees</button>
					  	<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
							<!-- PHP code -->
							<?php 
								// Insert into Degree drop down list
								try{
									# returns a PDOStatement object
									$sqlConnect = new mySQLDBConnection();
									$pdo = $sqlConnect->start_SQLConn();
									$result = $sqlConnect->get_table($pdo, 'degrees');

									# fetch records for Degree list
									$rowCount = $result->rowCount();
									if ($rowCount > 0){
										# loop through the dataset
										while ($row = $result->fetch()){
											// the keys match the field names from the table
											echo '<li><a class="dropdown-item" href="?' .$row['id'] . '">' . $row['name'] . "</a></li>";
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
					  	</ul>
					</div>      
		      	</div>
		    </div>
			<?php 
				// grab URL parameter and parse
				$url= $_SERVER['REQUEST_URI'];
				$degreeID = parse_url($url, PHP_URL_QUERY);
				if($degreeID >1){
					// Insert class object into database
					try{
						# returns a PDOStatement object
						$sqlConnect = new mySQLDBConnection();
						$pdo = $sqlConnect->start_SQLConn();
						
						// get header label
						$r = $sqlConnect->get_DegreeName($pdo, $degreeID);
						$rowCount = $r->rowCount();
						if ($rowCount > 0){
							# loop through the dataset
							$row = $r->fetch(PDO::FETCH_ASSOC);
							// the keys match the field names from the table
							echo "<h1 class='text-white' style='text-align:center;'>" . $row['name'] ."</h1>";
						}
						else{
							echo '<script type="text/javascript">';
							echo 'alert("No degrees found!")';
							echo '</script>';
						}						
						

						// get degree info
						$result = $sqlConnect->get_DegreeInfo($pdo, $degreeID);

						# fetch records for Degree list
						$rowCount = $result->rowCount();
						if ($rowCount > 0){
							# inform the user what they're looking at
							echo '<h3>Required Courses</h3>';

							# loop through the dataset
							while ($row = $result->fetch()){
								// the keys match the field names from the table
								echo '<div id="card" class="card text-dark bg-light mb-3">';
								echo '  <div class="card-header">'.$row['CourseID'].'</div>';
								echo '  <div class="card-body">';
								echo '    <h5 class="card-title">'.$row['Name'].'</h5>';
								echo '    <p class="card-text">'.$row['Description'].'</p>';
								echo '  </div>';
								echo '</div>';
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
				}
			?>			    


			<!-- guest buttons -->
			<button type="button" class="btn btn-outline-light btn-lg form-control" onclick="window.location.href='../Registration';">Create your Clown College account</button>
			<hr size="1">			
			<button type="button" class="btn btn-outline-warning btn-lg form-control" onclick="window.location.href='../Login';">Or sign in</button>
		</div>
	</form>

	<hr size=1/>

	<?php require_once '../footer.php';?>
</body>
</html>
