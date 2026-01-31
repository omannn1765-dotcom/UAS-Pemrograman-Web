<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Artikel - Admin CMS</title>
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
        .form-card {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        }
        .top-navbar {
            background: white;
            padding: 15px 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            margin: -30px -30px 30px;
        }
        .checkbox-group label { display: inline-block; margin-right: 15px; margin-bottom: 10px; }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="brand"><i class="fas fa-user-shield"></i> Admin Panel</div>
        <ul class="nav flex-column mt-4">
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('admin') ?>"><i class="fas fa-home"></i> Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="<?= base_url('admin/tambah') ?>"><i class="fas fa-plus-circle"></i> Tambah Artikel</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('admin/kategori') ?>"><i class="fas fa-folder"></i> Kategori</a>
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
            <h4 class="mb-0"><i class="fas fa-plus-circle"></i> Tambah Artikel Baru</h4>
        </div>

        <div class="form-card">
            <?= validation_errors('<div class="alert alert-danger"><i class="fas fa-exclamation-triangle"></i> ', '</div>'); ?>
            
            <form action="<?= base_url('admin/tambah') ?>" method="post">
                <div class="form-group">
                    <label for="judul"><i class="fas fa-heading"></i> Judul Artikel <span class="text-danger">*</span></label>
                    <input type="text" name="judul" id="judul" class="form-control" placeholder="Masukkan judul artikel..." value="<?= set_value('judul') ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="konten"><i class="fas fa-file-alt"></i> Konten Artikel <span class="text-danger">*</span></label>
                    <textarea name="konten" id="konten" class="form-control" rows="15" placeholder="Tulis konten artikel di sini..." required><?= set_value('konten') ?></textarea>
                    <small class="form-text text-muted">Anda bisa menggunakan HTML tags untuk formatting (p, strong, em, ul, ol, li, dll.)</small>
                </div>
                
                <div class="form-group">
                    <label><i class="fas fa-folder"></i> Kategori</label>
                    <div class="checkbox-group">
                        <?php if(!empty($kategori)): ?>
                            <?php foreach($kategori as $kat): ?>
                                <label class="checkbox-inline">
                                    <input type="checkbox" name="kategori[]" value="<?= $kat['id'] ?>"> <?= htmlspecialchars($kat['nama']) ?>
                                </label>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p class="text-muted mb-0">Tidak ada kategori. Silakan tambahkan kategori terlebih dahulu.</p>
                        <?php endif; ?>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="status"><i class="fas fa-toggle-on"></i> Status Publikasi <span class="text-danger">*</span></label>
                    <select name="status" id="status" class="form-control" required>
                        <option value="draft" <?= set_select('status', 'draft', TRUE) ?>>Draft (Tidak ditampilkan)</option>
                        <option value="published" <?= set_select('status', 'published') ?>>Published (Ditampilkan di website)</option>
                    </select>
                </div>
                
                <div class="mt-4">
                    <button type="submit" class="btn btn-success btn-lg">
                        <i class="fas fa-save"></i> Simpan Artikel
                    </button>
                    <a href="<?= base_url('admin') ?>" class="btn btn-secondary btn-lg">
                        <i class="fas fa-times"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
