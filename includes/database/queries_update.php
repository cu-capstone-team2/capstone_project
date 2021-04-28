<?php

/********************************************************************

           	******** SQL QUERIES UPDATE ********

	PURPOSE: This page contains all the SQL QUERIES to update 
			 records in the Enrollment database 

********************************************************************/

function update_student_major($student_id,$major_id){//This function update a students major 
	//main SQL code for a student to update their major in the Students table 
	$sql = "
		UPDATE Student
				SET major_id = ?
		WHERE student_id = ?
	";
	return query($sql,"ii",[$major_id, $student_id]);
}

function update_student_advisor($student_id,$faculty_id){//This function update a students advisors 
	// if advisor is changing, then delete all upcoming appointments
	delete_all_student_upcoming_appointments($student_id);

	//main SQL code for a Student to change their advisors 
	$sql = "
		UPDATE Student
		SET faculty_id = ?
		WHERE student_id = ?
	";
	return query($sql, "ii",[$faculty_id,$student_id]);
}

function update_student_info($student_id,$first_name,$last_name,$email,$classification,$major_id,$advisor_id){//This function update a students info by a admin 
	//main SQL code to update a student info by a admin
	$sql = "
		UPDATE Student SET
			student_firstname = ?,
			student_lastname = ?,
			student_username = CONCAT(LOWER(?),LOWER(?),?),
			student_email = ?,
			classification = ?,
			major_id = ?,
			faculty_id = ?
		WHERE student_id = ?
	";
	return query($sql,"sssssssiii",[$first_name,$last_name,$first_name,$last_name,$student_id,$email,$classification,$major_id,$advisor_id,$student_id]);
}

function update_student_password($student_id, $password){//This function updates a student password after it is hashed 
	//main SQL code to update students password 
	$sql = "
		UPDATE Student SET
		student_password = ?
		WHERE student_id = ?
	";
	return query($sql, "ss", [$password, $student_id]);
}

function update_faculty_password($faculty_id, $password){//This function updates a faculty password after it is hashed 
	//main SQL code to update a faculty's password
	$sql = "
		UPDATE Faculty_Staff SET
		faculty_password = ?
		WHERE faculty_id = ?
	";
	return query($sql, "ss", [$password, $faculty_id]);
}


function update_student_active($student_id, $active){//This function update a students account condition as active or deactivated
	// if deactivating a student a parameter must be brought in 
	// before deactivating, unenroll student from all classes, and cancel appointments
	if($active === 0){
		delete_all_student_enrollments($student_id);
		delete_all_student_upcoming_appointments($student_id);
	}
	//main SQL updates active status for a student 
	$sql = "
		UPDATE Student SET
		student_active = ?
		WHERE student_id = ?
	";
	return query($sql,"is",[$active, $student_id]);
}


/* How many classes they teach? */
function classes_instructor_teaches($faculty_id){//This function counts the number of classes a instructor teaches 
	//main SQL code to count the number of classes that a instructor teaches 
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
function students_instructor_advises($faculty_id){//This function return the count of students that a instructors advises 
	//main SQL code to count the # of students that a instructor advises 
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
function can_faculty_be_deactivated($faculty_id){//This function checks if faculty account can be deactivated before deactivating
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

function update_faculty_active($faculty_id, $active){//This function update a faculty account status after it been check for any active events

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

function update_class_details($class_id, $attrs){//This function updates class detail
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

function update_course_details($course_id, $course_name, $credits, $course_number, $major_id){//This function updates a course details 
	$sql = "
		UPDATE Course SET
		course_name = ?,
    	credits = ?,
    	course_number = ?,
    	major_id = ?
    	WHERE course_id = ?;
	";
	return query($sql, "siiii", [$course_name, $credits, $course_number, $major_id, $course_id]);
}

function update_faculty_details($faculty_id, $first_name, $last_name, $email, $phone, $role){//This function updates faculty info 
	$sql = "
		UPDATE Faculty_Staff SET
		faculty_firstname = ?,
		faculty_lastname = ?,
		faculty_username = CONCAT(LOWER(?),LOWER(?),?),
		faculty_email = ?,
		faculty_phone = ?,
		role = ?
		WHERE faculty_id = ?
	";
	return query($sql, "sssssssss", [$first_name, $last_name, $first_name, $last_name, $faculty_id, $email, $phone, $role, $faculty_id]);
}

function update_appointments_finished($instructor_id){//This function update an appointment when the appointment is finished by faculty
	$sql = "
	UPDATE Appointment
	SET is_finished = 1
	WHERE faculty_id = ?
		AND DATEDIFF(appointment_date, now()) < 0
	";
	return query($sql,"s",[$instructor_id]);
}

function update_appointments_by_student_finished($faculty_id, $appointment_id){//This function update an appointment when the appointment is finished by student
$sql = "
	UPDATE Appointment
	SET is_finished = 1
	WHERE faculty_id = ?
		AND appointment_id = ?
";
return query($sql,"ss",[$faculty_id, $appointment_id]);
}

function update_appointment($appointment_id,$date,$time_id,$comments){//This function allow a appointment to be updated 
	$sql = "
		UPDATE Appointment
		SET appointment_date = ?,
		comments = ?,
		time_id = ?
		WHERE appointment_id = ?
	";
	return query($sql,"ssss",[$date, $comments, $time_id, $appointment_id]);
}

function close_request($apply_id){//This function closes a apply request when request is completed
	$sql = "
		UPDATE Apply
		Set is_Completed = 1
		WHERE apply_id = ?;
	";
	return query($sql, "s",[$apply_id]);
}

function close_contact($id){//This function update a contact request when completed 
	$sql = "
		UPDATE Contact
		Set is_Contacted = 1
		WHERE ID = ?;
	";
	return query($sql, "s",[$id]);
}
?>