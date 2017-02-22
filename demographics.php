<?php
function insertdemographics($con, $demographics,$pid) {

	if(isset($demographics->location))
		$demo = $demographics->location;
	else
		$demo = NULL;
	if(isset($demographics->gender))
		$gen = $demographics->gender;
	else
		$gen = NULL;

   $demographicsinsert = "INSERT INTO demographics
	(locationGeneral, gender, id) VALUES (
	'$demo', '$gen', '$pid');";

   if(mysqli_query($con, $demographicsinsert) === TRUE){
		echo "demographics inserted Successfully\n";
   } else {
   	echo "Error inserting demographics: " . $con->error;
	}
}

function demographicstable($con) {

	$demographicscreate = "CREATE TABLE demographics (
	`gender` VARCHAR(8) NOT NULL ,
	`locationGeneral` VARCHAR(50) NOT NULL ,
	`id` INT,
	`demographics_id` INT AUTO_INCREMENT PRIMARY KEY
	);";

   if(!mysqli_query($con,"DESCRIBE `demographics`")){
      if(mysqli_query($con, $demographicscreate) === TRUE){
         echo "Table demographics created Successfully";
      } else {
         echo "Error creating demographics table: " . $con->error;
      }
   } else {
   echo "demographics table exists\n";
   }
}

?>
