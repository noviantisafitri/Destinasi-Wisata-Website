<?php
require '../../config/database.php';

function get_user_profile($user_id) {
    global $koneksi;
    $query = "SELECT * FROM users WHERE id = '$user_id'";
    $result = mysqli_query($koneksi, $query);
    return mysqli_fetch_assoc($result);
}

function get_destinasi_count() {
    global $koneksi;
    $destinasi_count = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM destinasi");
    $destinasi_row = mysqli_fetch_assoc($destinasi_count);
    return $destinasi_row['total'];
}

function get_users_count() {
    global $koneksi;
    $users_count = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM users WHERE role='Pengguna'");
    $users_row = mysqli_fetch_assoc($users_count);
    return $users_row['total'];
}

function get_favorites_count() {
    global $koneksi;
    $favorites_count = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM favorites");
    $favorites_row = mysqli_fetch_assoc($favorites_count);
    return $favorites_row['total'];
}

function get_admin_count() {
    global $koneksi;
    $users_count = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM users WHERE role='Admin'");
    $users_row = mysqli_fetch_assoc($users_count);
    return $users_row['total'];
}