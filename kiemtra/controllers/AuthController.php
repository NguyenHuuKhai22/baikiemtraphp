<?php
require_once 'models/Auth.php';

class AuthController {
    private $authModel;

    public function __construct() {
        $this->authModel = new Auth();
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $MaSV = $_POST['MaSV'];
            $sinhVien = $this->authModel->login($MaSV);

            if ($sinhVien) {
                $_SESSION['MaSV'] = $sinhVien['MaSV'];
                $_SESSION['HoTen'] = $sinhVien['HoTen'];
                header('Location: index.php?controller=hocphan&action=index');
                exit();
            } else {
                $_SESSION['error'] = "Mã sinh viên không tồn tại!";
                header('Location: index.php?controller=auth&action=login');
                exit();
            }
        }
        require_once 'views/auth/login.php';
    }

    public function logout() {
        session_destroy();
        header('Location: index.php?controller=auth&action=login');
        exit();
    }
}
?> 