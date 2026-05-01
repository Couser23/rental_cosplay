<?php
require_once 'config/database.php';

class CostumeModel {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->connect();
    }

    // Mengambil semua kostum yang berstatus Tersedia
    public function getAvailableCostumes() {
        $query = "SELECT * FROM costumes WHERE status_ketersediaan = 'Tersedia'";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Mengambil detail kostum berdasarkan ID
    public function getCostumeById($id) {
        $query = "SELECT * FROM costumes WHERE id_costume = :id LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Fungsi baru khusus untuk Admin (Mengambil semua data tanpa filter status)
    public function getAllCostumes() {
        $query = "SELECT * FROM costumes ORDER BY id_costume DESC";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Tambahkan di bawah fungsi getAllCostumes() yang tadi
    public function addCostume($nama, $series, $size, $harga_sewa, $harga_deposit, $status, $gambar) {
        $query = "INSERT INTO costumes (nama_karakter, series, size, harga_sewa, harga_deposit, status_ketersediaan, gambar) 
                  VALUES (:nama, :series, :size, :harga_sewa, :harga_deposit, :status, :gambar)";
        
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':nama', $nama);
        $stmt->bindParam(':series', $series);
        $stmt->bindParam(':size', $size);
        $stmt->bindParam(':harga_sewa', $harga_sewa);
        $stmt->bindParam(':harga_deposit', $harga_deposit);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':gambar', $gambar);
        
        return $stmt->execute();
    }

    // Tambahkan fungsi ini di dalam class CostumeModel
    public function deleteCostume($id) {
        // 1. Ambil data kostum untuk mengetahui nama file gambarnya
        $costume = $this->getCostumeById($id);
        
        // 2. Hapus file gambar fisik dari folder uploads jika ada
        if ($costume && !empty($costume['gambar'])) {
            $file_path = 'uploads/' . $costume['gambar'];
            if (file_exists($file_path)) {
                unlink($file_path); // Fungsi PHP untuk menghapus file
            }
        }

        // 3. Hapus data dari database
        $query = "DELETE FROM costumes WHERE id_costume = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        
        return $stmt->execute();
    }

    // Tambahkan di dalam class CostumeModel
    public function updateCostume($id, $nama, $series, $size, $harga_sewa, $harga_deposit, $status, $gambar_baru) {
        if ($gambar_baru != "") {
            // Jika ada gambar baru yang diupload
            $query = "UPDATE costumes 
                      SET nama_karakter = :nama, series = :series, size = :size, 
                          harga_sewa = :harga_sewa, harga_deposit = :harga_deposit, 
                          status_ketersediaan = :status, gambar = :gambar 
                      WHERE id_costume = :id";
        } else {
            // Jika gambar tidak diubah
            $query = "UPDATE costumes 
                      SET nama_karakter = :nama, series = :series, size = :size, 
                          harga_sewa = :harga_sewa, harga_deposit = :harga_deposit, 
                          status_ketersediaan = :status 
                      WHERE id_costume = :id";
        }
        
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':nama', $nama);
        $stmt->bindParam(':series', $series);
        $stmt->bindParam(':size', $size);
        $stmt->bindParam(':harga_sewa', $harga_sewa);
        $stmt->bindParam(':harga_deposit', $harga_deposit);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':id', $id);
        
        if ($gambar_baru != "") {
            $stmt->bindParam(':gambar', $gambar_baru);
        }
        
        return $stmt->execute();
    }
}
?>