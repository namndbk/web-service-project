<?php session_start() ?>
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
        <style>
            .notify {
                margin-top: 100px;
                font-family: 'Courier New', Courier, monospace;
                font-size: 3em;
            }
            .instruction {
                margin-top: 50px;
                font-family: 'Courier New', Courier, monospace;
                font-size: 1.5em;
            }
        </style>      
	</head>
    <body>
        <?php include 'Banner.php' ?>
        <div class="container-fluid">
            <?php if(isset($_SESSION['ketQuaDoiMatKhau'])){ ?>
                <h1 class="text-center notify"><?php echo $_SESSION['ketQuaDoiMatKhau']; unset($_SESSION['ketQuaDoiMatKhau']); ?></h1>
            <?php } ?>
            <h2 class="text-center instruction"><a class="text-center" href="TrangChu.php">Trang chủ</a></h2>
        </div>
    </body>

</html>	