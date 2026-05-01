<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Kostum - <?= htmlspecialchars($costume['nama_karakter']) ?></title>
    <link rel="stylesheet" href="assets/css/user-style.css">
    <style>
        .detail-wrapper {
            background: var(--card-bg);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-md);
            overflow: hidden;
            display: flex;
            flex-wrap: wrap;
            margin-top: 20px;
        }
        
        .detail-image {
            flex: 1;
            min-width: 300px;
            background: #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }
        
        .detail-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            max-height: 600px;
        }
        
        .detail-content {
            flex: 1;
            min-width: 300px;
            padding: 40px;
            display: flex;
            flex-direction: column;
        }
        
        .detail-title {
            font-size: 2.2rem;
            margin: 0 0 10px 0;
            color: var(--text-main);
        }
        
        .spec-list {
            list-style: none;
            padding: 0;
            margin: 20px 0;
        }
        
        .spec-list li {
            padding: 12px 0;
            border-bottom: 1px solid var(--border);
            display: flex;
            justify-content: space-between;
        }
        
        .spec-list li strong { color: var(--text-muted); font-weight: 600; }
        
        .booking-form {
            background: #f8fafc;
            padding: 25px;
            border-radius: var(--radius-md);
            margin-top: 30px;
            border: 1px solid var(--border);
        }
        
        .back-link {
            display: inline-flex;
            align-items: center;
            color: var(--text-muted);
            text-decoration: none;
            font-weight: 600;
            margin-bottom: 20px;
            transition: color 0.3s ease;
        }
        
        .back-link:hover { color: var(--primary); }
    </style>
</head>
<body>

    <div class="user-layout">
        <div class="user-mobile-header">
            <a href="index.php?page=katalog" class="nav-brand">✨ RentCos</a>
            <label for="user-menu-toggle" class="hamburger-btn">☰</label>
        </div>
        <input type="checkbox" id="user-menu-toggle" class="menu-toggle">
        <label for="user-menu-toggle" class="menu-overlay"></label>

        <!-- Sidebar -->
        <aside class="user-sidebar">
            <div class="user-sidebar-header">
                <a href="index.php?page=katalog" class="user-sidebar-brand">✨ RentCos</a>
            </div>
            <div class="user-sidebar-menu">
                <a href="index.php?page=katalog">Katalog</a>
                <?php if(isset($_SESSION['id_user'])): ?>
                    <a href="index.php?page=riwayat">Riwayat Sewa</a>
                <?php endif; ?>
            </div>
            <div class="user-sidebar-footer">
                <?php if(isset($_SESSION['id_user'])): ?>
                    <div style="font-size: 0.85rem; color: #94a3b8; margin-bottom: 5px;">Halo,</div>
                    <div style="font-weight: 600; margin-bottom: 15px; color: white;"><?= htmlspecialchars($_SESSION['nama']) ?> 👋</div>
                    <a href="index.php?page=logout" class="btn btn-danger" style="width: 100%; box-sizing: border-box;" onclick="return confirm('Yakin ingin logout?')">Logout</a>
                <?php else: ?>
                    <a href="index.php?page=login" class="btn btn-outline" style="width: 100%; margin-bottom: 10px; box-sizing: border-box; border-color: rgba(255,255,255,0.2); color: white;">Login</a>
                    <a href="index.php?page=register" class="btn btn-primary" style="width: 100%; box-sizing: border-box;">Daftar</a>
                <?php endif; ?>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="user-main">
            <div class="container">
        <a href="index.php" class="back-link">← Kembali ke Katalog</a>
        
        <div class="detail-wrapper">
            <!-- KIRI: GAMBAR -->
            <div class="detail-image">
                <?php if ($costume['status_ketersediaan'] == 'Tersedia'): ?>
                    <span class="badge badge-success" style="position: absolute; top: 20px; left: 20px;">Tersedia</span>
                <?php else: ?>
                    <span class="badge badge-danger" style="position: absolute; top: 20px; left: 20px;">Disewa</span>
                <?php endif; ?>

                <?php if (!empty($costume['gambar'])): ?>
                    <img src="uploads/<?= htmlspecialchars($costume['gambar']) ?>" alt="<?= htmlspecialchars($costume['nama_karakter']) ?>">
                <?php else: ?>
                    <div style="color: #94a3b8; font-weight: 600;">Belum Ada Foto</div>
                <?php endif; ?>
            </div>

            <!-- KANAN: SPESIFIKASI & FORM -->
            <div class="detail-content">
                <h2 class="detail-title"><?= htmlspecialchars($costume['nama_karakter']) ?></h2>
                <div style="font-size: 1.5rem; font-weight: 800; color: var(--primary);">Rp <?= number_format($costume['harga_sewa'], 0, ',', '.') ?> <span style="font-size: 1rem; color: var(--text-muted); font-weight: 400;">/ hari</span></div>
                
                <ul class="spec-list">
                    <li><strong>Series</strong> <span><?= htmlspecialchars($costume['series']) ?></span></li>
                    <li><strong>Ukuran</strong> <span><span class="badge" style="background:#e2e8f0; color:#334155;"><?= htmlspecialchars($costume['size']) ?></span></span></li>
                    <li><strong>Deposit Keamanan</strong> <span>Rp <?= number_format($costume['harga_deposit'], 0, ',', '.') ?></span></li>
                </ul>

                <p style="color: var(--text-muted); font-size: 0.9rem;"><em>* Deposit akan dikembalikan sepenuhnya setelah kostum dikembalikan dalam keadaan aman dan tanpa kerusakan.</em></p>

                <div class="booking-form">
                    <h3 style="margin-top: 0; font-size: 1.2rem;">Atur Penyewaan</h3>
                    <form action="index.php?page=checkout" method="POST">
                        <input type="hidden" name="id_costume" value="<?= $costume['id_costume'] ?>">
                        
                        <div class="form-group">
                            <label>Pilih Tanggal Mulai:</label>
                            <input type="date" name="tanggal_mulai" required>
                        </div>
                        
                        <div class="form-group">
                            <label>Durasi Sewa (Hari):</label>
                            <input type="number" name="durasi" min="1" value="1" required>
                        </div>
                        
                        <?php if (!isset($_SESSION['id_user'])): ?>
                            <div class="alert" style="background: #e2e8f0; border-left-color: #64748b; text-align: center;">
                                <p style="margin: 0 0 10px 0;">Silakan <strong>Login</strong> untuk menyewa kostum.</p>
                                <a href="index.php?page=login" class="btn btn-primary" style="width: 100%; box-sizing: border-box;">Login Sekarang</a>
                            </div>
                        <?php elseif ($_SESSION['status_verifikasi'] === 'Terverifikasi'): ?>
                            <button type="submit" class="btn btn-primary" style="width: 100%;">Lanjut Pembayaran</button>
                        <?php elseif ($_SESSION['status_verifikasi'] === 'Menunggu'): ?>
                            <button type="button" class="btn" disabled style="width: 100%; background-color: var(--warning); color: #fff; cursor: not-allowed; opacity: 0.8;">Identitas Sedang Ditinjau Admin</button>
                        <?php else: ?>
                            <div class="alert alert-warning" style="margin-bottom: 0;">
                                <p style="margin: 0 0 10px 0;">⚠️ Anda wajib mengunggah KTP untuk menyewa.</p>
                                <a href="index.php?page=upload_ktp" style="color: #92400e; font-weight: bold; text-decoration: underline;">Verifikasi KTP di sini</a>
                            </div>
                        <?php endif; ?>
                    </form>
                </div>
            </div>
        </div>
            </div>
        </main>
    </div>
</body>
</html>