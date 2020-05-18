<?php
session_start();
if (isset($_SESSION['MaKH'])) {
    if (isset($_POST['MaSP'])) {
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
    			$MaSP = $_POST['MaSP'];
    			$TenSP = $_POST['TenSP'];
    			$GiaGoc = str_replace('.','',$_POST['GiaGoc']);
    			$GiaGiam = str_replace('.','',$_POST['GiaGiam']);
    			$SoLuongTonKho = $_POST['SoLuongTonKho'];
    			$Description = $_POST['Description'];
				$LoaiSP = $_POST['LoaiSP'];
    			if (!empty($_FILES['Image1'])) {
    				move_uploaded_file($_FILES['Image1']['tmp_name'], '../view/Images/'.$_FILES['Image1']['name']);
    				$Image1 = 'Images/'.$_FILES['Image1']['name'];
    				$sql = "update `Sản Phẩm` set Image1 = '$Image1' where MaSP = $MaSP;";
    				$conn->query($sql);
    			}		
    			if (!empty($_FILES['Image2'])) {
    				move_uploaded_file($_FILES['Image2']['tmp_name'], '../view/Images/'.$_FILES['Image2']['name']);
    				$Image2 = 'Images/'.$_FILES['Image2']['name'];
    				$sql = "update `Sản Phẩm` set Image2 = '$Image2' where MaSP = $MaSP;";
    				$conn->query($sql);				
    			}	
    			if (!empty($_FILES['Image3'])) {
    				move_uploaded_file($_FILES['Image3']['tmp_name'], '../view/Images/'.$_FILES['Image3']['name']);
    				$Image3 = 'Images/'.$_FILES['Image3']['name'];
    				$sql = "update `Sản Phẩm` set Image3 = '$Image3' where MaSP = $MaSP;";
    				$conn->query($sql);				
    			}			
    			$sql = "update `Sản Phẩm` set TenSP = '$TenSP', GiaGoc = $GiaGoc, GiaGiam = $GiaGiam, SoLuongTonKho = $SoLuongTonKho, LoaiSP = '$LoaiSP',Description = '$Description' ";
    			$sql.= "where MaSP = $MaSP;";
    			if ($conn->query($sql) === false) {
    				echo "Cập nhật thông tin thất bại";
    				echo $conn->error;
    				$conn->close();
    			} else {
    				echo "Cập nhật thông tin thành công";
    				$conn->close();
    			}
    		}
    	}
    } else {
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
		    	$GiaGiam = str_replace('.','',$_POST['GiaGiam']);
		    	$SoLuongTonKho = $_POST['SoLuongTonKho'];
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
		    	$sql = "insert into `Sản Phẩm`(TenSP, createdDate,GiaGoc, GiaGiam, SoLuongTonKho, Description, LoaiSP, Image1, Image2, Image3, MaCH) ";
		    	$sql.= "values ('$TenSP', now(),$GiaGoc,$GiaGiam,$SoLuongTonKho,'$Description','$LoaiSP','$Image1','$Image2','$Image3', $_SESSION[MaKH]);";
		    	if ($conn->query($sql) === false) {
		    		echo "Thêm sản phẩm thất bại";
		    		echo $conn->error;
		    		$conn->close();
		    	} else {
		    		echo "Thêm sản phẩm thành công";
		    		$conn->close();
			    }
	    	}
	    }	
    }	
} else {
	header("Location: ../view/DangNhap.php", true, 301);
}
?>