<?php 

require_once("includes/all.php");

$user = authenticate();

$role = isset($user["role"])? (int)$user["role"] : STUDENT;

require_once("partials/user/header.php");

require_once("users/links/choose.php");

$feature = "";

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

require_once("partials/user/footer.php");

?>