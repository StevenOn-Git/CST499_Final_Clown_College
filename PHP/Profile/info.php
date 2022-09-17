<?php
	error_reporting(E_ALL ^ E_NOTICE);

?>
<!DOCTYPE html>
<html lang="en" >
<head>
	<title> Info Page </title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link href="../Style/CST499.css" rel="stylesheet" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>	
</head>
<style type="text/css">
	img{
		padding-top: 20px;
	}
	body {
	  margin: 0 auto;
	  padding: 0;
	  background: #222;
	}

	.left {
	  left: 25px;
	}

	.right {
	  right: 25px;
	}

	.center {
	  text-align: center;
	}

	.bottom {
	  position: absolute;
	  bottom: 25px;
	}

	#gradient {
	  background: #999955;
	  background-image: linear-gradient(#DAB046 20%, #D73B25 20%, #D73B25 40%, #C71B25 40%, #C71B25 60%, #961A39 60%, #961A39 80%, #601035 80%);
	  margin: 0 auto;
	  margin-top: 50px;
	  width: 100%;
	  height: 150px;
	}

	#gradient:after {
	  content: "";
	  position: absolute;
	  background: #E9E2D0;
	  left: 50%;
	  margin-top: -67.5px;
	  margin-left: -270px;
	  padding-left: 20px;
	  border-radius: 5px;
	  width: 520px;
	  height: 275px;
	  z-index: -1;
	}

	#card {
	  position: absolute;
	  width: 450px;
	  height: 225px;
	  padding: 25px;
	  padding-top: 0;
	  padding-bottom: 0;
	  left: 50%;
	  top: 140px;
	  margin-left: -250px;
	  background: #E9E2D0;
	  box-shadow: -20px 0 35px -25px black, 20px 0 35px -25px black;
	  z-index: 5;
	}

	#card img {
	  width: 150px;
	  float: left;
	  border-radius: 5px;
	  margin-right: 20px;
	  -webkit-filter: sepia(1);
	  -moz-filter: sepia(1);
	  filter: sepia(1);
	}

	#card h2 {
	  font-family: courier;
	  color: #333;
	  margin: 0 auto;
	  padding: 0;
	  font-size: 15pt;
	}

	#card p {
	  font-family: courier;
	  color: #555;
	  font-size: 13px;
	}

	#card span {
	  font-family: courier;
	}	
</style>
<body>
	<!-- Login Page -->
	<div class="container-fluid" style="text-align: center; padding-top: 25px;">
		<!-- Profile -->
		<div id="gradient"></div>
		<div id="card">
	  		<img src="https://gifimage.net/wp-content/uploads/2017/09/animated-fireworks-gif-download-5.gif"/>
	  		<?php
				try{
					# returns a PDOStatement object
					$sqlConnect = new mySQLDBConnection();
					$pdo = $sqlConnect->start_SQLConn();
					$result = $sqlConnect->get_userInfo($pdo, $userName);

					# fetch records for user info.
					$rowCount = $result->rowCount();
					if ($rowCount > 0){
						# get single record
						$row = $result->fetch(PDO::FETCH_ASSOC);
						echo "<br>";
						echo "<h2>" . $row['firstname'] . " " . $row['lastname'] ."</h2>";
					  	echo "<p>Clown College Student</p>";
					  	echo "<p>Interested in Web technologies like HTML5, CSS3, JavaScript, PHP, MySQL, etc.</p>";
						$tel = $row['phone'];
					  	echo '<span class="left bottom">tel: (' . substr($tel, 0,3) . ')' . substr($tel, 3,3) .'-'. substr($tel, 6, 4). '</span>';

				  		# fetch records for student's degree
				  		$result2 = $sqlConnect->get_StuDegree($pdo, $row['id']);
				  		$rowCount2 = $result2->rowCount();
				  		if($rowCount2 > 0){
				  			$row2 = $result2->fetch(PDO::FETCH_ASSOC);
					  		echo '<span class="right bottom">degree: ' . $row2['name'] . '</span>';				  			
				  		}
				  		else{
							echo '<script type="text/javascript">';
							echo 'alert("Degree Not Found!")';
							echo '</script>';				  			
				  		}
					}
					else{
						echo '<script type="text/javascript">';
						echo 'alert("User Not Found!")';
						echo '</script>';
					}

					# close the connection
					$sqlConnect->close_SQLConn($pdo);
				}
				catch (PDOException $e){
					echo $e->getMessage();
				}		
			?>  		
		</div>
</html>