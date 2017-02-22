<?php
function insertcounty($con,$county,$pid) {

	if(isset($county->deduced))
		$deduced = $county->deduced;
	else
		$deduced = NULL;
	if(isset($county->name))
		$name = $county->name;
	else
		$name = NULL;
	if(isset($county->code))
		$code = $county->code;
	else
		$code = NULL;

   $countyinsert = "INSERT INTO county(deduced, name, code, id)
   VALUES ('$deduced','$name','$code', '$pid');";

   if(mysqli_query($con, $countyinsert) === TRUE){
      echo "county inserted Successfully\n";
   } else {

      echo "Error inserting county: " . $con->error;
   }
}

function countytable($con) {

   $countycreate = "CREATE TABLE county (
   `deduced` VARCHAR(8) NOT NULL,
   `name` VARCHAR(50) NOT NULL,
   `code` VARCHAR(20) NOT NULL,
   `id` INT,
   `county_id` INT AUTO_INCREMENT PRIMARY KEY);";

   if(!mysqli_query($con,"DESCRIBE `county`")){
      if(mysqli_query($con, $countycreate) === TRUE){
         echo "Table county created Successfully";
      } else {
         echo "Error creating county table: " . $con->error;
      }
      } else {
         echo "county table exists\n";
      }
   }
?>

