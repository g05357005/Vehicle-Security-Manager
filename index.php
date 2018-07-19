<?php
session_start();
if (!isset($_SESSION['login_user'])){
    header("location:./login.php");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title></title>
    <?php include('./dependencies.php'); ?>
</head>
<body>
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->
    <div class="wrapper">
        <?php include('./sidebar.php'); ?>
        <!-- Page Content Holder -->
        <div id="content">
            <?php include('./header.php'); ?>
            <!-- #masthead -->
            <div class="container-fluid tel-qr-margin-top">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="top-margin">This application generates QR code, also known as the Quick Response Code for vehicles parked in Tata Elxsi Premises. The QR code is generated using information on Vehicle Registration Number, Employee ID and Employee Contact.
                            The application also supports QR Code generation with scalable quality in different sizes. This application is strictly under use by Tata Elxsi Ltd.</h1>
                    </div>
                </div>
            </div>


            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-6">
                        <form class="form-horizontal" method="POST" id="form" onsubmit="return false" autocomplete="on">
                            <div class="form-group">
                                <label class="control-label">Vehicle Registration Number : </label>
                                <input class="form-control col-xs-12" name="vcl_reg_no" id="vcl_reg_no" type="text" placeholder="KA-11-AA-1111" value="" required="required">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Employee ID : </label>
                                <input class="form-control col-xs-12" name="emp_id" id="emp_id" type="number" value="00000" required="required">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Contact No : </label>
                                <input class="form-control col-xs-12" name="emp_contact" id="emp_contact" type="text" value="" required="required">
                                <span class="unit">+91</span>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Vehicle Type : </label>
                                <!-- <input type="number" min="1" max="5" step="1" class="form-control col-xs-12" name="qr_size" id="qr_size" value="3"> -->
                                <select class="form-control col-xs-12" name="vchl_type" id="vchl_type">
									<option>Please Select</option>
									<option value="2">Two Wheeler</option>
									<option value="4">Four Wheeler</option>      		            
								</select>
                            </div>
                            <input type="hidden" name="ecc" id="ecc" value="H">
                            <!-- <div class="form-group">
									<label class="control-label">Print Quality : </label>
									<select class="form-control col-xs-12" name="ecc" id="ecc">
									<option value="H">H - best</option>
									<option value="M">M</option>
									<option value="Q">Q</option>
									<option value="L">L - smallest</option>       		            
									</select>
								  </div>      -->
                            <div class="form-group">
                                <label class="control-label"></label>
                                <input type="submit" name="submit" id="submit" class="btn btn-success" value="Generate QR">
                            </div>
                        </form>
                    </div>

                    <div class="col-md-6 col-6 thumbnail">
                        <div class="qrdiv loading thumbnail"></div>
                    </div>
                    <!-- <a href="#" class="btn btn-primary btn-info" id="js-print-link">Print</a> -->                    
                </div>
                <!-- .row -->
            </div>
            <?php include('./footer.php'); ?>
        </div>
    </div>    

<script type="text/javascript">	    
$(document).ready(function() {
    $("#form").submit(function() {
        $(".qrdiv").html('');        
        var vchl_type = $("#vchl_type").val();
        var ecc = 'H';
        var qr_size = 1;
        if (vchl_type == 2) {
            ecc = 'H';
            qr_size = 1;
        } else if (vchl_type == 4) {
        	ecc = 'Q';
        	qr_size = 1.5;
        }else{
        	ecc = 'H';
        	qr_size = 1;
        }
        $.ajax({
            url: './model/generate-qr-code.php',
            type: 'POST',
            data: {
                vcl_reg_no: $("#vcl_reg_no").val(),
                emp_id: $("#emp_id").val(),
                emp_contact: $("#emp_contact").val(),
                qr_size: qr_size,
                ecc: ecc,
                vchl_type:vchl_type
            },
            beforeSend: function() {
                $(".qrdiv").removeClass('loading');
                $(".qrdiv").addClass('qr-loading');                
            },
            success: function(resp) {
                $(".qrdiv").removeClass('qr-loading');
                $(".qrdiv").removeClass('loading-four-wheeler');
                $(".qrdiv").removeClass('loading-two-wheeler');

                if (vchl_type == 2) {
                    $(".qrdiv").addClass('loading-two-wheeler');
                    $(".qrdiv").html(resp);
                } else if (vchl_type == 4) {
                    $(".qrdiv").addClass('loading-four-wheeler');
                    $(".qrdiv").html(resp);
                } else {
                    $(".qrdiv").addClass('loading-two-wheeler');
                    $(".qrdiv").html(resp);
                }
            },
            complete: function() {
                $(".qrdiv").removeClass('loading');
            },
        });
        this.reset();
    });    
$('#js-print-link').on('click', function() {
    //$(this).parents('.qrdiv loading thumbnail').siblings('.qrdiv loading thumbnail').css('border','2px dashed red');
    //  var printBlock = $(".qrdiv loading thumbnail");
      //$("body > *:not(.qrdiv loading thumbnail)").css('display','none');
      
       //$("body > .loading").css('display','block');
      $('body').css('background','none'); 
      $('body > :not(.thumbnail)').css('display','none');
      $('.thumbnail').css({'height':'350px','width':'100%','border':'none'});
      $('.thumbnail').appendTo('body');
      window.new.print();     
       //$("body > .loading").css('display','block');
        //printBlock.show();
    });
});


</script>	
</body>
</html>