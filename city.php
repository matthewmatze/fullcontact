<?php
function insertcity($con,$city,$pid) {

	if(isset($city->deduced))
		$deduced = $city->deduced;
	else
		$deduced = NULL;
	if(isset($city->name))
		$name = $city->name;
	else
		$name = NULL;
	if(isset($city->code))
		$code = $city->code;
	else
		$code = NULL;

   $cityinsert = "INSERT INTO city(deduced, name, code, id)
   VALUES ('$deduced','$name','$code', '$pid');";

   if(mysqli_query($con, $cityinsert) === TRUE){
      echo "city inserted Successfully\n";
   } else {

      echo "Error inserting city: " . $con->error;
   }
}

function citytable($con) {

   $citycreate = "CREATE TABLE city (
   `deduced` VARCHAR(8) NOT NULL,
   `name` VARCHAR(50) NOT NULL,
   `code` VARCHAR(20) NOT NULL,
   `id` INT,
   `city_id` INT AUTO_INCREMENT PRIMARY KEY);";

   if(!mysqli_query($con,"DESCRIBE `city`")){
      if(mysqli_query($con, $citycreate) === TRUE){
         echo "Table city created Successfully";
      } else {
         echo "Error creating city table: " . $con->error;
      }
      } else {
         echo "city table exists\n";
      }
   }
?>

