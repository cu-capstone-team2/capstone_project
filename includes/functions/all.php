<?php

require_once('includes/functions/constants.php');

function check_select($array,$key,$compare){
    if(isset($array[$key]) && $array[$key] === $compare)
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

function check_user($valid_users){
    /* Check if user is valid */
    global $role;
    $valid = false;
    foreach($valid_users as $user){
        if($role === $user){
            $valid = true;
            break;
        }
    }
    if(!$valid)
        change_page("user.php");
}

function get_current_user_name(){
    global $user,$role;
    if($role === STUDENT)
        return $user["student_firstname"] . " " . $user["student_lastname"];
    return $user["faculty_firstname"] . " " . $user["faculty_lastname"];
}

?>