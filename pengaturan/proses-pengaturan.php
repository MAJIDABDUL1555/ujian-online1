<?php
session_start();

if (!isset($_SESSION['ssLogin'])) {
    header("location: ../otentikasi");
    exit();
}

require "../config.php";

if (isset($_POST['save'])) {
    $nama       = trim($_POST['nama']);
    $waktu      = (int) $_POST['waktu'];
    $min        = (int) $_POST['minimum'];
    $peraturan  = $_POST['peraturan']; // jangan pakai htmlspecialchars di sini, agar HTML CKEditor tetap utuh

    $query = "UPDATE tbl_pengaturan SET
                nama_ujian = '$nama',
                waktu = $waktu,
                nilai_minimal = $min,
                peraturan = '$peraturan'
              WHERE id = 1";

    $result = mysqli_query($koneksi, $query);

    if ($result) {
        echo "<script>
            alert('Data pengaturan berhasil diperbarui!');
            window.location = '../index.php'; // arahkan ke dashboard
        </script>";
        exit();
    } else {
        echo "<script>
            alert('Gagal memperbarui data: " . mysqli_error($koneksi) . "');
            window.history.back();
        </script>";
    }
}
?>
