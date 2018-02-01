<!-- <?php

// PHP Data Objects(PDO) Sample Code:
// try {
//     $conn = new PDO("sqlsrv:server = tcp:nutritionbox.database.windows.net,1433; Database = NutritionBox", "rupkaur98", "rk@6904$");
//     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// }
// catch (PDOException $e) {
//     print("Error connecting to SQL Server.");
//     die(print_r($e));
// }

// // SQL Server Extension Sample Code:
// $connectionInfo = array("UID" => "rupkaur98@nutritionbox", "pwd" => "rk@6904$", "Database" => "NutritionBox", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
// $serverName = "tcp:nutritionbox.database.windows.net,1433";
// $conn = sqlsrv_connect($serverName, $connectionInfo);


// $sql = "SELECT BNO, B_Name, B_Address, B_Phone FROM Bloodbank ";
	   
// 	    $result = mysqli_query($conn, $sql);
//             echo $result;
	    
// 	    if ($result->num_rows > 0) {
    
// 		    while($row = $result->fetch_assoc()) {
// 		        echo "<tr><td>" . $row["BNO"]. "</td><td>" . $row["B_Name"]. "</td><td>" . $row["B_Address"]. "</td><td>" . $row["B_Phone"]. "</td></tr> ";
// 		    }
// 		} else {
// 		    echo "0 results";
// 		}


?> -->

<?php
$host = 'nutritionbox.database.windows.net';
$username = 'rupkaur98';
$password = 'rk@6904$';
$db_name = 'NutritionBox';

//Establishes the connection
$conn = mysqli_init();
mysqli_real_connect($conn, $host, $username, $password, $db_name);
if (mysqli_connect_errno($conn)) {
die('Failed to connect to MySQL: '.mysqli_connect_error());
}

// Run the create table query
if (mysqli_query($conn, '
CREATE TABLE Products (
`Id` INT NOT NULL AUTO_INCREMENT ,
`ProductName` VARCHAR(200) NOT NULL ,
`Color` VARCHAR(50) NOT NULL ,
`Price` DOUBLE NOT NULL ,
PRIMARY KEY (`Id`)
);
')) {
printf("Table created\n");
}

//Close the connection
mysqli_close($conn);
?>
