<?php
function isExist($mang,$pt) {
	if (($key=array_search($pt, $mang)) !== false) {
        return true;
    } else {
		return false;
	}	
}
function catDonHang($xau) {
	$tg = trim($xau);
	return explode(' ', $tg);
}
function getMaSP($xau) {
	$mang = explode('SL',$xau);
    return intval($mang[0]);	
}
function getSL($xau) {
	$mang = explode('SL',$xau);
    return intval($mang[1]);	
}
?>