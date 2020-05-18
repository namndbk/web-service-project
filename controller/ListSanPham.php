<?php
    include_once "../tool/XuLyGia.php";
	include_once "../tool/XuLyMang.php";
	include_once "../tool/Connection.php";
	$conn = getConnection();
	if ($conn->connect_error) {
        $conn->close();		
	} else {	
	    if (isset($_COOKIE['Wishlist'])) {
			$listWish = json_decode($_COOKIE['Wishlist'], true);
		} 
	    if (isset($_COOKIE['Basket'])) {
			$listBasket = json_decode($_COOKIE['Basket'], true);
		}			
		$sql = "use BanHang;";
		$conn->query($sql);		
		$offset = 0;
		if (isset($_GET['offset'])) {
			$offset = intval($_GET['offset'])*24;
		}
		switch ($_GET['type']) {
            case "NoiBat":
                $sql = "select * from `Sản Phẩm` where laSPDauGia IS NULL and Deleted IS NULL order by DanhGiaTB desc limit 24 offset $offset;";
                break;
            case "SPMoi":
                $sql = "select * from `Sản Phẩm` where laSPDauGia IS NULL and Deleted IS NULL order by createdDate desc limit 24 offset $offset;";
                break;
            case "SPGiamGia":
                $sql = "select * from `Sản Phẩm` where laSPDauGia IS NULL and Deleted IS NULL order by GiaGiam/GiaGoc asc limit 24 offset $offset;";
                break;
	        case "TimKiem":
			    $xauTK = '%';
			    $xauTK.= $_GET['xauTK'];
				$xauTK.= '%';
	            $sql = "select * from `Sản Phẩm` where laSPDauGia IS NULL and Deleted IS NULL and TenSP like '$xauTK' ";
				if (isset($_GET['minGia'])) {
					$minGia = str_replace('.','',$_GET['minGia']);
					$sql.= "and GiaGiam >= $minGia ";
				}
				if (isset($_GET['maxGia'])) {
					$maxGia = str_replace('.','',$_GET['maxGia']);
					$sql.= "and GiaGiam <= $maxGia ";
				}
                if (isset($_GET['danhGia'])) {
					$danhGia = $_GET['danhGia'];
					$sql.= "and DanhGiaTB >= $danhGia ";
				}	
                if (isset($_GET['sort'])) {
					switch ($_GET['sort']) {
						case "giaTang":
						    $sql.="order by GiaGiam asc limit 24 offset $offset;";
							break;
						case "giaGiam":
						    $sql.="order by GiaGiam desc limit 24 offset $offset;";
							break;
						case "danhGia":
						    $sql.="order by DanhGiaTB desc limit 24 offset $offset;";
							break;
					}
				} else {
					$sql.="limit 24 offset $offset;";
				}	                			
		        break;
			case "DanhMuc":
			    $xauTK = $_GET['DanhMuc'];
	            $sql = "select * from `Sản Phẩm` where laSPDauGia IS NULL and Deleted IS NULL and LoaiSP = '$xauTK'";
				if (isset($_GET['minGia'])) {
					$minGia = str_replace('.','',$_GET['minGia']);
					$sql.= "and GiaGiam >= $minGia ";
				}
				if (isset($_GET['maxGia'])) {
					$maxGia = str_replace('.','',$_GET['maxGia']);
					$sql.= "and GiaGiam <= $maxGia ";
				}
                if (isset($_GET['danhGia'])) {
					$danhGia = $_GET['danhGia'];
					$sql.= "and DanhGiaTB >= $danhGia ";
				}
                if (isset($_GET['sort'])) {
					switch ($_GET['sort']) {
						case "giaTang":
						    $sql.="order by GiaGiam asc limit 24 offset $offset;";
							break;
						case "giaGiam":
						    $sql.="order by GiaGiam desc limit 24 offset $offset;";
							break;
						case "danhGia":
						    $sql.="order by DanhGiaTB desc limit 24 offset $offset;";
							break;
					}
				} else {
					$sql.="limit 24 offset $offset;";
				}				
		        break;	
            case "Wishlist":
                $sql = "select * from `Sản Phẩm` where MaSP in (";
				if (isset($listWish)) {
					foreach($listWish as $key=>$value){
					    $sql.= $value.',';
                    }
				}
                $sql.="0);";
                break;				
        }
		$ketQua = $conn->query($sql);
		echo "<div class=\"row\">";
		if ($ketQua->num_rows > 0) {
			while($row = $ketQua->fetch_assoc()) {
				echo "<div class=\"col-lg-2 col-md-3 col-sm-4 col-xs-6\">";
	            echo "<div name=\"$row[MaSP]\" class=\"product_frame_1\">";
	            echo "<div class=\"product_image\">";
				$x = intval($row['GiaGoc']);
				$y = intval($row['GiaGiam']);
				$percent = intval(100*($x-$y)/$x);
				if ($percent==0) {
					echo "<div class=\"sale\" style=\"visibility: hidden;\">";
				} else {
					echo "<div class=\"sale\">";
				}
			    echo  $percent;
				echo "%";
			    echo "</div>";	
                if (isset($listWish) && isExist($listWish,$row['MaSP'])) {
					echo "<div class=\"like like_choosen fa fa-heart\">";
				} else {
					echo "<div class=\"like fa fa-heart\">";
				}				 
			    echo "</div>";	
                if ($row['Image1']=="") {
					echo "<img width=\"100%\" height=\"100%\" src=\"Images/sanphamtrong.png\">";
				} else {
					echo "<img width=\"100%\" height=\"100%\" src=\"$row[Image1]\">";
				}					        
		        echo "</div>";
		        echo "<a href=\"SanPhamChiTiet.php?MaSP=$row[MaSP]\">";
		        echo "<div class=\"product_name\">";
		        echo $row['TenSP'];
		        echo "</div>";
		        echo "</a>";
		        echo "<div class=\"product_cost\">";
		        echo tienSangXau($row['GiaGiam']);
		        echo "</div>";
		        echo "<div class=\"item\">";
		        echo "<div class=\"rate\" name=\"$row[DanhGiaTB]\">";
			    echo "<div>";
				echo "</div>";
			    echo "</div>";
                if (isset($listBasket) && isExist($listBasket,$row['MaSP'])) {
					echo "<div class=\"basket basket_choosen fa fa-shopping-basket\">";
				} else {
					echo "<div class=\"basket fa fa-shopping-basket\">";
				}				
			    echo "</div>";
		        echo "</div>";
	            echo "</div>";	
	            echo "</div>";
            }
		}
		echo "</div>";
		$conn->close();
    }		
?>