<?php if (isset($_SESSION['success'])): ?>
    <div class="alert alert-success">
        <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
    </div>
<?php endif; ?>

<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-success text-white">
            <h3>Thông báo đăng ký thành công</h3>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-6">
                    <h4>Thông tin Đăng ký</h4>
                    <table class="table table-borderless">
                        <tr>
                            <td><strong>Mã số sinh viên:</strong></td>
                            <td><?php echo htmlspecialchars($MaSV); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Ngày Đăng Ký:</strong></td>
                            <td><?php echo htmlspecialchars($registrationInfo['ngayDK']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Tổng số tín chỉ:</strong></td>
                            <td><?php echo htmlspecialchars($registrationInfo['tongTinChi']); ?></td>
                        </tr>
                    </table>
                </div>
            </div>

            <h4>Danh sách học phần đã đăng ký</h4>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Mã HP</th>
                            <th>Tên Học Phần</th>
                            <th>Số Tín Chỉ</th>
                            <th>Mô Tả</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($registrationInfo['hocPhans'] as $hocPhan): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($hocPhan['MaHP']); ?></td>
                                <td><?php echo htmlspecialchars($hocPhan['TenHP']); ?></td>
                                <td><?php echo htmlspecialchars($hocPhan['SoTinChi']); ?></td>
                                <td><?php echo htmlspecialchars($hocPhan['MoTa'] ?? ''); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div class="text-center mt-4">
                <a href="index.php?controller=hocphan&action=danhSachDangKy" class="btn btn-primary">Xem danh sách đăng ký</a>
                <a href="index.php?controller=hocphan&action=index" class="btn btn-secondary">Quay lại trang chủ</a>
            </div>
        </div>
    </div>
</div> 