<?php
require_once 'models/SinhVien.php';

class SinhVienController {
    private $sinhVienModel;
    private $uploadDir = 'uploads/students/';

    public function __construct() {
        $this->sinhVienModel = new SinhVien();
        // Tạo thư mục upload nếu chưa tồn tại
        if (!file_exists($this->uploadDir)) {
            mkdir($this->uploadDir, 0777, true);
        }
    }

    public function index() {
        $sinhViens = $this->sinhVienModel->getAll();
        require_once 'views/sinhvien/index.php';
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'MaSV' => $_POST['MaSV'],
                'HoTen' => $_POST['HoTen'],
                'GioiTinh' => $_POST['GioiTinh'],
                'NgaySinh' => $_POST['NgaySinh'],
                'MaNganh' => $_POST['MaNganh']
            ];

            // Xử lý upload hình ảnh
            if (isset($_FILES['Hinh']) && $_FILES['Hinh']['error'] == 0) {
                $filename = time() . '_' . $_FILES['Hinh']['name'];
                $target = $this->uploadDir . $filename;
                
                if (move_uploaded_file($_FILES['Hinh']['tmp_name'], $target)) {
                    $data['Hinh'] = $target;
                }
            } else {
                $data['Hinh'] = $this->uploadDir . 'default.jpg';
            }

            if ($this->sinhVienModel->create($data)) {
                $_SESSION['success'] = "Thêm sinh viên thành công!";
                header('Location: index.php?controller=sinhvien&action=index');
                exit();
            }
        }
        require_once 'views/sinhvien/create.php';
    }

    public function edit() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'MaSV' => $_POST['MaSV'],
                'HoTen' => $_POST['HoTen'],
                'GioiTinh' => $_POST['GioiTinh'],
                'NgaySinh' => $_POST['NgaySinh'],
                'MaNganh' => $_POST['MaNganh']
            ];

            // Xử lý upload hình ảnh mới
            if (isset($_FILES['Hinh']) && $_FILES['Hinh']['error'] == 0) {
                $filename = time() . '_' . $_FILES['Hinh']['name'];
                $target = $this->uploadDir . $filename;
                
                if (move_uploaded_file($_FILES['Hinh']['tmp_name'], $target)) {
                    $data['Hinh'] = $target;
                    
                    // Xóa hình cũ nếu có
                    $oldImage = $_POST['HinhCu'];
                    if (file_exists($oldImage) && $oldImage != $this->uploadDir . 'default.jpg') {
                        unlink($oldImage);
                    }
                }
            } else {
                $data['Hinh'] = $_POST['HinhCu'];
            }

            if ($this->sinhVienModel->update($data)) {
                $_SESSION['success'] = "Cập nhật sinh viên thành công!";
                header('Location: index.php?controller=sinhvien&action=index');
                exit();
            }
        }
        $MaSV = $_GET['id'];
        $sinhVien = $this->sinhVienModel->getById($MaSV);
        require_once 'views/sinhvien/edit.php';
    }

    public function delete() {
        if (isset($_GET['id'])) {
            $MaSV = $_GET['id'];
            $sinhVien = $this->sinhVienModel->getById($MaSV);
            
            // Xóa file hình trước khi xóa record
            if ($sinhVien && $sinhVien['Hinh'] != $this->uploadDir . 'default.jpg') {
                if (file_exists($sinhVien['Hinh'])) {
                    unlink($sinhVien['Hinh']);
                }
            }
            
            if ($this->sinhVienModel->delete($MaSV)) {
                $_SESSION['success'] = "Xóa sinh viên thành công!";
            }
            header('Location: index.php?controller=sinhvien&action=index');
            exit();
        }
    }

    public function detail() {
        if (isset($_GET['id'])) {
            $MaSV = $_GET['id'];
            $sinhVien = $this->sinhVienModel->getById($MaSV);
            require_once 'views/sinhvien/detail.php';
        }
    }
}
?> 