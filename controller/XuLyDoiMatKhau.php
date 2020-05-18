<?php
    session_start();
    include_once "../tool/Connection.php";
    $connect = getConnectionData();

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $email = $_POST['email'];
        $password = $_POST['password'];
        $newPassword = $_POST['newPassword'];
        $confirmPassword = $_POST['confirmPassword'];

        if ($email != NULL && $password != NULL && $newPassword != NULL && $confirmPassword != NULL)
        {
            $query = "SELECT * FROM `tài khoản` WHERE Email = '" . $email . "' and Password ='" . $password . "'";
            $result = mysqli_query($connect, $query);

            if ($result->num_rows > 0){
                $queryChange = "UPDATE `tài khoản` SET Password = '$newPassword' WHERE Email = '$email' AND Password = '$password'";
                mysqli_query($connect, $queryChange);
                if (mysqli_affected_rows($connect) > 0){
                    $_SESSION['ketQuaDoiMatKhau'] = 'Đổi mật khẩu thành công';
                    header("Location: ../view/Result.php");
                }
            }else{
                $_SESSION['ketQuaDoiMatKhau'] = 'Đổi mật khẩu thất bại. Tài khoản hoặc mật khẩu sai';
                header("Location: ../view/Result.php");
            }
        }else{
            $_SESSION['ketQuaDoiMatKhau'] = 'Đổi mật khẩu thất bại. Tài khoản hoặc mật khẩu sai';
            header("Location: ../view/Result.php");
        }
    }
?>