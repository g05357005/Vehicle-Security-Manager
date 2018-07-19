<?php
/*     
* File Name: api.php 
* Description: API for Centralized Test Manager system users.
* php | Licensed under the GPL license. 
* Copyright (c) 2017: TATA Elxsi
* Authors: Santhosh S
* Creation Date: 07 August, 2017
*/

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
require("vendor/autoload.php");

require_once('model/db_conn.php');

$app = new \Slim\App;

/*
 * Name: schedule
 * Description: Public method which is used to post the schedule test details.              
 * Parameters: username 
 * @param : Used for filter the results only for particular user.
 * Returns: None.
 */
$app->post('/qr_scan_data/{vcl_reg_no}',function (Request $request, Response $response ,$args) {
    date_default_timezone_set("Asia/Kolkata");
    $vcl_reg_no = trim($args['vcl_reg_no']);
    $db = connect_db();    
    $scheduleQuery = "INSERT INTO `qr_scan_data`(`vcl_reg_no`, `scan_time`) VALUES ('".$vcl_reg_no."', convert_tz(utc_timestamp(),'+06:30','+00:00'))";
    if(mysqli_query($db, $scheduleQuery)){
      echo json_encode(array("status" => "Success"));
    }
    else{
      echo json_encode(array("status" => "Error", "code" => 501,  "message"=> "Test Not Scheduled" ));
    }
});
/*
 * Name: login
 * Description: Public method which is used to verify the login credentials.              
 * Parameters: username,password
 * @param : Used for credentials verification.
 * Returns: user role, login_name
 */

$app->post('/login/',function (Request $request, Response $response) {
 $allPostVars = $request->getParsedBody();
 header("Content-Type: application/json");
 $db = connect_db();
 $username = $allPostVars['username'];
 $password = $allPostVars['password'];
 $sql = "SELECT `name`, `login_name` FROM `user_records` WHERE (BINARY login_name = '$username' AND password =  md5('$password') AND `activation_status` = 1)";
  $row = mysqli_query($db, $sql) or die(mysqli_error($conn));
  $result = mysqli_fetch_array($row, MYSQLI_ASSOC);

 if(!empty($result)){
  echo json_encode(array("status" => "Success","data" => $result));
  }
 else{
  echo json_encode(array("status" => "Error", "code" => 400,  "message"=> "Invalid Credentials" ));
 }

});

$app->run();
?>