<?php
	error_reporting(E_ALL ^ E_NOTICE);
	//ini_set('session.use_only_cookies','1');
	session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title> Home Page </title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link href="../Style/CST499.css" rel="stylesheet" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>	
</head>
<body>
	<?php require('../protected/config.php');?>
	<?php
		if(isset($_POST['button1'])){
			unset($_SESSION['user']);
			header("Refresh:0, url=../Home");
		}


		class mySQLDBConnection{
			// Start SQL connection
			function start_SQLConn(){
				// Connection String Properties
				$connString = "mysql:host=" . DBHOST . ";dbname=" . DBNAME;
				$pdo = new PDO($connString, DBUSER, DBPASS);
				$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

				return $pdo;			
			}

			// Select statement methods
			function get_userLogin($pdo, $email, $password){
				//SQL call
				$sql = "SELECT * FROM users WHERE paswrd ='$password' and (email = '$email' or username ='$email')";

				//return query
				return $pdo->query($sql);
			}

			function get_userInfo($pdo, $username){
				//SQL call
				$sql = "SELECT * FROM users WHERE username ='$username'";

				//return query
				return $pdo->query($sql);				
			}

			function get_table($pdo, $table){
				//SQL call
				$sql = "SELECT * FROM $table";

				//return query
				return $pdo->query($sql);
			}

			function get_DegreeInfo($pdo, $DegreeID){
				$sql = "SELECT * FROM courses WHERE DegreeIDs like '%$DegreeID%' ORDER BY COURSEID";

				return $pdo->query($sql);
			}

			function get_DegreeName($pdo, $DegreeID){
				$sql = "SELECT * FROM degrees WHERE id=$DegreeID";

				return $pdo->query($sql);
			}

			function get_StuDegree($pdo, $StudentID){
				$sql = "SELECT * from academic_plan as ap inner join degrees as deg on ap.degreeid=deg.id WHERE ap.studentid=$StudentID";

				return $pdo->query($sql);
			}

			function get_Register($pdo, $StudentID){
				$sql = "SELECT 
						    c.id as courseUID,	
						    s.name as semester,
						    s.registration_start as regStart,
						    s.registration_end as regEnd,
						    s.waitlist_end as waitEnd,
						    c.courseid,
						    sec.name as Section,
						    c.name as CourseName,    
						    sec.classDays,
						    sec.class_start, 
						    sec.class_end, 
						    sec.roster_cap,
						    sec.waitlist_cap,
						    c.credit,
						    c.description,
						    u.username as professor,
						    u.id as professorID,
						    s.id as semesterID,
						    sec.id as secID
						FROM
							sections as sec
						    inner join courses as c on c.id=sec.courseid
						    inner join users as u on u.id=sec.professorid
						    inner join semesters as s on s.id=sec.semesterid
						WHERE 
							c.id not in (select completed_courseid from academic_progress where studentid=$StudentID) and 
							c.id not in (select c.id from section_rosters sr inner join sections s on s.id=sr.sectionid inner join courses c on c.id=s.courseid where sr.studentid=$StudentID)";

			    return $pdo->query($sql);
			}

			function get_SectionInfo($pdo, $sectionID){
				$sql = "SELECT 
						    c.id as courseUID,	
						    s.name as semester,
						    s.registration_start as regStart,
						    s.registration_end as regEnd,
						    s.waitlist_end as waitEnd,
						    c.courseid,
						    sec.name as Section,
						    c.name as CourseName,    
						    sec.classDays,
						    sec.class_start, 
						    sec.class_end, 
						    sec.roster_cap,
						    sec.waitlist_cap,
						    c.credit,
						    c.description,
						    u.username as professor,
						    u.id as professorID,
						    s.id as semesterID,
						    sec.id as secID
						FROM
							sections as sec
						    inner join courses as c on c.id=sec.courseid
						    inner join users as u on u.id=sec.professorid
						    inner join semesters as s on s.id=sec.semesterid
						WHERE sec.id=$sectionID";

				return $pdo->query($sql);
			}

			function get_StudentSchedule($pdo, $studentID){
				$sql = "SELECT 
						    c.id as courseUID,	
						    s.name as semester,
						    s.registration_start as regStart,
						    s.registration_end as regEnd,
						    s.waitlist_end as waitEnd,
						    c.courseid,
						    sec.name as Section,
						    c.name as CourseName,    
						    sec.classDays,
						    sec.class_start, 
						    sec.class_end, 
						    sec.roster_cap,
						    sec.waitlist_cap,
						    c.credit,
						    c.description,
						    u.username as professor,
						    u.id as professorID,
						    s.id as semesterID,
						    sec.id as secID
						FROM
							sections as sec
						    inner join courses as c on c.id=sec.courseid
						    inner join users as u on u.id=sec.professorid
						    inner join semesters as s on s.id=sec.semesterid
						    inner join section_rosters as sr on sr.sectionid=sec.id
						WHERE 
							sr.studentid=$studentID";

				return $pdo->query($sql);
			}			

			// Insert Statement methods
			function post_newUser($pdo, $email, $username, $firstname, $lastname, $phone, $password){
				$sql = "INSERT INTO users (email,username,firstname,lastname,phone,paswrd) 
						VALUES(
							'$email',
							'$username',
							'$firstname',
							'$lastname',
							'$phone',
							'$password')";
				return $pdo->exec($sql);
			}

			function post_RegRoster($pdo, $sectionID, $studentID){
				$sql = "INSERT INTO section_rosters (sectionid, studentid) VALUES (".$sectionID.",".$studentID.")";
					echo $sql;
				return $pdo->exec($sql);
			}			

			function post_UnRegRoster($pdo, $sectionID, $studentID){
				$sql = "DELETE FROM section_rosters WHERE sectionid=".$sectionID." and studentid=".$studentID;
					echo $sql;
				return $pdo->exec($sql);
			}				

			// Close the SQL Connection
			function close_SQLConn($pdo){
				$pdo = null;
			}

		} 
	?>
	<nav id="navbars" class="navbar navbar-light bg-light fixed-top">
		<div class="container-fluid">
		    <form class="d-flex">
		    	<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="35" height="35"><path d="M18.377 3.49c-1.862-.31-3.718.62-4.456 2.095-.428.857-.691 1.624-.728 2.361-.035.71.138 1.444.67 2.252.644.854 1.199 1.913 1.608 3.346a.75.75 0 11-1.442.412c-.353-1.236-.82-2.135-1.372-2.865l-.008-.01c-.53-.698-1.14-1.242-1.807-1.778a50.724 50.724 0 00-.667-.524C9.024 7.884 7.71 6.863 6.471 5.16c-.59.287-1.248.798-1.806 1.454-.665.78-1.097 1.66-1.158 2.446.246.36.685.61 1.246.715.643.12 1.278.015 1.633-.182a.75.75 0 11.728 1.311c-.723.402-1.728.516-2.637.346-.916-.172-1.898-.667-2.398-1.666L2 9.427V9.25c0-1.323.678-2.615 1.523-3.607.7-.824 1.59-1.528 2.477-1.917V2.75a.75.75 0 111.5 0v1.27c1.154 1.67 2.363 2.612 3.568 3.551.207.162.415.323.621.489.001-.063.003-.126.006-.188.052-1.034.414-2.017.884-2.958 1.06-2.118 3.594-3.313 6.044-2.904 1.225.204 2.329.795 3.125 1.748C22.546 4.713 23 5.988 23 7.5c0 1.496-.913 3.255-2.688 3.652.838 1.699 1.438 3.768 1.181 5.697-.269 2.017-1.04 3.615-2.582 4.675C17.409 22.558 15.288 23 12.5 23H4.75a.75.75 0 010-1.5h2.322c-.58-.701-.998-1.578-1.223-2.471-.327-1.3-.297-2.786.265-4.131-.92.091-1.985-.02-3.126-.445a.75.75 0 11.524-1.406c1.964.733 3.428.266 4.045-.19.068-.06.137-.12.208-.18a.745.745 0 01.861-.076.746.746 0 01.32.368.752.752 0 01-.173.819c-.077.076-.16.15-.252.221-1.322 1.234-1.62 3.055-1.218 4.654.438 1.737 1.574 2.833 2.69 2.837H12.5c2.674 0 4.429-.433 5.56-1.212 1.094-.752 1.715-1.904 1.946-3.637.236-1.768-.445-3.845-1.407-5.529a.576.576 0 01-.012-.02 3.557 3.557 0 01-1.553-.94c-.556-.565-.89-1.243-1.012-1.73a.75.75 0 011.456-.364c.057.231.26.67.626 1.043.35.357.822.623 1.443.623 1.172 0 1.953-1.058 1.953-2.234 0-1.205-.357-2.127-.903-2.78-.547-.654-1.318-1.08-2.22-1.23z"></path></svg>&nbsp;
		      <a class="navbar-brand" href="/CST499/Home">Clown College</a>
		    </form>
		    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
	      		<span class="navbar-toggler-icon"></span>
		    </button>
		    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
		      	<div class="offcanvas-header">
		        	<h5 class="offcanvas-title" id="offcanvasNavbarLabel">Clown College</h5>
		        	<button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
		      	</div>
		      	<div class="offcanvas-body">
  				    <form method="post" action="index.php">
			        	<ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
			          			<?php 
									if(isset($_SESSION['user'])){
										echo '	<li class="nav-item">';
										echo '		<a class="nav-link active text-primary" aria-current="page" href="../Profile">Profile</a>';
										echo '	</li>';
										echo '	<li class="nav-item">';
										echo '		<input type="submit" name="button1" value="Sign Out" style="background-color:transparent; color:magenta; border-color:transparent;"/>';
										echo '	</li>';
									}
									else{
										echo '	<li class="nav-item">';									
			            				echo '		<a class="nav-link active text-primary" aria-current="page" href="../Login">Sign In</a>';				
										echo '	</li>';
										echo '	<li class="nav-item">
			            							<a class="nav-link text-light" href="../Registration">Register</a>
		          								</li>';
									}
			          			?>
			          		<li class="nav-item">
			            		<a class="nav-link text-light" href="../Degrees">Degrees</a>
			          		</li>
			          		<li class="nav-item">
			            		<a class="nav-link text-light" href="../Courses">Course Catalog</a>
			          		</li>
		        		</ul>
					</form>
		      	</div>
		    </div>
	  	</div>
	</nav>
	<hr size="16">
</body>
</html>