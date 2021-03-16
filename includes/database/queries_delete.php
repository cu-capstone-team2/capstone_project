<?php

function delete_enrollment($student_id, $class_id){
    $sql = "
        DELETE FROM Enrollment
        WHERE student_id = ?
            AND class_id = ?
    ";
    return query($sql, "ii", [$student_id, $class_id]);
}
function delete_class($class_id){
    $sql = "
        DELETE FROM Class 
        WHERE class_id = ?
    ";
    return query($sql, "i", [$class_id]);
}

function delete_appointment($faculty_id, $appointment_id){
    $sql = "
        DELETE FROM Appointment
        WHERE faculty_id = ?
            AND appointment_id = ?
    ";
    return query($sql,"ii",[$faculty_id, $appointment_id]);
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

?>