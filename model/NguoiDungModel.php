<?php

    include_once '../tool/Connection.php';
    const _DATABASE_NAME = 'tài khoản';
    const _DATABASE_TEN_maNguoiDung = 'MaKH';
    const _DATABASE_TEN_ten = 'Ten';
    const _DATABASE_TEN_diaChi = 'DiaChi';
    const _DATABASE_TEN_email = 'Email';
    const _DATABASE_TEN_sdt = 'SDT';
    const _DATABASE_TEN_matKhau = 'Password';

    class NguoiDung{

        public $maNguoiDung;
        public $ten;
        public $diaChi;
        public $email;
        public $sdt;
        public $matKhau;

        public function __construct($maNguoiDung, $ten, $diaChi, $email, $sdt, $matKhau)
        {
            $this->manguoidung = $maNguoiDung;
            $this->ten = $ten;
            $this->diaChi = $diaChi;
            $this->email = $email;
            $this->sdt = $sdt;
            $this->matKhau = $matKhau;
        }

        
    }

    
    class NguoiDungModel {
        public function __construct()
        {
        }

        public function getAllNguoiDung(){
            $connect = getConnectionData();
            $query = 'USE banhang; select * from ' . _DATABASE_NAME;
            $nguoiDungs = mysqli_query($connect, $query);
            $connect->close();
            return $nguoiDungs;
        }

        public function getNguoiDungByID($maNguoiDung){
            $connect = getConnectionData();
             $query = "SELECT * FROM `" . _DATABASE_NAME . "` WHERE " . _DATABASE_TEN_maNguoiDung . " = " .$maNguoiDung;

            $result = mysqli_query($connect, $query);
            if ($result == NULL) echo 'result NULL';
            $nguoiDung = NULL;
            if ($result->num_rows > 0){
                $row = $result->fetch_assoc();
                $nguoiDung = new NguoiDung($row[_DATABASE_TEN_maNguoiDung], $row[_DATABASE_TEN_ten], $row[_DATABASE_TEN_diaChi],
                $row[_DATABASE_TEN_email], $row[_DATABASE_TEN_sdt], $row[_DATABASE_TEN_matKhau]);
            }
            $connect->close();
            return $nguoiDung;
        }

        public function getNguoiDungByEmail($email){
            $connect = getConnectionData();
            $query = "SELECT * FROM `" . _DATABASE_NAME . "` WHERE " . _DATABASE_TEN_email . " = '" . $email . "'";
            $result = mysqli_query($connect, $query);
            if ($result == NULL) echo "result null";
            $nguoiDung = NULL;
            if ($result->num_rows > 0)
            {
                $row = $result->fetch_assoc();
                $nguoiDung = new NguoiDung($row[_DATABASE_TEN_maNguoiDung], $row[_DATABASE_TEN_ten], $row[_DATABASE_TEN_diaChi],
                                    $row[_DATABASE_TEN_email], $row[_DATABASE_TEN_sdt], $row[_DATABASE_TEN_matKhau]);
            }
            $connect->close();
            return $nguoiDung;
        }

        

    }

?>