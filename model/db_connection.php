<?php
/*      
   * File Name: ctm_db_connection.php 
   * Description: Common Database connectivity for Centralized Test Manager system.
   * php | Licensed under the GPL license. 
   * Copyright (c) 2017: Jaguar Land Rover
   * Authors: Souvik DG
   * Creation Date: 27 June, 2017
*/
ini_set('display_errors', 'on');
// Create connection
function connectDB () {  
	require_once('../global/constraints.php');
	static $conn;

    $_Server_Name = "localhost";
    $_DB_Name = "vsm";
    $_DB_UserName = "root";
    $_DB_PassWord = "UupCNs6Prc+ta5";

	$servername = $_Server_Name;
	$username = $_DB_UserName;
	$password = $_DB_PassWord;
	$dbname = $_DB_Name;    

   // if ($conn===NULL){ 
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
		if ($conn->connect_error) {
		    die("Connection establishment failed: " . $conn->connect_error);
		} 
		$_SESSION['DB_CON_STATUS'] = "Connection established successfully";
   // }
    return $conn;
}
?>