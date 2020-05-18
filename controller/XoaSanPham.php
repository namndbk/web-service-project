<?php
if (isset($_GET['MaSP'])) {
	include_once "../tool/Connection.php";
	$conn = getConnection();
	if ($conn->connect_error) {
        $conn->close();		
	} else {
		$sql = "use BanHang;";
		$conn->query($sql);
		$sql = "update `Sản Phẩm` set Deleted='True' where MaSP = $_GET[MaSP];";
		$conn->query($sql);
		$conn->close();
	}		
}
?>