
<?php check_user([INSTRUCTOR]) ?>

<?php

	$appointment_id = isset($_GET["appoint"])? $_GET["appoint"] : "";
	$appointment = get_appointment_by_id($appointment_id);
	if(!$appointment){
		change_page('user.php');
    }   
    /* Validates input form data, and returns errors if any.
		Validations:
		Are all fields complete?
		Are input lengths respected?
		Are there any time conflicts?
		
	*/
    function validate_new_appointment($input){
	global $user, $appointment_id;
            $errors = [];
            if(!isset($input['time_id']) || empty($input["time_id"])){
                $errors['time_id'] = "Time is incorrect";
            }
    
            if(!isset($input['appointment_date']) || empty($input["appointment_date"])){
                $errors['appointment_date'] = "Date is Required";
            }else if(strtotime($input['appointment_date']) < strtotime('today midnight')){
                $errors['appointment_date'] = "Dates before today are invalid";
            } else if(isset($input['time_id']) && count(get_appointments_by_date($user['faculty_id'],$input['appointment_date'],$input['time_id'],$appointment_id)) > 0){
		$errors['time_conflict'] = "There's are already an appointment at this time.";
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

    /*
		If no errors are detected, the appointment is submitted.
    */
    if(isset($_POST["submit_new_appointment"])){
        $errors = validate_new_appointment($_POST);
        $input = clean_array($_POST);
        if(empty($errors)){
            update_appointment($appointment_id, $_POST["appointment_date"], $_POST["time_id"], $_POST["comments"]);
            $appointment = get_appointment_by_id($appointment_id);
            echo "<h3 style='color:green'>Appointment Updated</h3>";
        }
        $input = clean_array($_POST);
    }

?>

<h1>Edit Appointment</h1>
<hr>

<div class="who">
    <h3>Advisee: <?= "{$appointment["full_name"]}" ?></h3>
    <h3>Advisee ID: <?= $appointment["student_id"] ?></h3>
</div>


<form method="post" class="form">
	<?= show_error($errors, 'time_conflict') ?>
    <div class="form-group">
        <label>Date</label>
        <input value="<?= show_value($appointment,"appointment_date") ?>" <?= error_outline($errors, "appointment_date") ?> type="date" name="appointment_date" required>
        <?=show_error($errors, "appointment_date")?>
    </div>

    <div class="form-group">
        <label>Time</label>
        <select <?= error_outline($errors, "time_id") ?> name="time_id" required>
        <?php $times = get_all_appointment_timeslots(); ?>
            <?php foreach($times as $time): ?>
                <option <?= check_select($appointment,"time_id",$time["time_id"]) ?> value="<?=$time['time_id']?>">
                    <?=$time["time"]?>
                </option>
            <?php endforeach; ?>
        </select>    
        <?=show_error($errors, "time_id")?>
    </div>

    <div class="form-group">
        <label>Comments (Max:255)</label>
        <textarea <?= error_outline($errors,"comments") ?> id="comments" name="comments"><?= show_value($appointment,"comments") ?></textarea>
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
