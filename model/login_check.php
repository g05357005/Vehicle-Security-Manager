<!--       
* File Name: ctm_login_check.php   
* Description: Login validation mechanism for Centralized Test Manager system.  
* php | Licensed under the GPL license.   
* Copyright (c) 2017: Jaguar Land Rover  
* Authors: Souvik DG  
* Creation Date: 27 June, 2017  
-->
<?php
require_once('../global/constraints.php'); // Including Constraints package
require_once('./db_connection.php'); // Including DB Connectivity Script
/*print "<pre>";
print_r($_REQUEST);
print "</pre>"; */
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$conn = connectDB();
    session_start(); //starting the session for user profile
        // code for login credentials validation
        $vsm_username = $_REQUEST['login_username'] !== '' ? trim(mysqli_real_escape_string($conn, $_REQUEST['login_username'])) : 'Null';
        $vsm_password = $_REQUEST['login_password'] !== '' ? md5(mysqli_real_escape_string($conn, $_REQUEST['login_password'])) : 'Null';
        $query_login = "SELECT `name`, `login_name`, `password`, `role`, `activation_status` FROM `user_records` 
        WHERE (BINARY login_name = '".$vsm_username."' AND password = '".$vsm_password."' AND `activation_status` = 1)";
        $row = mysqli_query($conn, $query_login) or die(mysqli_error($conn));
        $result = mysqli_fetch_array($row, MYSQLI_ASSOC);
        if (mysqli_num_rows($row) == 1 AND!empty($result['login_name']) AND!empty($result['password'])) {
            $_SESSION['login_user'] = $result['login_name'];
            $_SESSION['name'] = $result['name'];
            $_SESSION['role'] = $result['role'];
            $_Error_Message = " ";
            header("location: ../index.php");
    }
}
?>