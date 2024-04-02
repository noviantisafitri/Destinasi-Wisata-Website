<?php
require '/xampp/htdocs/destinasi/app/config/database.php';

function get_user_profile($user_id) {
    global $koneksi;
    $query = "SELECT * FROM users WHERE id = '$user_id'";
    $result = mysqli_query($koneksi, $query);
    return mysqli_fetch_assoc($result);
}

function update_user_profile($user_id, $first_name, $last_name, $email, $password, $foto) {
    global $koneksi;

    // Update kolom 'foto' jika ada foto baru
    if ($foto && $foto["name"]) {
        $target_dir = "/xampp/htdocs/destinasi/uploads/";
        $target_file = $target_dir . basename($foto["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $check = getimagesize($foto["tmp_name"]);
        if ($check === false) {
            echo "File tersebut bukan gambar";
            $uploadOk = 0;
        }

        if (file_exists($target_file)) {
            echo "Gambar sudah ada";
            $uploadOk = 0;
        }

        if ($foto["size"] > 5000000) {
            echo "Ukuran gambar terlalu besar";
            $uploadOk = 0;
        }

        $allowedFormats = array("jpg", "jpeg", "png", "gif");
        if (!in_array($imageFileType, $allowedFormats)) {
            echo "Hanya untuk format JPG, JPEG, PNG & GIF yang diizinkan";
            $uploadOk = 0;
        }

        if ($uploadOk == 1) {
            if (move_uploaded_file($foto["tmp_name"], $target_file)) {
                $query_update_foto = "UPDATE users SET foto='" . basename($foto["name"]) . "' WHERE id='$user_id'";
                $result_update_foto = mysqli_query($koneksi, $query_update_foto);
                if (!$result_update_foto) {
                    echo "Gagal memperbarui foto profil dalam database";
                    exit();
                }
            } else {
                echo "Error dalam mengupload gambar: " . $foto["error"];
            }
        }
    }

    // Update kolom lain dalam database
    $query_update = "UPDATE users SET first_name='$first_name', last_name='$last_name', email='$email', password='$password' WHERE id='$user_id'";
    $result_update = mysqli_query($koneksi, $query_update);

    return $result_update;
}

function get_destinasi_count() {
    global $koneksi;
    $destinasi_count = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM destinasi");
    $destinasi_row = mysqli_fetch_assoc($destinasi_count);
    return $destinasi_row['total'];
}

function get_users_count() {
    global $koneksi;
    $users_count = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM users");
    $users_row = mysqli_fetch_assoc($users_count);
    return $users_row['total'];
}

function get_favorites_count() {
    global $koneksi;
    $favorites_count = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM favorites");
    $favorites_row = mysqli_fetch_assoc($favorites_count);
    return $favorites_row['total'];
}
