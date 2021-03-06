<?php

function get_next_student_id(){
	$sql = "SHOW TABLE STATUS LIKE 'Student'";
	$result = query_one_np($sql);
	return $result["Auto_increment"];
}

function get_next_faculty_id(){
	$sql = "SHOW TABLE STATUS LIKE 'Faculty_Staff'";
	$result = query_one_np($sql);
	return $result["Auto_increment"];
}

function generate_random_password(){
	$password = "";
	for($i=0;$i<10;$i++){
		$ascii = 48 + rand()%75;
		$password .= CHR($ascii);
	}
	return $password;
}

function generate_username($first_name, $last_name){
	global $role;
	
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