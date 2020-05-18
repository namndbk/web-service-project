<?php
if (isset($_SESSION['MaKH'])) {
?>
<div class="row hang_muc">
	<div class="col-lg-2 col-md-2 col-sm-3 col-xs-3">
		    Ảnh
    </div>
	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
		    Tên và giá thành
	</div>	
	<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
		    Đã bán
	</div>
	<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
	        Tồn kho
	</div>
	<div class="col-lg-3 col-md-3 col-sm-2 col-xs-2">
		    Thao tác
	</div>			
</div>
<div class="san_pham_cua_hang">
<?php
    include_once "../tool/XuLyGia.php";
	include_once "../tool/Connection.php";
	$conn = getConnection();
	if ($conn->connect_error) {
        $conn->close();		
	} else {
		$sql = "use BanHang;";
		$conn->query($sql);
		switch ($_GET['type']) {
			case "DangBan":
			    $tenSP = "%";
				if (isset($_GET['search'])) {
					$tenSP = "%$_GET[search]%";
				}
			    $sql = "select * from `Sản Phẩm` where MaCH = $_SESSION[MaKH] and TenSP like '$tenSP' and laSPDauGia IS NULL and Deleted IS NULL order by MaSP desc;";
				break;
			case "UaThich":
			    $sql = "select * from `Sản Phẩm` where MaCH = $_SESSION[MaKH] and laSPDauGia IS NULL and Deleted IS NULL order by DanhGiaTB desc limit 10;";
                break;
            case "BanChay":
			    $sql = "select * from `Sản Phẩm` where MaCH = $_SESSION[MaKH] and laSPDauGia IS NULL and Deleted IS NULL order by SoLuongDaBan desc limit 10;";
			    break;
			case "TonKho":
			    $sql = "select * from `Sản Phẩm` where MaCH = $_SESSION[MaKH] and laSPDauGia IS NULL and Deleted IS NULL order by SoLuongTonKho desc limit 10;";
			    break;
		}
		$ketQua = $conn->query($sql);
		if ($ketQua->num_rows>0) {
			while ($row = $ketQua->fetch_assoc()) {
				echo "<div class=\"row\">";
	            echo "<div class=\"col-lg-2 col-md-2 col-sm-3 col-xs-3 img\">";
				if ($row['Image1']=="") {
					echo "<img width=\"100%\" height=\"100%\" src=\"Images/sanphamtrong.png\">";
				} else {
					echo "<img width=\"100%\" height=\"100%\" src=\"$row[Image1]\">";
				}		        
		        echo "</div>";
	            echo "<div class=\"col-lg-3 col-md-3 col-sm-3 col-xs-3 name_cost\">";
		        echo "<div class=\"name\">$row[TenSP]</div>";
			    echo "<div class=\"cost\">";
				echo tienSangXau($row['GiaGiam']);
				echo "</div>";
		        echo "</div>";	
	            echo "<div class=\"col-lg-2 col-md-2 col-sm-2 col-xs-2 da_ban\">";
		        echo $row['SoLuongDaBan'];
		        echo "</div>";
	            echo "<div class=\"col-lg-2 col-md-2 col-sm-2 col-xs-2 da_ban\">";
		        echo $row['SoLuongTonKho'];
		        echo "</div>";		
	            echo "<div class=\"col-lg-3 col-md-3 col-sm-2 col-xs-2 function\">";
		        echo "<a href=\"SanPhamChiTiet.php?MaSP=$row[MaSP]\"><div>Chi tiết</div></a>";
			    echo "<a href=\"SuaThongTinSanPham.php?MaSP=$row[MaSP]\"><div><i class=\"fa fa-pencil-square\"></i></div></a>";
			    echo "<div name=\"$row[MaSP]\"><i class=\"fa fa-trash\"></i></div>";
		        echo "</div>";			
	            echo "</div>";
			}
		}
		$conn->close();
	}
?>	
</div>

<script language="javascript">
    $(document).ready(function() {
		var spch_height = $('.san_pham_cua_hang .row .img').width();
		$('.san_pham_cua_hang .row').height(spch_height);
		$('.san_pham_cua_hang .row .img').height(spch_height);
		var name_spch = parseInt(spch_height);
		name_spch = name_spch/2;
		$('.san_pham_cua_hang .row .name_cost .name').height(name_spch+'px');
		name_spch = name_spch*0.9;
		$('.san_pham_cua_hang .row .da_ban').css('padding-top',name_spch+'px');
		name_spch = parseInt(spch_height);
		name_spch = 0.3*name_spch;
		$('.san_pham_cua_hang .row .function div').height(name_spch+'px');
		$(window).resize(function() {
			spch_height = $('.san_pham_cua_hang .row .img').width();
		    $('.san_pham_cua_hang .row').height(spch_height);
			$('.san_pham_cua_hang .row .img').height(spch_height);
			name_spch = parseInt(spch_height);
			name_spch = name_spch/2;
		    $('.san_pham_cua_hang .row .name_cost .name').height(name_spch+'px');
			name_spch = name_spch*0.9;
			$('.san_pham_cua_hang .row .da_ban').css('padding-top',name_spch+'px');
		    name_spch = parseInt(spch_height);
		    name_spch = 0.3*name_spch;
		    $('.san_pham_cua_hang .row .function div').height(name_spch+'px');
		});
		$(document).on('click','.san_pham_cua_hang .row .function .fa-trash', function() {
			$.ajax ({
			    url: "../controller/XoaSanPham.php",
			    type: "get",
			    dataType: "text",
			    data: {
					MaSP: $(this).parent().attr('name')
				},
			    success: function(result) {			    	
				},
				error: function(){                           
                }
		    });
            $(this).parent().parent().parent().remove();			
		});
	});
</script>
<?php
} else {
	header("Location: ../view/DangNhap.php", true, 301);
}
?>