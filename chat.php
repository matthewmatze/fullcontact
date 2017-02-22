<?php
function insertchat($con,$chat,$pid) {

   $chatinsert = "INSERT INTO chat 
	(client, handle, id)	VALUES (
	'$chat->client', '$chat->handle', 
	'$pid');";

   if(mysqli_query($con, $chatinsert) === TRUE){
   	echo "chat inserted Successfully\n";
   } else {
      echo "Error inserting chat: " . $con->error;
   }
}

function chattable($con) {
   $chatcreate = "CREATE TABLE chat (
	`client` VARCHAR(50) NOT NULL ,
	`handle` VARCHAR(50) NOT NULL,
	`id` INT,
	`chat_id` INT AUTO_INCREMENT PRIMARY KEY
	);";

   if(!mysqli_query($con,"DESCRIBE `chat`")){
      if(mysqli_query($con, $chatcreate) === TRUE){
         echo "Table chat created Successfully";
      } else {
         echo "Error creating chat table: " . $con->error;
      }
   } else {
   echo "chat table exists\n";
   }
}

?>
