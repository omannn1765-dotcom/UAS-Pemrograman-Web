# 🚀 Quick Start Guide - CMS Portal

## Akses Aplikasi

### 🌐 Website Public
**URL**: http://localhost:8080
- Homepage dengan 5 artikel
- Search functionality
- Filter by kategori
- Responsive design

### 🔐 Admin Panel
**URL**: http://localhost:8080/auth/login
```
Username: admin
Password: admin123
```

### 🗄️ phpMyAdmin
**URL**: http://localhost:8081
```
Server: db
Username: root
Password: root
Database: cms_db
```

## Perintah Docker

### Start aplikasi:
```bash
docker compose up -d --build
```

### Stop aplikasi:
```bash
docker compose down
```

### Reset database (hapus semua data):
```bash
docker compose down -v
docker compose up -d --build
```

### Check status:
```bash
docker ps
```

### View logs:
```bash
docker logs ci3_web
docker logs ci3_db
```

## Fitur yang Sudah Diimplementasi

✅ **Authentication System**
- Login/Logout
- Password encryption (bcrypt)
- Session management
- Protected admin routes

✅ **Artikel Management (CRUD)**
- Create artikel dengan kategori
- Read artikel (public & admin)
- Update artikel
- Delete artikel
- Draft/Published status
- View counter
- Auto-generate slug

✅ **Kategori System**
- 4 kategori pre-loaded
- Many-to-many relationship
- Filter artikel by kategori

✅ **Search Functionality**
- Full-text search
- Search on title & content

✅ **Modern UI/UX**
- Gradient design (Purple-Blue)
- Responsive layout
- Font Awesome icons
- Bootstrap 4
- Card-based layout

✅ **Admin Dashboard**
- Statistics cards
- Data table with actions
- Sidebar navigation
- User info display

✅ **Security Features**
- Password hashing
- SQL injection prevention
- XSS protection
- CSRF protection
- Input validation

## Database Schema

### Tabel `users`
- id, username, password, nama_lengkap, email, created_at
- 1 admin user seeded

### Tabel `artikel`
- id, judul, slug, konten, gambar, penulis, status, views, tanggal_dibuat, tanggal_diupdate
- 5 artikel seeded

### Tabel `kategori`
- id, nama, slug, deskripsi, created_at
- 4 kategori seeded (Teknologi, Tutorial, Berita, Tips & Trik)

### Tabel `artikel_kategori`
- id, artikel_id, kategori_id
- Junction table for many-to-many

## File Structure Highlights

```
├── application/
│   ├── controllers/
│   │   ├── Welcome.php      # Public pages
│   │   ├── Admin.php        # Admin CRUD
│   │   └── Auth.php         # Login/Logout
│   ├── models/
│   │   ├── Artikel_model.php
│   │   ├── User_model.php
│   │   └── Kategori_model.php
│   └── views/
│       ├── home.php         # Homepage
│       ├── artikel_detail.php
│       ├── kategori_view.php
│       ├── search_results.php
│       ├── auth/login.php
│       └── admin/           # Admin views
├── db_init/init.sql         # Database seed
├── docker-compose.yml
├── Dockerfile
└── README.md               # Full documentation
```

## Testing Checklist

### Public Website
- [ ] Homepage loads (http://localhost:8080)
- [ ] 5 artikel displayed
- [ ] Click artikel to view detail
- [ ] Search functionality works
- [ ] Filter by kategori works
- [ ] Responsive on mobile

### Admin Panel
- [ ] Login page loads (http://localhost:8080/auth/login)
- [ ] Login with admin/admin123
- [ ] Dashboard shows statistics
- [ ] View all artikel in table
- [ ] Create new artikel
- [ ] Edit existing artikel
- [ ] Delete artikel (with confirmation)
- [ ] Kategori management page
- [ ] Logout works

### Database
- [ ] phpMyAdmin accessible (http://localhost:8081)
- [ ] All 4 tables exist
- [ ] Users table has 1 admin
- [ ] Artikel table has 5 records
- [ ] Kategori table has 4 records
- [ ] Artikel_kategori has relations

## Common Issues & Solutions

### Port already in use
Edit ports in `docker-compose.yml`:
```yaml
ports:
  - "8090:80"  # Change 8080 to 8090
```

### Permission errors
```bash
sudo chown -R $USER:$USER .
```

### Database not initialized
```bash
docker compose down -v
docker compose up -d --build
```

### White page / error
Check logs:
```bash
docker logs ci3_web
```

## Tech Stack Summary

- **Backend**: CodeIgniter 3 (PHP 8.1)
- **Database**: MariaDB 10.6
- **Frontend**: Bootstrap 4, Font Awesome, jQuery
- **Server**: Apache
- **DevOps**: Docker + Docker Compose
- **Tools**: phpMyAdmin

## Credits

Project for: **UAS Pemrograman Web**
Framework: **CodeIgniter 3**
Year: **2026**

---

🎉 **Aplikasi siap untuk UAS submission!** 🎉

All features implemented, tested, and documented.
