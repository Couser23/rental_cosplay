<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Sewa - RentCos</title>
    <link rel="stylesheet" href="assets/css/user-style.css">
    <style>
        .status-badge {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
        }
        .status-pending { background-color: #fef3c7; color: #92400e; }
        .status-success { background-color: #dcfce7; color: #166534; }
        .status-danger { background-color: #fee2e2; color: #991b1b; }
        .status-info { background-color: #e0e7ff; color: #3730a3; }
        
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
                    <a href="index.php?page=riwayat" class="active">Riwayat Sewa</a>
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
        <a href="index.php?page=katalog" class="back-link">← Kembali ke Katalog</a>
        <h2 style="font-size: 2rem; margin-top: 0; margin-bottom: 20px;">Riwayat Sewa Kostum Saya</h2>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th style="width: 50px; text-align: center;">No</th>
                        <th>Kostum</th>
                        <th>Tanggal Mulai</th>
                        <th>Durasi</th>
                        <th>Total Tagihan</th>
                        <th style="text-align: center;">Status Pembayaran</th>
                        <th style="text-align: center;">Status Sewa</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($riwayat)): ?>
                        <tr>
                            <td colspan="7" style="text-align: center; padding: 40px; color: var(--text-muted);">
                                <div style="font-size: 3rem; margin-bottom: 10px;">👻</div>
                                Belum ada riwayat penyewaan. Yuk sewa kostum pertamamu!
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php $no = 1; foreach ($riwayat as $row): ?>
                        <tr>
                            <td style="text-align: center; font-weight: 600; color: var(--text-muted);"><?= $no++ ?></td>
                            <td><strong style="color: var(--primary);"><?= htmlspecialchars($row['nama_karakter']) ?></strong></td>
                            <td><?= date('d M Y', strtotime($row['tgl_mulai'])) ?></td>
                            <td><?= htmlspecialchars($row['durasi_hari']) ?> Hari</td>
                            <td style="font-weight: 700;">Rp <?= number_format($row['total_harga'], 0, ',', '.') ?></td>
                            <td style="text-align: center;">
                                <?php 
                                    $pStatus = $row['status_pembayaran'];
                                    $pClass = 'status-pending';
                                    if ($pStatus == 'Lunas') $pClass = 'status-success';
                                    elseif ($pStatus == 'Batal') $pClass = 'status-danger';
                                ?>
                                <span class="status-badge <?= $pClass ?>"><?= htmlspecialchars($pStatus) ?></span>
                            </td>
                            <td style="text-align: center;">
                                <?php 
                                    $sStatus = $row['status_sewa'];
                                    $sClass = 'status-pending';
                                    if ($sStatus == 'Selesai') $sClass = 'status-success';
                                    elseif ($sStatus == 'Disewa') $sClass = 'status-info';
                                ?>
                                <span class="status-badge <?= $sClass ?>"><?= htmlspecialchars($sStatus) ?></span>
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