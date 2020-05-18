<?php
include_once "../tool/Connection.php";
include_once "../tool/XuLyGia.php";
class DonHang {
	public $mangDon;
	public function __construct() {
		$mangDon = array();
	}
	public function themSP($maSP, $sl) {
		$this->mangDon[$maSP] = $sl;
	}
	public function inSanPham($maCH) {
		$tongTien = 0;
		$conn = getConnection();
		if ($conn->connect_error) {
			$conn->close();
		} else {
			$sql = "use BanHang;";
			$conn->query($sql);
			echo "<div class=\"row muc_don_hang don_hang_sap_mua\">";
            echo "<div class=\"don_hang\">";
			echo "<div class=\"thong_tin col_lg_12 col_md_12 col_sm_12 col_xs_12\">";
			foreach ($this->mangDon as $key=>$value) {
			    $sql = "select * from `Sản Phẩm` where MaSP = $key;";
				$ketQua = $conn->query($sql);
				if ($ketQua->num_rows>0) {
					$sp = $ketQua->fetch_assoc();
	                echo "<div class=\"mat_hang\">";
		            echo "<div class=\"col-lg-2 col-md-2 col-sm-3 col-xs-3 item anh\">";
					if ($sp['Image1']=="") {
						echo "<img width=\"100%\" height=\"100%\" src=\"Images/sanphamtrong.png\">";
					} else {
						echo "<img width=\"100%\" height=\"100%\" src=\"$sp[Image1]\">";
					}			        
			        echo "</div>";
			        echo "<div class=\"col-lg-4 col-md-4 col-sm-4 col-xs-4 item ten\">";
			        echo $sp['TenSP'];
			        echo "</div>";
			        echo "<div class=\"col-lg-2 col-md-2 col-sm-2 col-xs-2 item hien_con\">";
			        echo $value;
			        echo "</div>";			
			        echo "<div class=\"col-lg-4 col-md-4 col-sm-3 col-xs-3 item thanh_tien\">";
			        $thanhTien = intval($value*intval($sp['GiaGiam']));
					$tongTien = $tongTien + $thanhTien;
					echo tienSangXau(strval($thanhTien));
			        echo "</div>";			
		            echo "</div>";					
				}
	        }
			$sql = "select * from `Tài Khoản` where MaKH = $maCH;";
			$ketQua = $conn->query($sql);
			if ($ketQua->num_rows>0) {
				$ch = $ketQua->fetch_assoc();
				echo "<div class=\"khach_hang\">";
			    echo "<div class=\"ten\">Cửa hàng: $ch[Ten]</div>";
			    echo "<div class=\"so_dien_thoai\">SĐT: $ch[SDT]</div>";
		        echo "</div>";
		        echo "<div class=\"dia_chi\">";
			    echo "Địa chỉ: $ch[DiaChi]";
		        echo "</div>";
			}	
		    echo "<div class=\"tong_tien\">";
		    echo "Tổng tiền: ";
			echo tienSangXau(strval($tongTien));
		    echo "</div>";
			echo "</div>";	
	        echo "</div>";
            echo "</div>";
			$conn->close();
		}
		return $tongTien;
	}
	
	public function themVaoDatabase($conn, $maCH) {
		$tongDon = 0;
        $sql = "insert into `Đơn Hàng`(TongTien,MaKH,TenNguoiNhan,SDT,DiaChi,Status,MaCH,NgayThang) ";
        $sql.= "values(0,$_SESSION[MaKH],'$_POST[Ten]','$_POST[SDT]','$_POST[DiaChi]','cho_xet',$maCH,now());";
        $conn->query($sql);
		$maDon = 0;
		$sql = "select * from `Đơn Hàng` order by MaDon desc limit 1;";
		$ketQua = $conn->query($sql);
		$don = $ketQua->fetch_assoc();
		$maDon = $don['MaDon'];
		foreach ($this->mangDon as $key=>$value) {
			$sql = "select * from `Sản Phẩm` where MaSP = $key;";
			$ketQua = $conn->query($sql);
			if ($ketQua->num_rows>0) {
				$sp = $ketQua->fetch_assoc();
				$thanhTien = intval($sp['GiaGiam'])*intval($value);
				$tongDon = $tongDon+$thanhTien;
				$sql = "insert into `Sản Phẩm Đơn Hàng`(MaDon, MaSP, SoLuong, ThanhTien) ";
				$sql.= "values($maDon,$sp[MaSP],$value,$thanhTien);";
				$conn->query($sql);	
			}						
		}
	    if (isset($_COOKIE['Basket'])) {
			$listSP = json_decode($_COOKIE['Basket'], true);
			foreach ($this->mangDon as $key=>$value) {
				if (($chiMuc = array_search($key, $listSP)) !== false) {
                    unset($listSP[$chiMuc]);
					$listSP = array_values($listSP);
                }				
			}			
			setcookie("Basket",json_encode($listSP),time()+30758400,'/');				
		} 			
        $sql = "update `Đơn Hàng` set TongTien = $tongDon where MaDon = $maDon;";
        $conn->query($sql);		
	}

	public function getDonHangKhachHang($loaiHinh, $maKH){
        $donHangs = array();
        $connect = getConnectionData();
        $query =  "SELECT * FROM `đơn hàng`, `tài khoản` WHERE `đơn hàng`.`MaKH` = $maKH AND Status = '$loaiHinh' AND `đơn hàng`.`MaCH` = `tài khoản`.`MaKH`";

        $result = $connect->query($query);

        while($row = $result->fetch_assoc()){
             $donHang = array();
             $donHang['MaDon'] = $row['MaDon'];
             $donHang['TongTien'] = $row['TongTien'];
             $donHang['TenNguoiNhan'] = $row['TenNguoiNhan'];
             $donHang['SDT'] = $row['SDT'];
             $donHang['DiaChi'] = $row['DiaChi'];
             $donHang['MaCH'] = $row['MaCH'];
             $donHang['NgayThang'] = $row['NgayThang'];
             $donHang['Deleted'] = $row['Deleted'];
             $donHang['TenCuaHang'] = $row['Ten'];

             array_push($donHangs, $donHang);
        }
        $connect->close();

        return $donHangs;
    }
    
    public function getSanPhamFromDonHang($maDon){
        $connect = getConnectionData();
        $sanPhams = array();

        $query = "SELECT * FROM `đơn hàng`, `sản phẩm đơn hàng`, `sản phẩm` 
                  WHERE `đơn hàng`.`MaDon` = $maDon AND 
                  `đơn hàng`.`MaDon` = `sản phẩm đơn hàng`.`MaDon` AND 
                  `sản phẩm đơn hàng`.`MaSP` = `sản phẩm`.`MaSP`";

        $result = mysqli_query($connect, $query);
        while($row = $result->fetch_assoc()){
            $sanPham = array();
            $sanPham['MaSP'] = $row['MaSP'];
            $sanPham['TenSP'] = $row['TenSP'];
            $sanPham['GiaGiam'] = $row['GiaGiam'];
            $sanPham['Image'] = $row['Image1'];
            $sanPham['SoLuong'] = $row['SoLuong'];
            $sanPham['ThanhTien'] = $row['ThanhTien'];
            
            array_push($sanPhams, $sanPham);
        }

        $connect->close();
        return $sanPhams;
    }
}
?>