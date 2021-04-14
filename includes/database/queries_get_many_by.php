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
            AND student_active = 1
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
            AND student_active = 1
        ORDER BY student_lastname, student_firstname;
    ";

    return query_many($sql, "s", [$class_id]);
}

function get_courses_by_course_number($major_id, $course_number, $course_id = -1){
	$sql = "
		SELECT
			CONCAT(short_name, course_number) as course_title,
			course_name
		FROM Course
		INNER JOIN Major
			ON Major.major_id = Course.major_id
		WHERE Major.major_id = ?
			AND course_number = ?
			AND course_id != ?
		;
	";
	return query_many($sql, "sss",[$major_id, $course_number, $course_id]);
}

function student_already_enrolled($student_id,$course_id){
	$sql = "
		SELECT Enrollment.*
		FROM Enrollment
		INNER JOIN Student
			ON Student.student_id = Enrollment.student_id
		INNER JOIN Class
			ON Class.class_id = Enrollment.class_id
		INNER JOIN Course
			ON Course.course_id = Class.course_id
		WHERE Course.course_id = ?
			AND Student.student_id = ?
	";
	$course = query_one($sql,"ss",[$course_id,$student_id]);
	return !!$course;
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
    if(!$row) return "ERROR";
	return $row["students"];
}

function get_classes_by_student($student_id){
    $sql = "
        SELECT
            Enrollment.class_id,
            Course.course_name,
	    Course.course_id,
            CONCAT(Major.short_name, Course.course_number) as course_title,
            CONCAT(Faculty_Staff.faculty_lastname,', ',Faculty_Staff.faculty_firstname) as instructor,
            CONCAT(Faculty_Staff.faculty_lastname,', ',SUBSTR(Faculty_Staff.faculty_firstname,1,1)) as instructor_short,	   
	        CONCAT(DATE_FORMAT(time_,'%l:%i-'), DATE_FORMAT(DATE_ADD(ADDTIME(TIMESTAMP(CURRENT_DATE),time_), INTERVAL minutes minute),'%l:%i%p')) as time,
            days,
            credits,
            CONCAT(building, ' ', room_number) as room,
            room_number,
            building
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
        INNER JOIN Room
            ON Room.room_id = Class.room_id
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
	        CONCAT(DATE_FORMAT(time_,'%l:%i-'), DATE_FORMAT(DATE_ADD(ADDTIME(TIMESTAMP(CURRENT_DATE),time_), INTERVAL minutes minute),'%l:%i%p')) as time,
            days,
            credits,
            COUNT(Enrollment.student_id) as students,
            CONCAT(building, ' ', room_number) as room,
            room_number,
            building
        FROM Class
        INNER JOIN Course
            ON Course.course_id = Class.course_id
        INNER JOIN Major
            ON Major.major_id = Course.major_id
        INNER JOIN Timeslot
            ON Timeslot.time_id = Class.time_id
        INNER JOIN Room
            ON Room.room_id = Class.room_id
        LEFT JOIN Enrollment
            ON Enrollment.class_id = Class.class_id
        WHERE Class.faculty_id = ?
        GROUP BY Class.class_id
        ORDER BY course_title
    ";
    return query_many($sql, "s", [$instructor_id]);
}

function get_appointments_by_instructor($instructor_id, $search=[], $count = false, $pagination = null){
    $appointments = "0%";
    if(isset($search["appointments"])){
        switch($search["appointments"]){
            case "all":
                $appointments = "%";
                break;
            default:
                $appointments = $search["appointments"] . "%";
                break;
        }
    }
    $name = isset($search["name"]) && !empty($search["name"])? "%{$search["name"]}%" : "%";
    $id = isset($search["id"]) && !empty($search["id"])? $search["id"] : "%";
    $order = "appointment_date, time_";
    if(isset($search["order"]) && $search["order"] === "name"){
        $order = "full_name, appointment_date, time_";
    }

    $sql = "
        SELECT
            appointment_id,
            Student.student_id,
            student_firstname,
            student_lastname,
            CONCAT(student_lastname,', ',student_firstname) as full_name,
            DATE_FORMAT(appointment_date,'%M %e, %Y') as date,
            TIME_FORMAT(time_, '%h:%i %p') as time,
            is_finished,
            CASE
                WHEN LENGTH(comments) = 0 THEN 'No Comments'
                ELSE comments
            END as comments,
            DATEDIFF(appointment_date, now()) as days_away,
            CASE
                WHEN is_finished = 0 THEN 'Incomplete'
                ELSE 'Completed'
            END as status
        FROM Appointment
        INNER JOIN Student
            ON Student.student_id = Appointment.student_id
        INNER JOIN Timeslot
            ON Timeslot.time_id = Appointment.time_id
        WHERE Appointment.faculty_id = ?
            AND EXPORT_SET(is_finished,'1','0','',4) LIKE ?
            AND Student.student_id LIKE ?
        HAVING full_name LIKE ?
        ORDER BY {$order}
    ";
    $params = [$instructor_id, $appointments, $id, $name];
    $types = "ssss";

    if($count)
        return Pagination::get_count_query($sql,$types,$params);
    else if($pagination !== null){
        return $pagination->get_pagination_query($sql, $types, $params);
    }
    return query_many($sql,$types,$params);
}

