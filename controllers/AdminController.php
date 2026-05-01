<?php
require_once 'models/CostumeModel.php';
require_once 'models/TransactionModel.php';
require_once 'models/UserModel.php';

class AdminController {
    // Properti untuk menyimpan objek model
    private $costumeModel;
    private $transactionModel;
    private $userModel;

    // Konstruktor: Inisialisasi semua model saat controller dipanggil
    public function __construct() {
        $this->costumeModel = new CostumeModel();
        $this->transactionModel = new TransactionModel();
        $this->userModel = new UserModel();
    }

    /**
     * Middleware Sederhana
     * Memastikan hanya user dengan role 'admin' yang bisa mengakses
     */
    private function checkAdmin() {
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            echo "<script>
                    alert('Akses Ditolak. Halaman khusus Administrator!'); 
                    window.location.href='index.php?page=login';
                  </script>";
            exit();
        }
    }

    // Menampilkan Dashboard Utama Admin
    public function showDashboard() {
        $this->checkAdmin();
        require_once 'views/admin_dashboard.php';
    }

    // ==========================================
    // MODUL KELOLA KOSTUM
    // ==========================================

    public function manageCostumes() {
        $this->checkAdmin();
        $costumes = $this->costumeModel->getAllCostumes();
        require_once 'views/admin_kostum.php';
    }

    public function showAddCostume() {
        $this->checkAdmin();
        require_once 'views/admin_kostum_tambah.php';
    }

    public function processAddCostume() {
        $this->checkAdmin();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nama = $_POST['nama_karakter'];
            $series = $_POST['series'];
            $size = $_POST['size'];
            $harga_sewa = $_POST['harga_sewa'];
            $harga_deposit = $_POST['harga_deposit'];
            $status = $_POST['status_ketersediaan'];
            
            $nama_file_gambar = ""; 
            if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === UPLOAD_ERR_OK) {
                $allowed_ext = ['jpg', 'jpeg', 'png', 'webp'];
                $file_ext = strtolower(pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION));
                if (in_array($file_ext, $allowed_ext)) {
                    $nama_file_gambar = time() . '_' . basename($_FILES['gambar']['name']); 
                    move_uploaded_file($_FILES['gambar']['tmp_name'], 'uploads/' . $nama_file_gambar);
                } else {
                    echo "<script>alert('Format gambar tidak valid! (Hanya JPG, PNG, WEBP)'); window.history.back();</script>";
                    exit();
                }
            }

            if ($this->costumeModel->addCostume($nama, $series, $size, $harga_sewa, $harga_deposit, $status, $nama_file_gambar)) {
                echo "<script>alert('Kostum berhasil ditambahkan!'); window.location.href='index.php?page=admin_kostum';</script>";
            }
        }
    }

    public function showEditCostume($id) {
        $this->checkAdmin();
        $costume = $this->costumeModel->getCostumeById($id);
        if ($costume) require_once 'views/admin_kostum_edit.php';
    }

    public function processEditCostume() {
        $this->checkAdmin();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id_costume'];
            $nama_file_gambar = ""; 
            if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === UPLOAD_ERR_OK) {
                $allowed_ext = ['jpg', 'jpeg', 'png', 'webp'];
                $file_ext = strtolower(pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION));
                if (in_array($file_ext, $allowed_ext)) {
                    $nama_file_gambar = time() . '_' . basename($_FILES['gambar']['name']); 
                    move_uploaded_file($_FILES['gambar']['tmp_name'], 'uploads/' . $nama_file_gambar);
                    if (!empty($_POST['gambar_lama'])) @unlink('uploads/' . $_POST['gambar_lama']);
                } else {
                    echo "<script>alert('Format gambar tidak valid! (Hanya JPG, PNG, WEBP)'); window.history.back();</script>";
                    exit();
                }
            }

            if ($this->costumeModel->updateCostume($id, $_POST['nama_karakter'], $_POST['series'], $_POST['size'], $_POST['harga_sewa'], $_POST['harga_deposit'], $_POST['status_ketersediaan'], $nama_file_gambar)) {
                echo "<script>alert('Data kostum diperbarui!'); window.location.href='index.php?page=admin_kostum';</script>";
            }
        }
    }

    public function deleteCostume($id) {
        $this->checkAdmin();
        if ($this->costumeModel->deleteCostume($id)) {
            echo "<script>alert('Kostum dihapus!'); window.location.href='index.php?page=admin_kostum';</script>";
        }
    }

    // ==========================================
    // MODUL KELOLA TRANSAKSI
    // ==========================================

    public function manageTransactions() {
        $this->checkAdmin();
        $transactions = $this->transactionModel->getAllTransactions();
        require_once 'views/admin_transaksi.php';
    }

    public function updateTransactionStatus() {
        $this->checkAdmin();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($this->transactionModel->updateStatus($_POST['id_transaksi'], $_POST['status_pembayaran'], $_POST['status_sewa'])) {
                echo "<script>alert('Status transaksi diperbarui!'); window.location.href='index.php?page=admin_transaksi';</script>";
            }
        }
    }

    // ==========================================
    // MODUL KELOLA PELANGGAN
    // ==========================================

    public function manageUsers() {
        $this->checkAdmin();
        // Mengambil SEMUA pelanggan (role='user') agar tabel tidak kosong
        $users = $this->userModel->getAllUsers(); 
        require_once 'views/admin_users.php';
    }

    public function processVerifyUser() {
        $this->checkAdmin();
        if (isset($_GET['id']) && isset($_GET['status'])) {
            if ($this->userModel->updateVerificationStatus($_GET['id'], $_GET['status'])) {
                echo "<script>alert('Status verifikasi pelanggan diperbarui!'); window.location.href='index.php?page=admin_users';</script>";
            }
        }
    }
}
?>