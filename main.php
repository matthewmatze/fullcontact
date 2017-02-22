#!/usr/bin/php
<?php
/*
	Author: Matthew Matze
	Date: 2/21/2017
	Location: ~/fullcontact/
	General Summary of Program
	
	The program is designed to curl in the xml file(saved as temp.xml) and 
	parse it	into arrays and stdclasses. Then it will go one by one through 
	each category and take the arrays and stdclasses and send them into organized
	tables all referenced together by the overall parent class persons. This
	is done through the id which is consistent throughout the program for each
	entry. In order to find someone you can search their name in the persons
	table and use the correlated id in the rest of the tables to discover the
	other attributes.

	This was built on centOS/Oracle compliant system other enviornments have
	not been tested thus far.
	
	To Run:
	./sendinfo.php

	Subsequently Prompted:
	Please enter in the email address you would like to add:
*/

	//Include utilities
	require("utility.php");
	require("findid.php");
	require("contactInfo.php");
	require("person.php");
	require("website.php");
	require("chat.php");
	require("photo.php");
	require("organization.php");
	require("location.php");
	require("demographics.php");
	require("socialProfiles.php");
	require("scores.php");
	require("topic.php");
	require("city.php");
	require("county.php");
	require("country.php");
	require("continent.php");

	//read in string email
	$email = readline("Please enter in the email address you would like to add:");
	//$email = "bart@fullcontact.com";

   //cat the curl command and email address then execute it
	$url = "curl -o temp.xml -H\"X-FullContact-APIKey:d0d83247005dc681\" \"https://api.fullcontact.com/v2/person.xml?email=";
	$url = $url . $email;
   $url = $url .  "\"";
	echo exec($url);

	//connect to the local sql database
	$con = connectToDB();
	
	//Load the xml into the simplexmlobject
	$xml=simplexml_load_file("temp.xml") or die("Error: Cannot create object");

	//json encode and decode to convert the simplexmlobject
	//into a stdclass or array
	$photos=json_decode(json_encode($xml->photos));
	$cont=json_decode(json_encode($xml->contactInfo));
	$org=json_decode(json_encode($xml->organizations));
	$demo=json_decode(json_encode($xml->demographics));
	$social=json_decode(json_encode($xml->socialProfiles));
	$digi=json_decode(json_encode($xml->digitalFootprint));
	

	//Create main persons table with all people and ids
	personstable($con);
	insertperson($con,$email);

	//find and save the person's id to be referenced in $pid
	$pid = findid($con);


	//Create and insert the photos into the photo table
	phototable($con);	
	if(isset($photos->photo)){
		if(is_array($photos->photo)){
			foreach($photos->photo as $cnt => $photo){
   			//cat the curl command and email address then execute it
				insertphotoinfo($con,$photo,$pid);
			}
		} else {
			foreach($photos as $photo){
				insertphotoinfo($con,$photo,$pid);
			}
		}
	}

	//Create and insert contactInfo into table
	contacttable($con);
	insertcontactInfo($con,$cont,$pid);

	//Create chat table and insert all elements if any
	chattable($con);
	if(isset($cont->chats->chat)){
		if(is_array($cont->chats->chat)){
			foreach($cont->chats->chat as $cnt => $chat){
				insertchat($con,$chat,$pid);
			}
		} else {
			foreach($cont->chats as  $chat){
				insertchat($con,$chat,$pid);
			}
		}
	}

	//Create and insert elements into website table if any
	websitetable($con);
	if(isset($cont->websites->website)){
		if(is_array($cont->websites->website)){
			foreach($cont->websites->website as  $website){
				insertwebsite($con,$website,$pid);
			}
		} else {
			foreach($cont->websites as  $website){
				insertwebsite($con,$website,$pid);
			}
		}
	}

	//Create and insert elements into organization table if any
	organizationtable($con);		
	if(isset($org->organization)){
		if(is_array($org->organization)){
			foreach($org->organization as $cnt => $organization){
				insertorganization($con,$organization,$pid);
			}
		} else {
			foreach($org as  $organization){
				insertorganization($con,$organization,$pid);
			}
		}
	}
	
	//Create and insert elements into demographics table if any
	demographicstable($con);
	if(isset($demo))
		insertdemographics($con,$demo,$pid);

	//Create and insert elements into location table if any
	locationtable($con);
	if(isset($demo->locationDeduced))
		insertlocation($con,$demo->locationDeduced,$pid);
 
	//Create and insert elements into city table if any
	citytable($con);
	if(isset($demo->locationDeduced->city))
		insertcity($con,$demo->locationDeduced->city,$pid);
	
	//Create and insert elements into country table if any
	countrytable($con);
	if(isset($demo->locationDeduced->country))
		insertcountry($con,$demo->locationDeduced->country,$pid);

	//Create and insert elements into county table if any
	countytable($con);
	if(isset($demo->locationDeduced->county))
		insertcounty($con,$demo->locationDeduced->county,$pid);

	//Create and insert elements into continent table if any
	continenttable($con);
	if(isset($demo->locationDeduced->continent))
		insertcontinent($con,$demo->locationDeduced->continent,$pid);

	//Create and insert elements into socialProfile table if any
	socialProfilestable($con);
	if(isset($social->socialProfile)){
		if(is_array($social->socialProfile)){
			foreach($social->socialProfile as $cnt => $socialProfile){
				insertsocialProfiles($con,$socialProfile,$pid);
			}
		} else {
			foreach($social as  $socialProfile){
				insertsocialProfiles($con,$socialProfile,$pid);
			}
		}
	}

	//Create and insert elements into score table if any
	scoretable($con);
	if(isset($digi->scores->score)){
		if(is_array($digi->scores->score)){
			foreach($digi->scores->score as $cnt => $score){
				insertscores($con,$score,$pid);
			}
		} else {
			foreach($digi->scores as $score){
				insertscores($con,$score,$pid);
			}
		}
	}

	//Create and insert elements into topic table if any
	topictable($con);
	if(isset($digi->topics->topic)){
		if(is_array($digi->topics->topic)){
			foreach($digi->topics->topic as $cnt => $topic){
				inserttopic($con,$topic,$pid);
			}
		} else {
			foreach($digi->topics as  $topic){
				inserttopic($con,$topic,$pid);
			}
		}
	}
	//close connection with server
	$con->close();
	return 0;
?>
