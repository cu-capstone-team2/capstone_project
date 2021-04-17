<?php check_user([INSTRUCTOR]) ?>

<?php
	
    // $student_id = isset($_get["student_id"])? $_get["student_id"] : "";
    // $student = get_student_by_id($student_id);

    $times = get_all_appointment_timeslots();

    // if(!$student){
		// change_page("user.php?feature=list_advisees");
    // }

	$students = get_students_by_advisor($user["faculty_id"]);
	
    function validate_new_appointment($input){
	global $user;
        $errors = [];
		
		if(!isset($input['student_id']) || empty($input['student_id'])){
			$errors['student_id'] = "Student is required";
		}
	    if(!isset($input['time_id']) || empty($input["time_id"])){
            $errors['time_id'] = "Time is incorrect";
        }

        if(!isset($input['appointment_date']) || empty($input["appointment_date"])){
            $errors['appointment_date'] = "Date is Required";
        }else if(strtotime($input['appointment_date']) < strtotime('today midnight')){
            $errors['appointment_date'] = "Dates before today are invalid";
        } else if(isset($input['time_id']) && count(get_appointments_by_date($user['faculty_id'],$input['appointment_date'],$input['time_id'])) > 0){
		$errors['time_conflict'] = "There is already an appointment at this date and time.";
	}

        if(!isset($input['comments'])){
            $errors['comments'] = "Comments Invalid";
        }else if(strlen($input["comments"]) > 255){
            $errors['comments'] = "Comment must be under 255 characters";
        }

	

        return $errors;
    }

    $errors = [];
    $input = [];

    if(isset($_POST["submit_new_appointment"])){
        $errors = validate_new_appointment($_POST);
        $input = clean_array($_POST);
        if(empty($errors)){
            insert_appointment($_POST["comments"], $_POST["appointment_date"], $_POST["student_id"], $user["faculty_id"], $_POST["time_id"]);

            echo "<h3 style='color:green'>Appointment Added!</h3>";
	$input = [];
        }
    }

?>



<h1>Add Appointment</h1>
<hr>



<form method="post" class="form">

	<div class="form-group">
		<label>Advisee</label>
        <select <?= error_outline($errors, "student_id") ?> name="student_id" required>
            <option disabled hidden selected></option>
            <?php foreach($students as $student): ?>
                <option <?= check_select($input,"student_id",$student["student_id"]) ?> value="<?=$student['student_id']?>">
                    <?=$student["full_name"]?>
                </option>
            <?php endforeach; ?>
        </select>    
        <?=show_error($errors, "student_id")?>
	</div>

	<?= show_error($errors,"time_conflict") ?>
    <div class="form-group">
        <label>Date</label>
        <input value="<?= show_value($input,"appointment_date") ?>" <?= error_outline($errors, "appointment_date") ?> type="date" name="appointment_date" required>
        <?=show_error($errors, "appointment_date")?>
    </div>
	
    <div class="form-group">
        <label>Time</label>
        <select <?= error_outline($errors, "time_id") ?> name="time_id" required>
            <option disabled hidden selected></option>
            <?php foreach($times as $time): ?>
                <option <?= check_select($input,"time_id",$time["time_id"]) ?> value="<?=$time['time_id']?>">
                    <?=$time["time"]?>
                </option>
            <?php endforeach; ?>
        </select>    
        <?=show_error($errors, "time_id")?>
    </div>

    <div class="form-group">
        <label>Comments (Max:255)</label>
        <textarea <?= error_outline($errors,"comments") ?> id="comments" name="comments"><?= show_value($input,"comments") ?></textarea>
        <p>Character Count: <span id="char-count">0</span></p>
        <?=show_error($errors, "comments")?>
    </div>


    <input type="submit" name="submit_new_appointment" >
</form>

<script>
const charCount = document.querySelector('#char-count');
const comments = document.querySelector('#comments');

const updateCharCount = (e) => {
    if(comments.value.length > 255){
        comments.value = comments.value.substring(0,255);
    }
    charCount.innerHTML = comments.value.length;
}

updateCharCount();
comments.oninput = updateCharCount;


</script>
