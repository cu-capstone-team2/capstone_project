<?php check_user([INSTRUCTOR]) ?>

<?php
    $student_id = isset($_GET["student_id"])? $_GET["student_id"] : "";
    $student = get_student_by_id($student_id);

    $times = get_all_appointment_timeslots();

    if(!$student){
		change_page("user.php?feature=list_advisees");
    }

    function validate_new_appointment($input){
        $errors = [];
        if(!isset($input['time_id'])){
            $errors['time_id'] = "Time is incorrect";
        }

        if(!isset($input['appointment_date']) || strtotime($input['appointment_date']) < strtotime('today midnight')){
            $errors['appointment_date'] = "Date's before today are invalid";

        }

        if(!isset($input['comments']) || strlen($input["comments"]) > 255){
            $errors['comments'] = "Over 255 Characters";
        }
        return $errors;
    }

    $errors = [];
    $input = [];

    if(isset($_POST["submit_new_appointment"])){
        $errors = validate_new_appointment($_POST);
        if(empty($errors)){
            insert_appointment($_POST["comments"], $_POST["appointment_date"], $student_id, $user["faculty_id"], $_POST["time_id"]);

            echo "<h3 style='color:green'>Appointment Added!</h3>";
            echo "<a href='user.php?feature=list_advisees'>Go Back to Advisees</a>";
        }
        $input = clean_array($_POST);
    }

?>



<h1>Add Appointment</h1>
<hr>

<div class="who">
    <h3>for <?= "{$student["student_firstname"]} {$student["student_lastname"]}" ?>, ID = <?= $student["student_id"] ?></h3>
</div>


<form method="post" class="form">

    <div class="form-group">
        <label>Date</label>
        <input <?= error_outline($errors, "appointment_date") ?> type="date" name="appointment_date" required>
        <?=show_error($errors, "appointment_date")?>
    </div>

    <div class="form-group">
        <label>Time</label>
        <select <?= error_outline($errors, "time_id") ?> name="time_id" required>
            <?php foreach($times as $time): ?>
                <option value="<?=$time['time_id']?>">
                    <?=$time["time"]?>
                </option>
            <?php endforeach; ?>
        </select>    
        <?=show_error($errors, "time_id")?>
    </div>

    <div class="form-group">
        <label>Comments (Max:255)</label>
        <textarea <?= error_outline($errors,"comments") ?> id="comments" name="comments"></textarea>
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