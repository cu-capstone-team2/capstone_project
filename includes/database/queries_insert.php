<?php

/***********************************************************************

			******** SQL QUERIES INSERT PAGE ********
			PURPOSE: This page contains the queries that inserts data
					 into a table in the database. 

***********************************************************************/


    // inserts new enrollment into database
    function insert_enrollment($student_id, $class_id){//This function will insert add a class for a student to be enrolled for a semester 
        $sql = "
            INSERT INTO Enrollment(student_id, class_id)
            VALUES (?, ?);
        ";
        return query($sql, "ii", [$student_id, $class_id]);
    }

    function insert_class($days, $minutes, $time_id, $room_id, $course_id, $faculty_id){//This function will insert a new class with the days and times of the class
        $sql = "
            INSERT INTO Class(days,minutes,time_id,room_id,course_id,faculty_id)
            VALUES(?,?,?,?,?,?);
        ";
        return query($sql, "ssssss", [$days,$minutes,$time_id,$room_id,$course_id,$faculty_id]);
    }

    function insert_course($course_name, $credits, $course_number, $major_id){//This function will insert a new course to become a class later 
        $sql = "
            INSERT INTO Course(course_name, credits, course_number, major_id)
            VALUES(?,?,?,?);
        ";
        return query($sql, "siii", [$course_name, $credits, $course_number, $major_id]);
    }

    function insert_appointment($comments, $appointment_date, $student_id, $faculty_id, $time_id){//This function will insert a new appointment for the student and the advisor
        $sql = "
            INSERT INTO Appointment(comments, appointment_date, student_id, faculty_id, time_id)
            VALUES(?,?,?,?,?);
        ";
        return query($sql, "ssiii", [$comments, $appointment_date, $student_id, $faculty_id, $time_id]);
    }

	function insert_student($first_name, $last_name, $student_email, $classification, $PIN, $student_username, $student_password, $major_id, $faculty_id){//This Function will insert a student into the enrollment database
			$sql = "
				INSERT INTO Student(student_firstname, student_lastname, student_email, classification, PIN, student_username, student_password, major_id, faculty_id)
				VALUES(?,?,?,?,?,?,?,?,?);
			";
			return query($sql, "ssssissii" ,[$first_name, $last_name, $student_email, $classification, $PIN, $student_username, $student_password, $major_id, $faculty_id]);
	  }

	function insert_faculty_staff($faculty_firstname,$faculty_lastname,$faculty_email,$faculty_phone,$role,$faculty_username,$faculty_password,$faculty_active,$room_id){//This function will insert a faculty memeber to the enrollment database
			$sql = "
				INSERT INTO Faculty_Staff(faculty_firstname,faculty_lastname,faculty_email,faculty_phone,role,faculty_username,faculty_password,faculty_active,room_id)
				VALUES(?,?,?,?,?,?,?,?,?);
			";
			return query($sql, "ssssissii" , [$faculty_firstname,$faculty_lastname,$faculty_email,$faculty_phone,$role,$faculty_username,$faculty_password,$faculty_active,$room_id]);
	  }

	function insert_apply($first_name,$last_name,$email,$major_id){//This function will insert a apply request into the system to be add has a new student 
			$sql = "
				INSERT into
				Apply(first_name,last_name,email,major_id,date_requested)
				VALUES(?,?,?,?,CURDATE());
			";
			return query($sql, "sssi", [$first_name,$last_name,$email,$major_id]);
	  }

      function insert_reset_password($key, $id, $is_student){//This function will insert a reset password and new password when a password needs to be reset 
        // delete all other password keys if they exist
        delete_password_reset($id, $is_student);
        $sql;
        if($is_student){
        $sql = "
            INSERT INTO Reset_Password(password_key, student_id, is_student)
            VALUES(?,?,1);
        ";
        } else{
            $sql = "
            INSERT INTO Reset_Password(password_key, faculty_id, is_student)
            VALUES(?,?,0);
            ";
        }
        return query($sql, "si", [$key, $id]);
      }

    function insert_contact($first_name, $last_name, $email, $message){//This function will insert contact attempt into the database 
        $sql = "
          INSERT INTO Contact (first_name, last_name, email, message,date_request)
          VALUES(?,?,?,?,CURDATE());
        ";
        return query($sql, "ssss", [$first_name, $last_name, $email, $message]);
    }
	
	function insert_major($major_name, $short_name){//This function will insert a new major into the major table
		$sql = "
			INSERT INTO Major(major_name, short_name)
			VALUES (?, ?);
		";
		return query($sql,"ss",[$major_name, $short_name]);
	}
?>