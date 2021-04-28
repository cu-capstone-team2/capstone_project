<?php
/***************************************************************************

			 ******** LOGIN AUTHENTICATION PAGE ********
			PURPOSE: This page contain the authentication for each user
					  when they login into the system 

***************************************************************************/

ob_start();//starts output buffer
session_start();//starts a new session 

function is_logged_in(){//This function checks that the users logged in 
    return isset($_SESSION["id"]) && isset($_SESSION["role"]);
}

function login_user($input){//This function will return the users info on the default page 
    if($input['role'] === "student"){
        $student = get_student_by_username($input['username']);
        login($student["student_id"], STUDENT);
    } else{
        $faculty = get_faculty_by_username($input['username']);
        login($faculty["faculty_id"], $faculty["role"]);
    }
}

function go_to_correct_page(){//This functin will direct the user to the right page
    if(!is_logged_in())
        change_page('index.php');
    change_page('user.php');
}

function login($id, $role){//This function saves the id and role of the user when logined
    $_SESSION["id"] = $id;
    $_SESSION["role"] = $role;
}

function logout(){//This function unset the session from the authentication
    unset($_SESSION["id"]);
    unset($_SESSION["role"]);
    unset($_SESSION["PIN"]);
}

function is_faculty($role){//This function after it is a faculty checks which role of the faculty member 
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

function check_user($valid_users){//This function checks that the user is valid in the database 
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

function authenticate(){//This function checks if user is logged if not redirects to homepage
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