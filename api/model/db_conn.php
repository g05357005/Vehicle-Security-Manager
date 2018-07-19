<?php
/*     
* File Name: mysql.php 
* Description: Db connection and constant values for CTM API.
* php | Licensed under the GPL license. 
* Copyright (c) 2017: TATA Elxsi
* Authors: Santhosh S
* Creation Date: 29 August, 2017
*/
function connect_db() {
	
    $server = 'localhost'; // this may be an ip address instead
    $user = 'root';
    $pass = 'UupCNs6Prc+ta5';
    $database = 'vsm'; // name of your database
    $connection = new mysqli($server, $user, $pass, $database);

    return $connection;
}
?>