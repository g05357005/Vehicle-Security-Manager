
<?php 

function get_emp_no($vcl_reg_no){
    $conn = connectDB();
    $query_emp_id = "SELECT `emp_id` FROM `qr_registration` WHERE `vcl_reg_no` ='".$vcl_reg_no."'";
    $row_emp_id= mysqli_query($conn, $query_emp_id) or die(mysqli_error($conn));
    $result_emp_id = mysqli_fetch_array($row_emp_id, MYSQLI_ASSOC);
    echo $empID= $result_emp_id["emp_id"];
 }

 function get_emp_contact($vcl_reg_no){
    $conn = connectDB();
    $query_emp_contact = "SELECT `emp_contact` FROM `qr_registration` WHERE `vcl_reg_no` ='".$vcl_reg_no."'";
    $row_emp_contact= mysqli_query($conn, $query_emp_contact) or die(mysqli_error($conn));
    $result_emp_contact = mysqli_fetch_array($row_emp_contact, MYSQLI_ASSOC);
    echo $emp_contact= $result_emp_contact["emp_contact"];
 }

 function qr_code_name($vcl_reg_no){
    $conn = connectDB();
    $query_qr_code_name = "SELECT `sticker_name` FROM `qr_registration` WHERE `vcl_reg_no` ='".$vcl_reg_no."'";
    $row_qr_code_name= mysqli_query($conn, $query_qr_code_name) or die(mysqli_error($conn));
    $result_qr_code_name = mysqli_fetch_array($row_qr_code_name, MYSQLI_ASSOC);
    echo $qr_code_name= $result_qr_code_name["sticker_name"];
 }

  function get_scan_time($vcl_reg_no){
    $conn = connectDB();
    $query_scan_time = "SELECT `scan_time` FROM `qr_scan_data` WHERE `vcl_reg_no` ='".$vcl_reg_no."'";
    $row_scan_time= mysqli_query($conn, $query_scan_time) or die(mysqli_error($conn));
    $order_trigger = true;
    while ($result_scan_time = mysqli_fetch_array($row_scan_time, MYSQLI_ASSOC)) {
       echo $scan_time = ($order_trigger = !$order_trigger) ? "<img src='../images/exit-icon.png' style='padding: 0'> <font color='#ffb4b5'>".$result_scan_time["scan_time"]."</font><br/>" : "<img src='../images/entry-icon.png' style='padding: 0'> <font color='#cbfdac'>".$result_scan_time["scan_time"]."</font><br/>";
    }
 }

?>
