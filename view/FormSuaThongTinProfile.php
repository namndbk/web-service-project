<?php
    if (isset($_SESSION['MaKH'])) {
		include_once "../tool/Connection.php";
	    $conn = getConnection();
	    if ($conn->connect_error) {
            $conn->close();		
	    } else {
		    $sql = "use BanHang;";
		    $conn->query($sql);	
			$sql = "select * from `Tài Khoản` where MaKH = $_SESSION[MaKH];";
			$ketQua = $conn->query($sql);
			if ($ketQua->num_rows>0) {
				$row = $ketQua->fetch_assoc();
			}
			$conn->close();
		}
    }
?>
<div class="row sua_thong_tin_profile">
<div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 col-xs-12 khung_info form_sua_profile">
    <div class="form_name">NHẬP THÔNG TIN NGƯỜI DÙNG</div>
	<div class="form_info">
	    <label>Tên tài khoản:</label>
		<?php
		    if (isset($row)) {
				echo "<div><i class=\"fa fa-user-circle-o\"></i><input name=\"ten_tai_khoan\" type=\"text\" value=\"$row[Ten]\"></div>";
			} else {
				echo "<div><i class=\"fa fa-user-circle-o\"></i><input name=\"ten_tai_khoan\" type=\"text\"></div>";
			}
		?>
	</div>
	<div class="form_info">
	    <label>Email:</label>
		<?php
		    if (isset($row)) {
				echo "<div><i class=\"fa fa-envelope\"></i><input name=\"email\" type=\"text\" value=\"$row[Email]\"></div>";
			} else {
				echo "<div><i class=\"fa fa-envelope\"></i><input name=\"email\" type=\"text\"></div>";
			}
		?>		
	</div>
	<div class="form_info">
	    <label>Số điện thoại:</label>
		<?php
		    if (isset($row)) {
				echo "<div><i class=\"fa fa-phone-square\"></i><input name=\"so_dien_thoai\" type=\"text\" value=\"$row[SDT]\"></div>";
			} else {
				echo "<div><i class=\"fa fa-phone-square\"></i><input name=\"so_dien_thoai\" type=\"text\"></div>";
			}
		?>			
	</div>
	<div class="form_info">
	    <label>Địa chỉ:</label>
		<?php
		    if (isset($row)) {
				echo "<div><i class=\"fa fa-home\"></i><input name=\"dia_chi\" type=\"text\" value=\"$row[DiaChi]\"></div>";
			} else {
				echo "<div><i class=\"fa fa-home\"></i><input name=\"dia_chi\" type=\"text\"></div>";
			}
		?>				
	</div>
<?php 
    if (!isset($_SESSION['MaKH'])) {
?>
 	<div class="form_info">
	    <label>Mật khẩu:</label>
		<div><i class="fa fa-key"></i><input name="mat_khau" type="password"></div>	
	</div>	
	<div class="form_info" hidden>
	    <label>Xác nhận mật khẩu:</label>
		<div><i class="fa fa-key"></i><input name="xac_nhan_mat_khau" type="password"></div>		
	</div>		
<?php
	}
?>	
	<div class="form_info">
		<div class="form_submit">
			<button type="submit">Lưu</button>
		</div>
	</div>	
</div>    
</div>
<div class="thong_bao_sau_nhap">
    <div class="status">Nhập thông tin thành công</div>
	<div class="xac_nhan"><button class="btn btn-xs btn-success">OK</button></div>
