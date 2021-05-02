<?php
//Call all pages in the form_validations folder 
$files = ['login'];

// loops through each file, and include it to be used by the web pages
foreach($files as $file){
    require_once("includes/form_validations/{$file}.php");
}

?>