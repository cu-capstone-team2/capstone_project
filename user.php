<?php 

// all.php includes database queries, authentication, and common functions
require_once("includes/all.php");

// user is an associative array of whoever is logged in
$user = authenticate();

// Role is determined here
$role = isset($user["role"])? (int)$user["role"] : STUDENT;

// header on every page
require_once("partials/user/header.php");

// only show links depending on the user role
require_once("users/links/choose.php");

// this feature doesn't exist, so if no feature requested, then go to default page
$feature = "does_not_exists_file";

if(isset($_GET["feature"])){
	$feature = $_GET["feature"];
}

// reset PIN
if($role === STUDENT && $feature !== "enroll" && isset($_SESSION["PIN"])){
	unset($_SESSION["PIN"]);
}

$file = "users/features/{$feature}.php";

// if the feature exists, show that page, else go to the default page
if(file_exists($file)){
	require_once($file);
} else{
	require_once("users/features/default.php");
}

// footer on every page
require_once("partials/user/footer.php");

?>
