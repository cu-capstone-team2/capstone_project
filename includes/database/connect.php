<?php
/**************************************************************************
			******** MYSQL DATABASE CONNECTION PAGE ********
			PURPOSE: Used to connect from the datebase to the website 
					 thru PHP 

**************************************************************************/


$conn = mysqli_connect(D_LOCATION,D_USERNAME,D_PASSWORD,D_DATABASE);//database connction call 

if($error = mysqli_connect_error($conn)){//if database connction fails it quits 
    die("CONNECTION FAILED: " . $error);
}

/*
Cleans entire array
*/
function query($sql,$types,$params){
    global $conn;

    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt,$sql)){
        die("SQL SYNTAX ERROR: " . mysqli_error($conn));
    }

    mysqli_stmt_bind_param($stmt,$types,...$params);
    $exec = mysqli_stmt_execute($stmt);
    if(!$exec){
        die("EXECUTION FAILED: " . mysqli_stmt_error($stmt));
    }
    $result = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);
    return $result;
}

// return row if only one row is to be the result
function query_one($sql,$types,$params){
    $result = query($sql,$types,$params);
    $row = mysqli_fetch_assoc($result);
    if(!$row) return false;
    return clean_array($row);
}

// returns one row only, does not call clean method
function query_one_no_clean($sql,$types,$params){
    $result = query($sql,$types,$params);
    return mysqli_fetch_assoc($result);
}

// return array of rows
function query_many($sql,$types,$params){
    $result = query($sql,$types,$params);
    $array = [];
    while($row = mysqli_fetch_assoc($result)){
        $array[] = clean_array($row);
    }
    return $array;
}

// query with no parameters
function query_np($sql){
    global $conn;
    $result = mysqli_query($conn,$sql);
    if(!$result){
        die("QUERY FAILED: " . mysqli_error($conn));
    }
    return $result;
}

// query many with no parameters
function query_many_np($sql){
    global $conn;
    $result = query_np($sql);
    $array = [];
    while($row = mysqli_fetch_assoc($result)){
        $array[] = clean_array($row);
    }
    return $array;
}

// querys exactly one row, doesn't require parameters
function query_one_np($sql){
    global $conn;
    $result = query_np($sql);
    $row = mysqli_fetch_assoc($result);
    if(!$row) return false;
    return clean_array($row);
}

// returns the last id entered into database.
function get_last_id(){
	global $conn;
	return mysqli_insert_id($conn);
}

?>