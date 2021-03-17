<?php

function update_student_major($student_id,$major_id){
	$sql = "
		UPDATE Student
				SET major_id = ?
		WHERE student_id = ?
	";
	return query($sql,"ii",[$major_id, $student_id]);
}

function update_student_advisor($student_id,$faculty_id){
	// if advisor is changing, then delete all upcoming appointments
	delete_all_student_upcoming_appointments($student_id);

	$sql = "
		UPDATE Student
		SET faculty_id = ?
		WHERE student_id = ?
	";
	return query($sql, "ii",[$faculty_id,$student_id]);
}

function update_student_password($student_id, $password){
	$sql = "
		UPDATE Student SET
		student_password = ?
		WHERE student_id = ?
	";
	return query($sql, "ss", [$password, $student_id]);
}

function update_faculty_password($faculty_id, $password){
	$sql = "
		UPDATE Faculty_Staff SET
		faculty_password = ?
		WHERE faculty_id = ?
	";
	return query($sql, "ss", [$password, $faculty_id]);
}


function update_student_active($student_id, $active){
	// before deactivating, unenroll student from all classes, and cancel appointments
	if($active === 0){
		delete_all_student_enrollments($student_id);
		delete_all_student_upcoming_appointments($student_id);
	}
	$sql = "
		UPDATE Student SET
		student_active = ?
		WHERE student_id = ?
	";
	return query($sql,"is",[$active, $student_id]);
}


/* How many classes they teach? */
function classes_instructor_teaches($faculty_id){
	$sql = "
		SELECT COUNT(*) as cnt
		FROM Class
		WHERE faculty_id = ?
	";
	$row = query_one($sql,"s",[$faculty_id]);
	if(!$row) return 0;
	return (int)$row["cnt"];
}

/* How many students they advise? */
function students_instructor_advises($faculty_id){
	$sql = "
		SELECT COUNT(*) as cnt
		FROM Student
		WHERE faculty_id = ?
	";
	$row = query_one($sql,"s",[$faculty_id]);
	if(!$row) return 0;
	return (int)$row["cnt"];
}

/* CAN THE Faculty member be deactivated? */
function can_faculty_be_deactivated($faculty_id){
	$faculty = get_faculty_by_id($faculty_id);
	if(!$faculty)
		return false;
	if($faculty["role"] != INSTRUCTOR)
		return true;

	if(classes_instructor_teaches($faculty_id) !== 0 ||
		 students_instructor_advises($faculty_id) !== 0){
			 return false;
		 }
		
	return true;
}

function update_faculty_active($faculty_id, $active){

	if($active === 0){
		if(!can_faculty_be_deactivated($faculty_id))
			return false;
		delete_all_instructor_upcoming_appointments($faculty_id);
	}
	$sql = "
		UPDATE Faculty_Staff SET
		faculty_active = ?
		WHERE faculty_id = ?
	";
	return query($sql,"is",[$active, $faculty_id]);
}

function update_class_details($class_id, $attrs){
	$sql = "
		UPDATE Class SET
		days = ?,
		time_id =?,
		minutes = ?,
		room_id = ?,
		faculty_id = ?
		WHERE class_id = ?
	";
	return query($sql, "siiiis", [$attrs[0],$attrs[1],$attrs[2],$attrs[3],$attrs[4], $class_id]);
}

function update_appointments_finished($instructor_id){
	$sql = "
	UPDATE Appointment
	SET is_finished = 1
	WHERE faculty_id = ?
		AND DATEDIFF(appointment_date, now()) < 0
	";
	return query($sql,"s",[$instructor_id]);
}

function update_appointments_by_student_finished($faculty_id, $appointment_id){
$sql = "
	UPDATE Appointment
	SET is_finished = 1
	WHERE faculty_id = ?
		AND appointment_id = ?
";
return query($sql,"ss",[$faculty_id, $appointment_id]);
}
?>