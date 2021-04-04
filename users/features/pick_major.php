<?php check_user([CHAIR,SECRETARY]) ?>

<?php

$student_id = isset($_GET["student_id"])? $_GET["student_id"] : "";

$student = get_student_by_id($student_id);

if(!$student){
    change_page("user.php");
}

$majors = get_all_majors();

function validate_new_major($input){
    $errors = [];
    if(!isset($input['major_id']) || empty($input["major_id"])){
        $errors['major_id'] = "Major id was incorrect";
    }
    return $errors;
}

$errors = [];
$input = [];

if(isset($_POST["submit_new_major"])){
    $errors = validate_new_major($_POST);
	$input = clean_array($_POST);
    if(empty($errors)){
        update_student_major($student_id,$_POST["major_id"]);
        $student = get_student_by_id($student_id);
        echo "<h3 style='color:green'>Changed Major!</h3>";
    }
	
}

?>


<h1>Pick Major</h1>
<hr>

<div class="who">
    <h3>for <?= "{$student["student_firstname"]} {$student["student_lastname"]}" ?>, ID = <?= $student["student_id"] ?></h3>
</div>

<form method="post" class="form">
    <div class="form-group">
        <label>New Major</label>
        <select <?= error_outline($errors,"major_id") ?> name="major_id" required>
            <?php foreach($majors as $major): ?>
                <option value="<?= $major["major_id"] ?>" <?= check_select($student,"major_id",$major["major_id"]) ?>>
                    <?= $major["short_name"] ?> - <?= $major["major_name"] ?>
                </option>
            <?php endforeach; ?>
        </select>
        <?= show_error($errors,'major_id') ?>
    </div>
    <input type="submit" name="submit_new_major" >
</form>
