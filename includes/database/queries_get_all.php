<?php

function get_all_students(){
    $sql = "
        SELECT
            student_id,
            student_firstname,
            student_lastname,
            student_email,
            classification,
            PIN,
            student_username,
            student_active,
            Major.short_name,
            CONCAT(faculty_lastname,', ',faculty_firstname) as advisor
        FROM Student
        INNER JOIN Major
            ON Major.major_id = Student.major_id
        INNER JOIN Faculty_Staff
            ON Faculty_Staff.faculty_id = Student.faculty_id
        ORDER BY student_lastname,student_firstname;
    ";
    return query_many_np($sql);
}

?>