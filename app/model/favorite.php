<?php
session_start();
require '/xampp/htdocs/destinasi/app/config/database.php';

if (isset($_POST['destination_id']) && isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $destination_id = $_POST['destination_id'];

    $check_user_query = "SELECT id FROM users WHERE id = '$user_id'";
    $check_user_result = mysqli_query($koneksi, $check_user_query);
    if (mysqli_num_rows($check_user_result) > 0) {
        $query_check = "SELECT * FROM favorites WHERE user_id='$user_id' AND destination_id='$destination_id'";
        $result_check = mysqli_query($koneksi, $query_check);
        if (mysqli_num_rows($result_check) > 0) {
            echo "Destinasi sudah difavoritkan sebelumnya.";
        } else {
            $query_title = "SELECT title FROM destinasi WHERE id='$destination_id'";
            $result_title = mysqli_query($koneksi, $query_title);
            $row_title = mysqli_fetch_assoc($result_title);
            $destination_title = $row_title['title'];

            setcookie("favorite_destination_title", $destination_title, time() + (86400 * 30), "/"); // Cookie berlaku selama 30 hari

            $query_insert = "INSERT INTO favorites (user_id, destination_id, created_at) VALUES ('$user_id', '$destination_id', NOW())";
            $result_insert = mysqli_query($koneksi, $query_insert);
            if ($result_insert) {
                echo "Data favorit berhasil disimpan.";
            } else {
                echo "Gagal menyimpan data favorit: " . mysqli_error($koneksi);
            }
        }
    } else {
        echo "User dengan ID $user_id tidak ditemukan.";
    }
} else {
    echo "Tidak cukup data yang diberikan untuk menyimpan favorit.";
}
