<?php check_user([ADMIN]) ?>
<h1>Add Course</h1>
<hr>
<?php

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

<h3>for <?= "{$student["student_firstname"]} {$student["student_lastname"]}" ?>, ID = <?= $student["student_id"] ?></h3>
<form method="post">

    <?=show_error($errors, "appointment_date")?>
    <label>Date</label>
