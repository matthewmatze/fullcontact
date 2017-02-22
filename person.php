<?php
function insertperson($con,$name) {

   $personinsert = "INSERT INTO persons (name)
	VALUES ('$name');";
   
	if(mysqli_query($con, $personinsert) === TRUE){
		echo "Person inserted Successfully\n";
   } else {
   	echo "Error inserting person: " . $con->error;
   }
}

function personstable($con) {
	
	$persons = "CREATE TABLE persons (
	`name`	VARCHAR(50) NOT NULL,
	`id`		INT AUTO_INCREMENT PRIMARY KEY
	);";	

   if(!mysqli_query($con,"DESCRIBE `persons`")){
      if(mysqli_query($con, $persons) === TRUE){
         echo "Table Persons created Successfully";
      } else {
         echo "Error creating table: " . $con->error;
      }
   } else {
   echo "persons table exists\n";
   }
}

?>
