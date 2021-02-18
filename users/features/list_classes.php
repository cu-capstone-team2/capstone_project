<?php check_user([ADMIN,CHAIR,INSTRUCTOR,STUDENT]) ?>

<h1>List Classes</h1>

<?php $classes = get_all_classes() ?>

<div class="div-table">
    <table>
        <tr>
            <th>CRN</th>
            <th>Course</th>
            <th>Title</th>
            <th>Time</th>
            <th>Days</th>
            <th>Credits</th>
            <th>Instructor</th>
            <th>Students Enrolled</th>
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
                <td><?= $class["students"] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
