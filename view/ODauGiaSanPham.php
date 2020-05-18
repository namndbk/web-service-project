<div style="background-image: linear-gradient(#ffffff,#ffffba);" class="row">
<div class="o_dau_gia khung_info col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 col-xs-12">
    <div class="form_name">NHẬP MỨC GIÁ ĐẤU</div>
	<div class="form_info">
	    <label>Giá đấu:</label>
		<div><i class="fa fa-usd"></i><input type="text"></div>
	</div>
	<div class="form_info">
		<div class="form_submit">
			<button type="submit">Gửi</button>
		</div>
	</div>		
</div>
</div>
<div class="thong_bao_sau_nhap">
    <div class="status">Đấu giá thành công</div>
	<div class="xac_nhan"><button class="btn btn-xs btn-success">OK</button></div>
</div>
<script language="javascript">
    $(document).ready(function() {
		$(document).on('click','.o_dau_gia .form_submit button',function() {
			$('.o_dau_gia').css('filter','blur(15px)');
			$('.thong_so_san_pham .gia_ca .gia_cu').html($('.thong_so_san_pham .gia_ca .gia_moi').html());
			$('.thong_so_san_pham .gia_ca .gia_moi').html($('.o_dau_gia .form_info input[type="text"]').val());
			$('.thong_so_san_pham .danh_gia').html("Tài khoản trả giá: Change");
			$('.thong_bao_sau_nhap').css('bottom','20px');
		});		
		$(document).on('click','.thong_bao_sau_nhap button',function() {
			$('.o_dau_gia .form_info input[type="text"]').val("");
			$(this).parent().parent().css('bottom','-14rem');
			$('.o_dau_gia').css('filter','none');
		});
	});	
</script>