function get_appointments_by_date($faculty_id,$date,$time_id,$appoint_id = -1){
	$sql = "
		SELECT *
		FROM Appointment
		WHERE faculty_id = ?
			AND appointment_date = ?
			AND time_id = ?
			AND NOT(appointment_id = ?)	
			AND is_finished = 0;
	";
	return query_many($sql,"ssss",[$faculty_id,$date,$time_id,$appoint_id]);
}

function get_many_class_overlap($days,$time_id,$room_id, $class_id = -1){
    $sql = "
        SELECT
            Class.class_id,
            course_name,
            CONCAT(Major.short_name, Course.course_number) as course_title,
	        CONCAT(DATE_FORMAT(time_,'%l:%i-'), DATE_FORMAT(DATE_ADD(ADDTIME(TIMESTAMP(CURRENT_DATE),time_), INTERVAL minutes minute),'%l:%i%p')) as time,
            days,
            credits,
            CONCAT(Room.building,' ',Room.room_number) as room
        FROM Class
        INNER JOIN Numbers
            ON INSTR(days, SUBSTR(?,number,1)) > 0
                AND number <= LENGTH(?)
        INNER JOIN Timeslot
            ON Timeslot.time_id = Class.time_id
        INNER JOIN Room
            ON Room.room_id = Class.room_id
        INNER JOIN Course
            ON Course.course_id = Class.course_id
        INNER JOIN Major
            ON Major.major_id = Course.major_id
        WHERE Class.time_id = ?
            AND Class.room_id = ?
            AND Class.class_id != ?
        GROUP BY class_id
    ";
    return query_many($sql, "sssss", [$days, $days, $time_id, $room_id, $class_id]);
}

function get_many_class_faculty_overlap($faculty_id, $days,$time_id, $class_id = -1){
    $sql = "
        SELECT
            Class.class_id,
            course_name,
            CONCAT(Major.short_name, Course.course_number) as course_title,
	        CONCAT(DATE_FORMAT(time_,'%l:%i-'), DATE_FORMAT(DATE_ADD(ADDTIME(TIMESTAMP(CURRENT_DATE),time_), INTERVAL minutes minute),'%l:%i%p')) as time,
            days,
            credits,
            CONCAT(Room.building,' ',Room.room_number) as room,
            CONCAT(Faculty_Staff.faculty_lastname,', ',Faculty_Staff.faculty_firstname) as instructor
        FROM Class
        INNER JOIN Room
            ON Room.room_id = Class.room_id
        INNER JOIN Numbers
            ON INSTR(days, SUBSTR(?,number,1)) > 0
                AND number <= LENGTH(?)
        INNER JOIN Timeslot
            ON Class.time_id = Timeslot.time_id
        INNER JOIN Faculty_Staff
            ON Class.faculty_id = Faculty_Staff.faculty_id
        INNER JOIN Course
            ON Course.course_id = Class.course_id
        INNER JOIN Major
            ON Major.major_id = Course.major_id
        WHERE Class.time_id = ?
            AND Class.faculty_id = ?
            AND Class.class_id != ?
        GROUP BY class_id
    ";
    return query_many($sql, "sssss", [$days, $days, $time_id, $faculty_id, $class_id]);
}

function get_many_class_student_overlap($student_id, $days, $time_id){
    $sql = "
        SELECT
            Class.class_id,
            course_name,
            CONCAT(Major.short_name, Course.course_number) as course_title,
	        CONCAT(DATE_FORMAT(time_,'%l:%i-'), DATE_FORMAT(DATE_ADD(ADDTIME(TIMESTAMP(CURRENT_DATE),time_), INTERVAL minutes minute),'%l:%i%p')) as time,
            days,
            credits,
            CONCAT(Room.building,' ',Room.room_number) as room,
            CONCAT(Faculty_Staff.faculty_lastname,', ',Faculty_Staff.faculty_firstname) as instructor
        FROM Class
        INNER JOIN Room
            ON Room.room_id = Class.room_id
        INNER JOIN Numbers
            ON INSTR(days, SUBSTR(?,number,1)) > 0
                AND number <= LENGTH(?)
        INNER JOIN Timeslot
            ON Class.time_id = Timeslot.time_id
        INNER JOIN Faculty_Staff
            ON Class.faculty_id = Faculty_Staff.faculty_id
        INNER JOIN Course
            ON Course.course_id = Class.course_id
        INNER JOIN Major
            ON Major.major_id = Course.major_id
        INNER JOIN Enrollment
            ON Enrollment.class_id = Class.class_id
        WHERE Enrollment.student_id = ?
            AND Class.time_id = ?
        GROUP BY class_id
    ";
    return query_many($sql,"ssss",[$days, $days, $student_id, $time_id]);
}

function get_majors_by_short_name($short_name){
    $sql = "
        SELECT major_name, short_name
        FROM Major
        WHERE short_name = ?
    ";
    return query_many($sql,'s',[$short_name]);
}

function get_majors_by_major_name($major_name){
    $sql = "
        SELECT major_name, short_name
        FROM Major
        WHERE major_name = ?
    ";
    return query_many($sql,'s',[$major_name]);
}