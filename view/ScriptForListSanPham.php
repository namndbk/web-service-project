<script language="javascript">
    $(document).ready(function() {
		var frame_width = $('.product_frame_1').width();
		$('.product_frame_1 .product_image').width(frame_width);
		$('.product_frame_1 .product_image').height(frame_width);
		var sale_height = parseInt($('.product_frame_1 .product_image .sale').height());
		sale_height = 0-sale_height*2;
		$('.product_frame_1 .product_image .sale').css("margin-bottom",sale_height+"px");
		$('.product_frame_1 .product_image .like').css("margin-bottom",sale_height+"px");
		$('.product_frame_1 .item .rate').each(function() {
		    sale_height = parseInt($(this).width());
		    percent = parseFloat($(this).attr("name"));
		    sale_height = percent*sale_height/5;
		    $(this).children().width(sale_height+"px");			
		});
		$(window).resize(function() {
			frame_width = $('.product_frame_1').width();
		    $('.product_frame_1 .product_image').width(frame_width);
		    $('.product_frame_1 .product_image').height(frame_width);
		    sale_height = parseInt($('.product_frame_1 .product_image .sale').height());
		    sale_height = 0-sale_height*2;
		    $('.product_frame_1 .product_image .sale').css("margin-bottom",sale_height+"px");
		    $('.product_frame_1 .product_image .like').css("margin-bottom",sale_height+"px");
	    	$('.product_frame_1 .item .rate').each(function() {
	    	    sale_height = parseInt($(this).width());
	    	    percent = parseFloat($(this).attr("name"));
	    	    sale_height = percent*sale_height/5;
	    	    $(this).children().width(sale_height+"px");			
	    	});			
		});
		
		$(document).on('click','.product_frame_1 .item .basket',function() {
            var ma = $(this).parent().parent().attr('name');				
			if (!$(this).hasClass('basket_choosen')) {
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
		$(document).on('click','.product_frame_1 .product_image .like',function() {
            var ma = $(this).parent().parent().attr('name');				
			if (!$(this).hasClass('like_choosen')) {
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