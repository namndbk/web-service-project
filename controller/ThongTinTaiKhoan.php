<div class="row thong_tin_nguoi_dung">
    <div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-xs-10 col-xs-offset-1">
		<div class="title">THÔNG TIN CỦA BẠN</div>
		<?php
		    if (isset($_SESSION['MaKH'])) {
				include_once "../tool/Connection.php";
	            $conn = getConnection();
	            if ($conn->connect_error) {
                    $conn->close();		
	            } else {
			        $sql = "use BanHang;";
		            $conn->query($sql);
					$sql = "select * from `Tài Khoản` where MaKH = $_SESSION[MaKH];";
					$ketQua = $conn->query($sql);
					if ($ketQua->num_rows>0) {
						$row = $ketQua->fetch_assoc();
						echo "<div class=\"muc_thong_tin\">";
				        echo "<label><i class=\"fa fa-user-circle-o\"></i> Tên tài khoản: </label>";
					    echo "<div class=\"gia_tri\">$row[Ten]</div>";
				        echo "</div>";
			            echo "<div class=\"muc_thong_tin\">";
				        echo "<label><i class=\"fa fa-envelope\"></i> Email: </label>";
					    echo "<div class=\"gia_tri\">$row[Email]</div>";
				        echo "</div>";
			            echo "<div class=\"muc_thong_tin\">";
				        echo "<label><i class=\"fa fa-phone-square\"></i> Số điện thoại: </label>";
					    echo "<div class=\"gia_tri\">$row[SDT]</div>";
				        echo "</div>";
			            echo "<div class=\"muc_thong_tin\">";
				        echo "<label><i class=\"fa fa-home\"></i> Địa chỉ: </label>";
					    echo "<div class=\"gia_tri\">$row[DiaChi]</div>";
		                echo "</div>";	
					}
					$conn->close();
				}
			}
		?>			    			
	</div>
</div>