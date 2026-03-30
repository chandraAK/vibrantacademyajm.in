<?= $this->include('admin/templates/header') ?>
<?= $this->include('admin/templates/sidebar') ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold mb-0">Lead Details</h2>
    <a href="<?= base_url('admin/leads') ?>" class="btn btn-secondary">
        <i class="fas fa-arrow-left me-2"></i>Back to Leads
    </a>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0 fw-bold">Personal Information</h5>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <td width="30%" class="text-muted">Full Name</td>
                        <td class="fw-semibold"><?= esc($lead['name']) ?></td>
                    </tr>
                    <tr>
                        <td class="text-muted">Mobile Number</td>
                        <td class="fw-semibold">
                            <a href="tel:+91<?= esc($lead['mobile']) ?>" class="text-decoration-none">
                                +91 <?= esc($lead['mobile']) ?> <i class="fas fa-phone text-success ms-2"></i>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-muted">Class/Course</td>
                        <td><span class="badge bg-primary fs-6"><?= esc($lead['class']) ?></span></td>
                    </tr>
                    <tr>
                        <td class="text-muted">School Name</td>
                        <td><?= esc($lead['school_name'] ?? 'Not provided') ?></td>
                    </tr>
                    <tr>
                        <td class="text-muted">Address</td>
                        <td><?= nl2br(esc($lead['address'] ?? 'Not provided')) ?></td>
                    </tr>
                </table>
            </div>
        </div>
        
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0 fw-bold">Submission Details</h5>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <td width="30%" class="text-muted">Submission Date</td>
                        <td><?= date('d F Y, h:i:s A', strtotime($lead['created_at'])) ?></td>
                    </tr>
                    <tr>
                        <td class="text-muted">IP Address</td>
                        <td><?= esc($lead['ip_address'] ?? 'N/A') ?></td>
                    </tr>
                    <tr>
                        <td class="text-muted">User Agent</td>
                        <td><small class="text-muted"><?= esc($lead['user_agent'] ?? 'N/A') ?></small></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0 fw-bold">Quick Actions</h5>
            </div>
            <div class="card-body">
                <a href="https://wa.me/91<?= esc($lead['mobile']) ?>?text=Hi%20<?= urlencode($lead['name']) ?>%2C%20Thank%20you%20for%20your%20inquiry%20at%20Vibrant%20Academy." 
                   target="_blank" class="btn btn-success w-100 mb-3">
                    <i class="fab fa-whatsapp me-2"></i>Contact on WhatsApp
                </a>
                <a href="tel:+91<?= esc($lead['mobile']) ?>" class="btn btn-primary w-100 mb-3">
                    <i class="fas fa-phone me-2"></i>Call Now
                </a>
                <button type="button" onclick="confirmDelete(<?= $lead['id'] ?>)" class="btn btn-danger w-100">
                    <i class="fas fa-trash me-2"></i>Delete Lead
                </button>
            </div>
        </div>
    </div>
</div>

<script>
function confirmDelete(id) {
    if (confirm('Are you sure you want to delete this lead?')) {
        const form = document.createElement('form');
        form.method = 'post';
        form.action = '<?= base_url('admin/leads/delete') ?>/' + id;
        
        const csrf = document.createElement('input');
        csrf.type = 'hidden';
        csrf.name = '<?= csrf_token() ?>';
        csrf.value = '<?= csrf_hash() ?>';
        
        form.appendChild(csrf);
        document.body.appendChild(form);
        form.submit();
    }
}
</script>

<?= $this->include('admin/templates/footer') ?>