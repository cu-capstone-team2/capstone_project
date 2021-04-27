<?php
/*********************************************************************

				******** FUNCTIONS PAGE ********

		PURPOSE: This page contains miscellaneous function that
					 are used thru out the website


*********************************************************************/


require_once('includes/functions/constants.php');

function check_select($array,$key,$compare){//This Function that a array and checks that it is a set
    if(isset($array[$key]) && $array[$key] == $compare)
        return "selected";
    return "";
}

function action(){//This Function is for security againist javascript injection
    /* Make sure form goes to specified page without javascript injection */
    return htmlspecialchars($_SERVER["PHP_SELF"]);
}


function show_error($array, $key){//This Function show any errors in a error and than prints
    /* Only show error if the error exists in the array */
    if(isset($array[$key])){
        return "<p class='error'>{$array[$key]}</p>";
    }
    return "";
}

function error_outline($array, $key){//This function adds an outline around a input if there is a error
    /* Adds classname to a input tag, if there is an error */
    if(isset($array[$key])){
        return "class='input-error'";
    }
    return "";
}

function clean_array($array){//This function cleans array after use for security
    /* Create a new clean version of array to prevent JavaScript injection */
    $clean = [];
    foreach($array as $key=>$value){
        $clean[$key] = htmlspecialchars($value);
    }
    return $clean;
}

function show_value($array,$key){
    /* Only echo the value if the key value exists in the array */
    if(isset($array[$key])){
        return $array[$key];
    }
    return "";
}

function change_page($page){//This function changes the page to a called page 
    /* Change to page specified */
    header("Location: {$page}");
    exit();
}

function get_role_name($role){//This function returns faculty role name with there role id 
    switch($role){
        case ADMIN: return "Admin";
        case SECRETARY: return "Secretary";
        case STUDENT: return "Student";
        case CHAIR: return "Chair";
        case INSTRUCTOR: return "Instructor";
        default: return "INVALID ROLE";
    }
}


function get_current_user_name(){//This function gets the first and last name of a user 
    global $user,$role;
    if($role === STUDENT)
        return $user["student_firstname"] . " " . $user["student_lastname"];
    return $user["faculty_firstname"] . " " . $user["faculty_lastname"];
}

function check_student_active($isactive){//This function checks if a students account is active 
	 switch($isactive){
		case ACTIVE: return "Active";
        	case NOT_ACTIVE: return "Not Active";
		default: return "INVALID ACTIVE";
	}
}

function link_without($param){//This function links page with an parameter 
    $link = "user.php?";
    $params = [];
    foreach($_GET as $key=>$value){
        if($key !== $param)
            $params[] = $key."=".$value;
    }
    $link .= implode($params, "&");

    return $link;
}

function get_random_char(){//This function generate random characters
    $r = rand()%62;
    if($r < 10){
        return chr(48 + $r);
    } else if($r < 36){
        return chr(65 + $r - 10);
    } else{
        return chr(97 + $r - 36);
    }
}

function generate_reset_password_key(){//This function generate a password to the users when accounts is made 
    $key = "";
    for($i=0;$i<50;$i++){
        $key .= get_random_char();
    }
    return $key;
}

function send_pin(){//This function get a request from student to be sent there enrollment pin
	global $user,$role;
	if($role !== STUDENT)
		return;
	mail($user["student_email"],"Enrollment PIN Request","\nYour PIN: {$user['PIN']}");
}

?>
