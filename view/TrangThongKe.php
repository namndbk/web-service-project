<?php
session_start();
if (isset($_SESSION['MaKH'])) {
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
		<?php
		    include "SoLieuThongKe.php";
		?>	
	    <div class="nhan_san_pham">SẢN PHẨM ƯA THÍCH</div>
		<?php
		    $_GET['type']="UaThich";
		    include "../controller/ListSanPhamCuaHang.php";
		?>			
	    <div class="nhan_san_pham">SẢN PHẨM BÁN CHẠY</div>
		<?php
		    $_GET['type']="BanChay";
		    include "../controller/ListSanPhamCuaHang.php";
		?>				
		<div class="nhan_san_pham">SẢN PHẨM TỒN KHO NHIỀU</div>
		<?php
		    $_GET['type']="TonKho";
		    include "../controller/ListSanPhamCuaHang.php";
		?>				
		<script language="javascript">
		    $(document).ready(function (){
				$('.menu_bar .nav li:eq(5)').addClass('active');
			    $(window).scroll(function (){
					if($(window).scrollTop() + $(window).height() == $(document).height()) {
				        				
                    }
				})
			})
		</script>		
    </body>	
</html>
<?php
} else {
	header("Location: ../view/DangNhap.php", true, 301);
}
?>