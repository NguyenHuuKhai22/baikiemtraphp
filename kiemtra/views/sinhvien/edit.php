<?php $title = 'Sửa thông tin sinh viên'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Sửa thông tin sinh viên</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Sửa thông tin sinh viên</h2>
        <form method="POST" action="index.php?controller=sinhvien&action=edit" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">Mã SV</label>
                <input type="text" class="form-control" name="MaSV" value="<?php echo $sinhVien['MaSV']; ?>" readonly>
            </div>
            <div class="mb-3">
                <label class="form-label">Họ tên</label>
                <input type="text" class="form-control" name="HoTen" value="<?php echo $sinhVien['HoTen']; ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Giới tính</label>
                <select class="form-control" name="GioiTinh" required>
                    <option value="Nam" <?php echo $sinhVien['GioiTinh'] == 'Nam' ? 'selected' : ''; ?>>Nam</option>
                    <option value="Nữ" <?php echo $sinhVien['GioiTinh'] == 'Nữ' ? 'selected' : ''; ?>>Nữ</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Ngày sinh</label>
                <input type="date" class="form-control" name="NgaySinh" value="<?php echo $sinhVien['NgaySinh']; ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Hình ảnh hiện tại</label>
                <div class="mb-2">
                    <img src="<?php echo $sinhVien['Hinh']; ?>" alt="Hình sinh viên" style="max-width: 200px; height: auto;">
                </div>
                <input type="hidden" name="HinhCu" value="<?php echo $sinhVien['Hinh']; ?>">
                <input type="file" class="form-control" name="Hinh" accept="image/*">
                <small class="text-muted">Chọn file hình ảnh mới nếu muốn thay đổi (jpg, png, gif)</small>
            </div>
            <div class="mb-3">
                <label class="form-label">Ngành học</label>
                <select class="form-control" name="MaNganh" required>
                    <option value="CNTT" <?php echo $sinhVien['MaNganh'] == 'CNTT' ? 'selected' : ''; ?>>Công nghệ thông tin</option>
                    <option value="QTKD" <?php echo $sinhVien['MaNganh'] == 'QTKD' ? 'selected' : ''; ?>>Quản trị kinh doanh</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Cập nhật</button>
            <a href="index.php?controller=sinhvien&action=index" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
</body>
</html> 