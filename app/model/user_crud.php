<?php
session_start();
require '../config/database.php';

// Create
if (isset($_POST['save_user'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = "Admin";

    // File upload
    if (!empty($_FILES["foto"]["name"])) { // Pengecekan apakah file dipilih
        $target_dir = "../../uploads/";
        $target_file = $target_dir . basename($_FILES["foto"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Cek apakah file gambar
        $check = getimagesize($_FILES["foto"]["tmp_name"]);
        if ($check === false) {
            $_SESSION['message'] = "File tersebut bukan gambar";
            header("Location: " . $_SERVER['HTTP_REFERER']);
            $uploadOk = 0;
            exit(0);
        }

        if (file_exists($target_file)) {
            $_SESSION['message'] = "Nama file tersebut telah digunakan";
            header("Location: " . $_SERVER['HTTP_REFERER']);
            $uploadOk = 0;
            exit(0);
        }

        // Ukuran gambar
        if ($_FILES["foto"]["size"] > 5000000) {
            $_SESSION['message'] = "Ukuran gambar terlalu besar";
            header("Location: " . $_SERVER['HTTP_REFERER']);
            $uploadOk = 0;
            exit(0);
        }

        // Format gambar
        $allowedFormats = array("jpg", "jpeg", "png", "gif");
        if (!in_array($imageFileType, $allowedFormats)) {
            $_SESSION['message'] = "Hanya untuk format JPG, JPEG, PNG & GIF yang diizinkan";
            header("Location: " . $_SERVER['HTTP_REFERER']);
            $uploadOk = 0;
            exit(0);
        }

        if ($uploadOk == 0) {
            $_SESSION['message'] = "File tidak terupload";
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit(0);
        } else {
            if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
                $_SESSION['message'] = "File " . htmlspecialchars(basename($_FILES["foto"]["name"])) . " berhasil diupload";

                $foto = basename($_FILES["foto"]["name"]);

                $query = "INSERT INTO users (first_name, last_name, email, password, foto, role) VALUES ('$first_name', '$last_name', '$email', '$password', '$foto', '$role')";
                $stmt = mysqli_prepare($koneksi, $query);
                $result = mysqli_stmt_execute($stmt);

                if ($result) {
                    $_SESSION['message'] = "User berhasil ditambahkan";
                    header("Location: " . $_SERVER['HTTP_REFERER']);
                    exit(0);
                } else {
                    $_SESSION['message'] = "User gagal ditambahkan";
                    header("Location: " . $_SERVER['HTTP_REFERER']);
                    exit(0);
                }
            } else {
                $_SESSION['message'] = "Error dalam mengupload gambar";
                header("Location: " . $_SERVER['HTTP_REFERER']);
                exit(0);
            }
        }
    } else {
        $_SESSION['message'] = "File gambar tidak dipilih";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit(0);
    }
}


// Delete
if (isset($_POST['delete_user'])) {
    $user_id = mysqli_real_escape_string($koneksi, $_POST['delete_user']);

    $query = "DELETE FROM users WHERE id='$user_id'";
    $query_run = mysqli_query($koneksi, $query);

    if ($query_run) {
        $_SESSION['message'] = "User berhasil dihapus";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit(0);
    } else {
        $_SESSION['message'] = "Terjadi kesalahan dalam menghapus User.";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit(0);
    }
}

?>
