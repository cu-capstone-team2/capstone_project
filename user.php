<?php require_once("includes/all.php") ?>

<?php $user = authenticate(); ?>

<?php $role = isset($user["role"])? (int)$user["role"] : STUDENT ?>
<?php require_once("partials/user/header.php") ?>

<?php require_once("users/links/choose.php") ?>

<?php

$features = [
	"add_appointment","add_class","add_course","add_faculty","change_advisor",
	"class_roster","contact_advisor","contact_chair","contact_student","edit_info",
	"enroll","list_advisees","list_advisors","list_classes","list_courses","list_faculty",
	"list_students","pick_major","teaching_schedule","view_appointments","view_schedule"
];

$curr_feature = "";
if(isset($_GET["feature"])){
	$curr_feature = $_GET["feature"];
}
$default = true;
foreach($features as $feature){
	if($curr_feature === $feature){
		$default = false;
		require_once("users/features/{$feature}.php");
	}
}

if($default){
	require_once("users/features/default.php");
}

?>

<?php require_once("partials/user/footer.php") ?>