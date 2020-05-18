<?php
	switch ($_GET['YCBasket']) {
		case "Them":
		    if (isset($_COOKIE['Basket'])) {
				$listSP = json_decode($_COOKIE['Basket'], true);
				if (($key = array_search($_GET['MaSP'], $listSP)) !== false) {      
                } else {
					array_push($listSP,$_GET['MaSP']);
				}					
				setcookie("Basket",json_encode($listSP),time()+30758400,'/');
				$dem = count($listSP);
				if ($dem<=9) {
					echo $dem;
				} else {
					echo "+";
				}				
			} else {
				$listSP = array($_GET['MaSP']);
				setcookie("Basket",json_encode($listSP),time()+30758400,'/');
				echo "1";
			}
		    break;
		case "Xoa":
		    if (isset($_COOKIE['Basket'])) {
				$listSP = json_decode($_COOKIE['Basket'], true);
				if (($key = array_search($_GET['MaSP'], $listSP)) !== false) {
                    unset($listSP[$key]);
                }				
				setcookie("Basket",json_encode($listSP),time()+30758400,'/');
				$dem = count($listSP);
				if ($dem<=9) {
					echo $dem;
				} else {
					echo "+";
				}				
			} 		    
		    break;
		case "Dem":
		    if (isset($_COOKIE['Basket'])) {
				$listSP = json_decode($_COOKIE['Basket'], true);
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