<?php

session_start();

if(!isset($_SESSION['ssLogin'])) {
  header("location: ../otentikasi");
  exit();
}

require "../config.php";

$title = "Pengaturan - Ujian Online";

require "../template/header.php";
require "../template/navbar.php";
require "../template/sidebar.php";

if($_SESSION['ssRole'] != 1) {
  echo "<script>
      alert('Halaman tidak di temukan');
      window.location = '../ujian';
      </script>";
  exit();
}

$query = mysqli_query($koneksi, "SELECT * FROM tbl_pengaturan");
$row   = mysqli_fetch_assoc($query);

if (!$row) {
    // Buat baris default kalau belum ada (prevent error)
    mysqli_query($koneksi, "INSERT INTO tbl_pengaturan (id, nama_ujian, waktu, nilai_minimal, peraturan) VALUES (1, '', 0, 0, '')");
    $query = mysqli_query($koneksi, "SELECT * FROM tbl_pengaturan");
    $row   = mysqli_fetch_assoc($query);
}


?>
   
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
            <form action="proses-pengaturan.php" method="post">
          <div class="row">
            <div class="col-md-12 grid-margin mb-3">
              <div class="d-flex justify-content-between align-items-center">
                <div>
                  <h3 class="font-weight-bold mb-0">Pengaturan</h3>
                </div>
                <div>
                    <button type="submit" name="save" class="btn btn-warning btn-icon-text btn-rounded">
                      <i class="ti-save-alt btn-icon-prepend"></i> Simpan
                    </button>
                </div>
              </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <p class="card-title">Pengaturan Ujian</p>
                    <div class="col-md-9">
                        <div class="form-group row mb-2">
                            <label for="nama" class="col-from-label-sm col-sm-3">Nama Ujian</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control form-control-sm" id="nama" placeholder="nama ujian" name="nama" value="<?= $row['nama_ujian'] ?>" required>
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label for="waktu" class="col-from-label-sm col-sm-3">waktu Ujian</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control form-control-sm" id="waktu" placeholder="waktu pengerjaan" name="waktu" value="<?= $row['waktu'] ?>" pattern="[0-9]+" title="hanya angka" required>
                            </div>
                        </div>
                         <div class="form-group row mb-2">
                            <label for="minimum" class="col-from-label-sm col-sm-3">Nilai Minimum</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control form-control-sm" id="minimum" placeholder="minimal nilai kelulusan" name="minimum" pattern="[0-9]+" title="hanya angka" value="<?= $row['nilai_minimal'] ?>" required>
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label for="peraturan" class="col-from-label-sm col-sm-3">Peraturan</label>
                            <div class="col-sm-9">
                                <textarea name="peraturan" id="editor"><?= $row['peraturan'] ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          </div>
          </form>
        </div>
        <!-- content-wrapper ends -->
      </div>
      <!-- main-panel ends -->
    
<?php

require "../template/footer.php";

?>
