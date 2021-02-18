<?php check_user([CHAIR,SECRETARY]) ?>
<h1>List Advisors</h1>
<?php $advisors = get_all_advisors() ?>
<div class="div-table">

        <table>
                <tr>
                    <th> Faculty ID</th> <!-- Faculty Number of advisors-->
                    <th>Advisor's Name</th>		
                    <th>Email</th>
                    <th>Phone</th>
		    <th>Username</th>
		    <th>Password</th>
		    <th>Active</th>
		    <th>Office Location</th>

                </tr>


                <?php foreach($advisors as $advisors): ?>
                    <tr>
                        <td><?= $advisors["faculty_id"]?> </td>
                        <td><?= $advisors["full_name"]?> </td>
                        <td><?= $advisors["faculty_email"]?></td>
                        <td><?= $advisors["faculty_phone"] ?></td>
 			<td><?= $advisors["faculty_username"] ?></td>
			<td><?= $advisors["faculty_password"] ?></td>
			<td><?= $advisors["faculty_active"] ?></td>
			<td><?= $advisors["room"] ?></td>


                    </tr>
                <?php endforeach; ?>

        </table>


<div>
