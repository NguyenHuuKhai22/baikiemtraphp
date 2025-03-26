<!DOCTYPE html>
<html>
<head>
    <title>Đăng ký học phần</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../../public/css/style.css" rel="stylesheet">
    <style>
        /* Fallback styles in case external CSS fails to load */
        .navbar {
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            background: linear-gradient(135deg, #4a90e2, #2980b9);
            padding: 1rem 0;
        }
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .btn {
            transition: all 0.3s ease;
        }
        .alert {
            border-radius: 10px;
            animation: slideDown 0.5s ease forwards;
        }
        @keyframes slideDown {
            from { transform: translateY(-20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
    </style>
</head>
<body>
   

    <div class="container mt-4">
        <?php $title = 'Danh sách đăng ký'; $active = 'dangky'; ?>

        <div class="row mb-4">
            <div class="col">
                <h2 class="text-dark mb-4">
                    <i class="fas fa-clipboard-list me-2"></i>
                    Danh sách học phần đã đăng ký
                </h2>
            </div>
            <div class="col-auto">
                <a href="index.php?controller=hocphan&action=index" class="btn btn-primary">
                    <i class="fas fa-plus me-1"></i>
                    Đăng ký thêm học phần
                </a>
            </div>
        </div>

        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success d-flex align-items-center" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                <?php 
                echo $_SESSION['success'];
                unset($_SESSION['success']);
                ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger d-flex align-items-center" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>
                <?php 
                echo $_SESSION['error'];
                unset($_SESSION['error']);
                ?>
            </div>
        <?php endif; ?>

        <div class="row">
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-header bg-white">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-list me-2"></i>
                            Danh sách học phần đã đăng ký
                        </h5>
                    </div>
                    <div class="card-body p-0">
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
                                    <?php 
                                    $tongTinChi = 0;
                                    $soHocPhan = 0;
                                    ?>
                                    <?php while ($hocPhan = $hocPhans->fetch(PDO::FETCH_ASSOC)): ?>
                                    <tr>
                                        <td class="fw-medium"><?php echo $hocPhan['MaHP']; ?></td>
                                        <td><?php echo $hocPhan['TenHP']; ?></td>
                                        <td>
                                            <span class="badge bg-primary rounded-pill">
                                                <?php echo $hocPhan['SoTinChi']; ?> tín chỉ
                                            </span>
                                        </td>
                                        <td>
                                            <a href="index.php?controller=hocphan&action=xoaDangKy&MaHP=<?php echo $hocPhan['MaHP']; ?>" 
                                               class="btn btn-danger btn-sm"
                                               onclick="return confirm('Bạn có chắc muốn xóa học phần này?')">
                                                <i class="fas fa-trash me-1"></i> Xóa
                                            </a>
                                        </td>
                                    </tr>
                                    <?php 
                                    $tongTinChi += $hocPhan['SoTinChi'];
                                    $soHocPhan++;
                                    ?>
                                    <?php endwhile; ?>
                                    <?php if ($soHocPhan == 0): ?>
                                    <tr>
                                        <td colspan="4" class="text-center text-muted py-5">
                                            <div class="py-5">
                                                <i class="fas fa-clipboard fa-3x mb-3"></i>
                                                <h5 class="font-weight-normal">Chưa có học phần nào được đăng ký</h5>
                                                <p class="text-muted mb-0">Hãy bắt đầu đăng ký học phần ngay!</p>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card summary-card mb-4">
                    <div class="card-body">
                        <h5 class="summary-title mb-4">
                            <i class="fas fa-info-circle me-2"></i>
                            Thông tin đăng ký
                        </h5>
                        <div class="row g-4">
                            <div class="col-6">
                                <div class="stats-card">
                                    <div class="stats-icon">
                                        <i class="fas fa-book"></i>
                                    </div>
                                    <small class="text-muted text-uppercase">Số học phần</small>
                                    <div class="summary-value"><?php echo $soHocPhan; ?></div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="stats-card">
                                    <div class="stats-icon">
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <small class="text-muted text-uppercase">Tổng tín chỉ</small>
                                    <div class="summary-value"><?php echo $tongTinChi; ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php if ($soHocPhan > 0): ?>
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title mb-4">
                            <i class="fas fa-cog me-2"></i>
                            Thao tác
                        </h5>
                        <div class="d-grid gap-3">
                            <button type="button" 
                                    class="btn btn-success btn-lg"
                                    onclick="if(confirm('Xác nhận lưu đăng ký học phần?')) window.location.href='index.php?controller=hocphan&action=luuDangKy'">
                                <i class="fas fa-save me-2"></i>
                                Lưu đăng ký
                            </button>
                            <a href="index.php?controller=hocphan&action=xoaTatCaDangKy" 
                               class="btn btn-danger btn-lg"
                               onclick="return confirm('Bạn có chắc muốn xóa tất cả học phần đã đăng ký?')">
                                <i class="fas fa-trash-alt me-2"></i>
                                Xóa tất cả đăng ký
                            </a>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Add loading spinner when submitting forms
        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', () => {
                const button = form.querySelector('button[type="submit"]');
                if (button) {
                    button.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Đang xử lý...';
                    button.disabled = true;
                }
            });
        });

        // Fade out alerts after 5 seconds
        document.querySelectorAll('.alert').forEach(alert => {
            setTimeout(() => {
                alert.style.transition = 'opacity 0.5s ease';
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500);
            }, 5000);
        });
    </script>
</body>
</html> 