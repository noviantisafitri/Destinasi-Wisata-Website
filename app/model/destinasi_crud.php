<?php
session_start();
require '/xampp/htdocs/destinasi/app/config/database.php';

// Create
if (isset($_POST['save_destinasi'])) {
    $title = $_POST['title'];
    $location = $_POST['location'];
    $description = $_POST['description'];

    // File upload
    if (!empty($_FILES["upload_path"]["name"])) { // Pengecekan apakah file dipilih
        $target_dir = "/xampp/htdocs/destinasi/uploads/";
        $target_file = $target_dir . basename($_FILES["upload_path"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Cek apakah file gambar
        $check = getimagesize($_FILES["upload_path"]["tmp_name"]);
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
        if ($_FILES["upload_path"]["size"] > 5000000) {
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
            if (move_uploaded_file($_FILES["upload_path"]["tmp_name"], $target_file)) {
                $_SESSION['message'] = "File " . htmlspecialchars(basename($_FILES["upload_path"]["name"])) . " berhasil diupload";

                $upload_path = basename($_FILES["upload_path"]["name"]);

                $query = "INSERT INTO destinasi (title, location, description, upload_path) VALUES ('$title', '$location', '$description', '$upload_path')";
                $stmt = mysqli_prepare($koneksi, $query);
                $result = mysqli_stmt_execute($stmt);

                if ($result) {
                    $_SESSION['message'] = "Destinasi berhasil ditambahkan";
                    header("Location: " . $_SERVER['HTTP_REFERER']);
                    exit(0);
                } else {
                    $_SESSION['message'] = "Destinasi gagal ditambahkan";
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





// Update
if (isset($_POST['update_destinasi'])) {
    $destinasi_id = mysqli_real_escape_string($koneksi, $_POST['destinasi_id']);
    $title = mysqli_real_escape_string($koneksi, $_POST['title']);
    $location = mysqli_real_escape_string($koneksi, $_POST['location']);
    $description = mysqli_real_escape_string($koneksi, $_POST['description']);
    $date_updated = date('Y-m-d H:i:s');
    $upload_path = ''; 

    // Jika pengguna mengunggah gambar baru
    if ($_FILES["upload_path"]["name"]) {
        // File upload
        $target_dir = "/xampp/htdocs/destinasi/uploads/";
        $target_file = $target_dir . basename($_FILES["upload_path"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Cek apakah file gambar
        $check = getimagesize($_FILES["upload_path"]["tmp_name"]);
        if ($check === false) {
            $_SESSION['message'] = "File tersebut bukan gambar";
            header("Location: " . $_SERVER['HTTP_REFERER']);
            $uploadOk = 0;
            exit(0);
        }

        if (file_exists($target_file)) {
            $_SESSION['message'] = "Gambar sudah ada";
            header("Location: " . $_SERVER['HTTP_REFERER']);
            $uploadOk = 0;
            exit(0);
        }

        // Ukuran gambar
        if ($_FILES["upload_path"]["size"] > 5000000) {
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
        }

        if (move_uploaded_file($_FILES["upload_path"]["tmp_name"], $target_file)) {
            $_SESSION['message'] = "File " . htmlspecialchars(basename($_FILES["upload_path"]["name"])) . " berhasil diupload";
            $upload_path = basename($_FILES["upload_path"]["name"]);
        } else {
            $_SESSION['message'] = "Error dalam mengupload gambar: " . $_FILES["upload_path"]["error"];
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit(0);
        }
    } else {
        // Jika tidak ada file yang diunggah, tetapkan nilai upload_path dari data sebelumnya
        $query_get_upload_path = "SELECT upload_path FROM destinasi WHERE id='$destinasi_id'";
        $query_run_get_upload_path = mysqli_query($koneksi, $query_get_upload_path);
        $row_upload_path = mysqli_fetch_assoc($query_run_get_upload_path);
        $upload_path = $row_upload_path['upload_path'];
    }

    $query = "UPDATE destinasi SET title='$title', location='$location', description='$description', upload_path='$upload_path', date_created='$date_updated' WHERE id='$destinasi_id' ";
    $query_run = mysqli_query($koneksi, $query);

    if ($query_run) {
        $_SESSION['message'] = "Destinasi berhasil diubah";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit(0);
    } else {
        $_SESSION['message'] = "Destinasi gagal diubah";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit(0);
    }
}


// Delete
if (isset($_POST['delete_destinasi'])) {
    $destinasi_id = mysqli_real_escape_string($koneksi, $_POST['delete_destinasi']);

    // Cek apakah ada entri yang terkait di tabel favorites
    $query_check_favorites = "SELECT COUNT(*) as total FROM favorites WHERE destination_id = '$destinasi_id'";
    $result_check_favorites = mysqli_query($koneksi, $query_check_favorites);
    $row_check_favorites = mysqli_fetch_assoc($result_check_favorites);
    $total_favorites = $row_check_favorites['total'];

    if ($total_favorites > 0) {
        $_SESSION['message'] = "Destinasi tidak dapat dihapus karena terdapat data terkait di tabel favorites.";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit(0);
    }

    // Hapus destinasi jika tidak ada entri yang terkait di tabel favorites
    $query = "DELETE FROM destinasi WHERE id='$destinasi_id'";
    $query_run = mysqli_query($koneksi, $query);

    if ($query_run) {
        $_SESSION['message'] = "Destinasi berhasil dihapus";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit(0);
    } else {
        $_SESSION['message'] = "Terjadi kesalahan dalam menghapus destinasi.";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit(0);
    }
}

?>
