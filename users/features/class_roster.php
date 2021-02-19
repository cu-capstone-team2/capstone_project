<?php check_user([INSTRUCTOR]) ?>
<h1>Class Roster</h1>


<?php 
    $classes = get_class_by_id($_GET["class_id"]); 

    if(!$classes){
        change_page("user.php?feature=teaching_schedule");
    }

    $students = get_students_by_class($classes["class_id"]);
?>

<div class="div-table">
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Classification</th>
            <th>Username</th>
            <th>Active</th>
            <th>Major</th>
        </tr>

        <?php foreach($students as $student): ?>
            <tr>
                <td><?= $student["student_id"] ?></td>
                <td><?= $student["full_name"] ?></td>
                <td><?= $student["student_email"] ?></td>
                <td><?= $student["classification"] ?></td>
                <td><?= $student["student_username"] ?></td>
                <td><?= $student["student_active"] ?></td>
                <td><?= $student["short_name"] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>