<?php
session_start();
if (isset($_SESSION['MaKH'])) {
	include_once "../tool/Connection.php";
	$conn = getConnection();
	if ($conn->connect_error) {
        $conn->close();		
	} else {
		$sql = "use BanHang;";
		$conn->query($sql);
		$sql = "select * from `Sản Phẩm` where MaSP = $_GET[MaSP];";
		$ketQua = $conn->query($sql);
		if ($ketQua->num_rows > 0) {
			$row = $ketQua->fetch_assoc();
			$soDG = intval($row['SoLuongDanhGia']);
			$dgTB = floatval($row['DanhGiaTB']);
			$dgTB = $dgTB*$soDG;
			$dgTB = $dgTB+intval($_GET['DanhGia']);
			$soDG = $soDG+1;
			$dgTB = $dgTB/$soDG;
			$sql = "update `Sản Phẩm` set SoLuongDanhGia=$soDG, DanhGiaTB=$dgTB where MaSP = $_GET[MaSP];";
			$conn->query($sql);
			echo $dgTB;
		}
		$conn->close();
	}
} else {
	include_once "../tool/Connection.php";
	$conn = getConnection();
	if ($conn->connect_error) {
        $conn->close();		
	} else {
		$sql = "use BanHang;";
		$conn->query($sql);
		$sql = "select * from `Sản Phẩm` where MaSP = $_GET[MaSP];";
		$ketQua = $conn->query($sql);
		if ($ketQua->num_rows > 0) {
			$row = $ketQua->fetch_assoc();
			$dgTB = floatval($row['DanhGiaTB']);
			echo $dgTB;
		}
		$conn->close();
	}		
}	
?>