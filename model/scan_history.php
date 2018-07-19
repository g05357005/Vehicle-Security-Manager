<?php include('./session_check.php'); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<?php 
require_once('../global/admin-dependencies.php');
require_once('./db_connection.php');
require_once('./functions.php');
?>

</head>
<body>
	 <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
     <![endif]-->    
     <div class="wrapper">
     	<?php include('../global/sidebar-admin.php'); ?>
            <!-- Page Content Holder -->
            <div id="content">
            	<?php include('../global/admin-header.php'); ?>
	<!-- #masthead -->
	<div class="container-fluid tel-qr-margin-top">
		<div class="row">
			<div class="col-md-12">
                <h1>Security Scan History</h1>
				<h2 class="top-margin">QR code is a two-dimensional barcode, also known as the Quick Response code. It can contain URL, simple text, contact number, email address and so on. In this tutorial, I will guide you through a step by step way about how to generate QR code using PHP and Ajax. The following example of QR code generator is very easy to implement and understand. In order to generate the QR code, you need a PHP library – PHP QR Code, download the latest version. </h2>
			</div>
		</div>
    </div> 


	<div class="container">

		<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Vehicle Registration Number</th>
                <th>Employee ID</th>
                <th>Contact No</th>
                <th>Scanned Time</th>
                <th>OR Code</th>
                <th>Action</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Vehicle Registration Number</th>
                <th>Employee ID</th>
                <th>Contact No</th>
                <th>Scanned Time</th>
                <th>OR Code</th>
                <th>Action</th>
            </tr>
        </tfoot>
        <tbody>
        <?php
        $conn = connectDB();    
    	$query_reg_history = "SELECT DISTINCT(TRIM(`vcl_reg_no`)) AS `vcl_reg_no` FROM `qr_scan_data` ORDER BY `scan_time` DESC";
        $row_reg_history = mysqli_query($conn, $query_reg_history) or die(mysqli_error($conn));
        $i = 0;
        $row_counter = 0;
        while ($result_reg_history = mysqli_fetch_array($row_reg_history, MYSQLI_ASSOC)) {           
         $counter = $i++;
        ?>

                <tr>
                <td><?php echo $result_reg_history['vcl_reg_no']; ?></td>
                <td><?php get_emp_no($result_reg_history['vcl_reg_no']); ?></td>
                <td><?php get_emp_contact($result_reg_history['vcl_reg_no']); ?></td>
                <td>
                    <button id="show_scan_time<?php echo $counter;?>" class="show_scan_time" onclick="myFunction(event)">Show Details</button>

                    <div id="scan_time<?php echo $counter;?>" class="scan_time">
                        <?php get_scan_time($result_reg_history['vcl_reg_no']); ?>  <?php ($row_counter % 2 == 0)?"dada":"adad" ?>
                    </div>
                </td>
                <td><a href="../vehicle_sticker/<?php echo qr_code_name($result_reg_history['vcl_reg_no']); ?>" download="<?php echo $result_reg_history['vcl_reg_no']."-".get_emp_no($result_reg_history['vcl_reg_no']); ?>"><img src="../images/qr_icon.png"></a></td>
                <td>SMS | Email</td>
            </tr>
         <?php } ?>   
        </tbody>
    </table>

    </div>

    <?php include('../footer.php'); ?>
            </div>
        </div> 


    <script type="text/javascript">
	    $(document).ready(function() {
        $('#example').DataTable();
        $("div[id^='scan_time']").hide();

} );
        function myFunction(event) { 
        $('#'+event.currentTarget.id).next().slideToggle(500,'swing');
}
         </script>
</body>
</html>