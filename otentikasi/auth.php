<?php


session_start();

require '../config.php';

// registrasi
if (isset($_POST['register'])) {
   $fullname   = htmlspecialchars($_POST['fullname']);
   $username   = htmlspecialchars($_POST['username']);
   $email      = htmlspecialchars($_POST['email']);
   $nis        = htmlspecialchars($_POST['nis']);
   $password   = htmlspecialchars($_POST['password']);
   $password2  = htmlspecialchars($_POST['password2']);

   // cek apakah nis atau email sudah terdaftar
   $ceksiswa = mysqli_query($koneksi, "SELECT * FROM tbl_user WHERE user_id = '$nis' OR email = '$email'");
   if (mysqli_num_rows($ceksiswa)) {
      echo "<script>
         alert('NIS atau email sudah terdaftar, user baru gagal di registrasi!');
         window.location = 'register.php';
      </script>";
      return;
   }

   // cek password sama tidak
   if ($password !== $password2) {
      echo "<script>
         alert('Konfirmasi password tidak sama, user baru gagal di registrasi!');
         window.location = 'register.php';
      </script>";
      return;
   }

   // enkripsi password
   $pass = password_hash($password, PASSWORD_DEFAULT);

   // simpan data
   mysqli_query($koneksi, "INSERT INTO tbl_user VALUES(null, '$nis', '$fullname', '$username', '$email', '$pass', 2)");

   echo "<script>
      alert('User baru berhasil di registrasi, silakan login!');
      window.location = 'index.php';
   </script>";
   return;
}

// login
if(isset($_POST['login'])){
   $email = htmlspecialchars($_POST['email']);
   $password = htmlspecialchars($_POST['password']);

   $queryUser = mysqli_query($koneksi, "SELECT * FROM tbl_user WHERE email = '$email'");

   if(mysqli_num_rows($queryUser)) {
      $user = mysqli_fetch_assoc($queryUser);
       if (password_verify($password, $user['password'])) {
         // set session
         $_SESSION['ssLogin'] = true;
          $_SESSION['ssFull'] = $user['fullname'];
          $_SESSION['ssUser'] = $user['username'];
          $_SESSION['ssId'] = $user['user_id'];
          $_SESSION['ssRole'] = $user['role'];

          if($_SESSION['ssRole'] == 1) {
            header('location: ../index.php');
          } else {
            header('location: ../ujian');
          }
         exit();
       }else{
         echo "<script>
      alert('email atau password salah, login gagal... ');
      window.location = 'index.php';
      </script>";
      exit();
       }
   }else{
      echo "<script>
      alert('email atau password salah, login gagal... ');
      window.location = 'index.php';
      </script>";
      exit();
   }
}

?>
