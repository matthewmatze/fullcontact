<?php
function insertcontactInfo($con,$cont,$pid) {
	
	if(isset($cont->familyName))
		$fam = $cont->familyName;
	else
		$fam = NULL;
	if(isset($cont->givenName))
		$give = $cont->givenName;
	else
		$give = NULL;
	if(isset($cont->fullName))
		$full = $cont->fullName;
	else
		$full = NULL;
	
   $contactInfoinsert = "INSERT INTO contactInfo 
	(familyName,fullName,givenName,id) VALUES (
	'$fam', '$full',
	'$give', '$pid');";

	if(mysqli_query($con, $contactInfoinsert) === TRUE){
   	echo "ContactInfo inserted Successfully\n";
   } else {
   	echo "Error inserting ContactInfo: " . $con->error;
   }
}

function contacttable($con) {
   $contactcreate = "CREATE TABLE contactInfo (
	`familyName` VARCHAR(50) NOT NULL ,
	`fullName` VARCHAR(50) NOT NULL,
	`givenName` VARCHAR(50) NOT NULL,
	`id` INT,
	`contact_id` INT AUTO_INCREMENT PRIMARY KEY
	);";

   if(!mysqli_query($con,"DESCRIBE `contactInfo`")){
      if(mysqli_query($con, $contactcreate) === TRUE){
         echo "Table contactInfo created Successfully";
      } else {
         echo "Error creating contactInfo table: " . $con->error;
      }
   } else {
   echo "contactInfo table exists\n";
   }
}
?>
