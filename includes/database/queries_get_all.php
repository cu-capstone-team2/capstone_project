<?php

function get_all_students($search){

    // initialize names and id, in case they were entered by user
    $name = "%";
    $name.= isset($search["name"])? $search["name"] : "";
    $name.= "%";
    $id = isset($search["id"])? $search["id"] : "";
    $id.= "%";
    
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
            Major.short_name,
            CONCAT(faculty_lastname,', ',faculty_firstname) as advisor
        FROM Student
        INNER JOIN Major
            ON Major.major_id = Student.major_id
        INNER JOIN Faculty_Staff
            ON Faculty_Staff.faculty_id = Student.faculty_id"
    ;
    $sql.= "
        WHERE CAST(student_id AS CHAR) LIKE ?
    ";
    if(isset($search["major"])){
        if($search["major"] === "it"){
            $sql.= "
                AND short_name LIKE 'IT'            
            ";
        } else if($search["major"] === "cs"){
            $sql.= "
                AND short_name LIKE 'CS'
            ";
        }
    }
    $sql.= "
        HAVING full_name LIKE ?
    ";
    $orderby = "";
    if(isset($search["order"])){
        switch($search["order"]){
            case "name":
                $orderby = "ORDER BY full_name, student_id, short_name";
                break;
            case "major":
                $orderby = "ORDER BY short_name, full_name, student_id";
                break;
            case "id":
                $orderby = "ORDER BY student_id, full_name, short_name";
                break;
        }
    }
    $sql.= "
        {$orderby}
    ";
    return query_many($sql,"ss",[$id, $name]);
}

function get_all_faculty(){
    $sql = "
        SELECT
            faculty_id,
            faculty_firstname,
            faculty_lastname,
            CONCAT(faculty_lastname,', ',faculty_firstname) as full_name,
            faculty_email,
            faculty_phone,
            faculty_username,
            faculty_password,
            faculty_active,
            CONCAT(Room.building,' ',Room.room_number) as room,
            CASE
                WHEN role = (SELECT role_instructor FROM Constants) THEN 'Instructor'
                WHEN role = (SELECT role_secretary FROM Constants) THEN 'Secretary'
                WHEN role = (SELECT role_admin FROM Constants) THEN 'Admin'
                WHEN role = (SELECT role_chair FROM Constants) THEN 'Chair'
                ELSE 'INVALID'
            END as role
        FROM Faculty_Staff
        INNER JOIN Room
            ON Room.room_id = Faculty_Staff.room_id
        ORDER BY role, faculty_lastname, faculty_firstname;
    ";
    return query_many_np($sql);  
}

function get_all_advisors(){
    $sql = "
        SELECT
            Faculty_Staff.faculty_id,
            faculty_firstname,
            faculty_lastname,
            CONCAT(faculty_lastname,', ',faculty_firstname) as full_name,
            faculty_email,
            faculty_phone,
            faculty_username,
            faculty_password,
            faculty_active,
            CONCAT(Room.building,' ',Room.room_number) as room,
            COUNT(Student.student_id) as students
        FROM Faculty_Staff
        INNER JOIN Room
            ON Room.room_id = Faculty_Staff.room_id
        LEFT JOIN Student
            ON Student.faculty_id = Faculty_Staff.faculty_id
        WHERE role = (SELECT role_instructor FROM Constants)
        GROUP BY Faculty_Staff.faculty_id
        ORDER BY faculty_lastname, faculty_firstname;
    ";
    return query_many_np($sql);
}

function get_all_classes(){
    $sql = "
        SELECT
            Class.class_id,
            Course.course_name,
            CONCAT(Major.short_name, Course.course_number) as course_title,
            CONCAT(Faculty_Staff.faculty_lastname,', ',Faculty_Staff.faculty_firstname) as instructor,
            DATE_FORMAT(Timeslot.time_,'%l:%i%p') as time,
            days,
            credits,
            COUNT(Student.student_id) as students
        FROM Class
        INNER JOIN Course
            ON Course.course_id = Class.course_id
        INNER JOIN Faculty_Staff
            ON Faculty_Staff.faculty_id = Class.faculty_id
        INNER JOIN Timeslot
            ON Timeslot.time_id = Class.time_id
        INNER JOIN Major
            ON Major.major_id = Course.major_id
        LEFT JOIN Enrollment
            ON Enrollment.class_id = Class.class_id
        LEFT JOIN Student
            ON Student.student_id = Enrollment.student_id
        GROUP BY Class.class_id
        ORDER BY Major.short_name, Course.course_number
    ";
    return query_many_np($sql);
}

function get_all_courses(){
    $sql = "
        SELECT
            course_id,
            course_name,
            credits,
            CONCAT(Major.short_name,' ',course_number) as title
        FROM Course
        INNER JOIN Major
            ON Major.major_id = Course.major_id
        ORDER BY title    
    ";
    
    return query_many_np($sql);
}

function get_all_constants(){
    $sql = "
        SELECT
            *
        FROM Constants;
    ";
    return query_one_np($sql);
}

function get_all_majors(){
    $sql = "
        SELECT
            major_id,
            major_name,
            short_name
        FROM Major
        ORDER BY short_name;
    ";
    return query_many_np($sql);
}

function get_all_timeslots(){
    $sql = "
        SELECT
			time_id,
			time_type,
			DATE_FORMAT(time_,'%h:%i %p') as time
        FROM Timeslot;
    ";
    return query_many_np($sql);
}

function get_all_appointment_timeslots(){
	$sql = "
		SELECT
			time_id,
			time_type,
			DATE_FORMAT(time_,'%h:%i %p') as time
		FROM Timeslot
		WHERE time_type = (SELECT time_appointment FROM Constants);
	";
	return query_many_np($sql);
}

?>