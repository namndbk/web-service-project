<?php
include_once "../tool/Connection.php";
include_once "../tool/XuLyGia.php";
$conn = getConnectionData();
if ($conn->connect_error) {
	$conn->close();
} else {
	if (isset($_GET['Type'])) {
		if ($_GET['Type']=='MyShop') {
			$sql = "select * from `Đấu Giá`,`Sản Phẩm` where `Sản Phẩm`.MaCH =$_SESSION[MaKH] and startDate <= now()";
        	$sql.= " and endDate >= now() and `Đấu Giá`.MaSP=`Sản Phẩm`.MaSP;";
		} else {
			if ($_GET['Type']=='TrangChu') {
				$sql = "select * from `Đấu Giá`,`Sản Phẩm` where startDate <= now() and endDate >= now() and `Đấu Giá`.MaSP=`Sản Phẩm`.MaSP limit 6;";
			} else {
				$sql = "select * from `Đấu Giá`,`Sản Phẩm` where startDate <= now() and endDate >= now() and `Đấu Giá`.MaSP=`Sản Phẩm`.MaSP;";
			}
		}
	} else {
		$sql = "select * from `Đấu Giá`,`Sản Phẩm` where startDate <= now() and endDate >= now() and `Đấu Giá`.MaSP=`Sản Phẩm`.MaSP;";
	}
	$ketQua = $conn->query($sql);
	if (isset($_GET['Type'])&&$_GET['Type']=='TrangChu') {
		if ($ketQua->num_rows>0) {
			while ($sp=$ketQua->fetch_assoc()) {
				echo "<a href=\"TrangDauGia.php?MaSP=$sp[MaSP]\">";
				echo "<div class=\"col-lg-4 col-md-6 col-sm-12 col-xs-12\">";		    
				echo "<div class=\"product_frame_2\">";
				echo "<div class=\"product_image\">";
				if ($sp['Image1']=="") {
					echo "<img width=\"100%\" height=\"100%\" src=\"Images/sanphamtrong.png\">";
				} else {
					echo "<img width=\"100%\" height=\"100%\" src=\"$sp[Image1]\">";
				}			
				echo "</div>";
				echo "<div class=\"dau_gia_info\">";
				echo "<div class=\"product_name\">$sp[TenSP]</div>";
				$gia = tienSangXau($sp['GiaGiam']);
				echo "<div class=\"product_cost\">$gia</div>";	                
				echo "</div></div></div></a>";					
			}
		}					
	} else {
		if ($ketQua->num_rows>0) {
			while ($sp=$ketQua->fetch_assoc()) {
				echo "<div>";
				echo "<a href=\"TrangDauGia.php?MaSP=$sp[MaSP]\">";
				echo "<div class=\"col-lg-4 col-md-4 col-sm-6 col-xs-12\">";		    
				echo "<div class=\"product_frame_2\">";
				echo "<div class=\"product_image\">";
				if ($sp['Image1']=="") {
					echo "<img width=\"100%\" height=\"100%\" src=\"Images/sanphamtrong.png\">";
				} else {
					echo "<img width=\"100%\" height=\"100%\" src=\"$sp[Image1]\">";
				}			
				echo "</div>";
				echo "<div class=\"dau_gia_info\">";
				echo "<div class=\"product_name\">$sp[TenSP]</div>";
				$gia = tienSangXau($sp['GiaGiam']);
				echo "<div class=\"product_cost\">$gia</div>";	                
				echo "</div></div></div></a></div>";				
			}
		}		
	}
}
?>