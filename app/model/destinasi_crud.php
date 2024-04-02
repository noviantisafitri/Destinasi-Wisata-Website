<?php
session_start();
require '/xampp/htdocs/destinasi/app/config/database.php';

// Create
if (isset($_POST['save_destinasi'])) {
    $title = $_POST['title'];
    $location = $_POST['location'];
    $description = $_POST['description'];

    // File upload
    $target_dir = "/xampp/htdocs/destinasi/uploads/";
    $target_file = $target_dir . basename($_FILES["upload_path"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Cek apakah file gambar
    $check = getimagesize($_FILES["upload_path"]["tmp_name"]);
    if ($check === false) {
        echo "File tersebut bukan gambar";
        $uploadOk = 0;
    }

    if (file_exists($target_file)) {
        echo "Gambar sudah ada";
        $uploadOk = 0;
    }

    // Ukuran gambar
    if ($_FILES["upload_path"]["size"] > 5000000) {
        echo "Ukuran gambar terlalu besar";
        $uploadOk = 0;
    }

    // Format gambar
    $allowedFormats = array("jpg", "jpeg", "png", "gif");
    if (!in_array($imageFileType, $allowedFormats)) {
        echo "Hanya untuk format JPG, JPEG, PNG & GIF yang diizinkan";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        echo "File tidak terupload";
    } else {
        if (move_uploaded_file($_FILES["upload_path"]["tmp_name"], $target_file)) {
            echo "File " . htmlspecialchars(basename($_FILES["upload_path"]["name"])) . " berhasil diupload";

            // path database
            $upload_path = basename($_FILES["upload_path"]["name"]);

            $query = "INSERT INTO destinasi (title, location, description, upload_path) VALUES ('$title', '$location', '$description', '$upload_path')";
            $stmt = mysqli_prepare($koneksi, $query);
            $result = mysqli_stmt_execute($stmt);

            if ($result) {
                $_SESSION['message'] = "Destinasi Created Successfully";
                header("Location: /destinasi/app/view/admin/destinasi.php");
                exit();
            } else {
                $_SESSION['message'] = "Destinasi Not Created";
                header("Location: /destinasi/app/view/admin/destinasi.php");
                exit();
            }
        } else {
            echo "Error dalam mengupload gambar";
        }
    }
}

// Update
if (isset($_POST['update_destinasi'])) {
    $destinasi_id = mysqli_real_escape_string($koneksi, $_POST['destinasi_id']);
    $title = mysqli_real_escape_string($koneksi, $_POST['title']);
    $location = mysqli_real_escape_string($koneksi, $_POST['location']);
    $description = mysqli_real_escape_string($koneksi, $_POST['description']);
    $date_updated = date('Y-m-d H:i:s');
    $upload_path = ''; // Inisialisasi variabel upload_path

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
            echo "File tersebut bukan gambar";
            $uploadOk = 0;
        }

        if (file_exists($target_file)) {
            echo "Gambar sudah ada";
            $uploadOk = 0;
        }

        // Ukuran gambar
        if ($_FILES["upload_path"]["size"] > 5000000) {
            echo "Ukuran gambar terlalu besar";
            $uploadOk = 0;
        }

        // Format gambar
        $allowedFormats = array("jpg", "jpeg", "png", "gif");
        if (!in_array($imageFileType, $allowedFormats)) {
            echo "Hanya untuk format JPG, JPEG, PNG & GIF yang diizinkan";
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            echo "File tidak terupload";
        } else {
            if (move_uploaded_file($_FILES["upload_path"]["tmp_name"], $target_file)) {
                echo "File " . htmlspecialchars(basename($_FILES["upload_path"]["name"])) . " berhasil diupload";
                $upload_path = basename($_FILES["upload_path"]["name"]);
            } else {
                echo "Error dalam mengupload gambar: " . $_FILES["upload_path"]["error"];
            }            
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
        $_SESSION['message'] = "destinasi Updated Successfully";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit(0);
    } else {
        $_SESSION['message'] = "destinasi Not Updated";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit(0);
    }
}


// Delete
if (isset($_POST['delete_destinasi'])) {
    $destinasi_id = mysqli_real_escape_string($koneksi, $_POST['delete_destinasi']);

    $query = "DELETE FROM destinasi WHERE id='$destinasi_id' ";
    $query_run = mysqli_query($koneksi, $query);

    if ($query_run) {
        $_SESSION['message'] = "destinasi Deleted Successfully";
        header("Location: " . $_SERVER['HTTP_REFERER'] . "#destinasi");
        exit(0);
    } else {
        $_SESSION['message'] = "destinasi Not Deleted";
        header("Location: " . $_SERVER['HTTP_REFERER'] . "#destinasi");
        exit(0);
    }
}