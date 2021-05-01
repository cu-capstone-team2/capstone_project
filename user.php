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

$feature = "does_not_exists_file";

if(isset($_GET["feature"])){
	$feature = $_GET["feature"];
}

if($role === STUDENT && $feature !== "enroll" && isset($_SESSION["PIN"])){
	unset($_SESSION["PIN"]);
}

$file = "users/features/{$feature}.php";

if(file_exists($file)){
	require_once($file);
} else{
	require_once("users/features/default.php");
}

// footer on every page
require_once("partials/user/footer.php");

?>
