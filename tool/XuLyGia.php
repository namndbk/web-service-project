<?php
    function xauSangTien($xau) {
		$tien = str_replace('.','',$xau);
		$tien = str_replace('VND','',$tien);
		return $tien;
	}
	function tienSangXau($tien) {
		$dem = 0;
		$xau = 'VND';
		for ($i = strlen($tien)-1; $i >= 0; $i-- ) {
			$xau = $tien[$i].$xau;
			$dem++;
			if ($dem==3) {
				$dem=0;
				if ($i>0) {
					$xau = '.'.$xau;
				}
			}
		}
        return $xau;		
	}
?>