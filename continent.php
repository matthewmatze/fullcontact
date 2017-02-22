<?php
function insertcontinent($con,$continent,$pid) {

	if(isset($continent->deduced))
		$deduced = $continent->deduced;
	else
		$deduced = NULL;
	if(isset($continent->name))
		$name = $continent->name;
	else
		$name = NULL;
	if(isset($continent->code))
		$code = $continent->code;
	else
		$code = NULL;

   $continentinsert = "INSERT INTO continent(deduced, name, code, id)
   VALUES ('$deduced','$name','$code', '$pid');";

   if(mysqli_query($con, $continentinsert) === TRUE){
      echo "continent inserted Successfully\n";
   } else {

      echo "Error inserting continent: " . $con->error;
   }
}

function continenttable($con) {

   $continentcreate = "CREATE TABLE continent (
   `deduced` VARCHAR(8) NOT NULL,
   `name` VARCHAR(50) NOT NULL,
   `code` VARCHAR(20) NOT NULL,
   `id` INT,
   `continent_id` INT AUTO_INCREMENT PRIMARY KEY);";

   if(!mysqli_query($con,"DESCRIBE `continent`")){
      if(mysqli_query($con, $continentcreate) === TRUE){
         echo "Table continent created Successfully";
      } else {
         echo "Error creating continent table: " . $con->error;
      }
   } else {
   	echo "continent table exists\n";
   }
}
?>

