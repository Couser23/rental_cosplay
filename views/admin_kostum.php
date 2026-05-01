<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Kostum - Admin Panel</title>
    <link rel="stylesheet" href="assets/css/user-style.css">
    <style>
        .action-btns { display: flex; gap: 8px; justify-content: center; }
        .btn-sm { padding: 6px 10px; font-size: 0.85rem; }
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
                <a href="index.php?page=admin_kostum" class="active">Kelola Kostum</a>
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
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h2 style="margin: 0; font-size: 2rem;">Daftar Katalog Kostum</h2>
            <a href="index.php?page=admin_tambah_kostum" class="btn btn-primary" style="background: linear-gradient(135deg, #10b981, #059669);">+ Tambah Kostum Baru</a>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th style="width: 50px; text-align: center;">No</th>
                        <th>Karakter</th>
                        <th>Series</th>
                        <th style="text-align: center;">Size</th>
                        <th>Harga Sewa</th>
                        <th style="text-align: center;">Status</th>
                        <th style="text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(empty($costumes)): ?>
                        <tr><td colspan="7" style="text-align: center; padding: 20px;">Belum ada data kostum.</td></tr>
                    <?php else: ?>
                        <?php $no = 1; foreach ($costumes as $row): ?>
                        <tr>
                            <td style="text-align: center; font-weight: 600; color: var(--text-muted);"><?= $no++ ?></td>
                            <td><strong style="color: var(--primary);"><?= htmlspecialchars($row['nama_karakter']) ?></strong></td>
                            <td><?= htmlspecialchars($row['series']) ?></td>
                            <td style="text-align: center;">
                                <span class="badge" style="background: #e2e8f0; color: #334155;"><?= htmlspecialchars($row['size']) ?></span>
                            </td>
                            <td style="font-weight: 600;">Rp <?= number_format($row['harga_sewa'], 0, ',', '.') ?></td>
                            <td style="text-align: center;">
                                <?php 
                                    $s = $row['status_ketersediaan'];
                                    $cls = 'badge-warning';
                                    if ($s == 'Tersedia') $cls = 'badge-success';
                                    elseif ($s == 'Disewa') $cls = 'badge-danger';
                                ?>
                                <span class="badge <?= $cls ?>"><?= htmlspecialchars($s) ?></span>
                            </td>
                            <td>
                                <div class="action-btns">
                                    <a href="index.php?page=admin_edit_kostum&id=<?= $row['id_costume'] ?>" class="btn btn-primary btn-sm" style="background: var(--warning); color: #92400e; box-shadow: none;">Edit</a>
                                    <a href="index.php?page=admin_hapus_kostum&id=<?= $row['id_costume'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus kostum <?= htmlspecialchars($row['nama_karakter']) ?> ini secara permanen?')">Hapus</a>
                                </div>
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