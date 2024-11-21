<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD','');
define('DB_NAME', 'pos_db');

class Connection{
    public $db;
    public function __construct()
    {
        $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        if(!$conn){
            die("Gagal terhubung ke database" . mysqli_connect_error());
        } else {
            $this->db = $conn;
            return $this->db;
        }
    }
}