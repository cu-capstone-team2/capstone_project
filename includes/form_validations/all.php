<?php
//Call all pages in the form_validations folder 
$files = ['login'];

foreach($files as $file){
    require_once("includes/form_validations/{$file}.php");
}

?>