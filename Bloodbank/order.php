

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

	<main>

	
	<div class="order-issue">
	<h3>Orders</h3>
	<p><a class="ref" href="issues.php">View Issues</a></p>
	</div>

	<table style="width:80%">
	  <tr>
	  	<th>Order Id</th>
	  	<th>Hospital Name</th>
	  	<th>Blood Type</th>
	    <th>Vol(in mL)</th>
	    <th>Availability</th>
	    <th>Approve</th>
	  </tr>
	<?php

	

	    $sql = "SELECT Order_Id, H_Name, B_Type, Vol FROM orders ";

	    $result = mysqli_query($conn,$sql);
   

	    if ($result->num_rows > 0) {
    
		    while($row = $result->fetch_assoc()) {

		    	$result1 = mysqli_query($conn,"SELECT Vol FROM bloodstored WHERE B_Type = '". $row["B_Type"]. "' AND BNO='205' ");
			    $row1 = mysqli_fetch_row($result1);
			    $matchFound = $row["Vol"] <= $row1[0]  ? 'Available' : 'Not Available';
				

		        echo "<tr><td>" . $row["Order_Id"]. "</td><td>" . $row["H_Name"]. "</td><td>" . $row["B_Type"]. "</td><td>" . $row["Vol"]. "</td><td class='match'>" . $matchFound. "</td><td><form action ='' method = 'post'><div class='hide'><input type='text' name='orderid' value='". $row["Order_Id"]."'><input type='text' name='hname' value='". $row["H_Name"]."'><input type='text' name='btype' value='". $row["B_Type"]."'><input type='text' name='vol' value='". $row["Vol"]."'></div><input class='approve' type ='submit' name='approve' value = 'Approve' /></form>";
		    }
		} else {
		    echo "0 results";
		}


		 if(isset($_POST['approve']))
			{

			    $sql = "INSERT INTO issues (BNO, H_Name, B_Type, Vol, Order_Id)
			    VALUES ('205','".$_POST["hname"]."','".$_POST["btype"]."','".$_POST["vol"]."','".$_POST["orderid"]."')";

			    $result = mysqli_query($conn,$sql);


			    $sql1 = "DELETE FROM orders WHERE Order_Id = ".$_POST["orderid"]."";
				$result1 = mysqli_query($conn,$sql1);


				$sql2 = "UPDATE bloodstored SET Vol = Vol - '".$_POST["vol"]."' WHERE B_Type = '".$_POST["btype"]."' ";
	    		$result2 = mysqli_query($conn,$sql2);




			}

			    
				

	?>
	</table>




	</main>

	<script type="text/javascript">

		var but = document.getElementsByClassName('match');

            for (let i=0; i < but.length; i++) {
                
                    var selection = but[i].innerHTML;
                    
                    var sel = jQuery(but[i]).next();

                   switch(selection)
				   {
				       case 'Available':
				           console.log("yes");
				           
				           break;
				       case 'Not Available':
				       		console.log("no");
				           sel.addClass('hide');
				           break;
				   }
                
            };
		

	</script>

</body>
</html>