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
        <link rel="stylesheet" href="../view/CSSForForm.css">		
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
		    include "SearchBar.php";
		?>
		<?php
		    include "DanhMuc.php";
		?>
		
<div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 col-xs-12 khung_info form_thong_tin_giao_hang">
    <div class="form_name">NHẬP THÔNG TIN KHÁCH HÀNG</div>
	<div class="form_info">
	    <label>Tên người nhận:</label>
		<div><i class="fa fa-user-circle-o"></i><input name="ten_tai_khoan" type="text"></div>
	</div>
	<div class="form_info">
	    <label>Số điện thoại:</label>
		<div><i class="fa fa-phone-square"></i><input name="so_dien_thoai" type="text"></div>
	</div>
	<div class="form_info">
	    <label>Địa chỉ:</label>
		<div><i class="fa fa-home"></i><input name="dia_chi" type="text"></div>
	</div>	
	<div class="form_info">
		<div class="form_submit">
			<button type="submit">Đặt hàng</button>
		</div>
	</div>	
</div>   

<div class="thong_bao_sau_nhap">
    <div class="status">Đặt hàng thành công</div>
	<div class="xac_nhan"><button class="btn btn-xs btn-success">OK</button></div>
</div>
<script language="javascript">
    $(document).ready(function() {
		function checkThongTinProfile() {
			var flag = 1;
			$('.form_thong_tin_giao_hang input[type="text"]').each(function() {
				if ($(this).val().length==0) {
					flag = 0;
				}
			});
			if (flag==1) {
				var phoneReg = /^([0-9]{3})[.]([0-9]{3})[.]([0-9]{4})$/;
				if (!phoneReg.test($('.form_thong_tin_giao_hang input[name="so_dien_thoai"]').val())) {
				    flag = 0;
				}
			}					
			return flag;
		};
		$(document).on('click','.form_thong_tin_giao_hang .form_submit button',function() {
			if (checkThongTinProfile()==1) {
			    $.ajax ({
			    	url: "../controller/HoanThanhDatHang.php",
			    	type: "post",
			    	dataType: "text",
			    	data: {
						Ten : $('.form_thong_tin_giao_hang input[name="ten_tai_khoan"]').val(),
						SDT : $('.form_thong_tin_giao_hang input[name="so_dien_thoai"]').val(),
						DiaChi : $('.form_thong_tin_giao_hang input[name="dia_chi"]').val()
					},
			    	success: function(result) {
		    	        $('.form_thong_tin_giao_hang').css('filter','blur(15px)');
		    	        $('.thong_bao_sau_nhap .status').html(result);							
		    	        $('.thong_bao_sau_nhap').css('bottom','20px');	
                        $.ajax ({
			                url: "../controller/XuLyGioHang.php",
			                type: "get",
			                dataType: "text",
			                data: {
				                YCBasket: 'Dem'
			                },
			                success: function(result) {
			                    $('.wishlist_giohang .item .number:eq(1)').html(result);   
			                },
			                error: function(){
			                    $('.wishlist_giohang .item .number:eq(1)').html('0');                           
                            }
		                });							
				    },
				    error: function(){
		    	        $('.form_thong_tin_giao_hang').css('filter','blur(15px)');
		    	        $('.thong_bao_sau_nhap .status').html('Yêu cầu thất bại');					
		    	        $('.thong_bao_sau_nhap').css('bottom','20px');		                        
                    }
				});							
			} else {
		    	$('.form_thong_tin_giao_hang').css('filter','blur(15px)');
		    	$('.thong_bao_sau_nhap .status').html('Hãy thông tin đầy đủ và hợp lệ');				
		    	$('.thong_bao_sau_nhap').css('bottom','20px');					
			}
		});		
		$(document).on('click','.thong_bao_sau_nhap button',function() {
			$(this).parent().parent().css('bottom','-14rem');
			$('.form_thong_tin_giao_hang').css('filter','none');
		});
	});
</script>
		
    </body>	
</html>