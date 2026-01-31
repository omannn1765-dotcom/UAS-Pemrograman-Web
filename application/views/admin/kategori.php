<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Kategori - Admin CMS</title>
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
        }
        .table-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="brand"><i class="fas fa-user-shield"></i> Admin Panel</div>
        <div class="user-info text-center py-4">
            <i class="fas fa-user-circle fa-3x mb-2"></i>
            <h6><?= htmlspecialchars($user['nama_lengkap']) ?></h6>
            <small><?= htmlspecialchars($user['username']) ?></small>
        </div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('admin') ?>"><i class="fas fa-home"></i> Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('admin/tambah') ?>"><i class="fas fa-plus-circle"></i> Tambah Artikel</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="<?= base_url('admin/kategori') ?>"><i class="fas fa-folder"></i> Kategori</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url() ?>" target="_blank"><i class="fas fa-eye"></i> Lihat Website</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('auth/logout') ?>"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </li>
        </ul>
    </div>

    <div class="main-content">
        <div class="top-navbar">
            <h4 class="mb-0"><i class="fas fa-folder"></i> Kelola Kategori</h4>
        </div>

        <div class="table-card">
            <h5 class="mb-4"><i class="fas fa-list"></i> Daftar Kategori</h5>
            
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th width="5%">#</th>
                            <th width="25%">Nama Kategori</th>
                            <th width="25%">Slug</th>
                            <th width="35%">Deskripsi</th>
                            <th width="10%">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(empty($kategori)): ?>
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">
                                    <i class="fas fa-folder-open fa-3x mb-3 d-block"></i>
                                    Tidak ada kategori
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php $no = 1; foreach($kategori as $kat): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td>
                                    <strong><?= htmlspecialchars($kat['nama']) ?></strong>
                                </td>
                                <td>
                                    <code><?= $kat['slug'] ?></code>
                                </td>
                                <td><?= htmlspecialchars($kat['deskripsi']) ?></td>
                                <td>
                                    <small><?= date('d M Y', strtotime($kat['created_at'])) ?></small>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            
            <div class="alert alert-info mt-4 mb-0">
                <i class="fas fa-info-circle"></i> Kategori sudah dikonfigurasi di database. Anda dapat menambah kategori baru melalui panel database phpMyAdmin (port 8081).
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
