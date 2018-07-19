<!-- CSS -->

<link rel="shortcut icon" type="image/png" href="../images/tel-icon.png"/>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" />
<link rel="stylesheet" href="../css/main.style.css">
<link rel="stylesheet" href="../css/style.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">

<!-- JavaScripts -->

<!--<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>-->

<script type="text/javascript" src="../js/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

<script type="text/javascript">
//Scrolling Title
var scrl = "Vehicle Security QR Generator | Tata Elxsi Limited | ";
function scrlsts() {
scrl = scrl.substring(1, scrl.length) + scrl.substring(0,1); 
document.title = scrl;
setTimeout("scrlsts()", 300);
}
window.onload = scrlsts();   

$(window).load(function() {
			// will first fade out the loading animation 
			$("#loader").fadeOut("slow", function(){

			// will fade out the whole DIV that covers the website.
			$("#preloader").delay(300).fadeOut("slow");
		  }); 
})
$(document).ready(function () {
             	$('#sidebar').toggleClass('active');
                 $('#sidebarCollapse').on('click', function () {
                     $('#sidebar').toggleClass('active');
                 });
             });
</script>