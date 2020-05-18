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
		$sql = "select * from `Sản Phẩm` where MaSP = $_GET[MaSP]";
		$ketQua = $conn->query($sql);
		if ($ketQua->num_rows > 0) {
			$row = $ketQua->fetch_assoc();
			echo "<div class=\"row thong_tin_san_pham\">";
            echo "<div class=\"col-lg-4 col-md-4 col-sm-5 col-xs-12 anh_minh_hoa_frame slide\">";
	        echo "<div class=\"row slide-window\">";
	        echo "<div class=\"slide-element\">";
			if ($row['Image1']=="") {
				echo "<img width=\"90%\" height=\"100%\" src=\"Images/sanphamtrong.png\">";
			} else {
				echo "<img width=\"90%\" height=\"100%\" src=\"$row[Image1]\">";
			}	        
	        echo "</div>";
	        echo "<div class=\"slide-element\">";
			if ($row['Image2']=="") {
				echo "<img width=\"90%\" height=\"100%\" src=\"Images/sanphamtrong.png\">";
			} else {
				echo "<img width=\"90%\" height=\"100%\" src=\"$row[Image2]\">";
			}	        
	        echo "</div>";
			echo "<div class=\"slide-element\">";
			if ($row['Image3']=="") {
				echo "<img width=\"90%\" height=\"100%\" src=\"Images/sanphamtrong.png\">";
			} else {
				echo "<img width=\"90%\" height=\"100%\" src=\"$row[Image3]\">";
			}	        
	        echo "</div>";		
		    echo "</div>";
            echo "<div class=\"row slide-button\">";
		    echo "<div class=\"fa fa-1x fa-arrow-circle-left slide-prev\"></div>";		
		    echo "<div class=\"fa fa-1x fa-arrow-circle-right slide-next\"></div>";		
            echo "</div>";			
	        echo "</div>";
	        echo "<div class=\"col-lg-8 col-md-8 col-sm-7 col-xs-12 thong_so_san_pham\">";
	        echo "<div name=\"$row[MaSP]\" class=\"like_basket\">";
            if (isset($listBasket) && isExist($listBasket,$row['MaSP'])) {
				echo "<div class=\"basket basket_choosen fa fa-shopping-basket\"></div>";
			} else {
				echo "<div class=\"basket fa fa-shopping-basket\"></div>";
			}			
            if (isset($listWish) && isExist($listWish,$row['MaSP'])) {
				echo "<div class=\"like like_choosen fa fa-heart\"></div>";
			} else {
				echo "<div class=\"like fa fa-heart\"></div>";
			}							
		    echo "</div>";
	        echo "<div class=\"ten_san_pham\">";	
            echo $row['TenSP'];		
		    echo "</div>";
		    echo "<div class=\"gia_ca\">";
			$GiaGoc = tienSangXau($row['GiaGoc']);
			$GiaGiam = tienSangXau($row['GiaGiam']);
		    echo "<div class=\"gia_cu\">$GiaGoc</div>";
		    echo "<div class=\"gia_moi\">$GiaGiam</div>";
		    echo "</div>";
		    echo "<div class=\"danh_gia\">";
            echo "<div>Đánh giá:</div>";
            echo "<div class=\"rate\"  name=\"$row[DanhGiaTB]\"><div></div></div>";
		    echo "</div>";
		    echo "<div class=\"mo_ta\">";
            echo "<div>Mô tả</div>";
		    echo $row['Description'];
		    echo "</div>";		    
			$sql = "select * from `Tài Khoản` where MaKH = $row[MaCH];";
			$kq = $conn->query($sql);
			if ($kq->num_rows > 0) {
			    $ch = $kq->fetch_assoc();
				echo "<div class=\"shop_name\">";
				echo "Được bán bởi $ch[Ten]";
				echo "</div>";
				echo "<div class=\"so_dien_thoai\">";
				echo "Địa chỉ: $ch[DiaChi]";
				echo "</div>";
				echo "<div class=\"so_dien_thoai\">";
				echo "Số điện thoại: $ch[SDT]";
				echo "</div>";
			}		
	        echo "</div>";
            echo "</div>";
		}
		$conn->close();
	}		
?>
<script language="javascript">
    $(document).ready(function() {
		var anmh_height = $('.anh_minh_hoa_frame').width();
		$('.anh_minh_hoa_frame').height(anmh_height);
        $('.thong_so_san_pham').height(anmh_height);
		$('.anh_minh_hoa_frame .slide-element').width(anmh_height);
		$('.thong_tin_san_pham .thong_so_san_pham .rate').each(function() {
		    sale_height = parseInt($(this).width());
		    percent = parseFloat($(this).attr("name"));
		    sale_height = percent*sale_height/5;
		    $(this).children().width(sale_height+"px");			
		});
		$(window).resize(function() {
			anmh_height = $('.anh_minh_hoa_frame').width();
		    $('.anh_minh_hoa_frame').height(anmh_height);
            $('.thong_so_san_pham').height(anmh_height);
			$('.anh_minh_hoa_frame .slide-element').width(anmh_height);
    		$('.thong_tin_san_pham .thong_so_san_pham .rate').each(function() {
		        sale_height = parseInt($(this).width());
		        percent = parseFloat($(this).attr("name"));
		        sale_height = percent*sale_height/5;
		        $(this).children().width(sale_height+"px");			
		    });
		});
		
		$(document).on('click','.thong_so_san_pham .like_basket .basket',function() {			
			if (!$(this).hasClass('basket_choosen')) {
				ma = $(this).parent().attr('name');
				$(this).addClass('basket_choosen');
				$.ajax ({
			        url: "../controller/XuLyGioHang.php",
			        type: "get",
			        dataType: "text",
			        data: {
				        YCBasket: 'Them',
						MaSP: ma
			        },
			        success: function(result) {
			            $('.wishlist_giohang .item .number:eq(1)').html(result);  						
			        },
			        error: function(){
			            $('.wishlist_giohang .item .number:eq(1)').html('0');                           
                    }
		        });	
			} else {
				ma = $(this).parent().attr('name');
				$(this).removeClass('basket_choosen');
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
			            $('.wishlist_giohang .item .number:eq(1)').html('0');                           
                    }
		        });				
			}
		});
		$(document).on('click','.thong_so_san_pham .like_basket .like',function() {			
			if (!$(this).hasClass('like_choosen')) {
				ma = $(this).parent().attr('name');
				$(this).addClass('like_choosen');
				$.ajax ({
			        url: "../controller/XuLyWishlist.php",
			        type: "get",
			        dataType: "text",
			        data: {
				        YCWishlist: 'Them',
						MaSP: ma
			        },
			        success: function(result) {
			            $('.wishlist_giohang .item .number:eq(0)').html(result);   
			        },
			        error: function(){
			            $('.wishlist_giohang .item .number:eq(0)').html('0');                           
                    }
		        });					
			} else {
				ma = $(this).parent().attr('name');
				$(this).removeClass('like_choosen');
				$.ajax ({
			        url: "../controller/XuLyWishlist.php",
			        type: "get",
			        dataType: "text",
			        data: {
				        YCWishlist: 'Xoa',
						MaSP: ma
			        },
			        success: function(result) {
			            $('.wishlist_giohang .item .number:eq(0)').html(result);   
			        },
			        error: function(){
			            $('.wishlist_giohang .item .number:eq(0)').html('0');                           
                    }
		        });					
			}
		});		
	});
</script>