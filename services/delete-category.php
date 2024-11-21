<?php
require_once __DIR__ . '/../Model/init.php';

if(!isset($_SESSION["full_name"])){
    header("Location: login.php");
    exit;    
}
$id = $_GET["id"];
$categories = new Category();
$success = $categories->delete($_GET["id"]);

if ($success) {
    echo "<script> alert('Berhasil dihapus'); window.location.href = '../views/index-menu.php'</script>";
} else {
    echo "<script> alert('Gagal menghapus'); window.location.href = '../views/index-menu.php'</script>";
}
