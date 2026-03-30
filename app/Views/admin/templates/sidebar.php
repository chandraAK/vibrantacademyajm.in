            <div class="col-md-3 col-lg-2 sidebar p-0">
                <div class="p-4 border-bottom border-secondary">
                    <h4 class="mb-0"><i class="fas fa-graduation-cap me-2"></i>Vibrant Academy</h4>
                    <small class="text-white-50">Admin Panel</small>
                </div>
                
                <nav class="nav flex-column mt-3">
                    <a class="nav-link <?= current_url() == base_url('admin/dashboard') ? 'active' : '' ?>" href="<?= base_url('admin/dashboard') ?>">
                        <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                    </a>
                    <a class="nav-link <?= strpos(current_url(), 'admin/leads') !== false ? 'active' : '' ?>" href="<?= base_url('admin/leads') ?>">
                        <i class="fas fa-users me-2"></i>Manage Leads
                    </a>
                    <a class="nav-link" href="/" target="_blank">
                        <i class="fas fa-external-link-alt me-2"></i>View Website
                    </a>
                    <a class="nav-link text-danger" href="<?= base_url('admin/logout') ?>">
                        <i class="fas fa-sign-out-alt me-2"></i>Logout
                    </a>
                </nav>
                
                <div class="mt-auto p-4 border-top border-secondary position-absolute bottom-0 w-100">
                    <small class="text-white-50">Logged in as:<br><strong><?= session()->get('admin_name') ?></strong></small>
                </div>
            </div>
            
            <div class="col-md-9 col-lg-10 main-content">