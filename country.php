<?php
function insertcountry($con,$country,$pid) {

	if(isset($country->deduced))
		$deduced = $country->deduced;
	else
		$deduced = NULL;
	if(isset($country->name))
		$name = $country->name;
	else
		$name = NULL;
	if(isset($country->code))
		$code = $country->code;
	else
		$code = NULL;

   $countryinsert = "INSERT INTO country(deduced, name, code, id)
   VALUES ('$deduced','$name','$code', '$pid');";

   if(mysqli_query($con, $countryinsert) === TRUE){
      echo "country inserted Successfully\n";
   } else {

      echo "Error inserting country: " . $con->error;
   }
}

function countrytable($con) {

   $countrycreate = "CREATE TABLE country (
   `deduced` VARCHAR(8) NOT NULL,
   `name` VARCHAR(50) NOT NULL,
   `code` VARCHAR(20) NOT NULL,
   `id` INT,
   `country_id` INT AUTO_INCREMENT PRIMARY KEY);";

   if(!mysqli_query($con,"DESCRIBE `country`")){
      if(mysqli_query($con, $countrycreate) === TRUE){
         echo "Table country created Successfully";
      } else {
         echo "Error creating country table: " . $con->error;
      }
      } else {
         echo "country table exists\n";
      }
   }
?>

