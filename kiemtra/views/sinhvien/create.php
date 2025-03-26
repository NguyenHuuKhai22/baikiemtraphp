<!DOCTYPE html>
<html>
<head>
    <title>Thêm sinh viên</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php $title = 'Thêm sinh viên mới'; ?>

    <div class="container mt-5">
        <h2>Thêm sinh viên mới</h2>
        <form method="POST" action="index.php?controller=sinhvien&action=create" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">Mã SV</label>
                <input type="text" class="form-control" name="MaSV" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Họ tên</label>
                <input type="text" class="form-control" name="HoTen" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Giới tính</label>
                <select class="form-control" name="GioiTinh" required>
                    <option value="Nam">Nam</option>
                    <option value="Nữ">Nữ</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Ngày sinh</label>
                <input type="date" class="form-control" name="NgaySinh" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Hình ảnh</label>
                <input type="file" class="form-control" name="Hinh" accept="image/*">
                <small class="text-muted">Chọn file hình ảnh (jpg, png, gif)</small>
            </div>
            <div class="mb-3">
                <label class="form-label">Ngành học</label>
                <select class="form-control" name="MaNganh" required>
                    <option value="CNTT">Công nghệ thông tin</option>
                    <option value="QTKD">Quản trị kinh doanh</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Lưu</button>
            <a href="index.php?controller=sinhvien&action=index" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
</body>
</html> 