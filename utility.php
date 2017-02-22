<?php
function connectToDB()
{
	//setup db info
	$dbPath="localhost";
	$dbUser="root";
	$dbPass="MyNewPass4!";
	$dbName="fullcontact_db";

	//create a database connection
	$dbconn = new mysqli($dbPath,$dbUser,$dbPass);
	logMsg("Connecting to $dbPath with user $dbUser");
	//if we couldn't connect or select the db then log the message
	if(!$dbconn)
	{
		logMsg('Connect Error ('.mysqli_connect_errno().') '.mysqli_connect_error());
		logMsgAndDie("Error Connecting to $dbPath with user $dbUser");
	}
	if(!$dbconn->select_db($dbName))
	{
		logMsgAndDie("Could not select $dbName database");
	}
	//otherwise return the connection
	return $dbconn;
}
function disconnectDB($dbconn)
{
   $dbconn->close();
   logMsg("Disconnect from database:");
}
function logMsg($message)
{
   error_log($message);
}
function logMsgAndDie($message)
{
   error_log($message);
   die('See error log for details '.mysql_error());

}
function cleanInput($data)
{
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
?>
