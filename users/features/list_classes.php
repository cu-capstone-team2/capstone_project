<?php check_user([ADMIN,CHAIR,INSTRUCTOR,STUDENT]) ?>

<h1>List Classes</h1>
<hr>

<?php $classes = get_all_classes() ?>

<div class="div-table">
    <table>
        <tr>
            <th>CRN</th>
            <th>Course</th>
            <th>Title</th>
            <th>Time</th>
            <th>Days</th>

        </tr>

        <?php foreach($classes as $class): ?>
            <tr class="row">
                <td><?= $class["class_id"] ?></td>
                <td><?= $class["course_title"] ?></td>
                <td><?= $class["course_name"] ?></td>
                <td><?= $class["time"] ?></td>
                <td><?= $class["days"] ?></td>
            </tr>
            <tr>
            <td colspan="100%">
                <div class="info-shown-div">
                <div class="info-shown-div-info">
                    <p><strong>Instructor: </strong><?= $class["instructor"] ?></p>
                    <p><strong>Location: </strong>Howell Hall</p>
                    <p><strong>Credits: </strong><?= $class["credits"] ?></p>
                    <p><strong># of Students: </strong><?= $class["students"] ?></p>
                </div>
                <div class="info-shown-div-links">
                </div>
                </div>
            </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
