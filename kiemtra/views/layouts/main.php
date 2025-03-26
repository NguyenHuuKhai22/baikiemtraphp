<!DOCTYPE html>
<html>
<head>
    <title><?php echo isset($title) ? $title . ' - Quản lý học phần' : 'Quản lý học phần'; ?></title>
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
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f0f2f5;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .navbar {
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            background: linear-gradient(135deg, #1a73e8, #0d47a1);
            padding: 1rem 0;
        }
        .navbar-brand {
            font-size: 1.5rem;
            font-weight: 500;
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.07);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            background: white;
            overflow: hidden;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0,0,0,0.1);
        }
        .card-header {
            border-bottom: 1px solid rgba(0,0,0,0.05);
            padding: 1.25rem;
        }
        .btn {
            transition: all 0.3s ease;
            border-radius: 8px;
            padding: 0.5rem 1.25rem;
            font-weight: 500;
        }
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .btn-primary {
            background: linear-gradient(135deg, #1a73e8, #0d47a1);
            border: none;
        }
        .btn-success {
            background: linear-gradient(135deg, #28a745, #208838);
            border: none;
        }
        .btn-danger {
            background: linear-gradient(135deg, #dc3545, #c82333);
            border: none;
        }
        .alert {
            border: none;
            border-radius: 12px;
            animation: slideDown 0.5s ease forwards;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        }
        .table {
            border-radius: 12px;
            overflow: hidden;
            margin-bottom: 0;
        }
        .table thead th {
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            border-bottom: 2px solid #dee2e6;
            padding: 1rem;
            font-weight: 500;
        }
        .table tbody td {
            padding: 1rem;
            vertical-align: middle;
        }
        .table-hover tbody tr:hover {
            background-color: #f8f9fa;
            transition: background-color 0.3s ease;
        }
        .form-control {
            border-radius: 8px;
            border: 1px solid #dee2e6;
            padding: 0.75rem 1rem;
            font-size: 1rem;
        }
        .form-control:focus {
            border-color: #1a73e8;
            box-shadow: 0 0 0 0.2rem rgba(26, 115, 232, 0.25);
        }
        @keyframes slideDown {
            from { transform: translateY(-20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        .summary-card {
            background: linear-gradient(135deg, #ffffff, #f8f9fa);
        }
        .summary-value {
            font-size: 2rem;
            font-weight: 700;
            background: linear-gradient(135deg, #1a73e8, #0d47a1);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            line-height: 1.2;
        }
        .nav-link {
            border-radius: 8px;
            padding: 0.75rem 1.25rem;
            transition: all 0.3s ease;
            margin: 0 0.25rem;
            font-weight: 500;
        }
        .nav-link:hover {
            background-color: rgba(255,255,255,0.15);
            transform: translateY(-1px);
        }
        .nav-link.active {
            background-color: rgba(255,255,255,0.2);
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .page-content {
            flex: 1 0 auto;
            padding: 2rem 0;
        }
        .footer {
            background: linear-gradient(135deg, #1a73e8, #0d47a1);
            color: white;
            padding: 2rem 0;
            margin-top: auto;
        }
        .footer-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .footer-links {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            gap: 1.5rem;
        }
        .footer-links a {
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            transition: all 0.3s ease;
        }
        .footer-links a:hover {
            color: white;
            transform: translateY(-2px);
        }
        .footer-brand {
            font-size: 1.25rem;
            font-weight: 500;
            color: white;
        }
        .stats-card {
            padding: 1.5rem;
            border-radius: 15px;
            background: white;
            box-shadow: 0 4px 6px rgba(0,0,0,0.07);
        }
        .stats-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 1rem;
            background: linear-gradient(135deg, #1a73e8, #0d47a1);
            color: white;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <i class="fas fa-graduation-cap me-2"></i>
                Quản lý học phần
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link <?php echo isset($active) && $active === 'sinhvien' ? 'active' : ''; ?>" 
                           href="index.php?controller=sinhvien&action=index">
                            <i class="fas fa-users me-1"></i> Sinh viên
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo isset($active) && $active === 'hocphan' ? 'active' : ''; ?>" 
                           href="index.php?controller=hocphan&action=index">
                            <i class="fas fa-book me-1"></i> Học phần
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo isset($active) && $active === 'dangky' ? 'active' : ''; ?>" 
                           href="index.php?controller=hocphan&action=danhSachDangKy">
                            <i class="fas fa-clipboard-check me-1"></i> Đã đăng ký
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?controller=auth&action=logout">
                            <i class="fas fa-sign-out-alt me-1"></i> Đăng xuất
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="page-content">
        <div class="container">
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

            <?php echo $content; ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-brand">
                    <i class="fas fa-graduation-cap me-2"></i>
                    Hệ thống quản lý học phần
                </div>
                <ul class="footer-links">
                    <li><a href="#"><i class="fas fa-info-circle me-1"></i> Giới thiệu</a></li>
                    <li><a href="#"><i class="fas fa-question-circle me-1"></i> Trợ giúp</a></li>
                    <li><a href="#"><i class="fas fa-book me-1"></i> Hướng dẫn</a></li>
                    <li><a href="#"><i class="fas fa-phone me-1"></i> Liên hệ</a></li>
                </ul>
            </div>
            <div class="text-center mt-4">
                <small class="text-white-50">© <?php echo date('Y'); ?> Hệ thống quản lý học phần. All rights reserved.</small>
            </div>
        </div>
    </footer>

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