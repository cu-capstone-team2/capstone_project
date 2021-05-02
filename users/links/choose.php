<?php
// depending on the role of the current user, then show those links
switch($role){
	case ADMIN:
		require_once('users/links/admin.php');
		break;
	case STUDENT:
		require_once('users/links/student.php');
		break;
	case INSTRUCTOR:
		require_once('users/links/instructor.php');
		break;
	case SECRETARY:
		require_once('users/links/secretary.php');
		break;
	case CHAIR:
		require_once('users/links/chair.php');
		break;
}

// below is dynamic renderin of links based on the user's links
?>

<?php foreach($links as $link=>$name): ?>
	<a class="mainlink" href="user.php?feature=<?= $link ?>"><?= $name ?></a>
<?php endforeach; ?>