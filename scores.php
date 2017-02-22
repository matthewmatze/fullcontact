<?php
function insertscores($con,$score,$pid) {

	$scoreinsert = "INSERT INTO score (provider, type,
   value, id) VALUES ('$score->provider', 
	'$score->type', '$score->value',  '$pid');";

	if(mysqli_query($con, $scoreinsert) === TRUE){
 		echo "score inserted Successfully\n";
   } else {
     	echo "Error inserting score: " . $con->error;
   }
}
function scoretable($con) {

	$scorecreate = "CREATE TABLE score (
	`provider` VARCHAR(20) NOT NULL ,
	`type` VARCHAR(40) NOT NULL,
	`value` VARCHAR(10) NOT NULL,
	`id` INT,
	`score_id` INT AUTO_INCREMENT PRIMARY KEY
	);";

   if(!mysqli_query($con,"DESCRIBE `score`")){
      if(mysqli_query($con, $scorecreate) === TRUE){
         echo "Table score created Successfully";
      } else {
         echo "Error creating score table: " . $con->error;
      }
   } else {
   	echo "score table exists\n";
   }
}
?>
