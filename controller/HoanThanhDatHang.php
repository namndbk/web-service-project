<?php
session_start();
if (isset($_SESSION['MaKH'])) {
    include_once "../tool/XuLyMang.php";
    include_once "../tool/Connection.php";
	include_once "../model/DonHang.php";
    $conn = getConnection();
    if ($conn->connect_error) {
	    $conn->close();
		echo "Đặt hàng thất bại!";
    } else {
	    if (isset($_SESSION['ListDonHang'])) {		
			$sql = "use BanHang;";
		    $conn->query($sql);
	        $listHang = catDonHang($_SESSION['ListDonHang']);
			$listDon = array();
			$flag = true;
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
			    } else {
					$flag = false;
				}				
	        }
            if ($flag) {			
	            foreach ($listDon as $key=>$value) {
		            $value->themVaoDatabase($conn,$key);		
	            } 
				echo "Tạo đơn hàng thành công";
				unset($_SESSION['ListDonHang']);
			} else {
				echo "Số lượng trong kho không đủ";
			}			
        } else {
			echo "Đặt hàng thất bại!";
		}
		$conn->close();
    }	
} else {
	header("Location: ../view/DangNhap.php", true, 301);	
}
?>