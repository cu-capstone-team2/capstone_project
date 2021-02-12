<?php $links = ['list_students','list_faculty','list_courses','list_classes','edit_info']; ?>

<?php foreach($links as $link): ?>
	<a href="user.php?feature=<?= $link ?>"><?= $link ?></a>
<?php endforeach; ?>