<?php
// Menjalankan session di baris paling awal
session_start(); 

require_once 'models/UserModel.php';
// Segarkan status verifikasi user dari database agar update persetujuan admin langsung terbaca
if (isset($_SESSION['id_user'])) {
    $sessionUserModel = new UserModel();
    $currentUser = $sessionUserModel->getUserById($_SESSION['id_user']);
    if ($currentUser) {
        $_SESSION['status_verifikasi'] = $currentUser['status_verifikasi'];
    }
}

// Memanggil semua Controller yang dibutuhkan
require_once 'controllers/RentController.php';
require_once 'controllers/AuthController.php';
require_once 'controllers/AdminController.php';

// Inisialisasi Object Controller
$rentController = new RentController();
$authController = new AuthController();
$adminController = new AdminController();

// Menangkap parameter 'page' dari URL, default ke 'katalog'
$page = isset($_GET['page']) ? $_GET['page'] : 'katalog';

switch ($page) {
    // ==========================================
    // MODULE RENTAL (USER)
    // ==========================================
    case 'katalog':
        $rentController->showKatalog();
        break;
        
    case 'detail':
        if (isset($_GET['id'])) {
            $rentController->showDetail($_GET['id']);
        } else {
            echo "ID Kostum tidak valid.";
        }
        break;

    case 'checkout':
        $rentController->processCheckout();
        break;

    case 'riwayat':
        $rentController->showRiwayat();
        break;

    case 'upload_ktp':
        $rentController->showUploadKTP();
        break;

    case 'process_upload_ktp':
        $rentController->processUploadKTP();
        break;

    // ==========================================
    // MODULE AUTHENTICATION (LOGIN & REGISTER)
    // ==========================================
    case 'login':
        // Jika sudah login, cegah masuk ke halaman login lagi
        if (isset($_SESSION['id_user'])) {
            // Arahkan sesuai role
            if ($_SESSION['role'] === 'admin') {
                header("Location: index.php?page=admin_dashboard");
            } else {
                header("Location: index.php?page=katalog");
            }
            exit();
        }
        $authController->showLogin();
        break;
        
    case 'process_login':
        $authController->processLogin();
        break;

    case 'register':
        $authController->showRegister();
        break;

    case 'process_register':
        $authController->processRegister();
        break;

    case 'logout':
        $authController->logout();
        break;

    // ==========================================
    // MODULE ADMIN
    // ==========================================
    case 'admin_dashboard':
        $adminController->showDashboard();
        break;

    case 'admin_kostum':
        $adminController->manageCostumes();
        break;

    case 'admin_tambah_kostum':
        $adminController->showAddCostume();
        break;

    case 'process_tambah_kostum':
        $adminController->processAddCostume();
        break;

    case 'admin_hapus_kostum':
        if (isset($_GET['id'])) {
            $adminController->deleteCostume($_GET['id']);
        }
        break;

    case 'admin_transaksi':
        $adminController->manageTransactions();
        break;

    case 'process_update_transaksi':
        $adminController->updateTransactionStatus();
        break;

    case 'admin_edit_kostum':
        if (isset($_GET['id'])) {
            $adminController->showEditCostume($_GET['id']);
        }
        break;

    case 'process_edit_kostum':
        $adminController->processEditCostume();
        break;

    case 'admin_users':
        $adminController->manageUsers();
        break;
        
    case 'verify_user':
        $adminController->processVerifyUser();
        break;

    // ==========================================
    // DEFAULT (HANDLE 404 NOT FOUND)
    // ==========================================
    default:
        echo "<h1>404 - Halaman tidak ditemukan</h1>";
        echo "<p>Maaf, halaman yang Anda cari tidak tersedia.</p>";
        echo "<a href='index.php'>Kembali ke Halaman Utama</a>";
        break;
}
?>