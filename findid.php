<?php
function findid($con) {

	//Query the last entry, they
	// are the current person 
	//because their id is autoincremented
	//and the most recent entry is the
	//last on in the id column
	$findid = "SELECT id FROM persons
	ORDER BY id DESC LIMIT 1
	;";
   $pidq = mysqli_query($con, $findid);
   $pid = $pidq->fetch_assoc();
   return $pid['id'];
}
?>
