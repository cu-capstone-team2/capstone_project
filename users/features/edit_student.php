<?php check_user([ADMIN]) ?>

<?php

	$student_id = isset($_GET["student_id"])? $_GET["student_id"] : "";
	
	$student = get_student_by_id($student_id);
	
	if(!$student)
		change_page('user.php');

    $majors = get_all_majors();
    $advisors = get_all_advisors();



    function validate_new_student($input){

        $errors = [];

        if(!isset($input['first_name']) || empty($input['first_name'])){
            $errors['first_name'] = "First Name Required";
        }else if(!ctype_alpha($input['first_name'])){
            $errors['first_name'] = "First Name can only contain characters";
        }

        if(!isset($input['last_name']) || empty($input['last_name'])){
            $errors['last_name'] = "Last Name Required";
        }else if(!ctype_alpha($input['last_name'])){
            $errors["last_name"] = "Last Name can only contain characters";
        }

        if(!isset($input['email']) || empty($input['email'])){
            $errors['email'] = "Email is required";
        }else if(!filter_var($input['email'], FILTER_VALIDATE_EMAIL)){
            $errors['email'] = "Email is not Valid";
        }

        if(!isset($input['classification']) || empty($input["classification"])){
            $errors['classification'] = "Classification is incorrect";
        }

        if(!isset($input['major_id']) || empty($input["major_id"])){
            $errors['major_id'] = "Major is incorrect";
        }

        if(!isset($input['faculty_id']) || empty($input["faculty_id"])){
            $errors['faculty_id'] = "Advisor is incorrect";
        }

        return $errors;
    }

    $input = [];
    $errors = []; 

    if(isset($_POST["submit_new_student"])){
        $errors = validate_new_student($_POST);
        if(empty($errors)){
            $first_name = $_POST["first_name"];
            $last_name = $_POST["last_name"];
            $email = $_POST["email"];
            $classification = $_POST["classification"];
            $major_id = $_POST["major_id"];
            $faculty_id = $_POST["faculty_id"];
			update_student_info($student_id,$first_name,$last_name,$email,$classification,$major_id,$faculty_id);
            $student = get_student_by_id($student_id);
			echo "<h3 style='color:green'>Successfully edited student</h3>";
        }
        $input = clean_array($_POST);
    }
?>


<h1>Edit Student</h1>
<hr>

<div class="who">
	<h3>ID: <?= $student["student_id"] ?></h3>
	<h3>Name: <?= $student["full_name"] ?></h3>
	<h3>Username: <?= $student["student_username"] ?></h3>
</div>

<form method="post" class="form">
    <div class="form-group">
        <label>First Name</label>
        <input <?= error_outline($errors, "first_name") ?> type="text" name="first_name" value="<?=show_value($student, "student_firstname")?>" required>
        <?=show_error($errors, "first_name")?>
    </div>

    <div class="form-group">
        <label>Last Name</label>
        <input <?= error_outline($errors, "last_name") ?> type="text" name="last_name" value="<?=show_value($student, "student_lastname")?>" required>
        <?=show_error($errors, "last_name")?>
    </div>

    <div class="form-group">
        <label>Email</label>
        <input <?= error_outline($errors, "email") ?> type="email" name="email" value="<?=show_value($student, "student_email")?>" required>
        <?=show_error($errors, "email")?>
    </div>

    <div class="form-group">
        <label>Classification</label>
        <select <?= error_outline($errors, "classification") ?> name="classification" id="classification" required>
            <option <?= check_select($student,"classification","freshman") ?> value="freshman">Freshman</option>
            <option <?= check_select($student,"classification","sophmore") ?> value="sophmore">Sophmore</option>
            <option <?= check_select($student,"classification","junior") ?> value="junior">Junior</option>
            <option <?= check_select($student,"classification","senior") ?> value="senior">Senior</option>
        </select>
        <?=show_error($errors, "classification")?>
    </div>

    <div class="form-group">
        <label>Major</label>
        <select <?= error_outline($errors, "major_id") ?> name="major_id" required>
            <?php foreach($majors as $major): ?>
                <option <?= check_select($student,"major_id",$major["major_id"]) ?>  value="<?=$major['major_id']?>">
                    <?=$major["major_name"]?>
                </option>
            <?php endforeach; ?>
        </select>
        <?=show_error($errors, "major_id")?>
    </div>

    <div class="form-group">
        <label>Advisor</label>
        <select <?= error_outline($errors, "faculty_id") ?> name="faculty_id" required>
            <?php foreach($advisors as $advisor): ?>
                <option <?= check_select($student,"faculty_id",$advisor["faculty_id"]) ?> value="<?=$advisor['faculty_id']?>">
                    <?=$advisor["full_name"]?> - Advises <?=$advisor["students"]?> Student(s)
                </option>
            <?php endforeach; ?>
        </select>
        <?=show_error($errors, "faculty_id")?>
    </div>

    <input type="submit" name="submit_new_student" >

</form>