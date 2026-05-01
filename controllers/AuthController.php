<?php
require_once 'models/UserModel.php';

class AuthController {
    private $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }

    // ==========================================
    // BAGIAN VIEWS (MENAMPILKAN HALAMAN)
    // ==========================================

    public function showLogin() {
        require_once 'views/login.php';
    }

    public function showRegister() {
        require_once 'views/register.php';
    }

    // ==========================================
    // BAGIAN LOGIKA (MEMPROSES DATA)
    // ==========================================

    public function processLogin() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Sanitasi input dasar untuk mencegah karakter aneh
            $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
            $password = trim($_POST['password']);

            // Ambil data user dari database berdasarkan email
            $user = $this->userModel->getUserByEmail($email);

            // Verifikasi keberadaan user dan kecocokan password (hash)
            if ($user && password_verify($password, $user['password'])) {
                
                // Set session jika berhasil login (session_start() sudah ada di index.php)
                $_SESSION['id_user']           = $user['id_user'];
                $_SESSION['nama']              = $user['nama_lengkap'];
                $_SESSION['role']              = $user['role'];
                $_SESSION['status_verifikasi'] = $user['status_verifikasi'];

                // Arahkan berdasarkan role
                if ($user['role'] === 'admin') {
                    header("Location: index.php?page=admin_dashboard");
                } else {
                    header("Location: index.php?page=katalog");
                }
                exit();
                
            } else {
                // Gagal login: kembalikan ke halaman login dengan alert
                echo "<script>
                        alert('Gagal Login! Email atau Password salah.'); 
                        window.location.href='index.php?page=login';
                      </script>";
                exit();
            }
        }
    }

    public function processRegister() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Ambil dan bersihkan input dari tag HTML berbahaya (XSS Protection)
            $nama     = htmlspecialchars(trim($_POST['nama_lengkap']));
            $email    = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
            $password = trim($_POST['password']); // Password akan di-hash di Model
            $no_wa    = htmlspecialchars(trim($_POST['no_whatsapp']));

            // Validasi format email yang benar
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo "<script>
                        alert('Format email tidak valid!'); 
                        window.location.href='index.php?page=register';
                      </script>";
                exit();
            }

            // Cek apakah email sudah terdaftar di database
            if ($this->userModel->getUserByEmail($email)) {
                echo "<script>
                        alert('Email sudah terdaftar! Silakan gunakan email lain atau coba login.'); 
                        window.location.href='index.php?page=register';
                      </script>";
                exit();
            }

            // Proses simpan ke database (Pemanggilan UserModel)
            if ($this->userModel->registerUser($nama, $email, $password, $no_wa)) {
                echo "<script>
                        alert('Registrasi berhasil! Silakan login untuk mulai menyewa kostum.'); 
                        window.location.href='index.php?page=login';
                      </script>";
                exit();
            } else {
                echo "<script>
                        alert('Terjadi kesalahan pada server saat registrasi. Coba lagi nanti.'); 
                        window.location.href='index.php?page=register';
                      </script>";
                exit();
            }
        }
    }

    public function logout() {
        // Hapus semua data session yang tersimpan
        session_unset();
        session_destroy();
        
        // Arahkan kembali ke halaman login
        header("Location: index.php?page=login");
        exit();
    }
}
?>