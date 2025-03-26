<?php
require_once 'models/HocPhan.php';

class HocPhanController {
    private $hocPhanModel;

    public function __construct() {
        $this->hocPhanModel = new HocPhan();
    }

    public function index() {
        if (!isset($_SESSION['MaSV'])) {
            header('Location: index.php?controller=auth&action=login');
            exit();
        }
        $hocPhans = $this->hocPhanModel->getAll();
        $maSV = $_SESSION['MaSV'];
        $daDangKy = $this->hocPhanModel->getDangKyByMaSV($maSV)->fetchAll(PDO::FETCH_COLUMN);
        require_once 'views/hocphan/index.php';
    }

    public function dangKy() {
        if (!isset($_SESSION['MaSV'])) {
            header('Location: index.php?controller=auth&action=login');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['MaHP'])) {
            $MaSV = $_SESSION['MaSV'];
            $MaHP = $_POST['MaHP'];
            
            // Kiểm tra số lượng tín chỉ đã đăng ký
            $tongTinChi = $this->hocPhanModel->getTongTinChi($MaSV);
            $tinChiMoi = $this->hocPhanModel->getSoTinChi($MaHP);
            
            if ($tongTinChi + $tinChiMoi > 25) {
                $_SESSION['error'] = "Không thể đăng ký quá 25 tín chỉ!";
                header('Location: index.php?controller=hocphan&action=index');
                exit();
            }
            
            if ($this->hocPhanModel->dangKyHocPhan($MaSV, $MaHP)) {
                $_SESSION['success'] = "Đăng ký học phần thành công!";
            } else {
                $_SESSION['error'] = "Đăng ký học phần thất bại!";
            }
            
            header('Location: index.php?controller=hocphan&action=index');
            exit();
        }
    }

    public function xoaDangKy() {
        if (!isset($_SESSION['MaSV'])) {
            header('Location: index.php?controller=auth&action=login');
            exit();
        }

        if (isset($_GET['MaHP'])) {
            $MaSV = $_SESSION['MaSV'];
            $MaHP = $_GET['MaHP'];
            
            if ($this->hocPhanModel->xoaDangKy($MaSV, $MaHP)) {
                $_SESSION['success'] = "Xóa đăng ký học phần thành công!";
            } else {
                $_SESSION['error'] = "Xóa đăng ký học phần thất bại!";
            }
            
            header('Location: index.php?controller=hocphan&action=danhSachDangKy');
            exit();
        }
    }

    public function xoaTatCaDangKy() {
        if (!isset($_SESSION['MaSV'])) {
            header('Location: index.php?controller=auth&action=login');
            exit();
        }

        $MaSV = $_SESSION['MaSV'];
        
        if ($this->hocPhanModel->xoaTatCaDangKy($MaSV)) {
            $_SESSION['success'] = "Xóa tất cả đăng ký học phần thành công!";
        } else {
            $_SESSION['error'] = "Xóa tất cả đăng ký học phần thất bại!";
        }
        
        header('Location: index.php?controller=hocphan&action=danhSachDangKy');
        exit();
    }

    public function danhSachDangKy() {
        if (!isset($_SESSION['MaSV'])) {
            header('Location: index.php?controller=auth&action=login');
            exit();
        }

        $MaSV = $_SESSION['MaSV'];
        $hocPhans = $this->hocPhanModel->getDangKyByMaSV($MaSV);
        require_once 'views/hocphan/danh_sach_dang_ky.php';
    }

    public function luuDangKy() {
        if (!isset($_SESSION['MaSV'])) {
            header('Location: index.php?controller=auth&action=login');
            exit();
        }

        $MaSV = $_SESSION['MaSV'];
        
        // Kiểm tra số lượng tín chỉ
        $tongTinChi = $this->hocPhanModel->getTongTinChi($MaSV);
        if ($tongTinChi < 10) {
            $_SESSION['error'] = "Bạn phải đăng ký ít nhất 10 tín chỉ!";
            header('Location: index.php?controller=hocphan&action=danhSachDangKy');
            exit();
        }
        
        if ($tongTinChi > 25) {
            $_SESSION['error'] = "Bạn chỉ được đăng ký tối đa 25 tín chỉ!";
            header('Location: index.php?controller=hocphan&action=danhSachDangKy');
            exit();
        }

        // Lưu trạng thái đăng ký
        if ($this->hocPhanModel->luuDangKy($MaSV)) {
            // Get registration details
            $hocPhans = $this->hocPhanModel->getDangKyByMaSV($MaSV);
            $_SESSION['success'] = "Lưu đăng ký học phần thành công!";
            $_SESSION['registration_info'] = [
                'tongTinChi' => $tongTinChi,
                'ngayDK' => date('d/m/Y'),
                'hocPhans' => $hocPhans->fetchAll(PDO::FETCH_ASSOC)
            ];
            header('Location: index.php?controller=hocphan&action=thongBaoDangKy');
            exit();
        } else {
            $_SESSION['error'] = "Lưu đăng ký học phần thất bại!";
            header('Location: index.php?controller=hocphan&action=danhSachDangKy');
            exit();
        }
    }

    public function thongBaoDangKy() {
        if (!isset($_SESSION['MaSV']) || !isset($_SESSION['registration_info'])) {
            header('Location: index.php?controller=hocphan&action=danhSachDangKy');
            exit();
        }

        $registrationInfo = $_SESSION['registration_info'];
        $MaSV = $_SESSION['MaSV'];
        
        require_once 'views/hocphan/thong_bao_dang_ky.php';
        
        // Clear the registration info from session after displaying
        unset($_SESSION['registration_info']);
    }
}
?> 