</div>
<script language="javascript">
    $(document).ready(function() {
		function checkThongTinProfile() {
			var flag = true;
			$('.form_sua_profile input[type="text"]').each(function() {
				if (!$(this).val().length) {
					flag = false;
				}
			});
<?php 
    if (!isset($_SESSION['MaKH'])) {
?>		
			$('.form_sua_profile input[type="password"]').each(function() {
				if (!$(this).val().length) {
					flag = false;
				}
			});			
			if (flag) {
				if ($('.form_sua_profile input[name="mat_khau"]').val().length) {
					if ($('.form_sua_profile input[name="mat_khau"]').val()==$('.form_sua_profile input[name="xac_nhan_mat_khau"]').val()) {
						flag = true;
					} else {
						flag = false;
					}
				}
			}
<?php
	}
?>	
			if (flag) {
				var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
				if (!emailReg.test($('.form_sua_profile input[name="email"]').val())) {
				    flag = false;
				}
			}
			if (flag) {
				var phoneReg = /^([0-9]{3})[.]([0-9]{3})[.]([0-9]{4})$/;
				if (!phoneReg.test($('.form_sua_profile input[name="so_dien_thoai"]').val())) {
				    flag = false;
				}
			}			
			return flag;
		};
<?php 
    if (!isset($_SESSION['MaKH'])) {
?>			
		$(document).on('keyup','.form_sua_profile input[name="mat_khau"]',function() {
			if ($(this).val().length) {
				$('.form_sua_profile input[name="xac_nhan_mat_khau"]').parent().parent().removeAttr('hidden');
			} else {
				$('.form_sua_profile input[name="xac_nhan_mat_khau"]').parent().parent().attr('hidden','true');
				$('.form_sua_profile input[name="xac_nhan_mat_khau"]').val("");				
			}
		});
<?php
	}
?>			
		$(document).on('click','.form_sua_profile .form_submit button',function() {
			if (checkThongTinProfile()) {
		    	$('.form_sua_profile').css('filter','blur(15px)');
		    	$.ajax ({
			    	url: "../controller/XuLyTaiKhoan.php",
			    	type: "post",
			    	dataType: "text",
			    	data: {
						<?php
                            if (isset($_SESSION['MaKH'])) {
								echo "MaKH : $_SESSION[MaKH],";
							}						
						?>
						Ten : $('.form_sua_profile input[name="ten_tai_khoan"]').val(),
						Email : $('.form_sua_profile input[name="email"]').val(),
						DiaChi : $('.form_sua_profile input[name="dia_chi"]').val(),
						SDT : $('.form_sua_profile input[name="so_dien_thoai"]').val(),
<?php 
    if (!isset($_SESSION['MaKH'])) {
?>							
						Password : $('.form_sua_profile input[name="mat_khau"]').val(),
<?php
	}
?>							
					},
			    	success: function(result) {
			    	    $('.thong_bao_sau_nhap .status').html(result);
				        $('.form_sua_profile').css('filter','blur(15px)');
				        $('.thong_bao_sau_nhap').css('bottom','20px');   				
						if (result.indexOf("Cập nhật tài khoản thành công!")!=-1) {							
							$('.thong_tin_nguoi_dung .muc_thong_tin:eq(0) div').html($('.form_sua_profile input[name="ten_tai_khoan"]').val());
							$('.thong_tin_nguoi_dung .muc_thong_tin:eq(1) div').html($('.form_sua_profile input[name="email"]').val());
							$('.thong_tin_nguoi_dung .muc_thong_tin:eq(2) div').html($('.form_sua_profile input[name="so_dien_thoai"]').val());
							$('.thong_tin_nguoi_dung .muc_thong_tin:eq(3) div').html($('.form_sua_profile input[name="dia_chi"]').val());
						}
				    },
					error: function(){
			    	    $('.thong_bao_sau_nhap .status').html('Thât bại! Đã có lỗi xảy ra.');
				        $('.form_sua_profile').css('filter','blur(15px)');
				        $('.thong_bao_sau_nhap').css('bottom','20px');	                                
                    }
				}); 		    			
			} else {
		    	$('.thong_bao_sau_nhap .status').html('Thông tin nhập chưa chính xác');
				$('.form_sua_profile').css('filter','blur(15px)');
				$('.thong_bao_sau_nhap').css('bottom','20px');		
		    }
		});		
		$(document).on('click','.thong_bao_sau_nhap button',function() {
			$(this).parent().parent().css('bottom','-14rem');
			$('.form_sua_profile').css('filter','none');
		});
	});
</script>
