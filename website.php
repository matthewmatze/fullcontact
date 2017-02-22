<?php
function insertwebsite($con,$website,$pid) {

	$websiteinsert = "INSERT INTO website (url, id)
	VALUES ('$website->url', '$pid');";

   if(mysqli_query($con, $websiteinsert) === TRUE){
   	echo "website inserted Successfully\n";
	} else {
   	echo "Error inserting website: " . $con->error;
   }
}

function websitetable($con) {
	
	$websitecreate = "CREATE TABLE website (
	`url` VARCHAR(270) NOT NULL,`id` INT,
	`website_id` INT AUTO_INCREMENT PRIMARY KEY);";

	if(!mysqli_query($con,"DESCRIBE `website`")){
   	if(mysqli_query($con, $websitecreate) === TRUE){
      	echo "Table website created Successfully";
	   } else {
   		echo "Error creating website table: " . $con->error;
      }
	   } else {
   		echo "website table exists\n";
	   }
	}
?>
