-- Insert dua artikel berita: kecelakaan dan bencana di Indonesia
-- Sesuaikan `kategori_id` jika tabel `kategori` berbeda di database Anda.

INSERT INTO artikel (judul, slug, konten, gambar, penulis, status, views)
VALUES
('Kecelakaan Beruntun di Jalan Tol, Puluhan Kendaraan Terlibat', 'kecelakaan-beruntun-di-jalan-tol-puluhan-kendaraan',
'<p>Pagi hari ini terjadi kecelakaan beruntun di salah satu ruas jalan tol utama di Pulau Jawa. Insiden terjadi sekitar pukul 07.30 WIB pada km 112 ketika kondisi jalan licin akibat hujan deras. Sejumlah kendaraan roda empat dan kendaraan berat terlibat dalam tabrakan berantai yang menyebabkan lalu lintas tersendat panjang.</p><p>Tim keselamatan dan petugas kepolisian segera dikerahkan ke lokasi untuk mengevakuasi korban serta mengatur arus lalu lintas. Beberapa korban mengalami luka-luka dan mendapat perawatan di rumah sakit terdekat. Penyebab awal diduga kombinasi antara kondisi jalan basah, jarak aman yang tidak terjaga, dan visibilitas yang menurun.</p><p>Pihak berwenang menghimbau pengendara untuk selalu menjaga kecepatan aman, meningkatkan jarak antar kendaraan, serta memantau kondisi cuaca sebelum melakukan perjalanan jauh. Proses evakuasi dan pembersihan jalan diperkirakan akan memakan beberapa jam sehingga pengendara disarankan mencari rute alternatif.</p>', NULL, 'Redaksi', 'published', 0),

('Banjir Bandang Melanda Wilayah Barat Pulau Sumatera, Ribuan Mengungsi', 'banjir-bandang-wilayah-barat-sumatera-ribuan-mengungsi',
'<p>Hujan deras yang berlangsung lebih dari 24 jam menyebabkan banjir bandang di beberapa kecamatan di wilayah barat Pulau Sumatera. Debit air yang meningkat secara tiba-tiba mengakibatkan aliran sungai meluap, merendam permukiman, fasilitas umum, dan infrastruktur jalan.</p><p>Badan Penanggulangan Bencana Daerah (BPBD) setempat melaporkan ribuan warga mengungsi ke pos-pos pengungsian yang didirikan di tempat lebih tinggi. Tim SAR bersama relawan terus melakukan evakuasi dan distribusi bantuan pangan, selimut, dan kebutuhan medis dasar.</p><p>Pemerintah daerah meminta masyarakat untuk tetap waspada terhadap potensi longsor di daerah perbukitan dan tidak kembali ke rumah hingga dinyatakan aman. Mitigasi jangka panjang seperti perbaikan drainase dan penghijauan kembali wilayah hulu sungai menjadi fokus agar kejadian serupa dapat diminimalkan di masa mendatang.</p>', NULL, 'Redaksi', 'published', 0);

-- Hubungkan artikel ke kategori 'Berita' (asumsi kategori 'berita' memiliki id = 3)
INSERT INTO artikel_kategori (artikel_id, kategori_id)
VALUES
((SELECT id FROM artikel WHERE slug = 'kecelakaan-beruntun-di-jalan-tol-puluhan-kendaraan'), 3),
((SELECT id FROM artikel WHERE slug = 'banjir-bandang-wilayah-barat-sumatera-ribuan-mengungsi'), 3);

-- Jika `kategori_id` berbeda, ganti angka 3 sesuai id kategori 'Berita' di tabel `kategori`.

-- Tambah artikel: Kebakaran di Cengkareng (Diduga korsleting listrik)
INSERT INTO artikel (judul, slug, konten, gambar, penulis, status, views)
VALUES ('Diduga Korsleting Listrik, Rumah-Lapak Semi Permanen di Cengkareng Kebakaran', 'diduga-korsleting-listrik-rumah-lapak-semi-permanen-di-cengkareng-kebakaran',
'<p><strong>Rumondang Naibaho - detikNews</strong><br>Sabtu, 31 Jan 2026 09:37 WIB</p><p>Kebakaran melanda rumah hingga lapak semi permanen di kawasan Cengkareng, Jakarta Barat. Sebanyak 13 mobil pemadam kebakaran dikerahkan ke lokasi.</p><p>Kepala Suku Dinas Penanggulangan Kebakaran dan Penyelamatan (Gulkarmat) Jakarta Barat, Suheri menyebut informasi kebakaran diterima pukul 04.47 WIB. Sebanyak 65 petugas damkar turun ke lapangan.</p><p>"Objek (terbakar) empat rumah semi permanen dan tiga lapak. 13 unit dan 65 personel dikerahkan," kata Suheri melalui keterangannya, Sabtu (31/1/2025).</p><p>Lokasi kebakaran persisnya di Jalan Pedongkelan Belakang, Cengkareng Timur. Lokasi yang terbakar diperkirakan seluas 400 meter persegi dengan kepala keluarga (KK) yang terdampak 3 KK berisi 12 jiwa.</p><p>"Dugaan penyebab sementara diduga karena fenomena listrik," tutur Suheri.</p><p>Kejadian bermula pada pukul 04.30 WIB warga melihat api sudah membesar dari lapak plastik bekas. Warga langsung melaporkan ke JS 112 dan langsung ditindaklanjuti oleh petugas.</p><p>"Api berhasil dipadamkan oleh petugas sekitar pukul 05.27 WIB. Sekira pukul 06.17 operasi selesai," imbuh Suheri.</p><p>Baca artikel detiknews, "Diduga Korsleting Listrik, Rumah-Lapak Semi Permanen di Cengkareng Kebakaran" selengkapnya https://news.detik.com/berita/d-8333934/diduga-korsleting-listrik-rumah-lapak-semi-permanen-di-cengkareng-kebakaran.</p>', NULL, 'Rumondang Naibaho - detikNews', 'published', 0);

-- Kaitkan ke kategori 'Berita' (asumsi id = 3)
INSERT INTO artikel_kategori (artikel_id, kategori_id)
VALUES ((SELECT id FROM artikel WHERE slug = 'diduga-korsleting-listrik-rumah-lapak-semi-permanen-di-cengkareng-kebakaran'), 3);
