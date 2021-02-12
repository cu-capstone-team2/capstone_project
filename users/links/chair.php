<?php $links = ['list_classes','list_students','list_advisors','edit_info']; ?>

<?php foreach($links as $link): ?>
	<a href="user.php?feature=<?= $link ?>"><?= $link ?></a>
<?php endforeach; ?>