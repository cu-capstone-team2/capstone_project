<?php

function get_students_by_advisor($advisor_id){
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

    return query_many($sql, "s", [$advisor_id]);
}

function get_classes_by_student($student_id){
    $sql = "
        SELECT
            Enrollment.class_id,
            Course.course_name,
            CONCAT(Major.short_name, Course.course_number) as course_title,
            CONCAT(Faculty_Staff.faculty_lastname,', ',Faculty_Staff.faculty_firstname) as instructor,
            DATE_FORMAT(Timeslot.time_,'%l:%i%p') as time,
            days,
            credits
        FROM Enrollment
        INNER JOIN Class
            ON Class.class_id = Enrollment.class_id
        INNER JOIN Course
            ON Course.course_id = Class.course_id
        INNER JOIN Faculty_Staff
            ON Faculty_Staff.faculty_id = Class.faculty_id
        INNER JOIN Timeslot
            ON Timeslot.time_id = Class.time_id
        INNER JOIN Major
            ON Major.major_id = Course.major_id
        WHERE Enrollment.student_id = ?
        ORDER BY Enrollment.class_id
    ";
    return query_many($sql, "s", [$student_id]);
}

function get_classes_by_instructor($instructor_id){

}

?>