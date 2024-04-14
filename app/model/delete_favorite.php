<?php
session_start();
require '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['destination_id'])) {
    $user_id = $_SESSION['user_id'];
    $destination_id = $_POST['destination_id'];

    $query = "DELETE FROM favorites WHERE user_id = ? AND destination_id = ?";
    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, "ii", $user_id, $destination_id);

    if (mysqli_stmt_execute($stmt)) {
        echo "Destinasi berhasil dihapus dari daftar favorit.";
        exit();
    }
     else {
        echo "Gagal menghapus destinasi dari daftar favorit.";
        
    }
} else {
    echo "Tidak ada data yang diterima atau data destination_id tidak tersedia.";
}
?>
