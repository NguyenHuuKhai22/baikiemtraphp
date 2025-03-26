<!DOCTYPE html>
<html>
<head>
    <title>Chi tiết sinh viên</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Chi tiết sinh viên</h2>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <img src="<?php echo $sinhVien['Hinh']; ?>" class="img-fluid" alt="Hình sinh viên">
                    </div>
                    <div class="col-md-8">
                        <table class="table">
                            <tr>
                                <th>Mã SV:</th>
                                <td><?php echo $sinhVien['MaSV']; ?></td>
                            </tr>
                            <tr>
                                <th>Họ tên:</th>
                                <td><?php echo $sinhVien['HoTen']; ?></td>
                            </tr>
                            <tr>
                                <th>Giới tính:</th>
                                <td><?php echo $sinhVien['GioiTinh']; ?></td>
                            </tr>
                            <tr>
                                <th>Ngày sinh:</th>
                                <td><?php echo $sinhVien['NgaySinh']; ?></td>
                            </tr>
                            <tr>
                                <th>Ngành học:</th>
                                <td><?php echo $sinhVien['TenNganh']; ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-3">
            <a href="index.php?controller=sinhvien&action=index" class="btn btn-secondary">Quay lại</a>
        </div>
    </div>
</body>
</html> 