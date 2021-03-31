<?php

require_once('includes/functions/constants.php');

function check_select($array,$key,$compare){
    if(isset($array[$key]) && $array[$key] == $compare)
        return "selected";
    return "";
}

function action(){
    /* Make sure form goes to specified page without javascript injection */
    return htmlspecialchars($_SERVER["PHP_SELF"]);
}


function show_error($array, $key){
    /* Only show error if the error exists in the array */
    if(isset($array[$key])){
        return "<p class='error'>{$array[$key]}</p>";
    }
    return "";
}

function error_outline($array, $key){
    /* Adds classname to a input tag, if there is an error */
    if(isset($array[$key])){
        return "class='input-error'";
    }
    return "";
}

function clean_array($array){
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

function change_page($page){
    /* Change to page specified */
    header("Location: {$page}");
    exit();
}

function get_role_name($role){
    switch($role){
        case ADMIN: return "Admin";
        case SECRETARY: return "Secretary";
        case STUDENT: return "Student";
        case CHAIR: return "Chair";
        case INSTRUCTOR: return "Instructor";
        default: return "INVALID ROLE";
    }
}


function get_current_user_name(){
    global $user,$role;
    if($role === STUDENT)
        return $user["student_firstname"] . " " . $user["student_lastname"];
    return $user["faculty_firstname"] . " " . $user["faculty_lastname"];
}

function check_student_active($isactive){
	 switch($isactive){
		case ACTIVE: return "Active";
        	case NOT_ACTIVE: return "Not Active";
		default: return "INVALID ACTIVE";
	}
}

function link_without($param){
    $link = "user.php?";
    $params = [];
    foreach($_GET as $key=>$value){
        if($key !== $param)
            $params[] = $key."=".$value;
    }
    $link .= implode($params, "&");

    return $link;
}

function get_random_char(){
    $r = rand()%62;
    if($r < 10){
        return chr(48 + $r);
    } else if($r < 36){
        return chr(65 + $r - 10);
    } else{
        return chr(97 + $r - 36);
    }
}

function generate_reset_password_key(){
    $key = "";
    for($i=0;$i<50;$i++){
        $key .= get_random_char();
    }
    return $key;
}


?>