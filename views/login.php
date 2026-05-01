<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - RentCos</title>
    <link rel="stylesheet" href="assets/css/user-style.css">
    <style>
        .auth-logo { font-size: 2.5rem; text-decoration: none; margin-bottom: 20px; display: inline-block; }
    </style>
</head>
<body>
    <div class="auth-wrapper">
        <div class="auth-card">
            <a href="index.php" class="nav-brand auth-logo">✨ RentCos</a>
            <h2>Selamat Datang Kembali</h2>
            <p style="color: var(--text-muted); margin-bottom: 30px;">Silakan login untuk mulai menyewa kostum impian Anda.</p>
            
            <form action="index.php?page=process_login" method="POST">
                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" name="email" placeholder="contoh@email.com" required>
                </div>
                
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="••••••••" required>
                </div>
                
                <button type="submit" class="btn btn-primary" style="width: 100%; padding: 12px; margin-top: 10px; font-size: 1.1rem;">Masuk</button>
            </form>
            
            <p style="margin-top: 25px; color: var(--text-muted);">
                Belum punya akun? <a href="index.php?page=register" style="color: var(--primary); font-weight: 600; text-decoration: none;">Daftar di sini</a>
            </p>
        </div>
    </div>
</body>
</html>