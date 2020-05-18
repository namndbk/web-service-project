<?php
    include_once '../tool/Connection.php';
	include_once '../tool/XuLyGia.php';
    include_once '../model/DonHang.php';
    $loaiHinh = $_POST['LoaiHinh'];
    $maKH = $_POST['MaKH'];
    $donHangModel = new DonHang(); 
    $donHangs = $donHangModel->getDonHangKhachHang($loaiHinh, $maKH);

?>

<div class="row hang_muc_don_hang don_hang_cho">
    <div class="de_muc">
    <?php $title = 'None';
        if ($loaiHinh == 'cho_xet') $title = 'ĐƠN HÀNG CHỜ XÉT DUYỆT';
        else if($loaiHinh == 'dang_giao') $title = 'ĐƠN HÀNG ĐANG GIAO';
        else if($loaiHinh == 'da_giao') $title = 'ĐƠN HÀNG ĐÃ GIAO';
    ?>
	    <div class='title'><?php echo $title ?></div>
	    <div class="col-lg-2 col-md-3 col-xs-3 col-sm-3 ">Ảnh</div>
		<div class="col-lg-4 col-md-3 col-xs-3 col-sm-3 ">Tên sản phẩm</div>
		<div class="col-lg-3 col-md-3 col-xs-3 col-sm-3 ">Số lượng</div>
		<div class="col-lg-3 col-md-3 col-xs-3 col-sm-3 ">Thành tiền</div>
	</div>
    <?php for ($i = 0; $i < count($donHangs); $i++){
             $donHang = $donHangs[$i];
             $sanPhams = $donHangModel->getSanPhamFromDonHang($donHang['MaDon']);
    ?>
    <div class="don_hang">
        <?php for ($j = 0; $j < count($sanPhams); $j++){  
            $sanPham = $sanPhams[$j];    
        ?>
            <div class="row san_pham">
                <div class="col-lg-2 col-md-3 col-xs-3 col-sm-3 anh"><img width="100%" height="100%" src="<?php echo $sanPham['Image']; ?>"></div>
                <div class="col-lg-4 col-md-3 col-xs-3 col-sm-3 ten_san_pham"><a href="../view/SanPhamChiTiet.php?MaSP=<?php echo $sanPham['MaSP'] ?>"><?php echo $sanPham['TenSP']; ?></a></div>
                <div class="col-lg-3 col-md-3 col-xs-3 col-sm-3 so_luong"><?php echo $sanPham['SoLuong']; ?></div>
                <div class="col-lg-3 col-md-3 col-xs-3 col-sm-3 thanh_tien"><?php echo tienSangXau($sanPham['GiaGiam']); ?>VND</div>
            </div>
        <?php } ?>	
		<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12 cua_hang">
            <div class="ten_cua_hang">Người nhận: <?php echo $donHang['TenNguoiNhan']; ?></div>
		</div>		
        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12 ngay_dat">Ngày đặt: <?php echo $donHang['NgayThang']; ?></div>		
		<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12 cua_hang">
		    <div class="ten_cua_hang">Cửa hàng: <?php echo $donHang['TenCuaHang']; ?></div>
			<div class="so_dien_thoai">SĐT: <?php echo $donHang['SDT']; ?></div>
			<div class="so_dien_thoai">Địa chỉ: <?php echo $donHang['DiaChi']; ?></div>
		</div>
        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12 tong_tien">Tổng tiền: <?php echo tienSangXau($donHang['TongTien']); ?></div>		
	</div>

    <?php } ?>
</div>

<script language="javascript">
    $(document).ready(function() {
		$(window).resize(function() {
		    var don_hang_height = $('.don_hang_cho .de_muc div:eq(1)').width();
		    $('.don_hang_cho .don_hang .san_pham').height(don_hang_height);
            $('.don_hang_cho .don_hang .san_pham .anh').height(don_hang_height);			
		});	
	});
</script>

