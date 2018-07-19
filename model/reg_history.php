<?php include('./session_check.php'); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<?php 
require_once('../global/admin-dependencies.php');
require_once('./db_connection.php');
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
				<h1>Registration History</h1>
                <h2 class="top-margin">This application generates QR code, also known as the Quick Response Code for vehicles parked in Tata Elxsi Premises. The QR code is generated using information on Vehicle Registration Number, Employee ID and Employee Contact. The application also supports QR Code generation with scalable quality in different sizes. This application is strictly under use by Tata Elxsi Ltd.</h2>
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
                <th>Registration Date</th>
                <th>OR Code</th>
                <th>Action</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Vehicle Registration Number</th>
                <th>Employee ID</th>
                <th>Contact No</th>
                <th>Registration Date</th>
                <th>OR Code</th>
                <th>Action</th>
            </tr>
        </tfoot>
        <tbody>
        <?php
        $conn = connectDB();
    	$query_reg_history = "SELECT `vcl_reg_no`, `emp_id`, `emp_contact`, `sticker_name`, `registration_date` FROM `qr_registration`";
        $row_reg_history = mysqli_query($conn, $query_reg_history) or die(mysqli_error($conn));
        while ($result_reg_history = mysqli_fetch_array($row_reg_history, MYSQLI_ASSOC)) {
        ?>
            <tr>
                <td><?php echo $result_reg_history['vcl_reg_no']; ?></td>
                <td><?php echo $result_reg_history['emp_id']; ?></td>
                <td><?php echo $result_reg_history['emp_contact']; ?></td>
                <td><?php echo $result_reg_history['registration_date']; ?></td>
                <td><a href="../vehicle_sticker/<?php echo $result_reg_history['sticker_name']; ?>" download="<?php echo $result_reg_history['vcl_reg_no']."-".$result_reg_history['emp_id']; ?>"><img src="../images/qr_icon.png"></a></td>
                <td>Update | Delete</td>
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
} );
         </script>


	
</body>
</html>