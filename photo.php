<?php
Function insertphotoinfo($con,$photo,$pid) {
	
   $photoinfoinsert = "INSERT INTO photo (type, typeId,
	typeName, url, isPrimary, id) VALUES ('$photo->type', 
	'$photo->typeId', '$photo->typeName', '$photo->url', 
	'$photo->isPrimary', '$pid');";

   if(mysqli_query($con, $photoinfoinsert) === TRUE){
   	echo "Photo Info inserted Successfully\n";
   } else {
   	echo "Error inserting Photo Info: " . $con->error;
	}   
}/*
function insertimage($con) {

   $imageinsert = "INSERT INTO photo (image)
	SELECT '1', BulkColumn
	FROM Openrowset (Bulk './temp.jpg', Single_Blob)
	as Image;";
	
   if(mysqli_query($con, $imageinsert) === TRUE){
   	echo "Image inserted Successfully\n";
   } else {
   	echo "Error inserting Image: " . $con->error;
	}   

}*/

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
