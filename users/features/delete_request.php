<?php check_user([ADMIN]);

$errors = [];
$input = [];

$apply_id = isset($_GET["apply_id"])? $_GET["apply_id"] : "";
$request= get_apply_info($apply_id);


delete_request($request["apply_id"]);
?>