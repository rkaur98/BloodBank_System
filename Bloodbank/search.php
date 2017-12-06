<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="description" content="">
<meta name="viewport" content="width=device-width,initial-scale=1">

	<title>Search</title>

	<?php
    include_once 'connect.php';
    ?>

     <link rel="stylesheet" type="text/css" href="style.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

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
	

	<script type="text/javascript">
	function changeValue(){
	    var option=document.getElementById('filter').value;

	    if(option=="B_Type"){
	            document.getElementById('field').innerHTML='<select name="key">  <option value="O+">O+</option> <option value="O-">O-</option> <option value="A+">A+</option> <option value="A-">A-</option> <option value="B+">B+</option> <option value="B-">B-</option> <option value="AB+">AB+</option> <option value="AB-">AB-</option> </select><br/>';
	    }
	        else if(option=="D_Age"){
	            document.getElementById('field').innerHTML='<input type ="number" name="key" value ="18" min="18" />';
	        }

	        else if(option=="D_Name"){
	            document.getElementById('field').innerHTML='<input type="text" name="key" required><br/>';
	        }


	}

	jQuery(document).ready(function($){

		$(".edit").on("click",function(){

	           $(this).parent().find(".hidden").toggleClass("expanded");
	    });

	});

	</script>

	<main>

	<div class="search-col1">

	<form action ='' method = 'post'>

	<label id="first">Search Donor with:</label><br/>
	<select name="filter" id="filter" onchange="changeValue();">
		<option id="A" value="B_Type">Blood Type</option>
		<option id="B" value="D_Age">Age</option>
		<option id="C" value="D_Name">Name</option>
	</select>

	<div id ="field">
		<select name="key">  <option value="O+">O+</option> <option value="O-">O-</option> <option value="A+">A+</option> <option value="A-">A-</option> <option value="B+">B+</option> <option value="B-">B-</option> <option value="AB+">AB+</option> <option value="AB-">AB-</option> </select><br/>
	</div>

	<input type ='submit' name='search' value = 'Search' />

	

	</form>


	</div>

	<div class="search-col2">

	<form action ='' method = 'post'>
		<input type ='submit' name='viewall' value = 'View All Donors' />
	</form>

	</div>


	<div>

	<table style="width:80%">
	  <tr>
	  	<th>DID</th>
	    <th>Name</th>
	    <th>Age</th> 
	    <th>Address</th>
	    <th>Phone</th>
	    <th>Sex</th> 
	    <th>Blood Type</th>
	    <th>Edit Area</th>
	  </tr>

	  	<?php

	  	if(isset($_POST['viewall']))
		{
			$sql = "SELECT DISTINCT donor.DID , donor.D_Name, donor.D_Age, donor.D_Address, donor.D_Phone, donor.D_Sex, blood.B_Type from donor inner join blood on donor.DID = blood.DID";
			

		    $filter = "";
		    $key = "";

		    
		    $result = mysqli_query($conn,$sql);

		    if ($result->num_rows > 0) {
			    $i = 0;
			    while($row = $result->fetch_assoc()) {
			        echo "<tr class='".$i."'><td>" . $row["DID"]. "</td><td>" . $row["D_Name"]. "</td><td>" . $row["D_Age"]. "</td><td>" . $row["D_Address"]."</td><td>" . $row["D_Phone"]. "</td><td>" . $row["D_Sex"]. "</td><td>" . $row["B_Type"]. "</td><td class='editbut' ><form action ='' method = 'post'><div class='hidden'><div class='hide'><input type='text' name='did' value='". $row["DID"]."'></div><input type='text' name='dname' value='". $row["D_Name"]."'><input type='text' name='dage' value='". $row["D_Age"]."'><input type='text' name='daddress' value='". $row["D_Address"]."'><input type='text' name='dphone' value='". $row["D_Phone"]."'><input type='text' name='dsex' value='". $row["D_Sex"]."'><div class='hide'><input type='text' name='btype' value='". $row["B_Type"]."'><input type='text' name='bfilter' value='". $filter."'><input type='text' name='bkey' value='". $key."'></div><input type ='submit' name='update' value = 'Update' /></div><input type ='submit' name='delete' value = 'Delete' /></form><input type ='submit' class='edit' name='edit' value = 'Edit' /></td></tr>";

			        $i++;
			    }
			} else {
			    echo "<tr>N0 results</tr>";
			}

		}

		?>

		<?php

		if(isset($_POST['search']))
		{
			if($_POST['filter']=="B_Type"){
				$sql = "SELECT DISTINCT donor.DID, donor.D_Name, donor.D_Age, donor.D_Address, donor.D_Phone, donor.D_Sex, blood.B_Type from donor inner join blood on donor.DID = blood.DID WHERE B_Type = '".$_POST["key"]."'";
			}
			else if ($_POST['filter']=="D_Age") {
				$sql = "SELECT DISTINCT donor.DID, donor.D_Name, donor.D_Age, donor.D_Address, donor.D_Phone, donor.D_Sex, blood.B_Type from donor inner join blood on donor.DID = blood.DID WHERE D_Age = '".$_POST["key"]."'";
			}
			else if ($_POST['filter']=="D_Name") {
				$sql = "SELECT DISTINCT donor.DID, donor.D_Name, donor.D_Age, donor.D_Address, donor.D_Phone, donor.D_Sex, blood.B_Type from donor inner join blood on donor.DID = blood.DID WHERE D_Name LIKE '%".$_POST["key"]."%'";
			}
		    

		    $filter = $_POST['filter'];
		    $key = $_POST['key'];

		    
		    $result = mysqli_query($conn,$sql);

		    if ($result->num_rows > 0) {
			    $i = 0;
			    while($row = $result->fetch_assoc()) {
			        echo "<tr class='".$i."'><td>" . $row["DID"]. "</td><td>" . $row["D_Name"]. "</td><td>" . $row["D_Age"]. "</td><td>" . $row["D_Address"]."</td><td>" . $row["D_Phone"]. "</td><td>" . $row["D_Sex"]. "</td><td>" . $row["B_Type"]. "</td><td class='editbut' ><form action ='' method = 'post'><div class='hidden'><div class='hide'><input type='text' name='did' value='". $row["DID"]."'></div><input type='text' name='dname' value='". $row["D_Name"]."'><input type='text' name='dage' value='". $row["D_Age"]."'><input type='text' name='daddress' value='". $row["D_Address"]."'><input type='text' name='dphone' value='". $row["D_Phone"]."'><input type='text' name='dsex' value='". $row["D_Sex"]."'><div class='hide'><input type='text' name='btype' value='". $row["B_Type"]."'><input type='text' name='bfilter' value='". $filter."'><input type='text' name='bkey' value='". $key."'></div><input type ='submit' name='update' value = 'Update' /></div><input type ='submit' name='delete' value = 'Delete' /></form><input type ='submit' class='edit' name='edit' value = 'Edit' /></td></tr>";

			        $i++;
			    }
			} else {
			    echo "<tr>N0 results</tr>";
			}



		    
		}

		if(isset($_POST['delete'])){
				$sql1 = "DELETE FROM donor WHERE DID = ".$_POST["did"]."";
				$result1 = mysqli_query($conn,$sql1);

			if($_POST['bfilter']=="B_Type"){
				$sql = "SELECT DISTINCT donor.DID, donor.D_Name, donor.D_Age, donor.D_Address, donor.D_Phone, donor.D_Sex, blood.B_Type from donor inner join blood on donor.DID = blood.DID WHERE B_Type = '".$_POST["bkey"]."'";
			}
			else if ($_POST['bfilter']=="D_Age") {
				$sql = "SELECT DISTINCT donor.DID, donor.D_Name, donor.D_Age, donor.D_Address, donor.D_Phone, donor.D_Sex, blood.B_Type from donor inner join blood on donor.DID = blood.DID WHERE D_Age = '".$_POST["bkey"]."'";
			}
			else if ($_POST['bfilter']=="D_Name") {
				$sql = "SELECT DISTINCT donor.DID, donor.D_Name, donor.D_Age, donor.D_Address, donor.D_Phone, donor.D_Sex, blood.B_Type from donor inner join blood on donor.DID = blood.DID WHERE D_Name LIKE '%".$_POST["bkey"]."%'";
			}
			else if ($_POST['bfilter']=="") {
				$sql = "SELECT DISTINCT donor.DID, donor.D_Name, donor.D_Age, donor.D_Address, donor.D_Phone, donor.D_Sex, blood.B_Type from donor inner join blood on donor.DID = blood.DID ";
			}
		    

		    $filter = $_POST['bfilter'];
		    $key = $_POST['bkey'];

		    
		    $result = mysqli_query($conn,$sql);

		    if ($result->num_rows > 0) {
			    $i = 0;
			    while($row = $result->fetch_assoc()) {
			        echo "<tr class='".$i."'><td>" . $row["DID"]. "</td><td>" . $row["D_Name"]. "</td><td>" . $row["D_Age"]. "</td><td>" . $row["D_Address"]."</td><td>" . $row["D_Phone"]. "</td><td>" . $row["D_Sex"]. "</td><td>" . $row["B_Type"]. "</td><td class='editbut' ><form action ='' method = 'post'><div class='hidden'><div class='hide'><input type='text' name='did' value='". $row["DID"]."'></div><input type='text' name='dname' value='". $row["D_Name"]."'><input type='text' name='dage' value='". $row["D_Age"]."'><input type='text' name='daddress' value='". $row["D_Address"]."'><input type='text' name='dphone' value='". $row["D_Phone"]."'><input type='text' name='dsex' value='". $row["D_Sex"]."'><div class='hide'><input type='text' name='btype' value='". $row["B_Type"]."'><input type='text' name='bfilter' value='". $filter."'><input type='text' name='bkey' value='". $key."'></div><input type ='submit' name='update' value = 'Update' /></div><input type ='submit' name='delete' value = 'Delete' /></form><input class='edit' type ='submit' name='edit' value = 'Edit' /></td></tr>";

			        $i++;
			    }
			} else {
			    echo "N0 results";
			}

		}

		if(isset($_POST['update'])){
				$sql1 = "UPDATE donor SET D_Name = '".$_POST["dname"]."', D_Age = '".$_POST["dage"]."', D_Address = '".$_POST["daddress"]."', D_Phone = '".$_POST["dphone"]."',  D_Sex = '".$_POST["dsex"]."'  WHERE DID = ".$_POST["did"]."";
				$result1 = mysqli_query($conn,$sql1);

			if($_POST['bfilter']=="B_Type"){
				$sql = "SELECT DISTINCT donor.DID, donor.D_Name, donor.D_Age, donor.D_Address, donor.D_Phone, donor.D_Sex, blood.B_Type from donor inner join blood on donor.DID = blood.DID WHERE B_Type = '".$_POST["bkey"]."'";
			}
			else if ($_POST['bfilter']=="D_Age") {
				$sql = "SELECT DISTINCT donor.DID, donor.D_Name, donor.D_Age, donor.D_Address, donor.D_Phone, donor.D_Sex, blood.B_Type from donor inner join blood on donor.DID = blood.DID WHERE D_Age = '".$_POST["bkey"]."'";
			}
			else if ($_POST['bfilter']=="D_Name") {
				$sql = "SELECT DISTINCT donor.DID, donor.D_Name, donor.D_Age, donor.D_Address, donor.D_Phone, donor.D_Sex, blood.B_Type from donor inner join blood on donor.DID = blood.DID WHERE D_Name LIKE '%".$_POST["bkey"]."%'";
			}
			else if($_POST['bfilter']==""){
				$sql = "SELECT DISTINCT donor.DID, donor.D_Name, donor.D_Age, donor.D_Address, donor.D_Phone, donor.D_Sex, blood.B_Type from donor inner join blood on donor.DID = blood.DID ";
			}
		    

		    $filter = $_POST['bfilter'];
		    $key = $_POST['bkey'];

		    
		    $result = mysqli_query($conn,$sql);

		    if ($result->num_rows > 0) {
			    $i = 0;
			    while($row = $result->fetch_assoc()) {
			        echo "<tr class='".$i."'><td>" . $row["DID"]. "</td><td>" . $row["D_Name"]. "</td><td>" . $row["D_Age"]. "</td><td>" . $row["D_Address"]."</td><td>" . $row["D_Phone"]. "</td><td>" . $row["D_Sex"]. "</td><td>" . $row["B_Type"]. "</td><td class='editbut' ><form action ='' method = 'post'><div class='hidden'><div class='hide'><input type='text' name='did' value='". $row["DID"]."'></div><input type='text' name='dname' value='". $row["D_Name"]."'><input type='text' name='dage' value='". $row["D_Age"]."'><input type='text' name='daddress' value='". $row["D_Address"]."'><input type='text' name='dphone' value='". $row["D_Phone"]."'><input type='text' name='dsex' value='". $row["D_Sex"]."'><div class='hide'><input type='text' name='btype' value='". $row["B_Type"]."'><input type='text' name='bfilter' value='". $filter."'><input type='text' name='bkey' value='". $key."'></div><input type ='submit' name='update' value = 'Update' /></div><input type ='submit' name='delete' value = 'Delete' /></form><input class='edit' type ='submit' name='edit' value = 'Edit' /></td></tr>";

			        $i++;
			    }
			} else {
			    echo "N0 results";
			}

		}

	

		?>

		


		</table>
	</div>

	</main>


</body>
</html>