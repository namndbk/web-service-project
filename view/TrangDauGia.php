<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">	
	    <!--Boostrap-->
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="../view/CSSForTrangChu.css">		
		<link rel="stylesheet" href="../view/CSSForSanPhamChiTiet.css">
		<link rel="stylesheet" href="../view/CSSForBinhLuan.css">
		<link rel="stylesheet" href="../view/CSSForForm.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	    <!--Jquery-->
	    <script language="javascript" src="http://code.jquery.com/jquery-2.0.0.min.js"></script>
		<!--css-->	    
	</head>
    <body>
	    <?php
		    include "Banner.php";
		?>
        <?php
            include "SearchBar.php";
        ?>			
        <?php
		    include "DanhMuc.php";
		?>
        <?php 
            include "../controller/ThongTinSanPhamDauGia.php";
        ?>	
		<?php 
		    include "ODauGiaSanPham.php";
		?>
		<?php
		    include "BinhLuan.php";
		?>
        <?php
            include  "ScriptTrangChu.php";
        ?>			
	</body>
</html>	