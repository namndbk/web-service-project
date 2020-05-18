<?php
session_start();
if (isset($_SESSION['MaKH'])) {
	include_once "../tool/Connection.php";
	$conn = getConnection();
	if ($conn->connect_error) {
		echo "Kết nối tới cơ sở dữ liệu thất bại";
		$conn->close();		
	} else {
		$sql = "use BanHang;";		
		if ($conn->query($sql) === false) {
			echo "Kết nối tới database thất bại";
			$conn->close();
		} else {
			$TenSP = $_POST['TenSP'];
			$GiaGoc = str_replace('.','',$_POST['GiaGoc']);
			$GiaGiam = $GiaGoc;
			$SoLuongTonKho = 1;
			$Description = $_POST['Description'];
			$LoaiSP = $_POST['LoaiSP'];
			$Image1 = null;
			$Image2 = null;
			$Image3 = null;
			if (!empty($_FILES['Image1'])) {
				move_uploaded_file($_FILES['Image1']['tmp_name'], '../view/Images/'.$_FILES['Image1']['name']);
				$Image1 = 'Images/'.$_FILES['Image1']['name'];
			}		
			if (!empty($_FILES['Image2'])) {
				move_uploaded_file($_FILES['Image2']['tmp_name'], '../view/Images/'.$_FILES['Image2']['name']);
				$Image2 = 'Images/'.$_FILES['Image2']['name'];
			}	
			if (!empty($_FILES['Image3'])) {
				move_uploaded_file($_FILES['Image3']['tmp_name'], '../view/Images/'.$_FILES['Image3']['name']);
				$Image3 = 'Images/'.$_FILES['Image3']['name'];
			}				
			$sql = "insert into `Sản Phẩm`(TenSP, createdDate,GiaGoc, GiaGiam, SoLuongTonKho, Description, LoaiSP, Image1, Image2, Image3, MaCH,laSPDauGia) ";
			$sql.= "values ('$TenSP', now(),$GiaGoc,$GiaGiam,$SoLuongTonKho,'$Description','$LoaiSP','$Image1','$Image2','$Image3', $_SESSION[MaKH],1);";
			if ($conn->query($sql) === false) {
				echo "Thêm sản phẩm thất bại";
				echo $conn->error;
				$conn->close();
			} else {
				$sql = "select * from `Sản Phẩm` where laSPDauGia=1 order by MaSP desc limit 1 ;";
				$ketQua = $conn->query($sql);
				if ($ketQua->num_rows>0) {
					$sp = $ketQua->fetch_assoc();
					$ngayBD = $_POST['TGBD'];
					$ngayKT = $_POST['TGKT'];
					$ngayBD = str_replace('T',' ',$ngayBD);
					$ngayBD .= ':00'; 
					$ngayKT = str_replace('T',' ',$ngayKT);
					$ngayKT .= ':00';					
					$sql="insert into `Đấu Giá`(MaKH,MaSP,startDate,endDate) values($_SESSION[MaKH],$sp[MaSP],'$ngayBD','$ngayKT')";
					$conn->query($sql);
					echo "Thêm sản phẩm thành công";
				} else {
					echo "Thêm sản phẩm thất bại";
				}				
				$conn->close();
			}
		}
	}		
} else {
	header("Location: ../view/DangNhap.php", true, 301);
}
?>