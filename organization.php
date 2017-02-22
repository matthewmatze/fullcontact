<?php
function insertorganization($con,$organization,$pid) {
  
	if(isset($organization->isPrimary))
      $isPrimary = $organization->isPrimary;
   else
      $isPrimary = NULL;
  
	if(isset($organization->name))
      $name = $organization->name;
   else
      $name = NULL;

  if(isset($organization->startDate))
      $startDate = $organization->startDate;
   else
      $startDate = NULL;

  if(isset($organization->current))
      $current = $organization->current;
   else
      $current = NULL;

  if(isset($organization->title))
      $title = $organization->title;
   else
      $title = NULL;

  	$organizationinsert = "INSERT INTO organization (isPrimary, name,
	startDate, title, current, id)
	VALUES ('$isPrimary', '$name',
	'$startDate', '$title',
	'$current', '$pid');";

   if(mysqli_query($con, $organizationinsert) === TRUE){
   	echo "organization inserted Successfully\n";
   } else {
   	echo "Error inserting organization: " . $con->error;
	}
}

function organizationtable($con) {
   $organizationcreate = "CREATE TABLE organization (
	`isPrimary` VARCHAR(8) NOT NULL ,
	`name` VARCHAR(50) NOT NULL ,
	`startDate` VARCHAR(10) NOT NULL ,
	`title` VARCHAR(170) NOT NULL ,
	`current` VARCHAR(8) NOT NULL ,
	`id` INT,
	`organization_id` INT AUTO_INCREMENT PRIMARY KEY
	);";
	if(!mysqli_query($con,"DESCRIBE `organization`")){
      if(mysqli_query($con, $organizationcreate) === TRUE){
      	echo "Table organization created Successfully";
  	   } else {
	  		echo "Error creating organization table: " . $con->error;
		}
	} else {
  		echo "organization table exists\n";
  	}
}
?>
