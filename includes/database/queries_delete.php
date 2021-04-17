<?php

function delete_enrollment($student_id, $class_id){
    $sql = "
        DELETE FROM Enrollment
        WHERE student_id = ?
            AND class_id = ?
    ";
    return query($sql, "ii", [$student_id, $class_id]);
}

function delete_all_student_upcoming_appointments($student_id){
    $sql = "
        DELETE FROM Appointment
        WHERE is_finished = 0
            AND student_id = ?
    ";
    return query($sql, "i", [$student_id]);
}

function delete_all_instructor_upcoming_appointments($faculty_id){
    $sql = "
        DELETE FROM Appointment
        WHERE is_finished = 0
            AND faculty_id = ?
    ";
    return query($sql, "i", [$faculty_id]);
}

function delete_all_student_enrollments($student_id){
    $sql = "
        DELETE FROM Enrollment
        WHERE student_id = ?
    ";
    return query($sql, "i", [$student_id]);
}

function delete_class($class_id){
    $sql = "
        DELETE FROM Class 
        WHERE class_id = ?
    ";
    return query($sql, "i", [$class_id]);
}

function can_course_be_deleted($course_id){
	$sql = "
		SELECT COUNT(Class.class_id) as classes
		FROM Course
		LEFT JOIN Class
			ON Class.course_id = Course.course_id
		WHERE Course.course_id = ?
	";
	$row = query_one($sql,"s",[$course_id]);
	if(!$row) return true;
	return (int)$row["classes"] === 0;
}

function delete_course($course_id){
	$sql = "
		DELETE FROM Course
		WHERE course_id = ?
	";
	return query($sql,"i",[$course_id]);
}

function delete_appointment($faculty_id, $appointment_id){
    $sql = "
        DELETE FROM Appointment
        WHERE faculty_id = ?
            AND appointment_id = ?
    ";
    return query($sql,"ii",[$faculty_id, $appointment_id]);
}

function delete_appointments_students_upcoming($student_id){
	$sql = "
		DELETE FROM Appointment
		WHERE is_finished = 0
			AND student_id = ?
	";
	return query($sql,"s",[$student_id]);
}

function delete_appointments_faculty_upcoming($faculty_id){
	$sql = "
		DELETE FROM Appointment
		WHERE is_finished = 0
			AND faculty_id = ?
	";
	return query($sql,"s",[$faculty_id]);
}

function delete_all_appointments_by_student($student_id){
	$sql = "
		DELETE FROM Appointment
		WHERE student_id = ?
	";
	return query($sql,"s",[$student_id]);
}

function delete_all_appointments_by_faculty($faculty_id){
	$sql = "
		DELETE FROM Appointment
		WHERE faculty_id = ?
	";
	return query($sql,"s",[$faculty_id]);
}

function delete_request($id){
	$sql = "
		DELETE FROM Apply 
		WHERE apply_id = ?;	
	";
	return query($sql, "i", [$id]);
}

function delete_password_reset($id, $is_student){
    $sql = "
        DELETE FROM Reset_Password
        WHERE
    ";
    if($is_student){
        $sql.= " is_student = 1 AND student_id = ?";
    } else{
        $sql.= " is_student = 0 AND faculty_id = ?";
    }
    return query($sql,"s",[$id]);
}

function delete_contact($id){
	$sql = "
		DELETE FROM Contact
		WHERE ID = ?;
	";
	
	return query($sql, "i", [$id]);
}

function can_major_be_deleted($major_id){
	return get_major_students($major_id) === 0
			&& get_major_courses($major_id) === 0
			&& get_major_classes($major_id) === 0;
}

function delete_major($major_id){
	$sql = "
		DELETE FROM Major
		WHERE major_id = ?
	";
	return query($sql,"s",[$major_id]);
}

function delete_applies_by_major($major_id){
	$sql = "
		DELETE FROM Apply
		WHERE major_id = ?
	";
	return query($sql,"s",[$major_id]);
}

function delete_student($student_id){
	$sql = "
		DELETE FROM Student
		WHERE student_id = ?
	";
	return query($sql,"s",[$student_id]);
}

function delete_faculty($faculty_id){
	$sql = "
		DELETE FROM Faculty_Staff
		WHERE faculty_id = ?
	";
	return query($sql,"s",[$faculty_id]);
}

?>