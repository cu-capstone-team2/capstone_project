<?php check_user([ADMIN]);

// used to close contact in from database
// I don't think this page is used anymore

$errors = [];
$input = [];

$contact_id = isset($_GET["contact_id"]) ? $_GET["contact_id"] : "";
$contact = get_contact_user($contact_id);

close_contact($contact["ID"]);
echo "<h3 style='color:green'>Request Closed</h3>";
echo "<a href = 'user.php?feature=list_contact_us'>Go back to Contact list.</a>";

?>
