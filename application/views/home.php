<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berita Terbaru Indonesia</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        :root{--bg:#0f1724;--card:#0b1220;--accent:#06b6d4;--muted:#94a3b8;--glass:rgba(255,255,255,0.04)}
        *{box-sizing:border-box}
        body{margin:0;font-family:Inter,system-ui,-apple-system,Segoe UI,Roboto,"Helvetica Neue",Arial;background:linear-gradient(180deg,#071023 0%,#07132a 100%);color:#e6eef8}
        .container{max-width:1100px;margin:0 auto;padding:28px}
        .topbar{display:flex;justify-content:space-between;align-items:center;padding:10px 0}
        .brand{display:flex;gap:12px;align-items:center;font-weight:700;color:var(--accent);text-decoration:none}
        .brand i{font-size:24px}
        .hero{background:linear-gradient(90deg,rgba(6,182,212,0.12),rgba(102,126,234,0.06));border-radius:12px;padding:36px;margin:18px 0}
        .hero h1{margin:0;font-size:28px;color:#ffffff}
        .hero p{margin:6px 0 0;color:var(--muted)}
        .layout{display:grid;grid-template-columns:1fr 320px;gap:24px;margin-top:20px}
        .grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(260px,1fr));gap:18px}
        .card{background:linear-gradient(180deg,var(--card),#07101a);padding:18px;border-radius:10px;box-shadow:0 6px 18px rgba(2,6,23,0.6);transition:transform .22s}
        .card:hover{transform:translateY(-6px)}
        .card h3{margin:0 0 8px;font-size:18px;color:#fff}
        .excerpt{color:var(--muted);font-size:14px;line-height:1.5}
        .meta{margin-top:12px;color:#7b8aa3;font-size:13px;display:flex;gap:10px;align-items:center}
        .btn-link{display:inline-flex;align-items:center;gap:8px;margin-top:12px;color:var(--accent);text-decoration:none;font-weight:600}
        .sidebar .box{background:var(--glass);padding:14px;border-radius:10px;color:var(--muted);}
        .search input{width:100%;padding:10px;border-radius:8px;border:1px solid rgba(255,255,255,0.04);background:transparent;color:#fff}
        footer{margin-top:40px;padding:20px;color:var(--muted);text-align:center;font-size:13px}
        @media(max-width:900px){.layout{grid-template-columns:1fr}.grid{grid-template-columns:repeat(auto-fill,minmax(200px,1fr))}}
    </style>
</head>
<body>
    <div class="container">
        <header class="topbar">
            <a class="brand" href="<?= base_url() ?>"><i class="fas fa-newspaper"></i> BeritaID</a>
            <nav>
                <a href="<?= base_url('auth/login') ?>" style="color:var(--muted);text-decoration:none">Admin</a>
            </nav>
        </header>

        <section class="hero">
            <h1>Berita Terbaru Indonesia</h1>
            <p>Platform Berita Terkini</p>
        </section>

        <div class="layout">
            <main>
                <h2 style="margin:0 0 12px;color:#cfeff6">Artikel Terbaru (Berita Indonesia)</h2>
                <?php if(empty($artikel)): ?>
                    <div class="card">Belum ada artikel yang dipublikasikan.</div>
                <?php else: ?>
                    <div class="grid">
                        <?php foreach($artikel as $item): ?>
                        <article class="card">
                            <h3><a href="<?= base_url('welcome/artikel/'.$item['slug']) ?>" style="color:inherit;text-decoration:none"><?= htmlspecialchars($item['judul']) ?></a></h3>
                            <div class="excerpt"><?= word_limiter(strip_tags($item['konten']), 30) ?></div>
                            <div class="meta">
                                <span><i class="far fa-calendar"></i> <?= date('d M Y', strtotime($item['tanggal_dibuat'])) ?></span>
                                <span>•</span>
                                <span><?= htmlspecialchars($item['penulis']) ?></span>
                                <span>•</span>
                                <span><i class="far fa-eye"></i> <?= $item['views'] ?></span>
                            </div>
                            <a class="btn-link" href="<?= base_url('welcome/artikel/'.$item['slug']) ?>">Baca Selengkapnya <i class="fas fa-arrow-right" style="font-size:12px"></i></a>
                        </article>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </main>

            <aside class="sidebar">
                <div class="box search" style="margin-bottom:14px">
                    <form action="<?= base_url('welcome/search') ?>" method="get">
                        <input type="text" name="q" placeholder="Cari artikel..." required>
                    </form>
                </div>

                <div class="box" style="margin-bottom:12px">
                    <strong style="color:#fff">Kategori</strong>
                    <div style="margin-top:8px">
                        <?php if(!empty($kategori)): ?>
                            <?php foreach($kategori as $kat): ?>
                                <div style="margin:6px 0"><a href="<?= base_url('welcome/kategori/'.$kat['slug']) ?>" style="color:var(--accent);text-decoration:none"><?= htmlspecialchars($kat['nama']) ?></a></div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div>Tidak ada kategori</div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="box">
                    <strong style="color:#fff">Tentang</strong>
                    <p style="margin:8px 0 0">Platform berita sederhana, cepat, dan mudah digunakan.</p>
                </div>
            </aside>
        </div>

        <footer>&copy; <?= date('Y') ?> BeritaID — Semua hak dilindungi.</footer>
    </div>
</body>
</html>
