<?php
    include_once "../tool/XuLyGia.php";
    if (isset($_GET['MaSP'])) {
		include_once "../tool/Connection.php";
	    $conn = getConnection();
	    if ($conn->connect_error) {
            $conn->close();		
	    } else {
		    $sql = "use BanHang;";
		    $conn->query($sql);
			$sql = "select * from `Sản Phẩm` where MaSP = $_GET[MaSP];";
			$ketQua = $conn->query($sql);
			if ($ketQua->num_rows>0) {
				$sp = $ketQua->fetch_assoc();
			}
			$conn->close();
        }			
    } 
?>
<div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 col-xs-12 khung_info form_thong_tin_san_pham">
    <div name="" class="form_name">NHẬP THÔNG TIN SẢN PHẨM</div>
	<div class="form_info">
	    <label>Tên sản phẩm:</label>
		<?php		    
            if (isset($sp)) {
				echo "<div><i class=\"fa fa-gift\"></i><input name=\"TenSP\" type=\"text\" value=\"$sp[TenSP]\"></div>";
			} else {
				echo "<div><i class=\"fa fa-gift\"></i><input name=\"TenSP\" type=\"text\"></div>";
			}	
		?>
	</div>
	<div class="form_info">
	    <label>Giá gốc:</label>
		<?php
            if (isset($sp)) {
				$tien = tienSangXau($sp['GiaGoc']);
				$tien = str_replace('VND','',$tien);
				echo "<div><i class=\"fa fa-usd\"></i><input name=\"GiaGoc\" type=\"text\" value=\"$tien\"></div>";
			} else {
				echo "<div><i class=\"fa fa-usd\"></i><input name=\"GiaGoc\" type=\"text\"></div>";
			}	
		?>		
	</div>
	<div class="form_info">
	    <label>Giá sale:</label>
		<?php
            if (isset($sp)) {
				$tien = tienSangXau($sp['GiaGiam']);
				$tien = str_replace('VND','',$tien);				
				echo "<div><i class=\"fa fa-arrow-down\"></i><input name=\"GiaGiam\" type=\"text\" value=\"$tien\"></div>";
			} else {
				echo "<div><i class=\"fa fa-arrow-down\"></i><input name=\"GiaGiam\" type=\"text\"></div>";
			}	
		?>		
	</div>
	<div class="form_info">
	    <label>Tồn kho:</label>
		<?php		    
            if (isset($sp)) {
				echo "<div><i class=\"fa fa-balance-scale\"></i><input name=\"SoLuongTonKho\" type=\"text\" value=\"$sp[SoLuongTonKho]\"></div>";
			} else {
				echo "<div><i class=\"fa fa-balance-scale\"></i><input name=\"SoLuongTonKho\" type=\"text\"></div>";
			}	
		?>		
	</div>	
	<div class="form_info">
	    <label>Ảnh:</label>
		<div class="anh_san_pham">
		    <ul class="list-inline">
			    <li>
				    <div><input type="file" name="Image1" style="display:none;"></div>
					<?php		    
                        if (isset($sp)) {
							if ($sp['Image1']=="") {
								echo "<div class=\"anh\"><img width=\"100%\" height=\"100%\" src=\"Images/anhtrong.png\"></div>";
							} else {
								echo "<div class=\"anh\"><img width=\"100%\" height=\"100%\" src=\"$sp[Image1]\"></div>";
							}				            
			            } else {
				            echo "<div class=\"anh\"><img width=\"100%\" height=\"100%\" src=\"Images/anhtrong.png\"></div>";
			            }	
		            ?>	
				</li>
				<li>
				    <div><input type="file" name="Image2" style="display:none;"></div>
					<?php		    
                        if (isset($sp)) {
							if ($sp['Image2']=="") {
								echo "<div class=\"anh\"><img width=\"100%\" height=\"100%\" src=\"Images/anhtrong.png\"></div>";
							} else {
								echo "<div class=\"anh\"><img width=\"100%\" height=\"100%\" src=\"$sp[Image2]\"></div>";
							}				            
			            } else {
				            echo "<div class=\"anh\"><img width=\"100%\" height=\"100%\" src=\"Images/anhtrong.png\"></div>";
			            }	
		            ?>	
				</li>
				<li>
				    <div><input type="file" name="Image3" style="display:none;"></div>
					<?php		    
                        if (isset($sp)) {
							if ($sp['Image3']=="") {
								echo "<div class=\"anh\"><img width=\"100%\" height=\"100%\" src=\"Images/anhtrong.png\"></div>";
							} else {
								echo "<div class=\"anh\"><img width=\"100%\" height=\"100%\" src=\"$sp[Image3]\"></div>";
							}				            
			            } else {
				            echo "<div class=\"anh\"><img width=\"100%\" height=\"100%\" src=\"Images/anhtrong.png\"></div>";
			            }	
		            ?>	
				</li>
			</ul>
		</div>
		
		<script>
		    $(document).ready(function() {
				var img_height = $('.form_info').width();
				img_height = parseInt(img_height);
				img_height = img_height/4;
				$('.form_info .anh_san_pham .list-inline li').width(img_height+'px');
				$('.form_info .anh_san_pham .list-inline li .anh').height(img_height+'px');
				
				$(document).on('click','.form_info .anh_san_pham .list-inline li .anh img',function () {
					var element = $(this).parent().parent();
					element = element.children('div:eq(0)').children('input[type="file"]');
					element.click();
				});
				
				$(window).resize(function () {
					img_height = $('.form_info').width();
				    img_height = parseInt(img_height);
				    img_height = img_height/4;
				    $('.form_info .anh_san_pham .list-inline li').width(img_height+'px');
				    $('.form_info .anh_san_pham .list-inline li .anh').height(img_height+'px');
				});
				
				$(document).on('change','input[type="file"]',function () {
					var element = $(this).parent().parent();
					element = element.children('.anh');
					element = element.children('img');
					element.attr('src',URL.createObjectURL($(this)[0].files[0]));
				});
			})
		</script>
		
		
	</div>	
	<div class="form_info">
	    <label>Mô tả:</label>
		<?php
            if (isset($sp)) {
				$tien = tienSangXau($sp['GiaGiam']);
				str_replace('VND','',$tien);				
				echo "<div><i class=\"fa fa-pencil\"></i><input name=\"Description\" type=\"text\" value=\"$sp[Description]\"></div>";
			} else {
				echo "<div><i class=\"fa fa-pencil\"></i><input name=\"Description\" type=\"text\"></div>";
			}	
		?>					
	</div>	
	<div class="form_info">
	    <label>Ngành hàng:</label>
		<div style="text-align:center;" class="nganh_hang">
		    <ul class="list-inline">
		        <li><span><input type="radio" name="LoaiSP" value="dien_thoai" hidden></span><span class="fas fa-mobile"></span></li>
			    <li><span><input type="radio" name="LoaiSP" value="lap_top" hidden></span><span class="fas fa-laptop"></span></li>
			    <li><span><input type="radio" name="LoaiSP" value="phu_kien" hidden></span><span class="fa fa-cogs"></span></li>
			    <li><span><input type="radio" name="LoaiSP" value="thiet_bi_dien_tu" hidden></span><span class="fas fa-tv"></span></li>
			    <li><span><input type="radio" name="LoaiSP" value="loa_tai_nghe" hidden></span><span class="fas fa-headphones"></span></li>
			    <li><span><input type="radio" name="LoaiSP" value="may_anh" hidden></span><span class="fa fa-camera"></span></li>
			    <li><span><input type="radio" name="LoaiSP" value="thoi_trang" hidden></span><span class="fas fa-tshirt"></span></li>
			    <li><span><input type="radio" name="LoaiSP" value="giay_dep" hidden></span><span class="fas fa-shoe-prints"></span></li>
			    <li><span><input type="radio" name="LoaiSP" value="me_va_be" hidden></span><span class="fas fa-baby-carriage"></span></li>
			    <li><span><input type="radio" name="LoaiSP" value="nha_cua" hidden></span><span class="fas fa-home"></span></li>
			    <li><span><input type="radio" name="LoaiSP" value="thu_cung" hidden></span><span class="fas fa-paw"></span></li>
			    <li><span><input type="radio" name="LoaiSP" value="sach" hidden></span><span class="fas fa-book"></span></li>
			    <li><span><input type="radio" name="LoaiSP" value="xe_co" hidden></span><span class="fas fa-car"></span></li>
			</ul>
		</div>
	</div>
	<?php
	    if (isset($sp)) {
	?>
	<script language="javascript">
	    $(document).ready(function() {
			var tennganh = "<?php echo $sp['LoaiSP'];?>";
			var choosen = ".form_thong_tin_san_pham .form_info .nganh_hang  input[value=\"";
			choosen = choosen + tennganh;
			choosen = choosen + "\"]";
			var element = $(choosen);
			element.prop('checked',true);
			element = element.parent().parent().children('span:eq(1)');
			element.addClass('choosen');
		});
	</script>
	<?php
	    }
	?>
	<div class="form_info">
		<div class="form_submit">
			<button type="submit">Lưu</button>
		</div>
	</div>	
