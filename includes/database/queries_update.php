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
	$sql = "
		UPDATE Student
		SET faculty_id = ?
		WHERE student_id = ?
	";
	return query($sql, "ii",[$faculty_id,$student_id]);
  
   }

?>