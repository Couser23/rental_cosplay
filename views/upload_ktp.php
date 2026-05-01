<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload KTP - Verifikasi</title>
    <link rel="stylesheet" href="assets/css/user-style.css">
    <style>
        .auth-logo { font-size: 2.5rem; text-decoration: none; margin-bottom: 20px; display: inline-block; }
    </style>
</head>
<body>

<div class="auth-wrapper">
    <div class="auth-card" style="max-width: 500px;">
        <a href="index.php" class="nav-brand auth-logo">✨ RentCos</a>
        <h2 style="margin-bottom: 15px;">Verifikasi Identitas</h2>
        <p style="color: var(--text-muted); margin-bottom: 30px;">
            Untuk dapat menyewa kostum, Anda diwajibkan mengunggah foto KTP sebagai jaminan keamanan penyewaan.
        </p>
        
        <form action="index.php?page=process_upload_ktp" method="POST" enctype="multipart/form-data">
            <div class="form-group" style="text-align: left;">
                <label>Pilih File KTP (JPG, PNG, WEBP):</label>
                <div style="border: 2px dashed var(--border); padding: 30px 20px; border-radius: var(--radius-md); text-align: center; background: #f8fafc; transition: all 0.3s ease;">
                    <input type="file" name="foto_ktp" accept="image/png, image/jpeg, image/jpg, image/webp" required style="width: 100%; border: none; padding: 0; background: transparent; box-shadow: none;">
                </div>
            </div>
            
            <button type="submit" class="btn btn-primary" style="width: 100%; padding: 12px; margin-top: 15px; font-size: 1.1rem;">Unggah Sekarang</button>
        </form>
        
        <p style="margin-top: 25px;">
            <a href="index.php?page=katalog" style="color: var(--text-muted); font-weight: 600; text-decoration: none;">← Kembali ke Katalog</a>
        </p>
    </div>
</div>

</body>
</html>
