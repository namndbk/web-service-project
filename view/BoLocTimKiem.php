<div class="row">
<div class="item col-lg-12 col-md-12 col-sm-4 col-xs-6 sort">
	    <h4>Sắp xếp theo:</h4>
		<div name="giaGiam">Giá từ cao đến thấp</div>
		<div name="giaTang">Giá từ thấp đến cao</div>
		<div name="danhGia">Được yêu thích nhất</div>
</div>	
<div class="item col-lg-12 col-md-12 col-sm-4 col-xs-6 cost">	
	    <h4>Giá:</h4>
		<div>Từ : 
		    <div><input name="giamin" type="text"></div>
		</div>	
		<div>Đến: 
		    <div><input name="giamax" type="text"></div>
		</div>
</div>	
<div class="item col-lg-12 col-md-12 col-sm-4 col-xs-6 rate">	
	    <h4>Đánh giá:</h4>
		<div name="5"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></div>
		<div name="4"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></div>
		<div name="3"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></div>
		<div name="2"><i class="fa fa-star"></i><i class="fa fa-star"></i></div>
		<div name="1"><i class="fa fa-star"></i></div>
</div>
</div>	
<div class="row text-center">	
	<button id="LocTimKiem" class="btn btn-info btn-xs">Lọc</button>
</div>
<script language="javascript">
    $(document).ready(function() {	
	    var offset = 0;
		function checkGiaMin() {
			flag = false;
			if ($('.filter .row .cost input[name="giamin"]').val()!="") {
				var tienReg = /^(\d{1,3})(.\d{3})*$/;
			    if (tienReg.test($('.filter .row .cost input[name="giamin"]').val())) {				
				    flag = true;
			    } 
			}
			return flag;
		}
		function checkGiaMax() {
			flag = false;
			if ($('.filter .row .cost input[name="giamax"]').val()!="") {
				var tienReg = /^(\d{1,3})(.\d{3})*$/;
			    if (tienReg.test($('.filter .row .cost input[name="giamax"]').val())) {				
				    flag = true;
			    } 
			}
			return flag;
		}		
		$(document).on('click','.filter .row .sort div',function() {
			if ($(this).hasClass('choosen')) {
				$(this).removeClass('choosen');
			} else {
				var element = $('.filter .row .sort .choosen');
				if (element.length) {
					element.removeClass('choosen');
				}
				$(this).addClass('choosen');
			}
		});
		$(document).on('click','.filter .row .rate div',function() {
			if ($(this).children('i').hasClass('choosen')) {
				$(this).children('i').removeClass('choosen');
			} else {
				var element = $('.filter .row .rate .choosen');
				if (element.length) {
					element.removeClass('choosen');
				}
				$(this).children('i').addClass('choosen');
			}
		});
		$(document).on('click','#LocTimKiem',function() {
			offset = 0;
			var Para = "../controller/ListSanPham.php?";
			Para = Para + "type="+<?php echo "'$_GET[type]'"; ?>;
			<?php 
				if ($_GET['type']=='DanhMuc') {
			?>		
			    Para = Para +'&DanhMuc='+<?php echo "'$_GET[DanhMuc]'"; ?>;
			<?php		
				} else {
			?>
				Para = Para +'&xauTK='+<?php echo "'$_GET[xauTK]'"; ?>; 
            <?php				
				}
			?>			
			if ($('.filter .row .sort .choosen').length) {
				Para = Para+"&sort="+$('.filter .row .sort .choosen').attr('name');
			}
			if ($('.filter .row .rate .choosen').length) {
				Para = Para+"&danhGia="+$('.filter .row .rate .choosen').parent().attr('name');
			}
			if (checkGiaMin()) {
				Para = Para+"&minGia="+$('.filter .row .cost input[name="giamin"]').val();
			}
			if (checkGiaMax()) {
				Para = Para+"&maxGia="+$('.filter .row .cost input[name="giamax"]').val();			
			}
			$.ajax ({
			    url: Para,
			    type: "get",
			    dataType: "text",
			    data: {},
			    success: function(result) {
					$('.product_list').html(result);
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
				},
				error: function(){                            
                }
			});
		});
			    $(window).scroll(function (){
					if($(window).scrollTop() + $(window).height() == $(document).height()) {
						offset = offset+1;
				        var Para = "../controller/ListSanPham.php?";
			            Para = Para + "type="+<?php echo "'$_GET[type]'"; ?>;
			            <?php 
				            if ($_GET['type']=='DanhMuc') {
			            ?>		
			                Para = Para +'&DanhMuc='+<?php echo "'$_GET[DanhMuc]'"; ?>;
			            <?php		
				            } else {
			            ?>
				            Para = Para +'&xauTK='+<?php echo "'$_GET[xauTK]'"; ?>; 
                        <?php				
				            }
			            ?>	
                        Para = Para + '&offset='+offset;						
			            if ($('.filter .row .sort .choosen').length) {
				            Para = Para+"&sort="+$('.filter .row .sort .choosen').attr('name');
			            }
			            if ($('.filter .row .rate .choosen').length) {
				            Para = Para+"&danhGia="+$('.filter .row .rate .choosen').parent().attr('name');
			            }
			            if (checkGiaMin()) {
				            Para = Para+"&minGia="+$('.filter .row .cost input[name="giamin"]').val();
			            }
			            if (checkGiaMax()) {
				            Para = Para+"&maxGia="+$('.filter .row .cost input[name="giamax"]').val();			
			            }
			            $.ajax ({
			                url: Para,
			                type: "get",
			                dataType: "text",
			                data: {},
			                success: function(result) {
					            $('.product_list').append(result);
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
				            },
				            error: function(){                            
                            }
			            });				
                    }
				});		
	});
</script>