<?php

function delete_enrollment($student_id, $class_id){
    $sql = "
        DELETE FROM Enrollment
        WHERE student_id = ?
            AND class_id = ?
    ";
    return query($sql, "ii", [$student_id, $class_id]);
}

?>