<?php

ob_start();
session_start();

function is_logged_in(){
    return isset($_SESSION["id"]) && isset($_SESSION["role"]);
}

function login_user($input){
    if($input['role'] === "student"){
        $student = get_student_by_username($input['username']);
        login($student["student_id"], STUDENT);
    } else{
        $faculty = get_faculty_by_username($input['username']);
        login($faculty["faculty_id"], $faculty["role"]);
    }
}

function go_to_correct_page(){
    if(!is_logged_in())
        change_page('index.php');
    change_page('user.php');
}

function login($id, $role){
    $_SESSION["id"] = $id;
    $_SESSION["role"] = $role;
}

function logout(){
    unset($_SESSION["id"]);
    unset($_SESSION["role"]);
    unset($_SESSION["PIN"]);
}

function is_faculty($role){
    switch($role){
        case ADMIN:
        case CHAIR:
        case INSTRUCTOR:
        case SECRETARY:
            return true;
        default:
            return false;
    }
}

function authenticate(){
    if(!is_logged_in()){
        change_page('index.php');
    }
    $user = false;
    if($_SESSION["role"] === STUDENT)
        $user = get_student_by_id($_SESSION["id"]);
    else if(is_faculty($_SESSION["role"]))
        $user = get_faculty_by_id($_SESSION["id"]);
    
    if(!$user)
        change_page('index.php');
    return $user;
}

?>