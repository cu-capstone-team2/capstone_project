<?php check_user([ADMIN]) ?>

<?php
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

        if(!isset($input['classification'])){
            $errors['classification'] = "Classification is incorrect";
        }

        if(!isset($input['major_id'])){
            $errors['major_id'] = "Major is incorrect";
        }

        if(!isset($input['faculty_id'])){
            $errors['faculty_id'] = "Advisor is incorrect";
        }

        return $errors;
    }

    $input = [];
    $errors = []; 

    if(isset($_POST["submit_new_student"])){
        $errors = validate_new_student($_POST);
        if(empty($errors)){
            $username = generate_username($_POST["first_name"], $_POST["last_name"]);
            $password = generate_random_password();
            $hash_password = PASSWORD_HASH($password, PASSWORD_DEFAULT);
            $PIN = generate_random_pin();


            insert_student($_POST["first_name"], $_POST["last_name"], $_POST["email"], $_POST["classification"], $PIN, $username, $hash_password, $_POST["major_id"], $_POST["faculty_id"]);
            
            $msg = "Username:{$username} Password:{$password}";

            mail($_POST['email'], "Student Login Information", $msg);

            change_page("user.php?feature=add_student");
        }
        $input = clean_array($_POST);
    }




?>


<h1>Add Student</h1>
<hr>

<form method="post">
    <?=show_error($errors, "first_name")?>
    <label>First Name:</label>
    <input type="text" name="first_name" value="<?=show_value($input, "first_name")?>" required>
    <br>

    <?=show_error($errors, "last_name")?>
    <label>Last Name:</label>
    <input type="text" name="last_name" value="<?=show_value($input, "last_name")?>" required>
    <br>

    <?=show_error($errors, "email")?>
    <label>Email:</label>
    <input type="email" name="email" value="<?=show_value($input, "email")?>" required>
    <br>

    <?=show_error($errors, "classification")?>
    <label>Classification:</label>
    <select name="classification" id="classification" required>
        <option value="freshman">Freshman</option>
        <option value="sophmore">Sophmore</option>
        <option value="junior">Junior</option>
        <option value="senior">Senior</option>
    </select>
    <br>

    <?=show_error($errors, "major_id")?>
    <label>Major:</label>
    <select name="major_id" required>
        <?php foreach($majors as $major): ?>
            <option value="<?=$major['major_id']?>">
                <?=$major["major_name"]?>
            </option>
        <?php endforeach; ?>
    </select>
    <br>

    <?=show_error($errors, "faculty_id")?>
    <label>Advisor:</label>
    <select name="faculty_id" required>
        <?php foreach($advisors as $advisor): ?>
            <option value="<?=$advisor['faculty_id']?>">
                <?=$advisor["full_name"]?> - Advises <?=$advisor["students"]?> Student(s)
            </option>
        <?php endforeach; ?>
    </select>
    <br>
    <input type="submit" name="submit_new_student" >

</form>