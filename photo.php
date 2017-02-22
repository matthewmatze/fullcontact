<?php
Function insertphoto($con,$photo,$pid) {

   $photoinsert = "INSERT INTO photo (type, typeId,
	typeName, url, isPrimary, id) VALUES ('$photo->type', 
	'$photo->typeId', '$photo->typeName', '$photo->url', 
	'$photo->isPrimary', '$pid');";

   if(mysqli_query($con, $photoinsert) === TRUE){
   	echo "Photo inserted Successfully\n";
   } else {
   	echo "Error inserting photo: " . $con->error;
	}   
}

function phototable($con) {
   
	$photocreate = "CREATE TABLE photo (
	`type` VARCHAR(50) NOT NULL ,
	`typeId` VARCHAR(50) NOT NULL ,
	`typeName` VARCHAR(50) NOT NULL ,
	`url` VARCHAR(300) NOT NULL,
	`isPrimary` VARCHAR(8) NOT NULL,
	`id` INT,
	`photo_id` INT AUTO_INCREMENT PRIMARY KEY
	);";

   if(!mysqli_query($con,"DESCRIBE `photo`")){
      if(mysqli_query($con, $photocreate) === TRUE){
         echo "Table Photos created Successfully";
      } else {
         echo "Error creating table: " . $con->error;
      }
   } else {
   echo "photo table exists\n";
   }
}


?>
