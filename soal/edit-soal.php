<?php
session_start();

if (!isset($_SESSION['ssLogin'])) {
    header("location: ../otentikasi");
    exit();
}

require "../config.php";

$title = "Soal - Ujian Online";

require "../template/header.php";
require "../template/navbar.php";
require "../template/sidebar.php";

// Hanya admin (role 1) yang bisa akses halaman ini
if ($_SESSION['ssRole'] != 1) {
    echo "<script>
        alert('Halaman tidak ditemukan');
        window.location = '../ujian';
    </script>";
    exit();
}

$id = $_GET['id'];

$querySoal = mysqli_query($koneksi, "SELECT * FROM tbl_soal WHERE id = $id");
$soal  = mysqli_fetch_assoc($querySoal);


?>

<!-- Main Panel -->
<div class="main-panel">
    <div class="content-wrapper">
        <form action="proses-soal.php" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-12 grid-margin mb-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="font-weight-bold mb-0">Edit Soal</h3>
                        <a href="index.php" class="btn btn-warning btn-icon-text btn-rounded">
                            <i class="ti-back-left btn-icon-prepend"></i> Kembali
                        </a>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <!-- Tambahkan input di sini -->
                            <p class="card-title">Rincian Soal</p>
                            <div class="col-md--9">
                                <input type="hidden" name="id" value="<?= $soal['id']?>">
                                <div class="form-group row mb-3">
                                    <label for="pertanyaan" class="col-sm-3 col-from-label-sm">Pertanyaan</label>
                                    <div class="col-sm-9">
                                        <textarea name="soal" id="editor"><?= $soal['pertanyaan']?></textarea>
                                    </div>
                                </div>
                                 <div class="form-group row mb-0">
                                    <label for="" class="col-sm-3 col-from-label-sm"></label>
                                    <div class="col-sm-9">
                                        <img src="../images/soal/<?= $soal['gambar']?>" width="200px" alt="" class="my-2" <?= $soal['gambar'] == '' ?'hidden' : null ?>>
                                    </div>
                                </div>
                                 <div class="form-group row mb-3">
                                    <label for="gambar" class="col-sm-3 col-from-label-sm">Gambar</label>
                                    <div class="col-sm-9">
                                      <input type="hidden" name="gambarlama" value="<?= $soal['gambar']?>">
                                    <input type="file" class="form-control form-control-sm" name="gambar">
                                    <span class="text-small">Type file gambar JPG | JPEG | PNG | GIF</span>
                                    </div>
                                </div>
                                 <div class="form-group row mb-2">
                                    <label for="a" class="col-sm-3 col-from-label-sm">Jawaban A</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control form-control-sm" placeholder="pilihan jawaban A" name="a" value="<?= $soal['a']?>" require>     
                                    </div>
                                </div>
                                
                                 <div class="form-group row mb-2">
                                    <label for="B" class="col-sm-3 col-from-label-sm">Jawaban B</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control form-control-sm" placeholder="pilihan jawaban B" name="b" value="<?= $soal['b']?>" require>     
                                    </div>
                                </div>
                                 <div class="form-group row mb-2">
                                    <label for="c" class="col-sm-3 col-from-label-sm">Jawaban C</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control form-control-sm" placeholder="pilihan jawaban C" name="c" value="<?= $soal['c']?>" require>     
                                    </div>
                                </div>
                                 <div class="form-group row mb-2">
                                    <label for="d" class="col-sm-3 col-from-label-sm">Jawaban D</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control form-control-sm" placeholder="pilihan jawaban D" name="d" value="<?= $soal['d']?>" require>     
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label for="kunci jawaban" class="col-sm-3 col-from-label-sm">Kunci Jawaban </label>
                                    <div class="col-sm-2">
                                        <div class="form-check">
                                        <label for="" class="form-check-label">
                                            <input type="radio" class="from-check-input" name="kunci" value="A" <?= $soal['kunci_jawaban'] == 'A' ?'checked' : null ?> required>A
                                        </label>   
                                        </div>  
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-check">
                                        <label for="" class="form-check-label">
                                            <input type="radio" class="from-check-input" name="kunci" value="B" <?= $soal['kunci_jawaban'] == 'B' ?'checked' : null ?> required>B
                                        </label>   
                                        </div>  
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-check">
                                        <label for="" class="form-check-label">
                                            <input type="radio" class="from-check-input" name="kunci" value="C" <?= $soal['kunci_jawaban'] == 'C' ?'checked' : null ?> required>C
                                        </label>   
                                        </div>  
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-check">
                                        <label for="" class="form-check-label">
                                            <input type="radio" class="from-check-input" name="kunci" value="D" <?= $soal['kunci_jawaban'] == 'D' ?'checked' : null ?> required>D
                                        </label>   
                                        </div>  
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label for="" class="col-sm-3 col-from-label-sm"></label>
                                    <div class="col-sm-9">
                                        <button type="submit" class="btn btn-warning text-white btn-icon-text btn-rounded" name="update"><i class="ti-pencil-alt btn-icon-prepend"></i>Update</button>     
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<?php
require "../template/footer.php";
?>

