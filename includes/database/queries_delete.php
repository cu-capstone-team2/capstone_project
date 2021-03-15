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

function delete_request($id){
	$sql = "
		DELETE FROM Apply 
		WHERE apply_id = ?;	
	";


	return query($sql, "i", [$id]);
}
?>