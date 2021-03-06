<?php

// these functions query exactly one row
// and returns associative array to access columns

function get_student_by_username($username){
    $sql = "
        SELECT
            student_username,
            student_password,
            student_id,
            student_email
        FROM Student
        WHERE student_username = ?
            AND student_active = 1
    ";
    return query_one_no_clean($sql,"s",[$username]);
}

function get_faculty_by_username($username){
    $sql = "
        SELECT
            faculty_username,
            faculty_password,
            faculty_id,
            faculty_email,
            role
        FROM Faculty_Staff
        WHERE faculty_username = ?
            AND faculty_active = 1
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
        WHERE student_id = ?
            AND student_active = 1
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
        WHERE faculty_id = ?
            AND faculty_active = 1
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
        WHERE role = (SELECT role_chair FROM Constants)
            AND faculty_active = 1
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

// returns one row of enrollment if student is enrolled
function get_enrollment_by_student_class($student_id,$class_id){
    $sql = "
        SELECT
            *
        FROM Enrollment
        WHERE student_id = ?
            AND class_id = ?
    ";
    return query_one($sql,"ss",[$student_id,$class_id]);
}

// returns class information if class exists
function get_class_by_id($id){
    $sql = "
        SELECT
            Class.*,
            Course.course_name,
            CONCAT(Major.short_name, Course.course_number) as course_title,
            CONCAT(Faculty_Staff.faculty_lastname,', ',Faculty_Staff.faculty_firstname) as instructor,
            DATE_FORMAT(Timeslot.time_,'%l:%i%p') as time,
            COUNT(Student.student_id) as students,
            credits
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

// returns how many credits the student is currently enrolled in
function get_credits_by_student($student_id){
    $sql = "
        SELECT
            SUM(credits) as credits
        FROM Enrollment
        LEFT JOIN Student
            ON Student.student_id = Enrollment.student_id
        INNER JOIN Class
            ON Class.class_id = Enrollment.class_id
        INNER JOIN Course
            ON Course.course_id = Class.course_id
        WHERE Student.student_id = ?
        GROUP BY Student.student_id;
    ";
    $row = query_one($sql,"s",[$student_id]);
    if(!$row) return 0;
    return (int)$row["credits"];
}

function get_timeslot_by_id($time_id){
    $sql = "
        SELECT * FROM Timeslot WHERE time_id = ?;
    ";
    return query_one($sql,"s",[$time_id]);
}

function get_room_by_id($room_id) {
    $sql = "
        SELECT * FROM Room WHERE room_id = ?;
    ";
    return query_one($sql,"s",[$room_id]);
}

function get_major_name_by_id($id){
	$sql = "
		SELECT major_name 
		FROM Major 
		WHERE = ?;
	";
	return query_one($sql, "s",[$id]);

}

function get_apply_info($id){
	$sql = "
	      SELECT 
		apply_id,
    		first_name,
    		last_name,
    		email,
		Apply.major_id,
    		Major.major_name as major_name,
		CONCAT(last_name, ', ',first_name) as full_name
    	      FROM Apply
		INNER JOIN Major
            		ON Major.major_id = Apply.major_id

    	      WHERE apply_id = ?;
	
	";
	 return query_one($sql, "s", [$id]);
}

function get_reset_password_by_key($key){
    $sql = "
        SELECT 
            password_key,
            student_id,
            faculty_id,
            is_student
        FROM Reset_Password
        WHERE password_key = ?
    ";
    return query_one($sql, "s", [$key]);
}

?>