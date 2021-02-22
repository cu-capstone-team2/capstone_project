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
            Student.*,
            CONCAT(student_lastname,', ',student_firstname) as full_name,
            CONCAT(faculty_lastname,', ',faculty_firstname) as advisor
        FROM Student
        INNER JOIN Major
            ON Major.major_id = Student.major_id
        INNER JOIN Faculty_Staff
            ON Faculty_Staff.faculty_id = Student.faculty_id
        WHERE student_id = ?;
    ";
    return query_one($sql,"s",[$id]);
}

function get_faculty_by_id($id){
    $sql = "
        SELECT
            Faculty_Staff.*,
            CONCAT(faculty_lastname,', ',faculty_firstname) as full_name,
            CONCAT(Room.building,' ',Room.room_number) as room
        FROM Faculty_Staff
        INNER JOIN Room
            ON Room.room_id = Faculty_Staff.room_id
        WHERE faculty_id = ?;
    ";
    return query_one($sql,"s",[$id]);
}

function get_chair(){
    $sql = "
        SELECT
            Faculty_Staff.*,
            CONCAT(faculty_lastname,', ',faculty_firstname) as full_name,
            CONCAT(Room.building,' ',Room.room_number) as room
        FROM Faculty_Staff
        INNER JOIN Room
            ON Room.room_id = Faculty_Staff.room_id
        WHERE role = (SELECT role_chair FROM Constants);
    ";
    return query_one_np($sql);
}

function get_course_by_id($id){
    $sql = "
        SELECT
            Course.*,
            CONCAT(Major.short_name,' ',course_number) as title
        FROM Course
        INNER JOIN Major
            ON Major.major_id = Course.major_id
        WHERE course_id = ?
    ";
    return query_one($sql,"s",[$id]);
}

function get_class_by_id($id){
    $sql = "
        SELECT
            Class.*,
            Course.course_name,
            CONCAT(Major.short_name, Course.course_number) as course_title,
            CONCAT(Faculty_Staff.faculty_lastname,', ',Faculty_Staff.faculty_firstname) as instructor,
            DATE_FORMAT(Timeslot.time_,'%l:%i%p') as time,
            COUNT(Student.student_id) as students
        FROM Class
        INNER JOIN Course
            ON Course.course_id = Class.course_id
        INNER JOIN Faculty_Staff
            ON Faculty_Staff.faculty_id = Class.faculty_id
        INNER JOIN Timeslot
            ON Timeslot.time_id = Class.time_id
        INNER JOIN Major
            ON Major.major_id = Course.major_id
        LEFT JOIN Enrollment
            ON Enrollment.class_id = Class.class_id
        LEFT JOIN Student
            ON Student.student_id = Enrollment.student_id
        WHERE Class.class_id = ?
        GROUP BY Class.class_id
    ";
    return query_one($sql,"s",[$id]);
}



?>