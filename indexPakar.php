<?php


include "koneksi.php";
if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] == 1) {
        header("location: test.php");
    }
} else {
    header("location:index.php");
}

$queryPengguna = mysqli_query($conn, "SELECT * FROM pengguna WHERE role = '2'");

$jumlahPengguna = mysqli_query($conn, "SELECT COUNT('id_pengguna') as jml_pengguna FROM pengguna WHERE role='1'");
$pengguna = mysqli_fetch_assoc($jumlahPengguna);

$jumlahKerusakan = mysqli_query($conn, "SELECT COUNT('id_kerusakan') as jml_kerusakan FROM kerusakan");
$kerusakan = mysqli_fetch_assoc($jumlahKerusakan);

$jumlahGejala = mysqli_query($conn, "SELECT COUNT('id_gejala') as jml_gejala FROM gejala");
$gejala = mysqli_fetch_assoc($jumlahGejala);

$jumlahDiagnosa = mysqli_query($conn, "SELECT COUNT('id_diagnosa') as jml_diagnosa FROM diagnosa");
$diagnosa = mysqli_fetch_assoc($jumlahDiagnosa);


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
            <img src="gambar/10.png" alt="logo" height="70px" />
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
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

<!-- Content Row -->
<div class="row">


<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Data Pengguna</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $pengguna['jml_pengguna']; ?></div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Data Kerusakan</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $kerusakan['jml_kerusakan']; ?></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Data Gejala</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $gejala['jml_gejala']; ?></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Data Hasil Diagnosa</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $diagnosa['jml_diagnosa']; ?></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- DataTales Example -->
<div class="card shadow  ml-3 mb-12">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Tabel Data Pakar</h6>
    </div>
    <div class="card-body">
        <form method="post" encytpe="multipart/form-data">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                    <?php if($_SESSION['role'] == 0) {
                        echo'<th>Aksi</th>';
                    }?>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Username</th>
                    </tr>
                </thead>
            <tbody>
                <?php while ($data = mysqli_fetch_assoc($queryPengguna)) { ?>
                <tr>
                    <td>
                    <a class="badge badge-pill badge-primary" href="editPakar.php?id_pengguna=<?php echo $data["id_pengguna"]; ?>">edit</a> |
                    <a href="koneksi.php?act=hapusPakar&id_pengguna=<?= $data["id_pengguna"]; ?>" onclick="return confirm('Yakin ingin menghapus data?');" class="badge badge-pill badge-danger">hapus</a>
                    </td>
                    <td><?= $data['nama']; ?></td>
                    <td><?= $data['email']; ?></td>
                    <td><?= $data['usernama']; ?></td>
                </tr>
                <?php } ?>
            </tbody>
            <?php if($_SESSION['role'] == 0) {
            echo'<a href="register_pakar.php" class="btn btn-primary my-2 px-2">Tambah Data Pakar</a>';
            }?>
            </table>
        </form>
    </div>
</div>
</body>
</html>