<?php
session_start();
if (isset($_SESSION['MaKH'])) {
	include_once "../tool/Connection.php";
	$conn = getConnection();
	if ($conn->connect_error) {
        $conn->close();		
	} else {
		$sql = "use BanHang;";
		$conn->query($sql);
		if ($_POST['isNew']=='Y') {
			$sql = "insert into `Bình Luận`(MaSP,MaKH,Content,commentDate,MaBLGoc) values";
			$sql.= "($_POST[MaSP],$_SESSION[MaKH],'$_POST[Content]',now(),-1);";
			if ($conn->query($sql)) {
				$sql = "select * from `Bình Luận` order by MaBL desc limit 1;";
				$ketQua = $conn->query($sql);
				if ($ketQua->num_rows > 0) {
					$ma = $ketQua->fetch_assoc();
					echo "<div name=\"$ma[MaBL]\" class=\"binh_luan\">";
				} else {
					echo "<div class=\"binh_luan\">";
				}
				echo "<div class=\"tai_khoan\">YOU</div>";
		        echo "<div class=\"noi_dung\">";
		        echo "<div>$_POST[Content]</div>";
		        echo "</div>";
		        echo "<div class=\"nut_reply\">Trả lời</div>";
		        echo "<div class=\"o_input\" hidden>";
		        echo "<input type=\"text\" placeholder=\"Trả lời\">";
			    echo "<span class=\"fa fa-paper-plane\"></span>";
			    echo "<span class=\"fa fa-angle-double-up\"></span>";
		        echo "</div>";
	            echo "</div>";	
			} 
		} else {
			$sql = "insert into `Bình Luận`(MaSP,MaKH,MaBLGoc,Content,commentDate) values";
			$sql.= "($_POST[MaSP],$_SESSION[MaKH],$_POST[MaBLGoc],'$_POST[Content]',now());";
			if ($conn->query($sql)) {
				echo "<div>YOU: $_POST[Content]</div>";
			} 
		}
		$conn->close();
	}
} else {
	header("Location: ../view/DangNhap.php", true, 301);	
}	
?>