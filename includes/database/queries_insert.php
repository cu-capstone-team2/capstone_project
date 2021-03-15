<?php

    // inserts new enrollment into database
    function insert_enrollment($student_id, $class_id){
        $sql = "
            INSERT INTO Enrollment(student_id, class_id)
            VALUES (?, ?);
        ";
        return query($sql, "ii", [$student_id, $class_id]);
    }

    function insert_class($days, $minutes, $time_id, $room_id, $course_id, $faculty_id){
        $sql = "
            INSERT INTO Class(days,minutes,time_id,room_id,course_id,faculty_id)
            VALUES(?,?,?,?,?,?);
        ";
        return query($sql, "ssssss", [$days,$minutes,$time_id,$room_id,$course_id,$faculty_id]);
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
	
	  function insert_student($first_name, $last_name, $student_email, $classification, $PIN, $student_username, $student_password, $major_id, $faculty_id){
			$sql = "
				INSERT INTO Student(student_firstname, student_lastname, student_email, classification, PIN, student_username, student_password, major_id, faculty_id)
				VALUES(?,?,?,?,?,?,?,?,?);
			";
			return query($sql, "ssssissii" ,[$first_name, $last_name, $student_email, $classification, $PIN, $student_username, $student_password, $major_id, $faculty_id]);
	  }
	  
	  function insert_faculty_staff($faculty_firstname,$faculty_lastname,$faculty_email,$faculty_phone,$role,$faculty_username,$faculty_password,$faculty_active,$room_id){
			$sql = "
				INSERT INTO Faculty_Staff(faculty_firstname,faculty_lastname,faculty_email,faculty_phone,role,faculty_username,faculty_password,faculty_active,room_id)
				VALUES(?,?,?,?,?,?,?,?,?);
			";
			return query($sql, "ssssissii" , [$faculty_firstname,$faculty_lastname,$faculty_email,$faculty_phone,$role,$faculty_username,$faculty_password,$faculty_active,$room_id]);
	  }

	  function insert_apply($first_name,$last_name,$email,$major_id){
			$sql = "
				INSERT into 
				Apply(first_name,last_name,email,major_id)		
				VALUES(?,?,?,?);
			";
			return query($sql, "sssi", [$first_name,$last_name,$email,$major_id]);
	  }
?>