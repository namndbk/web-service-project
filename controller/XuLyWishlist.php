<?php
	switch ($_GET['YCWishlist']) {
		case "Them":
		    if (isset($_COOKIE['Wishlist'])) {
				$listSP = json_decode($_COOKIE['Wishlist'], true);
				if (($key = array_search($_GET['MaSP'], $listSP)) !== false) {      
                } else {
					array_push($listSP,$_GET['MaSP']);
				}			
				setcookie("Wishlist",json_encode($listSP),time()+30758400,'/');
				$dem = count($listSP);
				if ($dem<=9) {
					echo $dem;
				} else {
					echo "+";
				}				
			} else {
				$listSP = array($_GET['MaSP']);
				setcookie("Wishlist",json_encode($listSP),time()+30758400,'/');
				echo "1";
			}
		    break;
		case "Xoa":
		    if (isset($_COOKIE['Wishlist'])) {
				$listSP = json_decode($_COOKIE['Wishlist'], true);
				if (($key = array_search($_GET['MaSP'], $listSP)) !== false) {
                    unset($listSP[$key]);
                }				
				setcookie("Wishlist",json_encode($listSP),time()+30758400,'/');
				$dem = count($listSP);
				if ($dem<=9) {
					echo $dem;
				} else {
					echo "+";
				}				
			} 		    
		    break;
		case "Dem":
		    if (isset($_COOKIE['Wishlist'])) {
				$listSP = json_decode($_COOKIE['Wishlist'], true);
				$dem = count($listSP);
				if ($dem<=9) {
					echo $dem;
				} else {
					echo "+";
				}
			} else {
				echo "0";
			}
		    break;
	}
?>