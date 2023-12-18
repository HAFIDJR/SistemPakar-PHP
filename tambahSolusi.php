<?php


include "koneksi.php";
if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] == 1) {
        header("location: test.php");
    }
} else {
    header("location:index.php");
}


$queryKerusakan = mysqli_query($conn, "SELECT * FROM kerusakan");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="styles.css">
    <link
        rel="stylesheet"
        href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
        crossorigin="anonymous"/>
    <link
        href="https://fonts.googleapis.com/css?family=Poppins:300,400,700&display=swap"
        rel="stylesheet"/>
</head>

<body >
    <div class="kiri">
        <section class="logo">
            <img src="gambar/10.png" alt="logo" height="70px">
        </section>
        <div class="sidebar-heading">
            <h5 class="font-weight-bold text-white text-uppercase teks">Data Pengguna Laptop Damage</h5>
        </div>
        <section class="isi">
            <a class="nav-link" href="indexAdmin.php">
            <span>Data Pengguna</span></a>
        </section>
        <section class="isi">
            <a class="nav-link" href="indexPakar.php">
            <span>Data Pakar</span></a>
        </section>
        <div class="sidebar-heading">
            <h5 class="font-weight-bold text-white text-uppercase teks">Gejala & Kerusakan</h5> 
        </div>
        <section class="isi">
            <a class="nav-link" href="indexKerusakan.php">
            <span>Data Kerusakan</span>
            </a>
        </section>
        <section class="isi">
            <a class="nav-link" href="indexGejala.php">
            <span>Data Gejala</span>
            </a>
        </section>
        <div class="sidebar-heading">
            <h5 class="font-weight-bold text-white text-uppercase teks">Hasil Diagnosa</h5> 
        </div>
        <section class="isi">
            <a class="nav-link" href="indexDiagnosa.php">
            <span>Data Hasil Diagnosa</span>
            </a>
        </section>
        <section class="isi">
            <a class="nav-link" href="logout.php">
            <span>Logout</span>
            </a>
        </section>
    </div>

    <div class="kanan">
    <div class="container-fluid">

    <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between ml-4 py-5">
            <h1 class="h3 mb-0 text-gray-800 " id="tess">Form Tambah Diagnosa</h1>
        </div>


    <!-- Content Row -->
    <div class="row ml-4">

    <form action="koneksi.php?act=tambahHasilDiagnosa" id="tambah" method="POST" >
        <div class="form-group">
            <label for="namaDiagnosa">Diagnosa</label>
            <input type="text" class="form-control" id="namaDiagnosa" name="namaDiagnosa"  placeholder="Masukkan Diagnosa">
        </div>
        <div class="form-group">
            <label for="id_kerusakan" class="form-label">Nama Kerusakan</label>
            <select name="id_kerusakan" id="id_kerusakan" class="form-control">
                <option value="">Pilih Kerusakan dari Diagnosa</option>
                <?php while ($kerusakan = mysqli_fetch_assoc($queryKerusakan)) { ?>
                    <option value="<?= $kerusakan["id_kerusakan"]; ?>"><?= $kerusakan["kerusakan"]; ?></option>
                <?php } ?>
            </select>
        </div>
        <input type="submit" name="tambah_btn" id="tambah" class="btn btn-primary" value="Tambah">
    </form>
    </div>
</div>
</div>
</body>
</html>