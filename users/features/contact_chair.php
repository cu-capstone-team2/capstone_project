<?php check_user([INSTRUCTOR]) ?>
<h1>Contact Chair</h1>
<hr>

<?php

$chair = isset($_GET["chair"])? $_GET["chair"] : "";
if ($role === INSTRUCTOR){
	$chair=$user["faculty_id"];

}

$chair = get_chair($chair);


function contact_chair($input){
	$errors = [];
	if(!isset($input['chair'])){
		$errors['chair'] = "Contact Chair";
	}
	return $errors;
}

?>

<h3> Chair: <?php echo $chair["full_name"] ?> </h3><br>

<form method="POST" action="">

Subject: <input type="text" name="subject"><br><br>
Message: <textarea name="message "></textarea><br><br>
<input type="submit" name="submit_new_chair">

</form>