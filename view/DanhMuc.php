<div class="row danh_muc">
    <div class="ban_hang_frame col-lg-4 col-md-4 col-sm-12 col-xs-12">
	    <a href="TrangCuaHang.php"><img width="100%" src="Images/banhang.png"></a>
	</div>
	<div class="danh_muc_frame slide col-lg-8 col-md-8 col-sm-12 col-xs-12">  
	    <div class="row slide-window">	
		    <div class="slide-element category">
			    <a href="SearchSanPham.php?type=DanhMuc&DanhMuc=dien_thoai"><img width="100%" height="100%" src="Images/dienthoai.png"></a>
			</div>
		    <div class="slide-element category">
			    <a href="SearchSanPham.php?type=DanhMuc&DanhMuc=lap_top"><img width="100%" height="100%" src="Images/laptop.png"></a>
			</div>
		    <div class="slide-element category">
			    <a href="SearchSanPham.php?type=DanhMuc&DanhMuc=phu_kien"><img width="100%" height="100%" src="Images/phukien.png"></a>
			</div>
		    <div class="slide-element category">
			    <a href="SearchSanPham.php?type=DanhMuc&DanhMuc=thiet_bi_dien_tu"><img width="100%" height="100%" src="Images/thietbidientu.png"></a>
			</div>
		    <div class="slide-element category">
			    <a href="SearchSanPham.php?type=DanhMuc&DanhMuc=loa_tai_nghe"><img width="100%" height="100%" src="Images/loa&tainghe.png"></a>
			</div>
		    <div class="slide-element category">
			    <a href="SearchSanPham.php?type=DanhMuc&DanhMuc=may_anh"><img width="100%" height="100%" src="Images/mayanh.png"></a>
			</div>
		    <div class="slide-element category">
			    <a href="SearchSanPham.php?type=DanhMuc&DanhMuc=thoi_trang"><img width="100%" height="100%" src="Images/thoitrang.png"></a>
			</div>
		    <div class="slide-element category">
			    <a href="SearchSanPham.php?type=DanhMuc&DanhMuc=giay_dep"><img width="100%" height="100%" src="Images/giaydep.png"></a>
			</div>
		    <div class="slide-element category">
			    <a href="SearchSanPham.php?type=DanhMuc&DanhMuc=me_va_be"><img width="100%" height="100%" src="Images/me&be.png"></a>
			</div>		
		    <div class="slide-element category">
			    <a href="SearchSanPham.php?type=DanhMuc&DanhMuc=nha_cua"><img width="100%" height="100%" src="Images/nhacua.png"></a>
			</div>	
		    <div class="slide-element category">
			    <a href="SearchSanPham.php?type=DanhMuc&DanhMuc=thu_cung"><img width="100%" height="100%" src="Images/thucung.png"></a>
			</div>	
		    <div class="slide-element category">
			    <a href="SearchSanPham.php?type=DanhMuc&DanhMuc=sach"><img width="100%" height="100%" src="Images/sach.png"></a>
			</div>	
		    <div class="slide-element category">
			    <a href="SearchSanPham.php?type=DanhMuc&DanhMuc=xe_co"><img width="100%" height="100%" src="Images/xeco.png"></a>
			</div>						
		</div>	
        <div class="row slide-button">
		    <div class="fa fa-1x fa-arrow-circle-left slide-prev"></div>		
		    <div class="fa fa-1x fa-arrow-circle-right slide-next"></div>		
        </div>		
	</div>
</div>
<script language="javascript">
    $(document).ready(function() {
		var banhang_height = $(".ban_hang_frame").height();
		$(".danh_muc_frame").height(banhang_height);
		var danh_muc_frame_width = parseInt($(".danh_muc_frame").width());
		danh_muc_frame_width = danh_muc_frame_width/5;
		$(".category").width(danh_muc_frame_width+"px");
		
        $(window).resize(function() {		
		    banhang_height = $(".ban_hang_frame").height();
		    $(".danh_muc_frame").height(banhang_height);
		    danh_muc_frame_width = parseInt($(".danh_muc_frame").width());
		    danh_muc_frame_width = danh_muc_frame_width/5;
		    $(".category").width(danh_muc_frame_width+"px");
		});
	});
</script>
<?php
    include "ScriptTrangChu.php";
?>