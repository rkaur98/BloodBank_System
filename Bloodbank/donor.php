

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



	

	<div class="content">

	<div class="col1">
	<h3>Register New Donor</h3>
	<form action="" method="post">
	<div>
	<label id="first"> Name:</label>
	<input type="text" name="dname" required>
	</div>

	<div>
	<label id="first">Age</label>
	<select name="dage">
	<?php
	    for ($i=18; $i<=60; $i++)
	    {
	        ?>
	            <option value="<?php echo $i;?>"><?php echo $i;?></option>
	        <?php
	    }
	?>
	</select>
	</div>

	<div>
	<label id="first">Address</label>
	<input type="text" name="daddress" required>
	</div>

	<div>
	<label id="first">Phone</label>
	<input type="tel" name="dphone" required>
	</div>

	<div>
	<label id="first">Sex</label>
	<p>
	<input type="radio" name="dsex" value="Male" checked> Male
    <input type="radio" name="dsex" value="Female"> Female
    <input type="radio" name="dsex" value="Other"> Other 
    </p>
    </div>

    <div>
    <label id="first">Blood Type</label>
	<select name="btype">
	  <option value="O+">O+</option>
	  <option value="O-">O-</option>
	  <option value="A+">A+</option>
	  <option value="A-">A-</option>
	  <option value="B+">B+</option>
	  <option value="B-">B-</option>
	  <option value="AB+">AB+</option>
	  <option value="AB-">AB-</option>
	</select>
	</div>

	<div>
	<label id="first">Volume (in mL)</label>
	<select name="bvol">
	<?php
	    for ($i=250; $i<=600; $i+=10)
	    {
	        ?>
	            <option value="<?php echo $i;?>"><?php echo $i;?></option>
	        <?php
	    }
	?>
	</select>
	</div>

	<button type="submit" name="submit">Register</button>

	</form>
	</div>

	<div class="col2">
		<h3>Already a Donor</h3>
		<a class="ref" href="donotion.php">Proceed with donotion</a>
		<a class="ref" href="search.php">Search Donor</a>
		<a class="ref" href="search.php">Edit Donor Info</a>
	</div>

	
	</div>
	<h3>
	<?php

	  if(isset($_POST['submit']))
	{

	    $sql = "INSERT INTO donor (D_Name, D_Age, D_Address, D_Phone, D_Sex)
	    VALUES ('".$_POST["dname"]."','".$_POST["dage"]."','".$_POST["daddress"]."','".$_POST["dphone"]."','".$_POST["dsex"]."')";

	    $result = mysqli_query($conn,$sql);
	    echo "Donor Registered";

	    $sql1 = "SELECT MAX(DID) FROM donor";
	    $result1 = mysqli_query($conn,$sql1);
	    $row = mysqli_fetch_row($result1);
	    echo $row[0];

	    $sql2 = "INSERT INTO blood (B_Type, Vol, DID)
	    VALUES ('".$_POST["btype"]."','".$_POST["bvol"]."','".$row[0]."')";

	    
	    $result2 = mysqli_query($conn,$sql2);


	    $sql3 = "UPDATE bloodstored SET Vol = Vol + '".$_POST["bvol"]."' WHERE B_Type = '".$_POST["btype"]."' ";
	    $result3 = mysqli_query($conn,$sql3);

		}

	?>
	</h3>


	</main>


</body>
</html>
