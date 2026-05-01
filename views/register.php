<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - RentCos</title>
    <link rel="stylesheet" href="assets/css/user-style.css">
    <style>
        .auth-logo { font-size: 2.5rem; text-decoration: none; margin-bottom: 10px; display: inline-block; }
    </style>
</head>
<body>
    <div class="auth-wrapper">
        <div class="auth-card">
            <a href="index.php" class="nav-brand auth-logo">✨ RentCos</a>
            <h2 style="margin-bottom: 10px;">Pendaftaran Akun Baru</h2>
            <p style="color: var(--text-muted); margin-bottom: 30px;">Lengkapi data diri Anda untuk bergabung.</p>
            
            <form action="index.php?page=process_register" method="POST">
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" placeholder="John Doe" required>
                </div>
                
                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" name="email" placeholder="contoh@email.com" required>
                </div>
                
                <div class="form-group">
                    <label>Nomor WhatsApp</label>
                    <input type="text" name="no_whatsapp" placeholder="081234567890" required>
                </div>
                
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="••••••••" required>
                </div>
                
                <button type="submit" class="btn btn-primary" style="width: 100%; padding: 12px; margin-top: 10px; font-size: 1.1rem;">Daftar Sekarang</button>
            </form>
            
            <p style="margin-top: 25px; color: var(--text-muted);">
                Sudah punya akun? <a href="index.php?page=login" style="color: var(--primary); font-weight: 600; text-decoration: none;">Login di sini</a>
            </p>
        </div>
    </div>
</body>
</html>