<?php

function get_students_by_advisor($advisor_id){
    $sql = "
        SELECT
            student_id,
            student_firstname,
            student_lastname,
            CONCAT(student_lastname,', ',student_firstname) as full_name,
            student_email,
            classification,
            PIN,
            student_username,
            student_active,
            Major.short_name
        FROM Student
        INNER JOIN Major
            ON Major.major_id = Student.major_id
        WHERE Student.faculty_id = ?
        ORDER BY student_lastname,student_firstname;
    ";

    return query_many($sql, "s", [$advisor_id]);
}

function get_students_by_class($class_id){
    $sql = "
        SELECT
            Student.student_id,
            student_firstname,
            student_lastname,
            CONCAT(student_lastname,', ',student_firstname) as full_name,
            student_email,
            classification,
            PIN,
            student_username,
            student_active,
            Major.short_name
        FROM Class
        INNER JOIN Enrollment
            ON Enrollment.class_id = Class.class_id
        INNER JOIN Student
            ON Student.student_id = Enrollment.student_id
        INNER JOIN Major
            ON Major.major_id = Student.major_id
        WHERE Class.class_id = ?
        ORDER BY student_lastname, student_firstname;
    ";

    return query_many($sql, "s", [$class_id]);
}

function get_class_count($class_id){
	$sql = "
		SELECT
			COUNT(Student.student_id) as students
		FROM Class
		LEFT JOIN Enrollment
			ON Enrollment.class_id = Class.class_id
		LEFT JOIN Student
			ON Student.student_id = Enrollment.student_id
		WHERE Class.class_id = ?
		GROUP BY Class.class_id
	";
	$row = query_one($sql,"s",[$class_id]);
	return $row["students"];
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
    $sql = "
        SELECT
            Class.class_id,
            course_name,
            CONCAT(Major.short_name, Course.course_number) as course_title,
            DATE_FORMAT(Timeslot.time_,'%l:%i%p') as time,
            days,
            credits,
            COUNT(Enrollment.student_id) as students
        FROM Class
        INNER JOIN Course
            ON Course.course_id = Class.course_id
        INNER JOIN Major
            ON Major.major_id = Course.major_id
        INNER JOIN Timeslot
            ON Timeslot.time_id = Class.time_id
        LEFT JOIN Enrollment
            ON Enrollment.class_id = Class.class_id
        WHERE Class.faculty_id = ?
        GROUP BY Class.class_id
        ORDER BY course_title
    ";
    return query_many($sql, "s", [$instructor_id]);
}

?>
