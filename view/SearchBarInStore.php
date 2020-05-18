<?php
	include_once '../model/NguoiDungModel.php';
?>

<div class="search_bar">
    <div class="search_frame">
		<input type="text" placeholder="search">
	    <button>
            <a href="TrangCuaHang.php"><i class="fa fa-search"></i></a>
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
<div class="menu_bar">
    <ul class="nav nav-tabs nav-pills justify-content-center">
        <li class="nav-item"><a class="nav-link" href="TrangCuaHang.php"><span class="glyphicon glyphicon-home"></span> My shop</a></li>
        <li class="nav-item"><a class="nav-link" href="DuyetDonHang.php"><span class="fa fa-hourglass-half"></span> Đơn hàng chờ</a></li>
		<li class="nav-item"><a class="nav-link" href="GiaoDonHang.php"><span class="fa fa-truck"></span> Đơn đang giao</a></li>
        <li class="nav-item"><a class="nav-link" href="LichSuDonHang.php"><span class="glyphicon glyphicon-shopping-cart"></span> Lịch sử</a></li>
		<li class="nav-item"><a class="nav-link" href="TaoDauGia.php"><span class="fa fa-gavel"></span> Đấu giá</a></li>
		<li class="nav-item"><a class="nav-link" href="TrangThongKe.php"><span class="glyphicon glyphicon-list-alt"></span> Thống kê</a></li>
    </ul>
</div>
<div class="add_product">
    <a href="SuaThongTinSanPham.php"><i class="fa fa-plus-circle"></i></a>
</div>
<script language="javascript">
    $(document).ready(function () {
		$(document).on('click','.search_bar .search_frame a', function() {
			$(this).attr('href','TrangCuaHang.php?search='+$('.search_bar .search_frame input[type="text"]').val());
		});
	});
</script>