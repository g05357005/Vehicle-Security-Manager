<?php
session_start();
ini_set('display_errors', 'on');
/*
 * File Name: ctm_user_session.php 
 * Description: Manages the session for valid user login.
 *----------*
 * php | * licensed under the GPL license. 
 *----------*
 * Copyright (c) 2017: Jaguar Land Rover
 * Authors: Sarath P G
 * Creation Date: 15 March, 2017
 */

if (!isset($_SESSION['login_user'])){
	header("location:../login.php");
}
?>