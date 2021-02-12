<?php $links = ['list_classes','enroll','view_schedule','contact_advisor','edit_info']; ?>

<?php foreach($links as $link): ?>
	<a href="user.php?feature=<?= $link ?>"><?= $link ?></a>
<?php endforeach; ?>