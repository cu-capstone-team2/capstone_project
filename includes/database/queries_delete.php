<?php
/*****************************************************************************

		************SQL QUERIES DELETE PAGE**************
																			 
																			 
	Purpose: This File has the function that contains the SQL code           
			 that delete records from the MYSQL database 					 
																			 
																			 
******************************************************************************/


function delete_enrollment($student_id, $class_id){//This function delete a students enrollment from the enrollment table
   //main SQL code to delete enrollment record
	$sql = "
        DELETE FROM Enrollment
        WHERE student_id = ?
            AND class_id = ?
    ";
    return query($sql, "ii", [$student_id, $class_id]);
}

function delete_all_student_upcoming_appointments($student_id){//This function deletes a students upcoming appointments with advisor from the appointment table
    //main SQL code to delete upcoming student's appointment
	$sql = "
        DELETE FROM Appointment
        WHERE is_finished = 0
            AND student_id = ?
    ";
    return query($sql, "i", [$student_id]);
}

function delete_all_instructor_upcoming_appointments($faculty_id){//This function delete a instuctors that are advisors upcoming appointment from the appointment table
    //main SQL code to delete instructors/advisors upcoming appointment
	$sql = "
        DELETE FROM Appointment
        WHERE is_finished = 0
            AND faculty_id = ?
    ";
    return query($sql, "i", [$faculty_id]);
}

function delete_all_student_enrollments($student_id){//This function deletes any enrollments from a students from the enrollment table
    //main SQL code to delete all of a students enrollments
	$sql = "
        DELETE FROM Enrollment
        WHERE student_id = ?
    ";
    return query($sql, "i", [$student_id]);
}

function delete_class($class_id){//This function deletes a class with the id from the class table
	//main SQL to delete a class from the Class table
   $sql = "
        DELETE FROM Class
        WHERE class_id = ?
    ";
    return query($sql, "i", [$class_id]);
}

function can_course_be_deleted($course_id){//This function checks if a course, but makes sure that there are no courses as current class before delete
	//main SQL code to delete a course if it is empty
	$sql = "
		SELECT COUNT(Class.class_id) as classes
		FROM Course
		LEFT JOIN Class
			ON Class.course_id = Course.course_id
		WHERE Course.course_id = ?
	";
	$row = query_one($sql,"s",[$course_id]);
	if(!$row) return true;
	return (int)$row["classes"] === 0;//check if the count of class is 0 before deleteing
}

function delete_course($course_id){//This function deletes the course after the function above ^ "function can_course_be_deleted" return true
 	//main SQL to delete a course from the Course Table in the database
	$sql = "
		DELETE FROM Course
		WHERE course_id = ?
	";
	return query($sql,"i",[$course_id]);
}

function delete_appointment($faculty_id, $appointment_id){//This function deletes appointments from faculty id and the appointment id
		//main SQL code to delete an appointment from the Appointment table
    $sql = "
        DELETE FROM Appointment
        WHERE faculty_id = ?
            AND appointment_id = ?
    ";
    return query($sql,"ii",[$faculty_id, $appointment_id]);
}

function delete_appointments_students_upcoming($student_id){//This function deletes appointments that are not completed and is selected by a student id
	//main SQL code to delete a appointment that is not completed and by a student id 
	$sql = "
		DELETE FROM Appointment
		WHERE is_finished = 0
			AND student_id = ?
	";
	return query($sql,"s",[$student_id]);
}

function delete_appointments_faculty_upcoming($faculty_id){//This function deletes appointment that are not completed and is selected by a faculty_id
	//main SQL code to delete a appointment that is not completed and by a faculty id
	$sql = "
		DELETE FROM Appointment
		WHERE is_finished = 0
			AND faculty_id = ?
	";
	return query($sql,"s",[$faculty_id]);
}

function delete_all_appointments_by_student($student_id){//This function deletes all appointments for a student
	//main SQL code to delete all of a students appointment 
	$sql = "
		DELETE FROM Appointment
		WHERE student_id = ?
	";
	return query($sql,"s",[$student_id]);
}

function delete_all_appointments_by_faculty($faculty_id){//This function deletes all appointment for a faculty
	//main SQL code to delete all of a faculty appointment 
	$sql = "
		DELETE FROM Appointment
		WHERE faculty_id = ?
	";
	return query($sql,"s",[$faculty_id]);
}

function delete_request($id){//This function deletes a request to Apply for to enter into the system to enroll for classes
	//main SQL code deletes a apply request from the Apply Table
	$sql = "
		DELETE FROM Apply
		WHERE apply_id = ?;
	";
	return query($sql, "i", [$id]);
}

function delete_password_reset($id, $is_student){//This function deletes P@$$W0RD/"PASSWORD" RESET request 
    //main SQL code to delete reset password request from the Reset Table 
	$sql = "
        DELETE FROM Reset_Password
        WHERE
    ";
    if($is_student){//checks if it is being used by a student or a faculty member 
        $sql.= " is_student = 1 AND student_id = ?";
    } else{
        $sql.= " is_student = 0 AND faculty_id = ?";
    }
    return query($sql,"s",[$id]);
}

function delete_contact($id){//This function deletes a Contact Us request 
	//main SQL code to delete a Contact from the Contact table 
	$sql = "
		DELETE FROM Contact
		WHERE ID = ?;
	";

	return query($sql, "i", [$id]);
}

function can_major_be_deleted($major_id){//This function checks if a major can be deleted by checking if has no classes and course under it 
	return get_major_students($major_id) === 0
			&& get_major_courses($major_id) === 0
			&& get_major_classes($major_id) === 0;//returns if majors empty of all students, classes and course
}

function delete_major($major_id){//This function from above ^ "function can_major_be_deleted" after returns then deletes in the feature page 
	//main SQL deletes a Major from the Major table
	$sql = "
		DELETE FROM Major
		WHERE major_id = ?
	";
	return query($sql,"s",[$major_id]);
}

function delete_applies_by_major($major_id){//This function deletes applies request from a major_id
	//main SQL code that deletes a applies request with the use of major 
	$sql = "
		DELETE FROM Apply
		WHERE major_id = ?
	";
	return query($sql,"s",[$major_id]);
}

function delete_student($student_id){//This function deletes a student from the entire system 
	//main SQL code to delete student from the Student table after the students unenrolled from all classes and is deactivated 
	$sql = "
		DELETE FROM Student
		WHERE student_id = ?
	";
	return query($sql,"s",[$student_id]);
}

function delete_faculty($faculty_id){//This function delets a faculty from the entire systeam
	//main SQL code to delete from the Faculty_Staff Table after is cleared from all classes,have no appointment, and account is deactivated 
	$sql = "
		DELETE FROM Faculty_Staff
		WHERE faculty_id = ?
	";
	return query($sql,"s",[$faculty_id]);
}

?>