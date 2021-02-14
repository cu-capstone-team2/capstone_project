<?php

// these functions query exactly one row
// and returns associative array to access columns

function get_student_by_username($username){
    $sql = "
        SELECT
            student_username,
            student_password,
            student_id
        FROM Student
        WHERE student_username = ?
    ";
    return query_one_no_clean($sql,"s",[$username]);
}

function get_faculty_by_username($username){
    $sql = "
        SELECT
            faculty_username,
            faculty_password,
            faculty_id,
            role
        FROM Faculty_Staff
        WHERE faculty_username = ?;
    ";
    return query_one_no_clean($sql,"s",[$username]);
}

function get_student_by_id($id){
    $sql = "
        SELECT
            *
        FROM Student
        WHERE student_id = ?;
    ";
    return query_one($sql,"s",[$id]);
}

function get_faculty_by_id($id){
    $sql = "
        SELECT
            *
        FROM Faculty_Staff
        WHERE faculty_id = ?;
    ";
    return query_one($sql,"s",[$id]);
}

?>