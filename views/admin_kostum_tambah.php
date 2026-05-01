<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kostum - Admin Panel</title>
    <link rel="stylesheet" href="assets/css/user-style.css">
</head>
<body>

<div class="auth-wrapper" style="padding-top: 40px; padding-bottom: 40px; align-items: flex-start;">
    <div class="auth-card" style="max-width: 600px; text-align: left;">
        
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
            <h2 style="margin: 0;">Tambah Kostum Baru</h2>
            <a href="index.php?page=admin_kostum" style="text-decoration: none; color: var(--text-muted); font-weight: 600;">✕ Batal</a>
        </div>
        
        <form action="index.php?page=process_tambah_kostum" method="POST" enctype="multipart/form-data">
            
            <div class="form-group">
                <label>Nama Karakter / Set Kostum:</label>
                <input type="text" name="nama_karakter" required placeholder="Contoh: Columbina">
            </div>
            
            <div class="form-group">
                <label>Asal Series / Game:</label>
                <input type="text" name="series" required placeholder="Contoh: Genshin Impact">
            </div>
            
            <div class="grid-2-col">
                <div class="form-group">
                    <label>Ukuran (Size):</label>
                    <input type="text" name="size" required placeholder="Contoh: M / L">
                </div>
                
                <div class="form-group">
                    <label>Status Awal:</label>
                    <select name="status_ketersediaan" required style="width: 100%; padding: 12px 15px; border: 1.5px solid var(--border); border-radius: 8px; font-family: 'Outfit', sans-serif; font-size: 1rem; background-color: #f8fafc;">
                        <option value="Tersedia">Tersedia</option>
                        <option value="Disewa">Sedang Disewa</option>
                        <option value="Laundry">Sedang Di-Laundry</option>
                    </select>
                </div>
            </div>
            
            <div class="grid-2-col">
                <div class="form-group">
                    <label>Harga Sewa / Hari (Rp):</label>
                    <input type="number" name="harga_sewa" required placeholder="150000">
                </div>
                
                <div class="form-group">
                    <label>Harga Deposit (Rp):</label>
                    <input type="number" name="harga_deposit" required placeholder="100000">
                </div>
            </div>
            
            <div class="form-group" style="margin-top: 10px;">
                <label>Upload Foto Kostum:</label>
                <div style="border: 2px dashed var(--border); padding: 20px; border-radius: var(--radius-md); text-align: center; background: #f8fafc;">
                    <input type="file" name="gambar" accept="image/png, image/jpeg, image/jpg, image/webp" style="width: 100%; border: none; padding: 0; background: transparent; box-shadow: none;">
                </div>
            </div>
            
            <button type="submit" class="btn btn-primary" style="width: 100%; padding: 12px; margin-top: 10px; font-size: 1.1rem; background: linear-gradient(135deg, #10b981, #059669);">Simpan Kostum Baru</button>
        </form>
    </div>
</div>

</body>
</html>