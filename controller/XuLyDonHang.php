<div class="nhan_san_pham">ĐƠN HÀNG CỦA BẠN</div>

<div class="row muc_don_hang don_hang_sap_mua">
    <div class="title">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	    <div class="col-lg-2 col-md-2 col-sm-3 col-xs-3">Ảnh</div>
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">Tên sản phẩm</div>
		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">Số lượng</div>
		<div class="col-lg-4 col-md-4 col-sm-3 col-xs-3">Thành tiền</div>		
	</div>
	</div>
</div>
<?php
if (isset($_SESSION['MaKH'])) {
    include_once "../tool/XuLyMang.php";
    include_once "../tool/Connection.php";
	include_once "../model/DonHang.php";
    $conn = getConnection();
    if ($conn->connect_error) {
	    $conn->close();
    } else {
	    if (isset($_POST['MaSP'])) {
            $_SESSION['ListDonHang'] = $_POST['MaSP'];			
			$sql = "use BanHang;";
		    $conn->query($sql);
	        $listHang = catDonHang($_POST['MaSP']);
			$listDon = array();
	        foreach ($listHang as $key=>$value) {
		        $maSP = getMaSP($value);
				$sl = getSL($value);
				$sql = "select * from `Sản Phẩm` where MaSP = $maSP and Deleted IS NULL and SoLuongTonKho>=$sl;";
			    $ketQua = $conn->query($sql);
			    if ($ketQua->num_rows>0) {
				    $row = $ketQua->fetch_assoc();
					$maCH = $row['MaCH'];
				    if (isset($listDon[$maCH])) {
						$listDon[$maCH]->themSP($maSP,$sl);
					} else {
						$listDon[$maCH] = new DonHang();
						$listDon[$maCH]->themSP($maSP,$sl);
					}
			    }			
	        }   
            $tongDon = 0;			
	        foreach ($listDon as $key=>$value) {
		        $tongDon = $tongDon + $value->inSanPham($key);			
	        } 
            echo "<div style=\"color: #cf0000;font-size: 2rem;text-align: center; margin-top: 4rem; margin-bottom: 4rem;\">";
            echo "Tổng đơn: ";
			echo tienSangXau(strval($tongDon));
            echo "</div>";
            echo "<div style=\"text-align: center; margin-bottom: 4rem;\">";
            echo "<a href=\"ThongTinGiaoHang.php\"><button class=\"btn btn-lg btn-success\">Tiếp tục</button></a>";
            echo "</div>";			
        }
		$conn->close();
    }	
} else {
	header("Location: ../view/DangNhap.php", true, 301);	
}
?>
<script language="javascript">
    $(document).ready(function() {
		var duyet_don_height = parseInt($('.don_hang_sap_mua .don_hang .mat_hang div:eq(0)').width());
		$('.don_hang_sap_mua .don_hang .mat_hang .item').height(duyet_don_height+'px');
		$('.don_hang_sap_mua .don_hang .tong_tien').height(duyet_don_height/3+'px');
		
		$(window).resize(function() {
			duyet_don_height = parseInt($('.don_hang_sap_mua .don_hang .mat_hang div:eq(0)').width());
		    $('.don_hang_sap_mua .don_hang .mat_hang .item').height(duyet_don_height+'px');
		    $('.don_hang_sap_mua .don_hang .tong_tien').height(duyet_don_height/3+'px');
		});	
	});
</script>