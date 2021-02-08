<?php

$files = ['connect','query_methods','validate_queries'];

foreach($files as $file){
    require_once("includes/database/{$file}.php");
}

?>