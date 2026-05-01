<?php
require_once 'config/database.php';

class UserModel {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->connect();
    }

    // Mengambil data user berdasarkan email untuk proses Login
    public function getUserByEmail($email) {
        $query = "SELECT * FROM users WHERE email = :email LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Mengambil data user berdasarkan ID
    public function getUserById($id) {
        $query = "SELECT * FROM users WHERE id_user = :id LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Memasukkan data user baru untuk proses Register
    public function registerUser($nama, $email, $password, $no_wa) {
        // Enkripsi password menggunakan BCRYPT
        $hash_password = password_hash($password, PASSWORD_BCRYPT);
        
        $query = "INSERT INTO users (nama_lengkap, email, password, no_whatsapp) 
                  VALUES (:nama, :email, :password, :no_wa)";
        
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':nama', $nama);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hash_password);
        $stmt->bindParam(':no_wa', $no_wa);
        
        return $stmt->execute();
    }

    // User mengunggah foto KTP
    public function uploadKTP($id_user, $nama_file) {
        $query = "UPDATE users SET foto_ktp = :foto, status_verifikasi = 'Menunggu' WHERE id_user = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':foto', $nama_file);
        $stmt->bindParam(':id', $id_user);
        return $stmt->execute();
    }

    // Admin mengambil daftar user yang butuh verifikasi
    public function getPendingUsers() {
        $query = "SELECT * FROM users WHERE status_verifikasi = 'Menunggu'";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Admin menyetujui/menolak verifikasi
    public function updateVerificationStatus($id_user, $status) {
        $query = "UPDATE users SET status_verifikasi = :status WHERE id_user = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':id', $id_user);
        return $stmt->execute();
    }

    public function getAllUsers() {
    // Mengambil semua user agar tabel tidak kosong
    $query = "SELECT * FROM users WHERE role = 'user' ORDER BY id_user DESC";
    $stmt = $this->db->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
}
?>