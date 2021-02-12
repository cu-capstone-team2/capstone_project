<?php $links = ['list_classes','list_advisees','teaching_schedule','contact_chair','edit_info']; ?>

<?php foreach($links as $link): ?>
	<a href="user.php?feature=<?= $link ?>"><?= $link ?></a>
<?php endforeach; ?>