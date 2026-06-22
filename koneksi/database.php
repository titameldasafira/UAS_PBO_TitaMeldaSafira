<?php
// File: koneksi/database.php

class Database {
    private $host     = "localhost";
    private $username = "root";
    private $password = ""; // Kosongkan jika menggunakan XAMPP default
    private $db_name  = "db_uas_pbo_ti1c_titameldasafira";
    protected $conn;

    // Method untuk mendapatkan koneksi database
    public function connect() {
        if ($this->conn === null) {
            try {
                // Menggunakan PDO untuk koneksi database
                $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->db_name . ";charset=utf8mb4";
                $this->conn = new PDO($dsn, $this->username, $this->password);
                
                // Mengatur error mode ke Exception untuk kemudahan debugging
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                // Mengatur fetch mode default menjadi Array Asosiatif
                $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
                
            } catch (PDOException $e) {
                // Menghentikan skrip jika koneksi gagal
                die("Koneksi database gagal: " . $e->getMessage());
            }
        }
        return $this->conn;
    }
}
?>