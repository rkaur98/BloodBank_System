

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="description" content="">
<meta name="viewport" content="width=device-width,initial-scale=1">

	<title>Blood Bank</title>

	<?php
    include_once 'connect.php';
    ?>

    <link rel="stylesheet" type="text/css" href="style.css">

</head>
<body>

	<header>
		<h1>Blood Bank System</h1>

		<nav>
			<ul class="menu">
				<a href="index.php"><li>Home</li></a>
				<a href="donor.php"><li>Donor</li></a>
				<a href="order.php"><li>Orders</li></a>
				<a href="bloodstored.php"><li>Blood Stored</li></a>
				<a href="hospitals.php"><li>Hospitals</li></a>
				<a href="bloodbanks.php"><li>Blood Banks</li></a>
			</ul>
		</nav>

	</header>

	<main class="index">

	<div class="content">

	<div class="col1">

	<img src="images/blood.jpg" alt="Blood">
	
	</div>

	<div class="col2">
		
		<a class="ref" href="order.php">View Orders</a>
		<a class="ref" href="issues.php">View Issues</a>
		<a class="ref" href="donor.php">Register Donor</a>
		<a class="ref" href="search.php">Search Donor</a>

	</div>

	
	</div>

	</main>

</body>
</html>