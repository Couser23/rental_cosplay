<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kostum - Admin Panel</title>
    <link rel="stylesheet" href="assets/css/user-style.css">
</head>
<body>

<div class="auth-wrapper" style="padding-top: 40px; padding-bottom: 40px; align-items: flex-start;">
    <div class="auth-card" style="max-width: 600px; text-align: left;">
        
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
            <h2 style="margin: 0;">Edit Katalog Kostum</h2>
            <a href="index.php?page=admin_kostum" style="text-decoration: none; color: var(--text-muted); font-weight: 600;">✕ Batal</a>
        </div>
        
        <form action="index.php?page=process_edit_kostum" method="POST" enctype="multipart/form-data">
            
            <!-- Hidden Input -->
            <input type="hidden" name="id_costume" value="<?= $costume['id_costume'] ?>">
            <input type="hidden" name="gambar_lama" value="<?= $costume['gambar'] ?>">
            
            <div class="form-group">
                <label>Nama Karakter / Set Kostum:</label>
                <input type="text" name="nama_karakter" required value="<?= htmlspecialchars($costume['nama_karakter']) ?>">
            </div>
            
            <div class="form-group">
                <label>Asal Series / Game:</label>
                <input type="text" name="series" required value="<?= htmlspecialchars($costume['series']) ?>">
            </div>
            
            <div class="grid-2-col">
                <div class="form-group">
                    <label>Ukuran (Size):</label>
                    <input type="text" name="size" required value="<?= htmlspecialchars($costume['size']) ?>">
                </div>
                
                <div class="form-group">
                    <label>Status Ketersediaan:</label>
                    <select name="status_ketersediaan" required style="width: 100%; padding: 12px 15px; border: 1.5px solid var(--border); border-radius: 8px; font-family: 'Outfit', sans-serif; font-size: 1rem; background-color: #f8fafc;">
                        <option value="Tersedia" <?= $costume['status_ketersediaan'] == 'Tersedia' ? 'selected' : '' ?>>Tersedia</option>
                        <option value="Disewa" <?= $costume['status_ketersediaan'] == 'Disewa' ? 'selected' : '' ?>>Sedang Disewa</option>
                        <option value="Laundry" <?= $costume['status_ketersediaan'] == 'Laundry' ? 'selected' : '' ?>>Sedang Di-Laundry</option>
                    </select>
                </div>
            </div>
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                <div class="form-group">
                    <label>Harga Sewa / Hari (Rp):</label>
                    <input type="number" name="harga_sewa" required value="<?= $costume['harga_sewa'] ?>">
                </div>
                
                <div class="form-group">
                    <label>Harga Deposit (Rp):</label>
                    <input type="number" name="harga_deposit" required value="<?= $costume['harga_deposit'] ?>">
                </div>
            </div>
            
            <div class="form-group" style="margin-top: 10px;">
                <label>Ganti Foto Baru (Opsional):</label>
                <div style="border: 2px dashed var(--border); padding: 20px; border-radius: var(--radius-md); text-align: center; background: #f8fafc;">
                    <input type="file" name="gambar" accept="image/png, image/jpeg, image/jpg, image/webp" style="width: 100%; border: none; padding: 0; background: transparent; box-shadow: none;">
                    <div style="font-size: 0.8rem; color: var(--text-muted); margin-top: 5px;">Biarkan kosong jika tidak ingin mengubah foto.</div>
                </div>
            </div>
            
            <button type="submit" class="btn btn-primary" style="width: 100%; padding: 12px; margin-top: 10px; font-size: 1.1rem; background: linear-gradient(135deg, #f59e0b, #d97706); box-shadow: none;">Simpan Perubahan</button>
        </form>
    </div>
</div>

</body>
</html>