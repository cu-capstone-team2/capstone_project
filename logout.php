<?php

require_once('includes/authentication/all.php');
require_once('includes/functions/all.php');

// logout the user, then go back to home page
logout();
change_page('index.php');

?>