<div class="row dau_gia">
    <div class="dau_gia_frame col-lg-3 col-md-4 col-sm-4 col-xs-12">
	    <a href="ListDauGia.php"><img width="100%" height="100%" src="Images/daugia.png"></a>
	</div>
	<div class="san_pham_dau_gia col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <?php
		    $_GET['Type'] = "TrangChu";
            include "../controller/ListSanPhamDauGia.php";		
        ?>		
    </div>  		
</div>
<script language="javascript">
    $(document).ready(function() {
		var height_frame = parseInt($('.dau_gia_frame').height());
		$('.san_pham_dau_gia').height(height_frame+"px");
		height_frame = 0.45*height_frame;
		$('.product_frame_2').height(height_frame+"px");
		$('.product_frame_2 .product_image').height(height_frame+"px");
		$('.product_frame_2 .product_image').width(height_frame+"px");
		var width_frame = parseInt($('.product_frame_2').width());
		width_frame = 0.98*width_frame-height_frame;
		$('.dau_gia_info').width(width_frame+"px");
		height_frame = height_frame/4.5;
		$('.product_frame_2').css("margin-bottom",height_frame+"px");
		
        $(window).resize(function() {
	     	var height_frame = parseInt($('.dau_gia_frame').height());
	    	height_frame = 0.45*height_frame;
	    	$('.product_frame_2').height(height_frame+"px");
	    	$('.product_frame_2 .product_image').height(height_frame+"px");
	    	$('.product_frame_2 .product_image').width(height_frame+"px");
			width_frame = parseInt($('.product_frame_2').width());
		    width_frame = 0.98*width_frame-height_frame;
		    $('.dau_gia_info').width(width_frame+"px");		
		    height_frame = height_frame/4.5;
		    $('.product_frame_2').css("margin-bottom",height_frame+"px");			
		});
	});    
</script>