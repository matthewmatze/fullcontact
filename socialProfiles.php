<?php
function insertsocialProfiles($con, $socialProfiles,$pid) {
	
	//Check to see if each individual social profile category
	//actually has something filled in
   
	if(isset($socialProfiles->bio))
      $bio = $socialProfiles->bio;
   else
      $bio=NULL;

   if(isset($socialProfiles->followers))
      $followers = $socialProfiles->followers;
   else
      $followers=NULL;

   if(isset($socialProfiles->type))
      $type = $socialProfiles->type;
   else
	   $type=NULL;

   if(isset($socialProfiles->typeId))
      $typeId = $socialProfiles->typeId;
   else
      $typeId=NULL;

   if(isset($socialProfiles->typeName))
      $typeName = $socialProfiles->typeName;
   else
      $typeName=NULL;

   if(isset($socialProfiles->url))
      $url = $socialProfiles->url;
  else
      $url=NULL;

   if(isset($socialProfiles->username))
      $username = $socialProfiles->username;
   else
      $username=NULL;

   if(isset($socialProfiles->id))
      $profileid = $socialProfiles->id;
   else
      $profileid=NULL;

   $socialProfilesinsert = "INSERT INTO socialProfiles
	(bio, followers, type, typeId, typeName, url, 
	username, profileid, id) VALUES ('$bio', '$followers', 
	'$type', '$typeId', '$typeName', '$url', '$username', 
	'$profileid','$pid');";

	if(mysqli_query($con, $socialProfilesinsert) === TRUE){
   	echo "social Profiles inserted Successfully\n";
   } else {
   	echo "Error inserting social Profiles: " . $con->error;
	}
}

function socialProfilestable($con) {

	$socialProfilescreate = "CREATE TABLE socialProfiles (
	`bio` VARCHAR(5000) , `followers` VARCHAR(30),
	`type` VARCHAR(30) ,	`typeId` VARCHAR(30) ,
	`typeName` VARCHAR(30) , `url` VARCHAR(150) ,
	`username` VARCHAR(50) , `profileid` VARCHAR(30) ,
	`id` INT,
	`socialProfile_id` INT AUTO_INCREMENT PRIMARY KEY
	);";

   if(!mysqli_query($con,"DESCRIBE `socialProfiles`")){
      if(mysqli_query($con, $socialProfilescreate) === TRUE){
         echo "Table socialProfiles created Successfully";
      } else {
         echo "Error creating Social Profiles table: " . $con->error;
      }
   } else {
   	echo "Social Profiles table exists\n";
   }
}

?>

