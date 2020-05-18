<div class="row quang_cao">
	<div class="quang_cao_frame slide col-lg-12 col-md-12 col-sm-12 col-xs-12">  
	    <div class="row slide-window">	
		    <div class="slide-element advertisement">
			    <a href="SearchSanPham.php?type=DanhMuc&DanhMuc=dien_thoai"><img width="90%"  height="100%" src="Images/quangcaodientu.png"></a>
			</div>		
		    <div class="slide-element advertisement">
			    <a href="SearchSanPham.php?type=DanhMuc&DanhMuc=thoi_trang"><img width="90%"  height="100%" src="Images/quangcaoquanao.png"></a>
			</div>	
		    <div class="slide-element advertisement">
			    <a href="SearchSanPham.php?type=DanhMuc&DanhMuc=sach"><img width="90%"  height="100%" src="Images/quangcaosach.png"></a>
			</div>	
		    <div class="slide-element advertisement">
			    <a href="SearchSanPham.php?type=DanhMuc&DanhMuc=me_va_be"><img width="90%"  height="100%" src="Images/quangcaome&be.png"></a>
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
		var quang_cao_frame_width = parseInt($(".quang_cao_frame").width());
		quang_cao_frame_width = quang_cao_frame_width/2;
		$(".advertisement").width(quang_cao_frame_width+"px");
		
        $(window).resize(function() {		
		    var quang_cao_frame_width = parseInt($(".quang_cao_frame").width());
		    quang_cao_frame_width = quang_cao_frame_width/2;
		    $(".advertisement").width(quang_cao_frame_width+"px");
		});
	});
</script>