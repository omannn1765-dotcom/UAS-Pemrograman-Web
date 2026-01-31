<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - CMS</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        :root { --primary-color: #667eea; --secondary-color: #764ba2; }
        body { background: #f8f9fa; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(180deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            position: fixed;
            left: 0;
            top: 0;
            width: 250px;
            padding: 20px 0;
        }
        .sidebar .brand { padding: 20px; text-align: center; font-size: 1.5rem; font-weight: 700; border-bottom: 1px solid rgba(255,255,255,0.1); }
        .sidebar .nav-item { padding: 0; }
        .sidebar .nav-link {
            color: rgba(255,255,255,0.8);
            padding: 15px 25px;
            transition: all 0.3s;
            border-left: 3px solid transparent;
        }
        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            background: rgba(255,255,255,0.1);
            color: white;
            border-left-color: white;
        }
        .main-content { margin-left: 250px; padding: 30px; }
        .top-navbar {
            background: white;
            padding: 15px 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            margin: -30px -30px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .stats-card {
            border: none;
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 25px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            transition: transform 0.3s;
        }
        .stats-card:hover { transform: translateY(-5px); }
        .stats-card.primary { background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%); color: white; }
        .stats-card.success { background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%); color: white; }
        .stats-card.warning { background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); color: white; }
        .stats-card.info { background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); color: white; }
        .table-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        }
        .btn-action { margin: 2px; }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="brand">
            <i class="fas fa-user-shield"></i> Admin Panel
        </div>
        <div class="user-info text-center py-4">
            <i class="fas fa-user-circle fa-3x mb-2"></i>
            <h6><?= htmlspecialchars($user['nama_lengkap']) ?></h6>
            <small><?= htmlspecialchars($user['username']) ?></small>
        </div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" href="<?= base_url('admin') ?>">
                    <i class="fas fa-home"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('admin/tambah') ?>">
                    <i class="fas fa-plus-circle"></i> Tambah Artikel
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('admin/kategori') ?>">
                    <i class="fas fa-folder"></i> Kategori
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url() ?>" target="_blank">
                    <i class="fas fa-eye"></i> Lihat Website
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('auth/logout') ?>" onclick="return confirm('Yakin ingin logout?')">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="top-navbar">
            <h4 class="mb-0"><i class="fas fa-tachometer-alt"></i> Dashboard</h4>
            <div>
                <span class="text-muted"><i class="far fa-clock"></i> <?= date('d F Y, H:i') ?></span>
            </div>
        </div>

        <?php if($this->session->flashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show">
                <i class="fas fa-check-circle"></i> <?= $this->session->flashdata('success') ?>
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
        <?php endif; ?>

        <!-- Statistics Cards -->
        <div class="row">
            <div class="col-md-3">
                <div class="stats-card primary">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6>Total Artikel</h6>
                            <h2 class="mb-0"><?= $total_artikel ?></h2>
                        </div>
                        <i class="fas fa-file-alt fa-3x" style="opacity: 0.3;"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card success">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6>Total Views</h6>
                            <h2 class="mb-0"><?= $total_views ?></h2>
                        </div>
                        <i class="fas fa-eye fa-3x" style="opacity: 0.3;"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card warning">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6>Published</h6>
                            <h2 class="mb-0"><?= count(array_filter($artikel, function($a){ return $a['status'] == 'published'; })) ?></h2>
                        </div>
                        <i class="fas fa-check-circle fa-3x" style="opacity: 0.3;"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card info">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6>Draft</h6>
                            <h2 class="mb-0"><?= count(array_filter($artikel, function($a){ return $a['status'] == 'draft'; })) ?></h2>
                        </div>
                        <i class="fas fa-file fa-3x" style="opacity: 0.3;"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Articles Table -->
        <div class="table-card">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="mb-0"><i class="fas fa-list"></i> Daftar Artikel</h5>
                <a href="<?= base_url('admin/tambah') ?>" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah Artikel Baru
                </a>
            </div>
            
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th width="5%">#</th>
                            <th width="35%">Judul</th>
                            <th width="12%">Penulis</th>
                            <th width="10%">Status</th>
                            <th width="10%">Views</th>
                            <th width="13%">Tanggal</th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(empty($artikel)): ?>
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">
                                    <i class="fas fa-inbox fa-3x mb-3 d-block"></i>
                                    Belum ada artikel
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php $no = 1; foreach($artikel as $a): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td>
                                    <strong><?= htmlspecialchars($a['judul']) ?></strong>
                                    <br><small class="text-muted"><?= $a['slug'] ?></small>
                                </td>
                                <td><?= htmlspecialchars($a['penulis']) ?></td>
                                <td>
                                    <?php if($a['status'] == 'published'): ?>
                                        <span class="badge badge-success"><i class="fas fa-check"></i> Published</span>
                                    <?php else: ?>
                                        <span class="badge badge-secondary"><i class="fas fa-file"></i> Draft</span>
                                    <?php endif; ?>
                                </td>
                                <td><i class="far fa-eye"></i> <?= $a['views'] ?></td>
                                <td>
                                    <small><?= date('d M Y', strtotime($a['tanggal_dibuat'])) ?></small>
                                </td>
                                <td>
                                    <a href="<?= base_url('welcome/artikel/'.$a['slug']) ?>" class="btn btn-sm btn-info btn-action" target="_blank" title="Lihat">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="<?= base_url('admin/edit/'.$a['id']) ?>" class="btn btn-sm btn-warning btn-action" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="<?= base_url('admin/hapus/'.$a['id']) ?>" class="btn btn-sm btn-danger btn-action" onclick="return confirm('Yakin ingin menghapus artikel ini?')" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
