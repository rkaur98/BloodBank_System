

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

     <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->

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

		$("input").on("click",function(event){

			event.preventDefault();

	           $(this).parent().find(".hidden").toggleClass("expanded");
	    });

	});

	</script>

	<a href="#" name="donote"></a>

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

	
	

	<?php

		if(isset($_POST['search']))
		{
			if($_POST['filter']=="B_Type"){
				$sql = "SELECT DISTINCT donor.DID, donor.D_Name, donor.D_Age, donor.D_Address, donor.D_Phone, donor.D_Sex, blood.B_Type from donor inner join blood on donor.DID = blood.DID WHERE B_Type = '".$_POST["key"]."' ";
			}
			else if ($_POST['filter']=="D_Age") {
				$sql = "SELECT DISTINCT donor.DID, donor.D_Name, donor.D_Age, donor.D_Address, donor.D_Phone, donor.D_Sex, blood.B_Type from donor inner join blood on donor.DID = blood.DID WHERE D_Age = '".$_POST["key"]."' ";
			}
			else if ($_POST['filter']=="D_Name") {
				$sql = "SELECT DISTINCT donor.DID, donor.D_Name, donor.D_Age, donor.D_Address, donor.D_Phone, donor.D_Sex, blood.B_Type from donor inner join blood on donor.DID = blood.DID WHERE D_Name LIKE '%".$_POST["key"]."%' ";
			}
		    
		    
		    $result = mysqli_query($conn,$sql);

		    echo "<table style='width:80%'><tr><th>DID</th><th>Name</th><th>Age</th><th>Address</th><th>Phone</th><th>Sex</th><th>Blood type</th><th>Select</th></tr>";

		    if ($result->num_rows > 0) {
			    $i = 0;
			    while($row = $result->fetch_assoc()) {
			        echo "<tr class='".$i."'><td>" . $row["DID"]. "</td><td>" . $row["D_Name"]. "</td><td>" . $row["D_Age"]. "</td><td>" . $row["D_Address"]."</td><td>" . $row["D_Phone"]. "</td><td>" . $row["D_Sex"]. "</td><td>" . $row["B_Type"]. "</td><td><form action ='' method = 'post'><div class='hide'><input type='text' name='did' value='". $row["DID"]."'></div><input type ='submit' name='select' value = 'Select' /></td></form></tr>";

			        $i++;
			    }
			} else {
			    echo "<tr>N0 results</tr>";
			}
			echo "</table>";


		    
		}
		?>
		

	</div>

	<?php

		if(isset($_POST['select']))
		{
			
			$sql = "SELECT DISTINCT donor.DID, donor.D_Name, donor.D_Age, donor.D_Address, donor.D_Phone, donor.D_Sex, blood.B_Type from donor inner join blood on donor.DID = blood.DID WHERE donor.DID = '".$_POST["did"]."' ";
			
		    
		    $result = mysqli_query($conn,$sql);

		    if ($result->num_rows > 0) {
			    
			    while($row = $result->fetch_assoc()) {
			        echo "<div class='donotion'>Donor Id: " . $row["DID"]. "<br/>Name: " . $row["D_Name"]. "<br/>Age:" . $row["D_Age"]. "<br/>Address: " . $row["D_Address"]."<br/>Phone:" . $row["D_Phone"]. "<br/>Sex: " . $row["D_Sex"]. "<br/>Blood Type:" . $row["B_Type"]. "<br/><form action ='' method = 'post'><div class='hide'><input type='text' name='did' value='". $row["DID"]."'><input type='text' name='btype' value='". $row["B_Type"]."'></div><label>Volume to donote (in mL)</label><input type='number' name='vol' min ='250' step='10'><br/><input type ='submit' name='donote' value = 'Donote' /></form></div>";

			        
			    }
			} else {
			    echo "<tr>N0 results</tr>";
			}

		}
		?>

		<?php

		if(isset($_POST['donote']))
		{
			
			$sql = "INSERT INTO blood (B_Type, Vol, DID) VALUES ('".$_POST["btype"]."','".$_POST["vol"]."','".$_POST["did"]."')";
			
			$nvol = $_POST["vol"];
		    
		    $result = mysqli_query($conn,$sql);

		    $sql1 = "SELECT DISTINCT donor.DID, donor.D_Name, donor.D_Age, donor.D_Address, donor.D_Phone, donor.D_Sex, blood.B_Type, SUM(blood.Vol) AS vol from donor inner join blood on donor.DID = blood.DID WHERE donor.DID = '".$_POST["did"]."' GROUP BY blood.B_Type";
			
		    
		    $result1 = mysqli_query($conn,$sql1);

		    if ($result1->num_rows > 0) {
			    
			    while($row = $result1->fetch_assoc()) {
			        echo "<div class='donotion'>Donor Id: " . $row["DID"]. "<br/>Name: " . $row["D_Name"]. "<br/>Age:" . $row["D_Age"]. "<br/>Address: " . $row["D_Address"]."<br/>Phone:" . $row["D_Phone"]. "<br/>Sex: " . $row["D_Sex"]. "<br/>Blood Type:" . $row["B_Type"]. "<br/>Total Volume Donoted(in mL):" . $row["vol"]. "<br/></div>";

			        
			    }
			} else {
			    echo "<tr>N0 results</tr>";
			}


			$sql2 = "UPDATE bloodstored SET Vol = Vol + '".$nvol."' WHERE B_Type = '".$_POST["btype"]."' ";
	    	$result2 = mysqli_query($conn,$sql2);

		}
		?>

	</main>


</body>
</html>