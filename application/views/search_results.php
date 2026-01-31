<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Pencarian: <?= htmlspecialchars($keyword) ?> - CMS Portal</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        :root { --primary-color: #667eea; --secondary-color: #764ba2; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .navbar { background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%); box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .navbar-brand { font-weight: 700; font-size: 1.5rem; }
        .page-header { background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%); color: white; padding: 60px 0 40px; margin-bottom: 40px; }
        .artikel-card { border: none; border-radius: 15px; transition: transform 0.3s, box-shadow 0.3s; box-shadow: 0 5px 15px rgba(0,0,0,0.08); margin-bottom: 20px; }
        .artikel-card:hover { transform: translateY(-5px); box-shadow: 0 15px 35px rgba(0,0,0,0.15); }
        .btn-read-more { background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%); color: white; border: none; border-radius: 20px; padding: 8px 20px; }
        footer { background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%); color: white; padding: 40px 0 20px; margin-top: 60px; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url() ?>"><i class="fas fa-newspaper"></i> CMS Portal</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a class="nav-link" href="<?= base_url() ?>"><i class="fas fa-home"></i> Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('auth/login') ?>"><i class="fas fa-user-shield"></i> Admin</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="page-header">
        <div class="container">
            <h1><i class="fas fa-search"></i> Hasil Pencarian</h1>
            <p class="lead">Menampilkan hasil untuk: "<strong><?= htmlspecialchars($keyword) ?></strong>"</p>
        </div>
    </div>

    <div class="container mb-5">
        <?php if(empty($artikel)): ?>
            <div class="alert alert-warning">
                <i class="fas fa-exclamation-triangle"></i> Tidak ada artikel yang ditemukan untuk kata kunci "<?= htmlspecialchars($keyword) ?>".
            </div>
            <a href="<?= base_url() ?>" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Kembali ke Beranda</a>
        <?php else: ?>
            <p class="mb-4">Ditemukan <strong><?= count($artikel) ?></strong> artikel</p>
            <?php foreach($artikel as $item): ?>
                <div class="card artikel-card">
                    <div class="card-body">
                        <h4><a href="<?= base_url('welcome/artikel/'.$item['slug']) ?>" class="text-decoration-none"><?= htmlspecialchars($item['judul']) ?></a></h4>
                        <p class="text-muted"><?= word_limiter(strip_tags($item['konten']), 30) ?></p>
                        <small class="text-muted">
                            <i class="far fa-calendar"></i> <?= date('d M Y', strtotime($item['tanggal_dibuat'])) ?> | 
                            <i class="far fa-user"></i> <?= htmlspecialchars($item['penulis']) ?> | 
                            <i class="far fa-eye"></i> <?= $item['views'] ?> views
                        </small>
                        <div class="mt-3">
                            <a href="<?= base_url('welcome/artikel/'.$item['slug']) ?>" class="btn btn-read-more btn-sm">Baca Selengkapnya <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <footer>
        <div class="container text-center">
            <p class="mb-0">&copy; <?= date('Y') ?> CMS Portal. Built with <i class="fas fa-heart text-danger"></i> using CodeIgniter 3</p>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
