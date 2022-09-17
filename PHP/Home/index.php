<?php
	error_reporting(E_ALL ^ E_NOTICE);

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
	<style>
		img{
			width:100%; 
			height:480px;
		}
	</style>

	<?php require '../master.php';?>

	<!-- Carousel -->
	<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
		<div class="carousel-indicators">
			<button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
			<button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
			<button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
		</div>
		<div class="carousel-inner">
			<div class="carousel-item">
			<img src="https://d3ui957tjb5bqd.cloudfront.net/images/screenshots/products/57/570/570935/d6fqaw5zsotdhhyzfqecj84gtmapx7saog8mjzqc0udiuurjuquodmniclkws2ek-o.jpg?1437241093" class="d-block w-100" alt="...">
			</div>
			<div class="carousel-item active">
				<img src="https://images.fineartamerica.com/images-medium-large-5/carousel-90-linda-mears.jpg" class="d-block w-100" alt="...">
			</div>
			<div class="carousel-item">
				<img src="https://images.fineartamerica.com/images-medium-large-5/carousel-dreams-3-andy-russell.jpg" class="d-block w-100" alt="...">
			</div>
		</div>
		<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
			<span class="carousel-control-prev-icon" aria-hidden="true"></span>
			<span class="visually-hidden">Previous</span>
		</button>
		<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
			<span class="carousel-control-next-icon" aria-hidden="true"></span>
			<span class="visually-hidden">Next</span>
		</button>
	</div>	

	<hr size=1/>

	<!-- Cards -->	
	<div class="container">
		<div class="row">
			<div class="col">
				<div class="card">
					<img class="card-img-top" src="https://i.pinimg.com/originals/d9/16/dc/d916dc09b893462633e2f5608d189f5f.gif" alt="Card image cap">
					<div class="card-body">
						<h5 class="card-title">Physical Education</h5>
						<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
					</div>
				</div>
			</div>
			<div class="col">
				<div class="card">
					<img class="card-img-top" src="https://www.vippng.com/png/detail/182-1829118_cream-pie-png.png" alt="Cream Pie">
					<div class="card-body">
						<h5 class="card-title">Mastering Tools</h5>
						<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
					</div>
				</div>
			</div>
			<div class="col">
				<div class="card">
					<img class="card-img-top" src="https://images-na.ssl-images-amazon.com/images/I/41ur%2BT5DhEL._SY300_QL70_.jpg" alt="Card image cap">
					<div class="card-body">
						<h5 class="card-title">Story Telling</h5>
						<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
					</div>
				</div>
			</div>
		</div>
	</div>

	<hr size=1/>

	<?php require_once '../footer.php';?>
</body>
</html>
