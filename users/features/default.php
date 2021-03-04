<h1>Welcome, <?= get_current_user_name() ?></h1>
<hr>
<div class="div-table">
	<table>
	<?php foreach($user as $key=>$value): ?>
		<?php if(strpos($key,"password") !== false) continue; ?>
		<tr>
			<th><?= $key ?>: </th>
			<td><?= $value ?></td>
		</tr>
	<?php endforeach; ?>
	</table>

</div>