<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - RentCos</title>
    <link rel="stylesheet" href="assets/css/user-style.css">
    <style>
        .dashboard-grid { 
            display: grid; 
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); 
            gap: 30px; 
            margin-top: 40px; 
        }
        
        .card-menu { 
            background: var(--card-bg); 
            padding: 40px 30px; 
            border-radius: var(--radius-lg); 
            text-align: center; 
            border: 1px solid var(--border); 
            box-shadow: var(--shadow-sm); 
            transition: all 0.3s ease;
        }
        .card-menu:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-hover);
        }
        .card-menu h3 { margin-top: 0; color: var(--text-main); font-size: 1.5rem; }
        .card-menu p { color: var(--text-muted); margin-bottom: 25px; }
        .icon-large { font-size: 3rem; margin-bottom: 15px; display: block; }
    </style>
</head>
<body>

    <div class="admin-layout">
        <div class="admin-mobile-header">
            <span class="admin-sidebar-brand" style="color: var(--text-main); font-size: 1.2rem;">⚙️ RentCos Admin</span>
            <label for="admin-menu-toggle" class="hamburger-btn">☰</label>
        </div>
        <input type="checkbox" id="admin-menu-toggle" class="menu-toggle">
        <label for="admin-menu-toggle" class="menu-overlay"></label>

        <!-- Sidebar -->
        <aside class="admin-sidebar">
            <div class="admin-sidebar-header">
                <span class="admin-sidebar-brand">⚙️ RentCos</span>
            </div>
            <div class="admin-sidebar-menu">
                <a href="index.php?page=admin_dashboard" class="active">Dashboard</a>
                <a href="index.php?page=admin_kostum">Kelola Kostum</a>
                <a href="index.php?page=admin_transaksi">Kelola Transaksi</a>
                <a href="index.php?page=admin_users">Kelola Pelanggan</a>
            </div>
            <div class="admin-sidebar-footer">
                <div style="font-size: 0.85rem; color: #94a3b8; margin-bottom: 10px;">Login sebagai:</div>
                <div style="font-weight: 600; margin-bottom: 15px;"><?= htmlspecialchars($_SESSION['nama']) ?></div>
                <a href="index.php?page=logout" class="btn btn-danger" style="width: 100%; padding: 8px; box-sizing: border-box;" onclick="return confirm('Yakin ingin keluar dari panel admin?')">Logout</a>
            </div>
        </aside>

        <!-- Konten Utama -->
        <main class="admin-main">
            <div class="container">
        <h2 style="font-size: 2rem; margin-top: 0; margin-bottom: 10px;">Overview Sistem</h2>
        <p style="color: var(--text-muted); font-size: 1.1rem;">Selamat datang di pusat kendali penyewaan kostum. Pilih menu di bawah untuk mengelola sistem.</p>

        <div class="dashboard-grid">
            <div class="card-menu">
                <span class="icon-large">📦</span>
                <h3>Data Kostum</h3>
                <p>Tambah, edit, atau hapus katalog kostum cosplay.</p>
                <a href="index.php?page=admin_kostum" class="btn btn-primary" style="width: 80%;">Kelola Kostum</a>
            </div>
            
            <div class="card-menu">
                <span class="icon-large">📝</span>
                <h3>Data Transaksi</h3>
                <p>Verifikasi pembayaran dan update status sewa.</p>
                <a href="index.php?page=admin_transaksi" class="btn btn-primary" style="width: 80%; background: linear-gradient(135deg, #10b981, #059669);">Kelola Transaksi</a>
            </div>
            
            <div class="card-menu">
                <span class="icon-large">👥</span>
                <h3>Data Pelanggan</h3>
                <p>Verifikasi KTP dan pantau identitas penyewa.</p>
                <a href="index.php?page=admin_users" class="btn btn-primary" style="width: 80%; background: linear-gradient(135deg, #f59e0b, #d97706);">Kelola Pelanggan</a>
            </div>
        </div>
            </div>
        </main>
    </div>

</body>
</html>