<?php
$serverName = "nutritionbox.database.windows.net";
$connectionOptions = array(
    "Database" => "NutritionBox",
    "Uid" => "user",
    "PWD" => "pwd"
);
//Establishes the connection
$conn = sqlsrv_connect($serverName, $connectionOptions);
$tsql= "SELECT *
        FROM Bloodbank";
$getResults= sqlsrv_query($conn, $tsql);
echo ("Reading data from table" . PHP_EOL);
if ($getResults == FALSE)
    echo (sqlsrv_errors());
while ($row = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_ASSOC)) {
 echo ($row['B_Name'] . " " . $row['BNO'] . PHP_EOL);
}
sqlsrv_free_stmt($getResults);
?>

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

