<?php
session_start();
if (isset($_SESSION['MaKH'])) {
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
        <link rel="stylesheet" href="CSSForTrangChu.css">		
		<link rel="stylesheet" href="CSSForForm.css">		
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	    <!--Jquery-->
        <script language="javascript" src="http://code.jquery.com/jquery-2.0.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
        <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
		<!--css-->	    
	</head>
    <body>
	<?php
		include "Banner.php";
	?>
    <div class="row sua_thong_tin_profile">
    <div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 col-xs-12 khung_info form_sua_profile">
       <form id="doiMatKhauForm" action="../controller/XuLyDoiMatKhau.php" method="POST">
        <div class="form_name">ĐỔI MẬT KHẨU</div>
            <div class="form_info">
                <label for="email">Email:</label>
                    <div><i class="fa fa-envelope"></i><input name="email" type="text"></div>	
            </div>
            <div class="form_info">
                <label for="password">Mật khẩu cũ:</label>
                    <div><i class="fa fa-key"></i><input name="password" type="password" id="password"></div>
            </div>
            <div class="form_info">
                <label for="newPassword">Mật khẩu mới:</label>
                <div><i class="fa fa-key"></i><input name="newPassword" type="password" id="newPassword"></div>
            </div>		
            <div class="form_info">
                <label for="confirmPassword">Xác nhận mật khẩu:</label>
                <div><i class="fa fa-key"></i><input name="confirmPassword" type="password" id="confirmPassword"></div>
            </div>	
            <div class="form_info">
                <div class="form_submit">
                    <button type="submit">Xác nhận</button>
                </div>
            </div>	
       </form>
      
    </div>    
    </div>

    </body>
    <script type="text/javascript">
        $(document).ready(function (){
            $("#doiMatKhauForm").validate({
                rules: {
                    email: {
                        required: true
                    },
                    password: {
                        required: true
                    },
                    newPassword: {
                        required: true,
                        notEqualTo: "#password"
                    },
                    confirmPassword: {
                        required: true,
                        equalTo: "#newPassword"
                    }
                },
                messages: {
                    email: "Xin vui lòng nhập email",
                    password: "Xin vui lòng nhập password",
                    newPassword:{
                        required: "Xin vui lòng nhập mật khẩu mới",
                        notEqualTo: "Mật khẩu mới phải khác mật khẩu cũ"
                    },
                    confirmPassword: "Xin vui lòng nhập đúng mật khẩu mới"  
                }
            });

    
        })
    </script>   
</html>
<?php
} else {
	header("Location: ../view/DangNhap.php", true, 301);	
}
?>	