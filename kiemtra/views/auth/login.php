<?php $title = 'Đăng nhập'; ?>

<div class="row justify-content-center">
    <div class="col-md-6 col-lg-4">
        <div class="card">
            <div class="card-body p-5">
                <div class="text-center mb-4">
                    <i class="fas fa-user-circle fa-3x text-primary mb-3"></i>
                    <h4 class="card-title">Đăng nhập</h4>
                    <p class="text-muted">Vui lòng nhập thông tin đăng nhập</p>
                </div>

                <form method="POST" action="index.php?controller=auth&action=login">
                    <div class="mb-3">
                        <label for="MaSV" class="form-label">Mã sinh viên</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fas fa-user"></i>
                            </span>
                            <input type="text" 
                                   class="form-control" 
                                   id="MaSV" 
                                   name="MaSV" 
                                   required 
                                   autofocus>
                        </div>
                    </div>


                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-sign-in-alt me-1"></i>
                            Đăng nhập
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> 