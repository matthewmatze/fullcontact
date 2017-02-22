<?php
function inserttopic($con,$topic,$pid) {

   $topicinsert = "INSERT INTO topic (provider, value,
   id) VALUES ('$topic->provider', '$topic->value', 
	'$pid');";

   if(mysqli_query($con, $topicinsert) === TRUE){
	 	echo "topic inserted Successfully\n";
   } else {
      echo "Error inserting topic: " . $con->error;
   }
}
function topictable($con) {
   
	$topiccreate = "CREATE TABLE topic (
	`provider` VARCHAR(20) NOT NULL ,
	`value` VARCHAR(50) NOT NULL,
	`id` INT,
	`topic_id` INT AUTO_INCREMENT PRIMARY KEY
	);";

   if(!mysqli_query($con,"DESCRIBE `topic`")){
      if(mysqli_query($con, $topiccreate) === TRUE){
         echo "Table topic created Successfully";
      } else {
         echo "Error creating topic table: " . $con->error;
      }
   } else {
   echo "topic table exists\n";
   }
}

?>
