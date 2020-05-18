<div class="row hang_trong_gio">
    <div class="title">
		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">Ảnh</div>
		<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">Tên sản phẩm</div>
		<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">Giá</div>
		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">Số lượng</div>
		<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">Đặt hàng</div>
		<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">Xóa</div>
	</div>
<?php	
    include_once "../tool/XuLyGia.php";
	include_once "../tool/XuLyMang.php";
	if (isset($_COOKIE['Basket'])) {
		$listBasket = json_decode($_COOKIE['Basket'], true);
		include_once "../tool/Connection.php";
	    $conn = getConnection();
	    if ($conn->connect_error) {
            $conn->close();		
	    } else {
			$sql = "use BanHang;";
		    $conn->query($sql);
			$sql = "select * from `Sản Phẩm` where MaSP in (";
			foreach($listBasket as $key=>$value){
			    $sql.= $value.',';
            }
			$sql.="0);";
			$ketQua = $conn->query($sql);
			if ($ketQua->num_rows>0) {
				while ($row = $ketQua->fetch_assoc()) {
					echo "<div name=\"$row[MaSP]\" class=\"san_pham\">";
					if ($row['Image1']=="") {
						echo "<div class=\"col-lg-2 col-md-2 col-sm-2 col-xs-2 anh\"><img width=\"100%\" height=\"100%\" src=\"Images/sanphamtrong.png\"></div>";
					} else {
						echo "<div class=\"col-lg-2 col-md-2 col-sm-2 col-xs-2 anh\"><img width=\"100%\" height=\"100%\" src=\"$row[Image1]\"></div>";
					}			        
				    echo "<div class=\"col-lg-3 col-md-3 col-sm-3 col-xs-3 ten_san_pham\">$row[TenSP]</div>";
				    echo "<div class=\"col-lg-3 col-md-3 col-sm-3 col-xs-3 gia\">";
					echo tienSangXau($row['GiaGiam']);
					echo "</div>";
				    echo "<div class=\"col-lg-2 col-md-2 col-sm-2 col-xs-2 so_luong\" max=\"$row[SoLuongTonKho]\">";
				    echo "<div class=\"tang\"><i class=\"fa fa-sort-asc\"></i></div>";
					echo "<div class=\"gia_tri\">1</div>";
					echo "<div class=\"giam\"><i class=\"fa fa-sort-desc\"></i></div>";
				    echo "</div>";
				    echo "<div class=\"col-lg-1 col-md-1 col-sm-1 col-xs-1 dat_hang\"><i class=\"fa fa-plus\"></i></div>";
				    echo "<div class=\"col-lg-1 col-md-1 col-sm-1 col-xs-1 xoa\"><i class=\"fa fa-trash\"></i></div>";			
			        echo "</div>";
				}
			}
			$conn->close();
		}
	}	
?>			
	<div style="margin-top: 7rem; margin-bottom: 7rem; text-align: center;" class="thanh_toan row" hidden>
		<button class="btn btn-lg btn-success">Thanh toán</button>
	</div>	
    <form method="post" action="../view/ReviewDonHang.php" hidden>
	    <input name="MaSP" type="text" hidden> 
    </form>	
</div>
        <script language="javascript">
		    $(document).ready(function() {
				var gio_height = $('.hang_trong_gio .title div:eq(0)').width();
				$('.hang_trong_gio .san_pham').height(gio_height);
				$('.hang_trong_gio .san_pham').children().height(gio_height);
				$(window).resize(function() {
					gio_height = $('.hang_trong_gio .title div:eq(0)').width();
					$('.hang_trong_gio .san_pham').height(gio_height);
				    $('.hang_trong_gio .san_pham').children().height(gio_height);						
				});
				$(document).on('click','.hang_trong_gio .san_pham .so_luong .giam',function() {
					var number = $(this).parent().children('.gia_tri');
					var value = parseInt(number.html());
					if (value!=1) {
						value--;
						number.html(value);
					}
				});
				$(document).on('click','.hang_trong_gio .san_pham .so_luong .tang',function() {
					var number = $(this).parent().children('.gia_tri');
					var value = parseInt(number.html());
					if (value<parseInt(number.parent().attr('max'))) {
						value++;
						number.html(value);
					}
				});	
                $(document).on('click','.hang_trong_gio .san_pham .dat_hang i', function () {
					if ($(this).hasClass('fa-plus')) {
						$(this).removeClass('fa-plus');
						$(this).addClass('fa-check-circle');						
                        $('.hang_trong_gio .thanh_toan').removeAttr('hidden');						
					} else {
						$(this).removeClass('fa-check-circle');
						$(this).addClass('fa-plus');
                        if ($('.hang_trong_gio .san_pham .dat_hang .fa-check-circle').length==0) {
							$('.hang_trong_gio .thanh_toan').attr('hidden','true');
						}						
					}
				});	
                $(document).on('click','.hang_trong_gio .san_pham .xoa i', function () {
					var ma = $(this).parent().parent().attr('name');
				    $.ajax ({
			            url: "../controller/XuLyGioHang.php",
			            type: "get",
			            dataType: "text",
			            data: {
				            YCBasket: 'Xoa',
						    MaSP: ma
			            },
			            success: function(result) {
			                $('.wishlist_giohang .item .number:eq(1)').html(result);                             							
			            },
			            error: function(){                        
                        }
		            });
                    $(this).parent().parent().remove();					
				});
                $(document).on('click','.thanh_toan button', function() {
					var Para = "";
					$('.hang_trong_gio .san_pham .fa-check-circle').each(function () {
						Para = Para+$(this).parent().parent().attr('name')+"SL"+$(this).parent().parent().children('.so_luong').children('.gia_tri').html()+" ";
					});
					$('form input[name="MaSP"]').val(Para);
                    $('form').submit();					
				});				
			});
        </script>	