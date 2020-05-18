<?php
	include_once '../model/NguoiDungModel.php';
?>

<div class="search_bar">
    <div class="search_frame">
		<input type="text" placeholder="search">
	    <button>
            <a href="SearchSanPham.php"><i class="fa fa-search"></i></a>
        </button>
	</div>
    <div class="login_frame">
		<?php if(!isset($_SESSION['MaKH'])) { ?>
			<div> 
				<a href="DangNhap.php">Đăng nhập</a>
			</div>
		<?php } else {
				$nguoiDungModel = new NguoiDungModel();
				$nguoiDung = $nguoiDungModel->getNguoiDungByID($_SESSION['MaKH']);
			?>
			<div> 
		    	<a href="ProfileNguoiDung.php"><?php echo $nguoiDung->ten ?></a>
			</div>
		<?php } ?>
		<?php if(!isset($_SESSION['MaKH'])) { ?>
			<div> 
				<a href="../view/TaoTaiKhoan.php">Đăng ký</a>
			</div>
		<?php } else {
			?>
			<div> 
		    	<a href="../controller/XuLyDangXuat.php">Đăng xuất</a>
			</div>
		<?php } ?>			
	</div>
</div>
<script language="javascript">
    $(document).ready(function () {
		$(document).on('click','.search_bar .search_frame a', function() {
			$(this).attr('href','SearchSanPham.php?type=TimKiem&xauTK='+$('.search_bar .search_frame input[type="text"]').val());
		});
	});
</script>