<?php $title = 'Danh sách học phần'; $active = 'hocphan'; ?>

<div class="row mb-4">
    <div class="col">
        <h2 class="text-dark mb-4">
            <i class="fas fa-book me-2"></i>
            Danh sách học phần
        </h2>
    </div>
    <div class="col-auto">
        <a href="index.php?controller=hocphan&action=danhSachDangKy" class="btn btn-primary">
            <i class="fas fa-clipboard-list me-1"></i>
            Xem đăng ký
        </a>
    </div>
</div>

<div class="card">
    <div class="card-header bg-white">
        <h5 class="card-title mb-0">
            <i class="fas fa-list me-2"></i>
            Danh sách học phần có thể đăng ký
        </h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Mã HP</th>
                        <th>Tên học phần</th>
                        <th>Số tín chỉ</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($hocPhan = $hocPhans->fetch(PDO::FETCH_ASSOC)): ?>
                    <tr>
                        <td><?php echo $hocPhan['MaHP']; ?></td>
                        <td><?php echo $hocPhan['TenHP']; ?></td>
                        <td><?php echo $hocPhan['SoTinChi']; ?></td>
                        <td>
                            <?php if (in_array($hocPhan['MaHP'], $daDangKy)): ?>
                                <span class="badge bg-success">
                                    <i class="fas fa-check me-1"></i> Đã đăng ký
                                </span>
                            <?php else: ?>
                                <form method="POST" action="index.php?controller=hocphan&action=dangKy" style="display: inline;">
                                    <input type="hidden" name="MaHP" value="<?php echo $hocPhan['MaHP']; ?>">
                                    <button type="submit" class="btn btn-success btn-sm">
                                        <i class="fas fa-plus me-1"></i> Đăng ký
                                    </button>
                                </form>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div> 