</div>
<div class="thong_bao_sau_nhap">
    <div class="status">Nhập thông tin thành công</div>
	<div class="xac_nhan"><button class="btn btn-xs btn-success">OK</button></div>
</div>
<script language="javascript">
    $(document).ready(function() {
		function kiemTraTrong() {
			var flag = true;
			if ($('.form_thong_tin_san_pham input[name="TenSP"]').val()=="") {
				flag = false;
			}
			if ($('.form_thong_tin_san_pham input[name="GiaGoc"]').val()=="") {
				flag = false;
			}
			if ($('.form_thong_tin_san_pham input[name="SoLuongTonKho"]').val()=="") {
				flag = false;
			}
			if ($('.form_thong_tin_san_pham input[name="LoaiSP"]:checked').length==0) {
				flag = false;
			}
			if ($('.form_thong_tin_san_pham input[name="Description"]').val()=="") {
				flag = false;
			}			
            return flag;			
		}
		function kiemTraTien() {
			var flag = true;
			var tienReg = /^(\d{1,3})(.\d{3})*$/;
			if (!tienReg.test($('.form_thong_tin_san_pham input[name="GiaGoc"]').val())) {				
				flag = false;
			} else {
				if ($('.form_thong_tin_san_pham input[name="GiaGiam"]').val()!="") {
					if (!tienReg.test($('.form_thong_tin_san_pham input[name="GiaGiam"]').val())) {
						flag = false;
					}
				}
			}
			return flag;
		}
		function kiemTraSoLuong() {
			var sLReg = /^(\d+)$/;
			if (!sLReg.test($('.form_thong_tin_san_pham input[name="SoLuongTonKho"]').val())) {
				return false;
			} else {
				return true;
			}
		}
		function kiemTraForm() {
			if (kiemTraTrong()) {
				if (kiemTraSoLuong()) {
					if (kiemTraTien()) {
						return true;
					} else {
						return false;
					}
				} else {
					return false;
				}
			} else {
				return false;
			}
		}
		$(document).on('click','.form_thong_tin_san_pham .form_submit button',function() {
			if (kiemTraForm()) {
				$('.form_thong_tin_san_pham').css('filter','blur(15px)');
		    	var form_data = new FormData();
                form_data.append('TenSP',$('.form_thong_tin_san_pham input[name="TenSP"]').val());	
                form_data.append('GiaGoc',$('.form_thong_tin_san_pham input[name="GiaGoc"]').val());
                if ($('.form_thong_tin_san_pham input[name="GiaGiam"]').val()=="") {
		    		form_data.append('GiaGiam',$('.form_thong_tin_san_pham input[name="GiaGoc"]').val());
			    } else {
			    	form_data.append('GiaGiam',$('.form_thong_tin_san_pham input[name="GiaGiam"]').val());
			    }			            
                form_data.append('SoLuongTonKho',$('.form_thong_tin_san_pham input[name="SoLuongTonKho"]').val());
                form_data.append('Description',$('.form_thong_tin_san_pham input[name="Description"]').val());
                form_data.append('LoaiSP',$('.form_thong_tin_san_pham input[name="LoaiSP"]:checked').val());
		    	if ($('.form_thong_tin_san_pham .form_name').attr('name')!="") {
		    		form_data.append('MaSP',$('.form_thong_tin_san_pham .form_name').attr('name'));
		    	}
                if ($('.form_thong_tin_san_pham input[name="Image1"]')[0].files.length) {
		    		form_data.append('Image1', $('.form_thong_tin_san_pham input[name="Image1"]').prop('files')[0]);
		    	}	
                if ($('.form_thong_tin_san_pham input[name="Image2"]')[0].files.length) {
		    		form_data.append('Image2', $('.form_thong_tin_san_pham input[name="Image2"]').prop('files')[0]);
		    	}	
                if ($('.form_thong_tin_san_pham input[name="Image3"]')[0].files.length) {
		    		form_data.append('Image3', $('.form_thong_tin_san_pham input[name="Image3"]').prop('files')[0]);
		    	}
                <?php
				    if (isset($sp)) {
				?>
				    form_data.append('MaSP',<?php echo $_GET['MaSP'];?>);
				<?php
					}
                ?>				
		    	$.ajax ({
			        url: "../controller/ThemSanPham.php",
			        type: "post",
			        dataType: 'text',
                    cache: false,
                    contentType: false,
                    processData: false,
			        data: form_data,
			        success: function(result) {
			    		$('.thong_bao_sau_nhap .status').html(result);
			        	$('.thong_bao_sau_nhap').css('bottom','20px');
			    	},
			    	error: function(){
			        	$('.thong_bao_sau_nhap .status').html('Yêu cầu thất bại');
			        	$('.thong_bao_sau_nhap').css('bottom','20px');                          
                    }
		    	});	
			} else {
				$('.form_thong_tin_san_pham').css('filter','blur(15px)');
				$('.thong_bao_sau_nhap .status').html('Thông tin nhập chưa chính xác');
				$('.thong_bao_sau_nhap').css('bottom','20px');
			}				
		});		
		$(document).on('click','.thong_bao_sau_nhap button',function() {
			$(this).parent().parent().css('bottom','-14rem');
			$('.form_thong_tin_san_pham').css('filter','none');
		});
		$(document).on('click','.form_thong_tin_san_pham .form_info .nganh_hang span',function() {
			if ($(this).hasClass('choosen')) {
			    $(this).removeClass('choosen');
			    element = $(this).parent();
			    element = element.children('span:eq(0)');
			    element = element.children('input[type="radio"]');
			    element.prop('checked', false);					
			} else {
			    var element = $('.form_thong_tin_san_pham .form_info .nganh_hang .choosen');
			    if (element.length) {
				    element.removeClass('choosen');				
			    }
			    $(this).addClass('choosen');
			    element = $(this).parent();
			    element = element.children('span:eq(0)');
			    element = element.children('input[type="radio"]');
			    element.prop('checked', true);				
			}
		});
	});
</script>