<?php

$conn = mysqli_connect('localhost','cs01','CUqyh5Hf','cs01');

if($error = mysqli_connect_error($conn)){
    die("CONNECTION FAILED: " . $error);
}
?>