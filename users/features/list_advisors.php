<?php check_user([CHAIR,SECRETARY]) ?>

<h1>List Advisors</h1>
<hr>

<?php $advisors = get_all_advisors() ?>
<div class="div-table">
        <table>
                <tr>
                    <th>ID</th> 
                    <th>Name</th>
                    <th># of Advisees</th>
                </tr>
                <?php foreach($advisors as $advisors): ?>
                    <tr class="row">
                        <td><?= $advisors["faculty_id"]?> </td>
                        <td><?= $advisors["full_name"]?> </td>
                        <td><?= $advisors["students"]?></td>
                    </tr>
                    <tr>
                    <td colspan="100%">
                        <div class="info-shown-div">
                            <div class="info-shown-div-info">
                                <p><strong>Email: </strong><?= $advisors["faculty_email"] ?></p>
                                <p><strong>Phone: </strong><?= $advisors["faculty_phone"] ?></p>
                                <p><strong>Location: </strong><?= $advisors["room"] ?></p>
                                <p><strong>Username: </strong><?= $advisors["faculty_username"] ?></p>
                                <p><strong>Active Status: </strong><?= $advisors["faculty_active"] ?></p>
                            </div>
                            <div class="info-shown-div-links">
                                <a class="feature-url" href="user.php?feature=list_advisees&faculty_id=<?= $advisors["faculty_id"] ?>">List Advisees</a>
                                <a class="feature-url" href="user.php?feature=contact_advisor&faculty_id=<?= $advisors["faculty_id"] ?>">Contact Advisor</a>
                            </div>

                        </div>
                    </td>
                    </tr>
                <?php endforeach; ?>
        </table>


<div>
