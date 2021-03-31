<?php check_user([ADMIN]);

$errors = [];
$input = [];

$apply_id = isset($_GET["apply_id"])? $_GET["apply_id"] : "";
$request= get_apply_info($apply_id);

close_request($request["apply_id"]);
echo "<h3 style='color:green'>Request Closed</h3>";
echo "<a href = 'user.php?feature=list_apply_request'>Go back to Request</a>";


?>

<h1>Close Request<h1>
<hr>
