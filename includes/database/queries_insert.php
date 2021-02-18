<?php
    function insert_enrollment($student_id, $class_id){
        $sql = "
            INSERT INTO Enrollment(student_id, class_id)
            VALUES (?, ?);
        ";
        return query($sql, "ii", [$student_id, $class_id]);
    }

?>