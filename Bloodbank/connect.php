<?php

// Create connection
$conn = mysqli_connect("nutritionbox.database.windows.net", "rupkaur98", "rk@6904$", "NutritionBox");

// Check connection
if (!$conn) {
   die("Connection failed: " . mysqli_connect_error());
}

?>
