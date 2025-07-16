<?php
require '../config.php'; // sesuaikan path jika perlu

// Ganti password admin jadi 'admin123'
$passwordBaru = password_hash('admin123', PASSWORD_DEFAULT);

// Jalankan update ke akun admin (pastikan email benar)
mysqli_query($koneksi, "UPDATE tbl_user SET password = '$passwordBaru' WHERE email = 'admin@gmail.com'");

echo "✅ Password admin berhasil direset ke: admin123";
?>


