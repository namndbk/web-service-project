<?php
    session_start();
	if (isset($_SESSION['MaKH'])) {
		unset($_SESSION['MaKH']);
	}
	header("Location: ../view/DangNhap.php", true, 301);
?>