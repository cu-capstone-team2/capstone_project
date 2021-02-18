<?php check_user([CHAIR,INSTRUCTOR]) ?>
<h1>Teaching Schedule</h1>

<?php $classes = get_classes_by_instructor($user["faculty_id"]); ?>

<div class="div-table">
    <table>
        <tr>
            <th>CRN</th>
            <th>Title</th>
            <th>Course</th>
            <th>Time</th>
            <th>Days</th>
            <th>Credits</th>
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
                <td><?= $class["students"] ?></td> 
            </tr>
        <?php endforeach; ?>
    </table>
</div>