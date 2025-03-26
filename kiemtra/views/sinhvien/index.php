<?php $title = 'Danh sách sinh viên'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Danh sách sinh viên</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Danh sách sinh viên</h2>
        <a href="index.php?controller=sinhvien&action=create" class="btn btn-primary mb-3">Thêm sinh viên</a>
        
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Mã SV</th>
                    <th>Họ tên</th>
                    <th>Giới tính</th>
                    <th>Ngày sinh</th>
                    <th>Hình</th>
                    <th>Ngành học</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $sinhViens->fetch(PDO::FETCH_ASSOC)): ?>
                <tr>
                    <td><?php echo $row['MaSV']; ?></td>
                    <td><?php echo $row['HoTen']; ?></td>
                    <td><?php echo $row['GioiTinh']; ?></td>
                    <td><?php echo $row['NgaySinh']; ?></td>
                    <td><img src="<?php echo $row['Hinh']; ?>" width="50"></td>
                    <td><?php echo $row['TenNganh']; ?></td>
                    <td>
                        <a href="index.php?controller=sinhvien&action=edit&id=<?php echo $row['MaSV']; ?>" class="btn btn-warning btn-sm">Sửa</a>
                        <a href="index.php?controller=sinhvien&action=delete&id=<?php echo $row['MaSV']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</a>
                        <a href="index.php?controller=sinhvien&action=detail&id=<?php echo $row['MaSV']; ?>" class="btn btn-info btn-sm">Chi tiết</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html> 