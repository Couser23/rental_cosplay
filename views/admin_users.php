<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Pelanggan - Admin Panel</title>
    <link rel="stylesheet" href="assets/css/user-style.css">
    <style>
        .img-ktp { width: 100px; cursor: pointer; border-radius: 4px; border: 1px solid var(--border); transition: transform 0.3s ease; }
        .img-ktp:hover { transform: scale(1.1); box-shadow: var(--shadow-sm); }
        .btn-sm { padding: 6px 12px; font-size: 0.85rem; }
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
                <a href="index.php?page=admin_transaksi">Kelola Transaksi</a>
                <a href="index.php?page=admin_users" class="active">Kelola Pelanggan</a>
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
        <h2 style="font-size: 2rem; margin-top: 0; margin-bottom: 20px;">Daftar Pelanggan Terdaftar</h2>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th style="width: 50px; text-align: center;">No</th>
                        <th>Nama Pelanggan</th>
                        <th>Email</th>
                        <th>WhatsApp</th>
                        <th style="text-align: center;">Foto KTP</th>
                        <th style="text-align: center;">Status Verifikasi</th>
                        <th style="text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(empty($users)): ?>
                        <tr><td colspan="7" style="text-align: center; padding: 20px;">Belum ada pelanggan terdaftar.</td></tr>
                    <?php else: ?>
                        <?php $no = 1; foreach ($users as $row): ?>
                        <tr>
                            <td style="text-align: center; font-weight: 600; color: var(--text-muted);"><?= $no++ ?></td>
                            <td><strong style="color: var(--primary);"><?= htmlspecialchars($row['nama_lengkap']) ?></strong></td>
                            <td><?= htmlspecialchars($row['email']) ?></td>
                            <td><a href="https://wa.me/<?= htmlspecialchars($row['no_whatsapp']) ?>" target="_blank" style="color: #10b981; text-decoration: none; font-weight: 600;"><?= htmlspecialchars($row['no_whatsapp']) ?></a></td>
                            <td style="text-align: center;">
                                <?php if($row['foto_ktp']): ?>
                                    <a href="uploads/ktp/<?= $row['foto_ktp'] ?>" target="_blank">
                                        <img src="uploads/ktp/<?= $row['foto_ktp'] ?>" class="img-ktp" alt="KTP" title="Klik untuk memperbesar">
                                    </a>
                                <?php else: ?>
                                    <span style="color: var(--text-muted); font-size: 0.9rem;">Belum Upload</span>
                                <?php endif; ?>
                            </td>
                            <td style="text-align: center;">
                                <?php 
                                    $s = $row['status_verifikasi'];
                                    $cls = 'badge-danger';
                                    if ($s == 'Terverifikasi') $cls = 'badge-success';
                                    elseif ($s == 'Menunggu') $cls = 'badge-warning';
                                ?>
                                <span class="badge <?= $cls ?>"><?= htmlspecialchars($s) ?></span>
                            </td>
                            <td style="text-align: center;">
                                <?php if($row['status_verifikasi'] === 'Menunggu'): ?>
                                    <a href="index.php?page=verify_user&id=<?= $row['id_user'] ?>&status=Terverifikasi" class="btn btn-primary btn-sm" style="background: linear-gradient(135deg, #10b981, #059669);" onclick="return confirm('Setujui identitas pelanggan ini?')">Setujui</a>
                                    <a href="index.php?page=verify_user&id=<?= $row['id_user'] ?>&status=Ditolak" class="btn btn-danger btn-sm" onclick="return confirm('Tolak identitas pelanggan ini?')">Tolak</a>
                                <?php elseif($row['status_verifikasi'] === 'Terverifikasi'): ?>
                                    <span style="color: #10b981; font-weight: bold; font-size: 0.9rem;">✓ Terverifikasi</span>
                                <?php else: ?>
                                    <span style="color: var(--text-muted); font-size: 0.85rem;">-</span>
                                <?php endif; ?>
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