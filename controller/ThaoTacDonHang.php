<?php
include_once "../tool/Connection.php";
$conn = getConnectionData();
if ($conn->connect_error) {
	$conn->close();
} else {
	$sql = "update `Đơn Hàng` set Status = '$_GET[Loai]' where MaDon = $_GET[MaDon];";
	$conn->query($sql);
	if ($_GET['Loai']=='dang_giao') {
		$sql = "select * from `Sản Phẩm Đơn Hàng` where MaDon = $_GET[MaDon];";
		$ketQua = $conn->query($sql);
		if ($ketQua->num_rows>0) {
			while($sp = $ketQua->fetch_assoc()) {
				$sql = "update `Sản Phẩm` set SoLuongTonKho = SoLuongTonKho-$sp[SoLuong] where MaSP = $sp[MaSP];";
				$conn->query($sql);
			}
		}
	}
	if ($_GET['Loai']=='khach_tu_choi') {
		$sql = "select * from `Sản Phẩm Đơn Hàng` where MaDon = $_GET[MaDon];";
		$ketQua = $conn->query($sql);
		if ($ketQua->num_rows>0) {
			while($sp = $ketQua->fetch_assoc()) {
				$sql = "update `Sản Phẩm` set SoLuongTonKho = SoLuongTonKho+$sp[SoLuong] where MaSP = $sp[MaSP];";
				$conn->query($sql);
			}
		}		
	}
	if ($_GET['Loai']=='da_giao') {
		$sql = "select * from `Sản Phẩm Đơn Hàng` where MaDon = $_GET[MaDon];";
		$ketQua = $conn->query($sql);
		if ($ketQua->num_rows>0) {
			while($sp = $ketQua->fetch_assoc()) {
				$sql = "update `Sản Phẩm` set SoLuongDaBan = SoLuongDaBan+$sp[SoLuong] where MaSP = $sp[MaSP] and SoLuongDaBan IS NOT NULL;";
				$conn->query($sql);
				$sql = "update `Sản Phẩm` set SoLuongDaBan = $sp[SoLuong] where MaSP = $sp[MaSP] and SoLuongDaBan IS NULL;";
				$conn->query($sql);				
			}
		}			
	}
	$conn->close();
}
?>