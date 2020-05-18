<?php session_start(); ?>
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
        <link rel="stylesheet" href="CSSForTrangChu.css">	
        <link rel="stylesheet" href="CSSForForm.css">		
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	    <!--Jquery-->
	    <script language="javascript" src="http://code.jquery.com/jquery-2.0.0.min.js"></script>
		<!--css-->	    
	</head>
    <body>
	    <?php
		    include "Banner.php";
		?>
		<div class="login_form col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-10 col-sm-offset-1 col-xs-12">
        <div class="khung_info">
		    <div class="form_name">NHẬP THÔNG TIN TÀI KHOẢN</div>
		    <form method="post" action="../controller/XuLyDangNhap.php">
			    <div class="form_info">
				    <label>Email</label>
					<div><i class="fa fa-envelope"></i><input name="email" type="text"></div>
				</div>
				<div class="form_info">
				    <label>Password</label>
					<div><i class="fa fa-key"></i><input name="password" type="password"></div>
				</div>
				<?php
				    if (isset($_SESSION['TrangThaiDangNhap'])) {
				?>
				<div class="form_info">
				    <div class="form_submit" style="color:red; font-weight: bold;">
					    <?php 
						    echo $_SESSION['TrangThaiDangNhap'];
						    unset($_SESSION['TrangThaiDangNhap']);
						?>
					</div>
				</div>				    
				<?php
					}
				?>
				<div class="form_info">
				    <div class="form_submit">
					    <button type="submit">Đăng nhập</button>
					</div>
				</div>
				<div class="form_info">
				    <div class="form_submit">
					    <a href="TaoTaiKhoan.php">Đăng ký</a>
					</div>
				</div>
			</form>
        </div>
        </div>	
    </body>	
</html>