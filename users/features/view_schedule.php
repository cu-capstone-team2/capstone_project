<?php check_user([STUDENT]) ?>
<h1>View Student Schedule</h1>

<?php $classes = get_classes_by_student($user["student_id"]) ?>

<div class="div-table">

    <table>
        <tr>
            <td>CRN</td>
            <td>Course</td>
            <td>Title</td>
            <td>Time</td>
            <td>Days</td>
            <td>Credits</td>
            <td>Instructor</td>
        </tr>

        <?php foreach($classes as $class): ?>
            <tr>
                <td><?= $class["class_id"] ?></td>
                <td><?= $class["course_title"] ?></td>
                <td><?= $class["course_name"] ?></td>
                <td><?= $class["time"] ?></td>
                <td><?= $class["days"] ?></td>
                <td><?= $class["credits"] ?></td>
                <td><?= $class["instructor"] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>


