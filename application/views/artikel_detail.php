<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($artikel['judul']) ?> - CMS Portal</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        :root {
            --primary-color: #667eea;
            --secondary-color: #764ba2;
        }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .navbar { background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%); box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .navbar-brand { font-weight: 700; font-size: 1.5rem; }
        .article-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            padding: 60px 0 40px;
            margin-bottom: 40px;
        }
        .article-title { font-size: 2.5rem; font-weight: 700; margin-bottom: 20px; }
        .article-meta { font-size: 1rem; opacity: 0.9; }
        .article-content { font-size: 1.1rem; line-height: 1.8; color: #2d3748; }
        .article-content p { margin-bottom: 20px; }
        .article-content ul, .article-content ol { margin-bottom: 20px; padding-left: 30px; }
        .sidebar-card { border: none; border-radius: 15px; box-shadow: 0 5px 15px rgba(0,0,0,0.08); margin-bottom: 25px; }
        .sidebar-card .card-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            font-weight: 600;
            border-radius: 15px 15px 0 0 !important;
        }
        .kategori-badge {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            padding: 8px 15px;
            border-radius: 20px;
            text-decoration: none;
            display: inline-block;
            margin: 5px;
        }
        .btn-back {
            background: white;
            color: var(--primary-color);
            border: 2px solid white;
            padding: 10px 25px;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s;
        }
        .btn-back:hover {
            background: var(--primary-color);
            color: white;
        }
        footer {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            padding: 40px 0 20px;
            margin-top: 60px;
        }
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

    <div class="article-header">
        <div class="container">
            <a href="<?= base_url() ?>" class="btn btn-back mb-4">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
            <h1 class="article-title"><?= htmlspecialchars($artikel['judul']) ?></h1>
            <div class="article-meta">
                <i class="far fa-calendar"></i> <?= date('d F Y', strtotime($artikel['tanggal_dibuat'])) ?>
                <span class="mx-3">|</span>
                <i class="far fa-user"></i> <?= htmlspecialchars($artikel['penulis']) ?>
                <span class="mx-3">|</span>
                <i class="far fa-eye"></i> <?= $artikel['views'] ?> views
            </div>
        </div>
    </div>

    <div class="container mb-5">
        <div class="row">
            <div class="col-lg-8">
                <div class="article-content">
                    <?= $artikel['konten'] ?>
                </div>
                
                <div class="mt-5 pt-4 border-top">
                    <a href="<?= base_url() ?>" class="btn btn-primary">
                        <i class="fas fa-arrow-left"></i> Kembali ke Beranda
                    </a>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card sidebar-card">
                    <div class="card-header"><i class="fas fa-folder"></i> Kategori</div>
                    <div class="card-body">
                        <?php if(!empty($kategori)): ?>
                            <?php foreach($kategori as $kat): ?>
                                <a href="<?= base_url('welcome/kategori/'.$kat['slug']) ?>" class="kategori-badge">
                                    <i class="fas fa-tag"></i> <?= htmlspecialchars($kat['nama']) ?>
                                </a>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="card sidebar-card">
                    <div class="card-header"><i class="fas fa-share-alt"></i> Bagikan</div>
                    <div class="card-body text-center">
                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?= current_url() ?>" target="_blank" class="btn btn-primary btn-sm m-1">
                            <i class="fab fa-facebook-f"></i> Facebook
                        </a>
                        <a href="https://twitter.com/intent/tweet?url=<?= current_url() ?>&text=<?= urlencode($artikel['judul']) ?>" target="_blank" class="btn btn-info btn-sm m-1">
                            <i class="fab fa-twitter"></i> Twitter
                        </a>
                        <a href="https://wa.me/?text=<?= urlencode($artikel['judul'].' '.current_url()) ?>" target="_blank" class="btn btn-success btn-sm m-1">
                            <i class="fab fa-whatsapp"></i> WhatsApp
                        </a>
                    </div>
                </div>
            </div>
        </div>
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
