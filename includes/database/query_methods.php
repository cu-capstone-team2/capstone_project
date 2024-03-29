<?php
/***********************************************************************

		******** MYSQL QUERIES METHOD PAGE ********
		PURPOSE: This page contain the function that returns
				 the query from the SQL code to be save in abs
				 an array
		
***********************************************************************/

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

// query one row with no parameters, doesn't clean array
function query_one_np($sql){
    $result = query_np($sql);
    $row = mysqli_fetch_assoc($result);
    return $row;
    
}

// query many with no parameters
function query_many_np($sql){
    $result = query_np($sql);
    $array = [];
    while($row = mysqli_fetch_assoc($result)){
        $array[] = clean_array($row);
    }
    return $array;
}

?>