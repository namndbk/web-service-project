<?php 
if (isset($_SESSION['MaKH'])) {
?>	
<div class="danh_gia_san_pham">
    <div class="title">Đánh giá: </div>
	<div class="danh_gia_sao">
	    <div name="5"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></div>
		<div name="4"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></div>
		<div name="3"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></div>
		<div name="2"><i class="fa fa-star"></i><i class="fa fa-star"></i></div>
		<div name="1"><i class="fa fa-star"></i></div>	    
	</div>
	<div class="nut_luu" hidden>
	    <button class="btn btn-xs btn-info"><i class="fa fa-reply"></i> Gửi</button>
	</div>
</div>
<script language="javascript">
    $(document).ready(function() {
		$(document).on('click','.danh_gia_san_pham .danh_gia_sao div',function() {
			if ($(this).children('i').hasClass('choosen')) {
				$(this).children('i').removeClass('choosen');
				$('.danh_gia_san_pham .nut_luu').attr('hidden','true');
			} else {
				var element = $('.danh_gia_san_pham .danh_gia_sao div .choosen');
				if (element.length) {
					element.removeClass('choosen');
				}
				$(this).children('i').addClass('choosen');
				$('.danh_gia_san_pham .nut_luu').removeAttr('hidden');
			}
		});
		$(document).on('click','.danh_gia_san_pham .nut_luu',function() {
			$(this).attr('hidden','true');
			var element = $('.danh_gia_san_pham .danh_gia_sao div .choosen');
			$.ajax ({
			    url: "../controller/XuLyDanhGia.php",
			    type: "get",
			    dataType: "text",
			    data: {
					MaSP : <?php echo $_GET['MaSP']; ?>,
					DanhGia : element.parent().attr('name')
				},
			    success: function(result) {
			    	$('.thong_tin_san_pham .thong_so_san_pham .rate').attr('name',result);
					$('.thong_tin_san_pham .thong_so_san_pham .rate').each(function() {
		                sale_height = parseInt($(this).width());
		                percent = parseFloat($(this).attr("name"));
		                sale_height = percent*sale_height/5;
		                $(this).children().width(sale_height+"px");			
		            });
				},
				error: function(){                          
                }
			});			
			if (element.length) {
				element.removeClass('choosen');
			}			
		});		
	});
</script>
<?php
    }
?>
<div class="binh_luan_san_pham">
    <div class="title">Bình luận: </div>
	<div class="list_binh_luan">
<?php
	include_once "../tool/Connection.php";
	$conn = getConnection();
	if ($conn->connect_error) {
        $conn->close();		
	} else {
		$sql = "use BanHang;";
		$conn->query($sql);
		$sql = "select * from `Bình Luận`,`Tài Khoản` where MaSP = $_GET[MaSP] and MaBLGoc=-1 and `Tài Khoản`.MaKH = `Bình Luận`.MaKH order by MaBL desc;";
		$ketQua = $conn->query($sql);
		if ($ketQua->num_rows > 0) {
			while($row = $ketQua->fetch_assoc()) {
				echo "<div name=\"$row[MaBL]\" class=\"binh_luan\">";
				if (isset($_SESSION['MaKH'])) {
					if ($_SESSION['MaKH']==$row['MaKH']) {
						echo "<div class=\"tai_khoan\">YOU</div>";
					} else {
						echo "<div class=\"tai_khoan\">$row[Ten]</div>";
					}
				} else {
					echo "<div class=\"tai_khoan\">$row[Ten]</div>";
				}
				echo "<div class=\"noi_dung\">";
				if (isset($_SESSION['MaKH'])) {
					if ($_SESSION['MaKH']==$row['MaKH']) {
						echo "<div>YOU: $row[Content]</div>";
					} else {
						echo "<div>$row[Ten]: $row[Content]</div>";
					}
				} else {
					echo "<div>$row[Ten]: $row[Content]</div>";
				}				
				$sql = "select * from `Bình Luận`,`Tài Khoản` where MaBLGoc = $row[MaBL] and `Tài Khoản`.MaKH = `Bình Luận`.MaKH order by commentDate asc;";
				$kq = $conn->query($sql);
				if ($kq->num_rows > 0) {
			        while($bl = $kq->fetch_assoc()) {
						if (isset($_SESSION['MaKH'])) {
					        if ($_SESSION['MaKH']==$row['MaKH']) {
						        echo "<div>YOU: $bl[Content]</div>";
					        } else {
						        echo "<div>$bl[Ten]: $bl[Content]</div>";
					        }
				        } else {
					        echo "<div>$bl[Ten]: $bl[Content]</div>";
				        }
					}
				}
				echo "</div>";
				if (isset($_SESSION['MaKH'])) {
					echo "<div class=\"nut_reply\">Trả lời</div>";
					echo "<div class=\"o_input\" hidden>";
		            echo "<input type=\"text\" placeholder=\"Trả lời\">";
			        echo "<span class=\"fa fa-paper-plane\"></span>";
			        echo "<span class=\"fa fa-angle-double-up\"></span>";
		            echo "</div>";
				}
				echo "</div>";
			}
		}
		$conn->close();
	}	
?>		
	</div>
<?php	
if (isset($_SESSION['MaKH'])) {
?>	
    <div class="binh_luan_moi">
	    <input type="text" placeholder="Bình luận">
		<span class="fa fa-paper-plane"></span>
    </div>
<?php
}	
?>	
</div>
<script language="javascript">
    $(document).ready(function() {
		$(document).on('click','.binh_luan_san_pham .binh_luan .nut_reply', function() {
			var parent = $(this).parent();
			parent.children('.o_input').removeAttr('hidden');
			$(this).attr('hidden','true');
		});
		$(document).on('click','.binh_luan_san_pham .binh_luan .o_input .fa-angle-double-up', function() {
			var parent = $(this).parent();
			parent.attr('hidden','true');
			parent = parent.parent();
			parent = parent.children('.nut_reply');
			parent.removeAttr('hidden');
		});	
		$(document).on('click','.binh_luan_san_pham .binh_luan .o_input .fa-paper-plane', function() {
			var parent = $(this).parent();
			parent=parent.children('input[type="text"]');
			var content = parent.val();	
            if (content.length) {
				$.ajax ({
			    	url: "../controller/XuLyBinhLuan.php",
			    	type: "post",
			    	dataType: "text",
			    	data: {
						isNew : 'N',
						MaSP : <?php echo $_GET['MaSP']; ?>,
						Content : content,
						MaBLGoc : $(this).parent().parent().attr('name')
					},
			    	success: function(result) {
						parent.val("");
				        parent = parent.parent().parent().children('.noi_dung');
						parent.append(result);
				    },
				    error: function(){                          
                    }
				});
			}	
		});	
		$(document).on('click','.binh_luan_san_pham .binh_luan_moi span:eq(0)', function() {
			var parent = $(this).parent();
			parent=parent.children('input[type="text"]');
			var content = parent.val();	
            if (content.length) {
				$.ajax ({
			    	url: "../controller/XuLyBinhLuan.php",
			    	type: "post",
			    	dataType: "text",
			    	data: {
						isNew : 'Y',
						MaSP : <?php echo $_GET['MaSP']; ?>,
						Content : content
					},
			    	success: function(result) {
						parent.val("");
				        parent = parent.parent().parent();
						parent = parent.children('.list_binh_luan');
						new_BL = result + parent.html();
						parent.html(new_BL);
				    },
				    error: function(){                          
                    }
				});			
			}	
		});			
	});
</script>