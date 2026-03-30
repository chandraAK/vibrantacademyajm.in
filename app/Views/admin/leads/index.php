<?= $this->include('admin/templates/header') ?>
<?= $this->include('admin/templates/sidebar') ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold mb-0">Manage Leads</h2>
    <a href="<?= base_url('admin/leads/export') ?>" class="btn btn-success">
        <i class="fas fa-file-csv me-2"></i>Export to CSV
    </a>
</div>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show">
        <?= session()->getFlashdata('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<!-- Filters -->
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body">
        <form method="get" class="row g-3">
            <div class="col-md-4">
                <input type="text" name="search" class="form-control" placeholder="Search by name, mobile or school..." value="<?= esc($search) ?>">
            </div>
            <div class="col-md-3">
                <select name="class" class="form-select">
                    <option value="">All Classes</option>
                    <?php foreach ($class_list as $cls): ?>
                        <option value="<?= $cls ?>" <?= $class == $cls ? 'selected' : '' ?>><?= $cls ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-3">
                <input type="date" name="date" class="form-control" value="<?= esc($date) ?>">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">Filter</button>
            </div>
        </form>
    </div>
</div>

<!-- Leads Table -->
<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <form id="bulkDeleteForm" method="post" action="<?= base_url('admin/leads/bulk-delete') ?>">
            <?= csrf_field() ?>
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th width="40"><input type="checkbox" class="form-check-input" id="selectAll"></th>
                            <th>Name</th>
                            <th>Mobile</th>
                            <th>Class</th>
                            <th>School</th>
                            <th>Address</th>
                            <th>Date</th>
                            <th width="120">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($leads as $lead): ?>
                        <tr>
                            <td><input type="checkbox" class="form-check-input lead-checkbox" name="ids[]" value="<?= $lead['id'] ?>"></td>
                            <td><?= esc($lead['name']) ?></td>
                            <td><?= esc($lead['mobile']) ?></td>
                            <td><span class="badge bg-primary"><?= esc($lead['class']) ?></span></td>
                            <td><?= esc($lead['school_name'] ?? 'N/A') ?></td>
                            <td><?= strlen($lead['address']) > 30 ? esc(substr($lead['address'], 0, 30)) . '...' : esc($lead['address']) ?></td>
                            <td><?= date('d M Y', strtotime($lead['created_at'])) ?></td>
                            <td>
                                <a href="<?= base_url('admin/leads/view/' . $lead['id']) ?>" class="btn btn-sm btn-info" title="View">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete(<?= $lead['id'] ?>)" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php if (empty($leads)): ?>
                        <tr>
                            <td colspan="8" class="text-center py-4">No leads found</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            
            <?php if (!empty($leads)): ?>
            <div class="p-3 border-top">
                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete selected leads?')">
                    <i class="fas fa-trash me-2"></i>Delete Selected
                </button>
            </div>
            <?php endif; ?>
        </form>
    </div>
</div>

<script>
document.getElementById('selectAll').addEventListener('change', function() {
    document.querySelectorAll('.lead-checkbox').forEach(cb => cb.checked = this.checked);
});

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