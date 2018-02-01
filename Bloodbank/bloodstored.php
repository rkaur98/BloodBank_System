

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

	<main>

	<h3>Total Blood Stored</h3>

	<table style="width:30%">
	  <tr>
	  	<th>Blood Type</th>
	    <th>Vol(in mL)</th>
	  </tr>
	<?php

	

	    $sql = "SELECT B_Type, Vol FROM bloodstored WHERE BNO='205' ";

	    $result = $conn->query($sql);

	    

	    if ($result->num_rows > 0) {
    
		    while($row = $result->fetch_assoc()) {
		        echo "<tr><td>" . $row["B_Type"]. "</td><td>" . $row["Vol"]. "</td></tr> ";
		    }
		} else {
		    echo "0 results";
		}

	?>
	</table>

	</main>

</body>
</html>
