<?php
	include_once "../tool/Connection.php";
	$conn = getConnection();
	if ($conn->connect_error) {
        $conn->close();		
	} else {
		$sql = "use BanHang;";
		$conn->query($sql);	
		if (isset($_POST['MaKH'])) {
			$sql = "select * from `Tài Khoản` where Email = '$_POST[Email]' and MaKH != $_POST[MaKH];";
            $ketQua = $conn->query($sql);
		    if ($ketQua->num_rows > 0) {
			    echo "Email không khả dụng!";
		    } else {
				$sql = "update `Tài Khoản` set ";
			    $sql.= "Ten = '$_POST[Ten]', DiaChi = '$_POST[DiaChi]', Email = '$_POST[Email]', SDT = '$_POST[SDT]' ";
			    $sql.= "where MaKH = $_POST[MaKH];";
			    if ($conn->query($sql)) {
					echo "Cập nhật tài khoản thành công!";
				} else {
					echo "Cập nhật tài khoản thất bại!";
				};
			}
		} else {
			$sql = "select * from `Tài Khoản` where Email = '$_POST[Email]'";
            $ketQua = $conn->query($sql);
		    if ($ketQua->num_rows > 0) {
			    echo "Email không khả dụng!";
		    } else {
			    $sql = "insert into `Tài Khoản`(Ten, DiaChi, Email, Password, SDT) values";
			    $sql.= "('$_POST[Ten]','$_POST[DiaChi]','$_POST[Email]','$_POST[Password]','$_POST[SDT]');";
			    if ($conn->query($sql)) {
					echo "Tạo tài khoản thành công!";
				} else {
					echo "Tạo tài khoản thất bại!";
				};	
		    }	
		}
		$conn->close();	
	}	
?>		