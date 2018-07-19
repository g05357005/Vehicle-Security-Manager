<?php 

    if(isset($_POST) && !empty($_POST)) {

    require_once('../library/phpqrcode/qrlib.php');
    require_once('./db_connection.php');
    date_default_timezone_set('Asia/Kolkata');
    $image_gen_location = "../qrcodes/";
    $qr_display_location = "./qrcodes/";
    $sticker_location = "../vehicle_sticker/";
    $sticker_location_dis = "./vehicle_sticker/";

/*    print "<pre>";
    print_r($_REQUEST);
    print "</pre>"; */
    
    $vcl_reg_no = $_REQUEST['vcl_reg_no'];
    $emp_id = $_REQUEST['emp_id'];
    $emp_contact = $_REQUEST['emp_contact'];
    $qr_size = $_REQUEST['qr_size'];
    $ecc = $_REQUEST['ecc'];
    $vchl_type = $_REQUEST['vchl_type'];
    $dataContent = "Vehicle Registration Number : ".$vcl_reg_no."\nEmployee ID : ".$emp_id."\nContact No : ".$emp_contact."\nDate : ".date("d-m-Y H:i:sa");
    $qr_name = $vcl_reg_no."_".$emp_id."_".date('d-m-Y-h-i-s').'.png';
    $sticker_name = $vcl_reg_no."_".$emp_id."_".date('d-m-Y-h-i-s').'.jpg';
    $image_location = $qr_display_location.$qr_name;

    // generating the QR code
    QRcode::png(base64_encode($dataContent), $image_gen_location.$qr_name, $ecc, $qr_size); 
    
    $conn = connectDB();
    session_start();

    $query_login = "INSERT INTO `qr_registration`
                        (`vcl_reg_no`, `emp_id`, `emp_contact`, `qr_code_name`, `sticker_name`,`registration_date`) 
                    VALUES 
                        ('".$vcl_reg_no."','".$emp_id."','".$emp_contact."','".$qr_name."','".$sticker_name."',convert_tz(utc_timestamp(),'+06:30','+00:00'))";
        $row = mysqli_query($conn, $query_login) or die(mysqli_error($conn));

    // ############ Sticker Generation ##########//

    if ($vchl_type == 4) {
       $im1 = '../images/tel-qr_template_11x11.jpg';
    }elseif ($vchl_type == 2) {
       $im1 = '../images/tel-qr_template_8x8.jpg';
    }else{
       $im1 = '../images/tel-qr_template_8x8.jpg';
    }
       $im2 = '.'.$image_location; 


    // Get Resolution Details
    list($width,$height) = getimagesize($im2);

    // Generate image object
    $im1 = imagecreatefromstring(file_get_contents($im1));
    $im2 = imagecreatefromstring(file_get_contents($im2));

    // Join image objects
    if ($vchl_type == 4) {
        imagecopymerge($im1, $im2, 120, 190, 0, 0, $width, $height, 100);
    }elseif ($vchl_type == 2) {
        imagecopymerge($im1, $im2, 90, 140, 0, 0, $width, $height, 100);
    }else{
        imagecopymerge($im1, $im2, 120, 190, 0, 0, $width, $height, 100);
    }
    header('Content-Type: image/png');
    // Store merged image 
    imagepng($im1,$sticker_location.$sticker_name);

    // displaying the QR code on the web page
    echo '<img class="img-thumbnail" src="'.$sticker_location_dis.$sticker_name.'" />';
    /*echo '<a href="#" class="btn btn-primary btn-info" id="js-print-link">Print</a>';*/
    /*echo '<a href="'.$image_location.'" class="btn btn-primary btn-info" style="margin: 70% 0 0 0;" download="QR_'.$emp_id.'"><span class="glyphicon glyphicon-save"></span>Download</a>';*/
    
    } else {
        header('location:./');
    }
?>