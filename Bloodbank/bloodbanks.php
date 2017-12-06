

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

	<h3>Blood Banks</h3>

	<table style="width:80%">
	  <tr>
	  	<th>BNO</th>
	  	<th>Blood Bank Name</th>
	  	<th>Address</th>
	    <th>Phone</th>
	  </tr>
	<?php

	

	    $sql = "SELECT BNO, B_Name, B_Address, B_Phone FROM bloodbank ";

	    $result = mysqli_query($conn,$sql);

	    

	    if ($result->num_rows > 0) {
    
		    while($row = $result->fetch_assoc()) {
		        echo "<tr><td>" . $row["BNO"]. "</td><td>" . $row["B_Name"]. "</td><td>" . $row["B_Address"]. "</td><td>" . $row["B_Phone"]. "</td></tr> ";
		    }
		} else {
		    echo "0 results";
		}

	?>
	</table>


	</main>

</body>
</html>