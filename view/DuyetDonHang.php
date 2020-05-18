<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">	
	    <!--Boostrap-->
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="/Project/view/CSSForTrangChu.css">	
        <link rel="stylesheet" href="/Project/view/CSSForCuaHang.css">	
        <link rel="stylesheet" href="/Project/view/CSSForMucDonHang.css">			
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	    <!--Jquery-->
	    <script language="javascript" src="http://code.jquery.com/jquery-2.0.0.min.js"></script>
		<!--css-->	    
	</head>
    <body>
	    <?php
		    include "Banner.php";
		?>
		<?php
		    include "SearchBarInStore.php";
		?>
		<div class="nhan_san_pham">ĐƠN HÀNG CHỜ DUYỆT</div>
        <?php
		    $_GET['Type'] = "cho_xet";
            include "../controller/ListDonHang.php";
        ?>			
		<script language="javascript">
		    $(document).ready(function (){
				$(document).on('click','.don_hang_cho_duyet .thao_tac .xac_nhan i',function () {
					var element = $(this).parent().parent().parent().parent();
					$.ajax({
						url: "../controller/ThaoTacDonHang.php",
						type: "get",
						dataType: "text",
						data: {
							MaDon: element.attr('name'),
							Loai: 'dang_giao',
						},
						success: function(result) {
						},
						error: function() {
						}
					});
					element.remove();
				});
				
				$(document).on('click','.don_hang_cho_duyet .thao_tac .tu_choi i',function () {
					var element = $(this).parent().parent().parent().parent();
					$.ajax({
						url: "../controller/ThaoTacDonHang.php",
						type: "get",
						dataType: "text",
						data: {
							MaDon: element.attr('name'),
							Loai: 'tu_choi',
						},
						success: function(result) {
						},
						error: function() {
						}
					});					
					element.remove();
				});	
			})
		</script>		
    </body>	
</html>