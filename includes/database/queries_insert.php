<?php

    // inserts new enrollment into database
    function insert_enrollment($student_id, $class_id){
        $sql = "
            INSERT INTO Enrollment(student_id, class_id)
            VALUES (?, ?);
        ";
        return query($sql, "ii", [$student_id, $class_id]);
    }

    function insert_class($class_id, $days, $minutes, $time_id, $room_id, $course_id, $faculty_id){
        $sql = "
            INSERT INTO Class(class_id,days,minutes,time_id,room_id,course_id,faculty_id)
            VALUES(?,?,?,?,?,?);
        ";
        return query($sql, "sssssss", [$class_id,$days,$minutes,$time_id,$room_id,$course_id,$faculty_id]);
    }

    function insert_course($course_name, $credits, $course_number, $major_id){
        $sql = "
            INSERT INTO Course(course_name, credits, course_number, major_id)
            VALUES(?,?,?,?);
        ";
        return query($sql, "siii", [$course_name, $credits, $course_number, $major_id]);
    }

    function insert_appointment($comments, $appointment_date, $student_id, $faculty_id, $time_id){
        $sql = "
            INSERT INTO Appointment(comments, appointment_date, student_id, faculty_id, time_id)
            VALUES(?,?,?,?,?);
        ";
        return query($sql, "ssiii", [$comments, $appointment_date, $student_id, $faculty_id, $time_id]);
    }
	
	  function insert_student($student_id, $first_name, $last_name, $student_email, $classification, $PIN, $student_username, $student_password, $student_active, $major_id, $faculty_id){
			$sql = "
				INSERT INTO Student
				VALUES(student_id,first_name,last_name,student_email,classification,PIN,student_username,student_password,student_active,major_id,faculty_id);
			";
			return query($sql, "issssissiii" ,[$student_id, $first_name, $last_name, $student_email, $classification, $PIN, $student_username, $student_password, $student_active, $major_id, $faculty_id]);
	  }
	  
	  function insert_faculty_staff($faculty_id, $faculty_firstname,$faculty_lastname,$faculty_email,$faculty_phone,$role,$faculty_username,$faculty_password,$faculty_active,$room_id){
			$sql = "
				INSERT INTO Faculty_Staff
				VALUES(faculty_id,faculty_firstname,faculty_lastname,faculty_email,faculty_phone,role,faculty_username,faculty_password,faculty_active,room_id);
			";
			return query($sql, "issssissii" , [$faculty_id, $faculty_firstname,$faculty_lastname,$faculty_email,$faculty_phone,$role,$faculty_username,$faculty_password,$faculty_active,$room_id]);
	  }
?>