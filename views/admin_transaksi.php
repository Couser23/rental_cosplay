<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Transaksi - Admin Panel</title>
    <link rel="stylesheet" href="assets/css/user-style.css">
    <style>
        .inline-form { display: flex; gap: 8px; justify-content: center; align-items: center; }
        .form-select { 
            padding: 8px 10px; 
            border: 1px solid var(--border); 
            border-radius: 6px; 
            font-family: 'Outfit', sans-serif;
            font-size: 0.9rem;
            background: #f8fafc;
        }
        .btn-sm { padding: 8px 12px; font-size: 0.85rem; }
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
                <a href="index.php?page=admin_dashboard">Dashboard</a>
                <a href="index.php?page=admin_kostum">Kelola Kostum</a>
                <a href="index.php?page=admin_transaksi" class="active">Kelola Transaksi</a>
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
        <h2 style="font-size: 2rem; margin-top: 0; margin-bottom: 20px;">Daftar Pesanan Sewa Kostum</h2>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th style="width: 60px;">ID</th>
                        <th>Penyewa</th>
                        <th>Kostum</th>
                        <th>Mulai Sewa</th>
                        <th>Tagihan</th>
                        <th style="text-align: center;">Aksi (Update Status)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(empty($transactions)): ?>
                        <tr><td colspan="6" style="text-align: center; padding: 20px;">Belum ada data transaksi.</td></tr>
                    <?php else: ?>
                        <?php foreach ($transactions as $row): ?>
                        <tr>
                            <td style="font-weight: bold; color: var(--text-muted);">#<?= htmlspecialchars($row['id_transaksi']) ?></td>
                            <td><strong style="color: var(--primary);"><?= htmlspecialchars($row['nama_lengkap']) ?></strong></td>
                            <td><?= htmlspecialchars($row['nama_karakter']) ?></td>
                            <td>
                                <div><?= date('d M Y', strtotime($row['tgl_mulai'])) ?></div>
                                <div style="font-size: 0.85rem; color: var(--text-muted);">(<?= htmlspecialchars($row['durasi_hari']) ?> Hari)</div>
                            </td>
                            <td style="font-weight: 700; color: var(--text-main);">Rp <?= number_format($row['total_harga'], 0, ',', '.') ?></td>
                            
                            <td>
                                <form action="index.php?page=process_update_transaksi" method="POST" class="inline-form">
                                    <input type="hidden" name="id_transaksi" value="<?= $row['id_transaksi'] ?>">
                                    
                                    <select name="status_pembayaran" class="form-select">
                                        <option value="Belum Bayar" <?= $row['status_pembayaran'] == 'Belum Bayar' ? 'selected' : '' ?>>🔴 Belum Bayar</option>
                                        <option value="Lunas" <?= $row['status_pembayaran'] == 'Lunas' ? 'selected' : '' ?>>🟢 Lunas</option>
                                        <option value="Batal" <?= $row['status_pembayaran'] == 'Batal' ? 'selected' : '' ?>>❌ Batal</option>
                                    </select>
                                    
                                    <select name="status_sewa" class="form-select">
                                        <option value="Menunggu" <?= $row['status_sewa'] == 'Menunggu' ? 'selected' : '' ?>>⏳ Menunggu</option>
                                        <option value="Berjalan" <?= $row['status_sewa'] == 'Berjalan' ? 'selected' : '' ?>>🚚 Berjalan</option>
                                        <option value="Selesai" <?= $row['status_sewa'] == 'Selesai' ? 'selected' : '' ?>>✅ Selesai</option>
                                    </select>
                                    
                                    <button type="submit" class="btn btn-primary btn-sm">Update</button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
            </div>
        </main>
    </div>

</body>
</html>