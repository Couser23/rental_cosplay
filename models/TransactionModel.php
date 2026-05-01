<?php
require_once 'config/database.php';

class TransactionModel {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->connect();
    }

    // Menyimpan data pesanan baru
    public function createTransaction($id_user, $id_costume, $tgl_mulai, $durasi_hari, $total_harga) {
        $query = "INSERT INTO transactions (id_user, id_costume, tgl_mulai, durasi_hari, total_harga) 
                  VALUES (:id_user, :id_costume, :tgl_mulai, :durasi_hari, :total_harga)";
        
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id_user', $id_user);
        $stmt->bindParam(':id_costume', $id_costume);
        $stmt->bindParam(':tgl_mulai', $tgl_mulai);
        $stmt->bindParam(':durasi_hari', $durasi_hari);
        $stmt->bindParam(':total_harga', $total_harga);
        
        return $stmt->execute();
    }

    // Tambahkan fungsi ini di bawah fungsi createTransaction yang sudah ada
    public function getTransactionsByUser($id_user) {
        // Menggunakan JOIN untuk mengambil nama kostum dari tabel costumes
        $query = "SELECT t.*, c.nama_karakter 
                  FROM transactions t 
                  JOIN costumes c ON t.id_costume = c.id_costume 
                  WHERE t.id_user = :id_user 
                  ORDER BY t.created_at DESC";
                  
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id_user', $id_user);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // 1. Mengambil semua transaksi untuk Admin
    public function getAllTransactions() {
        $query = "SELECT t.*, u.nama_lengkap, c.nama_karakter 
                  FROM transactions t 
                  JOIN users u ON t.id_user = u.id_user 
                  JOIN costumes c ON t.id_costume = c.id_costume 
                  ORDER BY t.created_at DESC";
                  
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // 2. Mengubah status pembayaran dan status sewa
    public function updateStatus($id_transaksi, $status_pembayaran, $status_sewa) {
        $query = "UPDATE transactions 
                  SET status_pembayaran = :pembayaran, status_sewa = :sewa 
                  WHERE id_transaksi = :id";
                  
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':pembayaran', $status_pembayaran);
        $stmt->bindParam(':sewa', $status_sewa);
        $stmt->bindParam(':id', $id_transaksi);
        
        return $stmt->execute();
    }
}
?>