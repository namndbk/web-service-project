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
        <link rel="stylesheet" href="../view/CSSForTrangChu.css">	
        <link rel="stylesheet" href="../view/CSSForCuaHang.css">	
        <link rel="stylesheet" href="../view/CSSForForm.css">		
        <script src="https://kit.fontawesome.com/a076d05399.js"></script>			
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
		<div class="nhan_san_pham">SẢN PHẨM ĐANG ĐƯỢC ĐẤU GIÁ</div>		
		<div class="row trang_dau_gia">
		    <?php
			    $_GET['Type'] = 'MyShop';
			    include "../controller/ListSanPhamDauGia.php";
			?>	
		</div>
        <?php  
            include "FormDauGia.php";
        ?>			
	<script language="javascript">
		$(document).ready(function (){
			$('.menu_bar .nav li:eq(4)').addClass('active');	
			var height_dau_gia = $('.trang_dau_gia .col-lg-4').width();
			height_dau_gia = parseInt(height_dau_gia);
			$('.trang_dau_gia .col-lg-4 .product_frame_2').height(height_dau_gia/3 + 'px');
			$('.trang_dau_gia .col-lg-4 .product_frame_2').css('margin-bottom','1rem');
		    $('.trang_dau_gia .col-lg-4 .product_frame_2 .product_image').height(height_dau_gia/3 + 'px');
			$('.trang_dau_gia .col-lg-4 .product_frame_2 .product_image').width(height_dau_gia/3 + 'px');
			$('.trang_dau_gia .col-lg-4 .product_frame_2 .dau_gia_info').width(1.8*height_dau_gia/3 + 'px');
			$(window).resize(function() {
				height_dau_gia = $('.trang_dau_gia .col-lg-4').width();
			    height_dau_gia = parseInt(height_dau_gia);
			    $('.trang_dau_gia .col-lg-4 .product_frame_2').height(height_dau_gia/3 + 'px');
		        $('.trang_dau_gia .col-lg-4 .product_frame_2 .product_image').height(height_dau_gia/3 + 'px');
			    $('.trang_dau_gia .col-lg-4 .product_frame_2 .product_image').width(height_dau_gia/3 + 'px');
				$('.trang_dau_gia .col-lg-4 .product_frame_2 .dau_gia_info').width(1.8*height_dau_gia/3 + 'px');
			});
		});
	</script>		
    </body>	
</html>