<?php
/***********************************************************************

			******** ALL FILES READ ONCE ********
			PURPOSE: This file contains the fucntion that 
					 read the files and load them into website
					 to be called only once in the entire website 

***********************************************************************/


//saves the entire folder in a array to called only once 
$files = ['connect_variables','connect','queries_get_all',
	'queries_get_many_by','queries_get_one_by','queries_insert',
	'queries_update','queries_delete','register_user', 'pagination'];

//loops for the file to be loaded in project to be only called once 
foreach($files as $file){
    require_once("includes/database/{$file}.php");
}

?>