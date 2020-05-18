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
        <link rel="stylesheet" href="CSSForTrangChu.css">	
        <link rel="stylesheet" href="CSSForProfileNguoiDung.css">	
        <link rel="stylesheet" href="CSSForDonHangKhachHang.css">			
        <link rel="stylesheet" href="CSSForForm.css">			
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
		    include "../controller/ThongTinTaiKhoan.php";
		?>
		<div class="row nut_chuc_nang_profile">
		    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 item">
			    <div><i class="fa fa-3x fa-hourglass-half"></i></div>
				<div>Chờ xét duyệt</div>
			</div>
		    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 item">
			    <div><i class="fa fa-3x fa-truck"></i></div>
				<div>Đang giao</div>
			</div>
		    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 item">
			    <div><i class="fa fa-3x fa-archive"></i></div>
				<div>Đã giao</div>
			</div>
		    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 item">
			    <div><i class="fa fa-3x fa-pencil-square"></i></div>
				<div>Chỉnh sửa</div>
			</div>			
		</div>
		<div class="chuc_nang_profile">
		    <?php
		        include "FormSuaThongTinProfile.php";
		    ?>
			<div id="chucNangKhac"></div>
		</div>
		<script language="javascript">
		    $(document).ready(function (){
				$('.chuc_nang_profile').children().attr('hidden','true');
				$(document).on('click','.nut_chuc_nang_profile .item:eq(3)',function (){
					$('.chuc_nang_profile').children().attr('hidden','true');
					$('.chuc_nang_profile .sua_thong_tin_profile').removeAttr('hidden');
					$('.chuc_nang_profile .thong_bao_sau_nhap').removeAttr('hidden');
				});
				$(document).on('click','.nut_chuc_nang_profile .item:eq(0)',function (){

					$.ajax({
						url: "../controller/XuLyDonHangKhachHang.php",
						type: "post",
						dataType: "text",
						data: {
							LoaiHinh: "cho_xet",
							MaKH: <?php echo $_SESSION['MaKH']; ?>
						},
						success: function(result){
							$('.chuc_nang_profile').children().attr('hidden','true');
							$("#chucNangKhac").empty();
							$('#chucNangKhac').append(result).removeAttr('hidden');
							var don_hang_height = $('.don_hang_cho .de_muc div:eq(1)').width();
		                    $('.don_hang_cho .don_hang .san_pham').height(don_hang_height);
							$('.don_hang_cho .don_hang .san_pham .anh').height(don_hang_height);
						},
						error: function(){
							$("#chucNangKhac").empty()
							$('#chucNangKhac').append("<h1>Failed to load</h1>");
						}
					});
				});	
				$(document).on('click','.nut_chuc_nang_profile .item:eq(1)',function (){

					$.ajax({
						url: "../controller/XuLyDonHangKhachHang.php",
						type: "post",
						dataType: "text",
						data: {
							LoaiHinh: "dang_giao",
							MaKH: <?php echo $_SESSION['MaKH']; ?>
						},
						success: function(result){
							$('.chuc_nang_profile').children().attr('hidden','true');
							$("#chucNangKhac").empty();
							$('#chucNangKhac').append(result).removeAttr('hidden');
							var don_hang_height = $('.don_hang_cho .de_muc div:eq(1)').width();
		                    $('.don_hang_cho .don_hang .san_pham').height(don_hang_height);
							$('.don_hang_cho .don_hang .san_pham .anh').height(don_hang_height);							
						},
						error: function(){
							$("#chucNangKhac").empty();
							$('#chucNangKhac').append("<h1>Failed to load</h1>");
						}
					});		
				});	
				$(document).on('click','.nut_chuc_nang_profile .item:eq(2)',function (){

					$.ajax({
						url: "../controller/XuLyDonHangKhachHang.php",
						type: "post",
						dataType: "text",
						data: {
							LoaiHinh: "da_giao",
							MaKH: <?php echo $_SESSION['MaKH']; ?>
						},
						success: function(result){
							$('.chuc_nang_profile').children().attr('hidden','true');
							$("#chucNangKhac").empty();
							$('#chucNangKhac').append(result).removeAttr('hidden');
							var don_hang_height = $('.don_hang_cho .de_muc div:eq(1)').width();
		                    $('.don_hang_cho .don_hang .san_pham').height(don_hang_height);
							$('.don_hang_cho .don_hang .san_pham .anh').height(don_hang_height);							
						},
						error: function(){
							$("#chucNangKhac").empty();
							$('#chucNangKhac').append("<h1>Failed to load</h1>");
						}
					});
				});
		
			})
		</script>		
    </body>	
</html>
<?php
} else {
	header("Location: ../view/DangNhap.php", true, 301);
}
?>