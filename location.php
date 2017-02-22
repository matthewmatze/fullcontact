<?php
function insertlocation($con,$location,$pid) {

   $locationinsert = "INSERT INTO location
	(normalizedLocation, deducedLocation, id)
	VALUES ('$location->normalizedLocation', 
	'$location->deducedLocation', '$pid');";

	if(mysqli_query($con, $locationinsert) === TRUE){
   	echo "location inserted Successfully\n";
   } else {
   	echo "Error inserting location: " . $con->error;
   }
}

function locationtable($con) {
   $locationcreate = "CREATE TABLE location (
	`normalizedLocation` VARCHAR(150) NOT NULL ,
	`deducedLocation` VARCHAR(150) NOT NULL,
	`id` INT,
	`location_id` INT AUTO_INCREMENT PRIMARY KEY
	);";

   if(!mysqli_query($con,"DESCRIBE `location`")){
      if(mysqli_query($con, $locationcreate) === TRUE){
         echo "Table location created Successfully";
      } else {
         echo "Error creating location table: " . $con->error;
      }
   } else {
   echo "location table exists\n";
   }
}

?>
