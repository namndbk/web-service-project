<div class="wishlist_giohang">
    <div class="item">
	    <div class="image">
		    <div class="number"></div>
			<a href="TrangWishlist.php"><div class="icon fa fa-heart"></div></a>
		</div>
	</div>
	<div class="item">
	    <div class="image">
		    <div class="number"></div>
			<a href="TrangGioHang.php"><div class="icon fa fa-shopping-basket"></div></a>
		</div>
	</div>
	<div class="item">
	    <div class="image">
			<a href="ProfileNguoiDung.php"><div class="icon fa fa-user-circle"></div></a>
		</div>	
	</div>
</div>
<div class="back_to_top">
    <a href="#banner">
	    <div class="fa fa-arrow-circle-up"></div>
	</a>
</div>
<div id="banner" class="banner">
    <a href="TrangChu.php"><img style="width: 100%;" src="Images/bannerforshop.png"></a>
</div>
<script language="javascript">
    $(document).ready(function() {
        $.ajax ({
			url: "../controller/XuLyWishlist.php",
			type: "get",
			dataType: "text",
			data: {
				YCWishlist: 'Dem'
			},
			success: function(result) {
			    $('.wishlist_giohang .item .number:eq(0)').html(result);   
			},
			error: function(){
			    $('.wishlist_giohang .item .number:eq(0)').html('0');                           
            }
		});	
        $.ajax ({
			url: "../controller/XuLyGioHang.php",
			type: "get",
			dataType: "text",
			data: {
				YCBasket: 'Dem'
			},
			success: function(result) {
			    $('.wishlist_giohang .item .number:eq(1)').html(result);   
			},
			error: function(){
			    $('.wishlist_giohang .item .number:eq(1)').html('0');                           
            }
		});			
	});
</script>