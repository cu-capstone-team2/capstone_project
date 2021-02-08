<?php

require_once('includes/functions/constants.php');

function check_select($array,$key,$compare){
    if(isset($array[$key]) && $array[$key] === $compare)
        return "selected";
    return "";
}

function action(){
    /* Make sure form goes to specified page without javascript injection */
    return htmlspecialchars($_SERVER["PHP_SELF"]);
}

function show_error($array, $key){
    /* Only show error if the error exists in the array */
    if(isset($array[$key])){
        return "<p class='error'>{$array[$key]}</p>";
    }
    return "";
}

function clean_array($array){
    /* Create a new clean version of array to prevent JavaScript injection */
    $clean = [];
    foreach($array as $key=>$value){
        $clean[$key] = htmlspecialchars($value);
    }
    return $clean;
}

function show_value($array,$key){
    /* Only echo the value if the key value exists in the array */
    if(isset($array[$key])){
        return $array[$key];
    }
    return "";
}

function change_page($page){
    /* Change to page specified */
    header("Location: {$page}");
    exit();
}

?>