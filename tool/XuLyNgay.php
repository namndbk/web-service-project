<?php
function xuLyNgay($ngay) {
	$mang = explode(' ',$ngay);
	$ketQua = $mang[1];
	$ketQua.= ' ';
	$ngayThang = explode('-',$mang[0]);
	$ketQua.= "$ngayThang[2]-";
	$ketQua.= "$ngayThang[1]-";
	$ketQua.= "$ngayThang[0]";
	return $ketQua;
}
?>