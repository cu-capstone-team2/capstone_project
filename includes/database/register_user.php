<?php
/**************************************************************************

				******** SQL GENERATE USER PAGE ********
				PURPOSE: This page contains function that aid in the 
					     in the generation of new users accounts 

**************************************************************************/
function get_next_student_id(){//This function will get the next availble id for a student
	$sql = "SHOW TABLE STATUS LIKE 'Student'";
	$result = query_one_np($sql);
	return $result["Auto_increment"];
}

function get_next_faculty_id(){//This function will get the next availble id for a faculty
	$sql = "SHOW TABLE STATUS LIKE 'Faculty_Staff'";
	$result = query_one_np($sql);
	return $result["Auto_increment"];
}

function generate_random_password(){//This function will generate a password for new users before emailing the user when account is created
	$password = "";
	for($i=0;$i<10;$i++){
		$ascii = 48 + rand()%75;
		$password .= CHR($ascii);
	}
	return $password;
}

function generate_username($first_name, $last_name, $role = 0){//this function wil generate a username when account is created by combining user first name and last and then their ID
	$username = $first_name . $last_name;
	if($role === STUDENT){
		$username .= get_next_student_id();
	} else{
		$username .= get_next_faculty_id();
	}
	return strtolower($username);
}

function generate_random_pin(){
	return 1000 + rand()%9000;
}

?>