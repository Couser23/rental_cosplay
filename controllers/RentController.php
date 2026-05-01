<?php
require_once 'models/CostumeModel.php';
require_once 'models/TransactionModel.php'; // Tambahkan ini

class RentController {
    private $costumeModel;
    private $transactionModel; // Tambahkan ini

    public function __construct() {
        $this->costumeModel = new CostumeModel();
        $this->transactionModel = new TransactionModel(); // Tambahkan ini
    }

    public function showKatalog() {
        $costumes = $this->costumeModel->getAvailableCostumes();
        require_once 'views/katalog.php';
    }

    public function showDetail($id) {
        $costume = $this->costumeModel->getCostumeById($id);
        if ($costume) {
            require_once 'views/detail.php';
        } else {
            echo "Kostum tidak ditemukan.";
        }
    }

    // --- TAMBAHKAN METHOD INI KE BAWAH ---
    public function processCheckout() {
        // Cek apakah user sudah login
        if (!isset($_SESSION['id_user'])) {
            echo "<script>
                    alert('Anda harus login terlebih dahulu untuk menyewa!'); 
                    window.location.href='index.php?page=login';
                  </script>";
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_user = $_SESSION['id_user'];
            $id_costume = $_POST['id_costume'];
            $tgl_mulai = $_POST['tanggal_mulai'];
            $durasi_hari = (int)$_POST['durasi'];

            // Validasi: pastikan tanggal sewa tidak di masa lalu
            if (strtotime($tgl_mulai) < strtotime(date('Y-m-d'))) {
                echo "<script>alert('Tanggal sewa tidak valid (tidak boleh di masa lalu)!'); window.history.back();</script>";
                exit();
            }

            // Ambil data kostum untuk menghitung total harga (Harga Sewa * Durasi + Deposit)
            $costume = $this->costumeModel->getCostumeById($id_costume);
            $harga_sewa_total = $costume['harga_sewa'] * $durasi_hari;
            $total_tagihan = $harga_sewa_total + $costume['harga_deposit'];

            // Simpan ke database
            $is_saved = $this->transactionModel->createTransaction(
                $id_user, 
                $id_costume, 
                $tgl_mulai, 
                $durasi_hari, 
                $total_tagihan
            );

            if ($is_saved) {
                echo "<script>
                        alert('Pesanan berhasil dibuat! Total tagihan Anda: Rp " . number_format($total_tagihan, 0, ',', '.') . "'); 
                        window.location.href='index.php?page=katalog';
                      </script>";
            } else {
                echo "<script>
                        alert('Gagal memproses pesanan.'); 
                        window.location.href='index.php?page=detail&id=$id_costume';
                      </script>";
            }
        }
    }
    
    // Tambahkan fungsi ini di bagian bawah dalam class RentController
    public function showRiwayat() {
        // Pastikan user sudah login
        if (!isset($_SESSION['id_user'])) {
            echo "<script>
                    alert('Silakan login terlebih dahulu!'); 
                    window.location.href='index.php?page=login';
                  </script>";
            exit();
        }

        $id_user = $_SESSION['id_user'];
        $riwayat = $this->transactionModel->getTransactionsByUser($id_user);
        
        require_once 'views/riwayat.php';
    }

    // Menampilkan halaman form upload KTP
    public function showUploadKTP() {
        if (!isset($_SESSION['id_user'])) {
            echo "<script>alert('Silakan login terlebih dahulu!'); window.location.href='index.php?page=login';</script>";
            exit();
        }
        require_once 'views/upload_ktp.php';
    }

    // Memproses upload foto KTP
    public function processUploadKTP() {
        if (!isset($_SESSION['id_user'])) {
            header("Location: index.php?page=login");
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_user = $_SESSION['id_user'];
            
            if (isset($_FILES['foto_ktp']) && $_FILES['foto_ktp']['error'] === UPLOAD_ERR_OK) {
                // Validasi ekstensi file
                $allowed_ext = ['jpg', 'jpeg', 'png', 'webp'];
                $file_ext = strtolower(pathinfo($_FILES['foto_ktp']['name'], PATHINFO_EXTENSION));
                
                if (!in_array($file_ext, $allowed_ext)) {
                    echo "<script>alert('Format gambar tidak valid! Hanya JPG, PNG, WEBP.'); window.history.back();</script>";
                    exit();
                }

                // Cek apakah folder uploads/ktp ada, jika tidak, buat
                $target_dir = 'uploads/ktp/';
                if (!file_exists($target_dir)) {
                    mkdir($target_dir, 0777, true);
                }

                $nama_file = time() . '_' . basename($_FILES['foto_ktp']['name']);
                
                if (move_uploaded_file($_FILES['foto_ktp']['tmp_name'], $target_dir . $nama_file)) {
                    require_once 'models/UserModel.php';
                    $userModel = new UserModel();
                    
                    if ($userModel->uploadKTP($id_user, $nama_file)) {
                        // Update session agar tombol di detail.php berubah statusnya
                        $_SESSION['status_verifikasi'] = 'Menunggu';
                        echo "<script>alert('KTP berhasil diunggah! Harap tunggu verifikasi Admin.'); window.location.href='index.php?page=katalog';</script>";
                    } else {
                        echo "<script>alert('Gagal menyimpan data ke database.'); window.history.back();</script>";
                    }
                } else {
                    echo "<script>alert('Gagal mengunggah file.'); window.history.back();</script>";
                }
            } else {
                echo "<script>alert('Harap pilih file KTP terlebih dahulu.'); window.history.back();</script>";
            }
        }
    }
}
?>