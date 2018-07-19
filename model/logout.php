<?php
/*
 * File Name: ctm_logout.php 
 * Description: Logs out the user and redirects to login page.
 *----------*
 * php | * licensed under the GPL license. 
 *----------*
 * Copyright (c) 2017: Jaguar Land Rover
 * Authors: Sarath P G
 * Creation Date: 15 March, 2017
 */
session_start();
 // Clear all session veriables
session_unset(void);
unset($_SESSION);

if (session_destroy()) {
	header("Location: ../login.php");	//header("Location: http://192.168.12.53:81/Hils_Test1/login.php");

}else{
	session_destroy();
}
?>