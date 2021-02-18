<?php check_user([CHAIR,SECRETARY]) ?>
<h1>List Advisors</h1>
<?php $advisors = get_all_advisors() ?>
<div class="div-table">
        <table>
                <tr>
                    <th>ID</th> 
                    <th>Advisor's Name</th>
                    <th># of Advisees</th>
                    <th>List Advisees</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Username</th>
                    <th>Active</th>
                    <th>Office Location</th>
                </tr>
                <?php foreach($advisors as $advisors): ?>
                    <tr>
                        <td><?= $advisors["faculty_id"]?> </td>
                        <td><?= $advisors["full_name"]?> </td>
                        <td><?= $advisors["students"]?></td>
                        <td><a href="user.php?feature=list_advisees&faculty_id=<?= $advisors["faculty_id"] ?>">List Advisees</a></td>
                        <td><?= $advisors["faculty_email"]?></td>
                        <td><?= $advisors["faculty_phone"] ?></td>
                        <td><?= $advisors["faculty_username"] ?></td>
                        <td><?= $advisors["faculty_active"] ?></td>
                        <td><?= $advisors["room"] ?></td>
                    </tr>
                <?php endforeach; ?>

        </table>


<div>
