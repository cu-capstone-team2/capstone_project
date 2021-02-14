<h1>Welcome, <?= get_current_user_name() ?></h1>

<br>
<div class="div-table">

	<table>

	<?php foreach($user as $key=>$value): ?>
		<tr>
			<th><?= $key ?>: </th>
			<td><?= $value ?></td>
		</tr>
	<?php endforeach; ?>

	</table>

</div>
<br>