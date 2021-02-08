<?php

$files = ['login'];

foreach($files as $file){
    require_once("includes/form_validations/{$file}.php");
}

?>