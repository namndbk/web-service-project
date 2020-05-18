<?php
    session_start();
	include_once "../tool/Connection.php";
	$conn = getConnection();
	if ($conn->connect_error) {
        $conn->close();
        $_SESSION['TrangThaiDangNhap'] = "Đăng nhập thất bại";		
        header("Location: ../view/DangNhap.php", true, 301);	
	} else {
		$sql = "use BanHang;";
		$conn->query($sql);
		$sql = "select * from `Tài Khoản` where Email = '$_POST[email]' and Password = '$_POST[password]';";
		$ketQua = $conn->query($sql);
		if ($ketQua->num_rows > 0) {
			$row = $ketQua->fetch_assoc();
			$_SESSION['MaKH'] = $row['MaKH'];
			$conn->close();
			header("Location: ../view/TrangChu.php", true, 301);	
		} else {
			$_SESSION['TrangThaiDangNhap'] = "Thông tin tài khoản không chính xác";
			$conn->close();
			header("Location: ../view/DangNhap.php", true, 301);	
		}			
	}		
?>