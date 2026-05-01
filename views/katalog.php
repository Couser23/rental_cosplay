<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Cosplay - RentCos</title>
    <link rel="stylesheet" href="assets/css/user-style.css">
    <style>
        .catalog-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 30px;
            margin-top: 30px;
        }
        
        .costume-card {
            background: var(--card-bg);
            border-radius: var(--radius-lg);
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
            border: 1px solid var(--border);
        }
        
        .costume-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-hover);
        }
        
        .card-img-wrapper {
            position: relative;
            height: 300px;
            overflow: hidden;
        }
        
        .card-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }
        
        .costume-card:hover .card-img {
            transform: scale(1.05);
        }
        
        .card-status {
            position: absolute;
            top: 15px;
            right: 15px;
            z-index: 10;
            box-shadow: 0 2px 4px rgba(0,0,0,0.2);
        }
        
        .card-content {
            padding: 20px;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }
        
        .card-title { margin: 0 0 5px 0; font-size: 1.25rem; }
        .card-series { color: var(--text-muted); font-size: 0.9rem; margin-bottom: 15px; }
        .card-details { display: flex; justify-content: space-between; margin-bottom: 15px; font-size: 0.95rem;}
        .card-price { font-size: 1.3rem; font-weight: 800; color: var(--primary); margin-bottom: 20px;}
        .card-action { margin-top: auto; }
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
                <a href="index.php?page=katalog" class="active">Katalog</a>
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
        <div style="text-align: center; margin-bottom: 50px;">
            <h1 style="font-size: 2.5rem; margin-bottom: 10px;">Temukan Kostum Impianmu</h1>
            <p style="color: var(--text-muted); font-size: 1.1rem;">Koleksi cosplay premium dengan harga terjangkau untuk event terbesarmu.</p>
        </div>

        <div class="catalog-grid">
            <?php foreach ($costumes as $row): ?>
                <div class="costume-card">
                    <div class="card-img-wrapper">
                        <?php if ($row['status_ketersediaan'] == 'Tersedia'): ?>
                            <span class="badge badge-success card-status">Tersedia</span>
                        <?php else: ?>
                            <span class="badge badge-danger card-status">Disewa</span>
                        <?php endif; ?>
                        
                        <?php if (!empty($row['gambar'])): ?>
                            <img src="uploads/<?= htmlspecialchars($row['gambar']) ?>" alt="<?= htmlspecialchars($row['nama_karakter']) ?>" class="card-img">
                        <?php else: ?>
                            <div style="width: 100%; height: 100%; background: #e2e8f0; display: flex; align-items: center; justify-content: center; color: #94a3b8; font-weight: 600;">No Image</div>
                        <?php endif; ?>
                    </div>

                    <div class="card-content">
                        <h3 class="card-title"><?= htmlspecialchars($row['nama_karakter']) ?></h3>
                        <div class="card-series"><?= htmlspecialchars($row['series']) ?></div>
                        
                        <div class="card-details">
                            <span><span style="color: var(--text-muted)">Size:</span> <strong><?= htmlspecialchars($row['size']) ?></strong></span>
                        </div>
                        
                        <div class="card-price">Rp <?= number_format($row['harga_sewa'], 0, ',', '.') ?><span style="font-size: 0.8rem; font-weight: 400; color: var(--text-muted);">/hari</span></div>
                        
                        <div class="card-action">
                            <a href="index.php?page=detail&id=<?= $row['id_costume'] ?>" class="btn btn-primary" style="width: 100%; box-sizing: border-box;">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
            </div>
        </main>
    </div>
    
</body>
</html>