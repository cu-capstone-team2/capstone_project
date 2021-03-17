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
            CONCAT(Major.short_name, Course.course_number) as course_title,
            CONCAT(Faculty_Staff.faculty_lastname,', ',Faculty_Staff.faculty_firstname) as instructor,
            DATE_FORMAT(Timeslot.time_,'%l:%i%p') as time,
            days,
            credits
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
            DATE_FORMAT(Timeslot.time_,'%l:%i%p') as time,
            days,
            credits,
            COUNT(Enrollment.student_id) as students
        FROM Class
        INNER JOIN Course
            ON Course.course_id = Class.course_id
        INNER JOIN Major
            ON Major.major_id = Course.major_id
        INNER JOIN Timeslot
            ON Timeslot.time_id = Class.time_id
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


?>
