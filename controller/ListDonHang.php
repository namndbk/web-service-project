<div class="row muc_don_hang don_hang_cho_duyet">
    <div class="title">
	<div class="col-lg-11 col-md-11 col-sm-11 col-xs-11">
	    <div class="col-lg-2 col-md-2 col-sm-3 col-xs-3">Ảnh</div>
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">Tên sản phẩm</div>
		<div class="col-lg-4 col-md-4 col-sm-3 col-xs-3">Thành tiền</div>
		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">Trong kho</div>
	</div>
	<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
	    Thao tác
	</div>	
	</div>
</div>
<?php
    if (isset($_GET['Type'])) {
		include_once "../tool/Connection.php";
		include_once "../tool/XuLyGia.php";
		$conn = getConnectionData();
		if ($conn->connect_error) {
			$conn->close();
		} else {
			$sql = "select * from `Đơn Hàng` where MaCH = $_SESSION[MaKH] and Status='$_GET[Type]' ";
			if ($_GET['Type']=='da_giao') {
				$sql.= "order by MaDon desc;";
			} else {
				$sql.= ";";
			}
			$ketQua = $conn->query($sql);
			if ($ketQua->num_rows>0) {												
				while ($dh = $ketQua->fetch_assoc()) {
					echo "<div name=\"$dh[MaDon]\" class=\"row muc_don_hang don_hang_cho_duyet\">";
					echo "<div class=\"don_hang\">";
					echo "<div class=\"thong_tin col-lg-11 col-md-11 col-sm-11 col-xs-11\">";
					$sql = "select * from `Sản Phẩm Đơn Hàng`, `Sản Phẩm` where `Sản Phẩm Đơn Hàng`.MaDon = $dh[MaDon]";
        			$sql.= " and `Sản Phẩm Đơn Hàng`.MaSP = `Sản Phẩm`.MaSP;";
					$ketQua2 = $conn->query($sql);
					if ($ketQua2->num_rows>0) {
						while ($sp = $ketQua2->fetch_assoc()) {
							echo "<div class=\"mat_hang\">";
							echo "<div class=\"col-lg-2 col-md-2 col-sm-3 col-xs-3 item anh\">";
							if ($sp['Image1']=="") {
								echo "<img width=\"100%\" height=\"100%\" src=\"Images/sanphamtrong.php\">";
							} else {
								echo "<img width=\"100%\" height=\"100%\" src=\"$sp[Image1]\">";
							}
							echo "</div>";
							echo "<div class=\"col-lg-4 col-md-4 col-sm-4 col-xs-4 item ten\">$sp[TenSP](x$sp[SoLuong])</div>";
							$thanhTien = tienSangXau($sp['ThanhTien']);
							echo "<div class=\"col-lg-4 col-md-4 col-sm-3 col-xs-3 item thanh_tien\">$thanhTien</div>";
							echo "<div class=\"col-lg-2 col-md-2 col-sm-2 col-xs-2 item hien_con\">$sp[SoLuongTonKho]</div>";
							echo "</div>";
						}
					}
			        echo "<div class=\"khach_hang\">";
				    echo "<div class=\"ten\">Người nhận: $dh[TenNguoiNhan]</div>";
				    echo "<div class=\"so_dien_thoai\">SĐT: $dh[SDT]</div>";
			        echo "</div>";
			        echo "<div class=\"dia_chi\">Địa chỉ: $dh[DiaChi]</div>";	
					$tongTien = tienSangXau($dh['TongTien']);
			        echo "<div class=\"tong_tien\">Tổng tiền: $tongTien</div>";
		            echo "</div>";
		            echo "<div class=\"thao_tac col-lg-1 col-md-1 col-xs-1 col-sm-1\">";
			        echo "<div class=\"xac_nhan\"><i class=\"fa fa-check-square\"></i></div>";
			        echo "<div class=\"tu_choi\"><i class=\"fa fa-times-circle\"></i></div>";
		            echo "</div>";		
	                echo "</div>";
					echo "</div>";
				}
			}
			$conn->close();
		}
	}
?>
</div>
<script language="javascript">
    $(document).ready(function() {
		var duyet_don_height = parseInt($('.don_hang_cho_duyet .don_hang .mat_hang div:eq(0)').width());
		$('.don_hang_cho_duyet .don_hang .mat_hang .item').height(duyet_don_height+'px');
		$('.don_hang_cho_duyet .don_hang .tong_tien').height(duyet_don_height/3+'px');
		
		$(window).resize(function() {
			duyet_don_height = parseInt($('.don_hang_cho_duyet .don_hang .mat_hang div:eq(0)').width());
		    $('.don_hang_cho_duyet .don_hang .mat_hang .item').height(duyet_don_height+'px');
		    $('.don_hang_cho_duyet .don_hang .tong_tien').height(duyet_don_height/3+'px');
		});
	
	});
</script>
