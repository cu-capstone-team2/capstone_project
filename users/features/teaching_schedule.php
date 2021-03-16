<?php check_user([CHAIR,INSTRUCTOR]) ?>
<h1>Teaching Schedule</h1>
<hr>

<h3>For <?= $user["full_name"] ?></h3>
<?php $classes = get_classes_by_instructor($user["faculty_id"]); ?>

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
                    <p><strong>Location: </strong>Howell Hall</p>
                    <p><strong>Credits: </strong><?= $class["credits"] ?></p>
                    <p><strong># of Students: </strong><?= $class["students"] ?></p>
                </div>
                <div class="info-shown-div-links">
                    <a class="feature-url" href="user.php?feature=class_roster&class_id=<?= $class["class_id"] ?>">Class Listing</a>

                </div>
                </div>
            </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>

