<?php
include 'koneksi.php';
if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] == 0) {
        header("location: indexAdmin.php");
    } else if ($_SESSION['role'] == 2) {
        header("location: indexPakar.php");
    }
}

if (!isset($_SESSION['persentase'])) {
    $_SESSION['persentase'] = [];
}

$gejala = mysqli_query($conn, "SELECT * FROM gejala");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
    rel="stylesheet"
    href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
    crossorigin="anonymous"/>
    <link
    href="https://fonts.googleapis.com/css?family=Poppins:300,400,700&display=swap"
    rel="stylesheet"/>
    <link rel="stylesheet" href="custom.css" />
    <title>Laptop Damage</title>
</head>
<body>
    <nav class="navbar py-2 navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="./img/10.png" width="200" alt="logo">
            </a>
            <buttonclass="navbar-toggler"type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li>
                        <a class="btn px-4 btn-primary ml-2" href="logout.php" role="button">Log Out</a>
                    </li> 
                </ul>
            </div>
        </div>
    </nav>

    <section class="test mt-5">
        <div class="container">
       
            <div class="row">
                <div class="col align-self-center">
                    <h2 class="mb-4">Pertanyaan : </h2>
                    <form action="" method="post" enctype="multipart/form-data" role="form">
                    <?php
                    $id_kerusakan = 1;
                    $id = gejala($id_kerusakan);
                    $id_gejala = intval($id);
                    $persentase = $_SESSION['persentase'];
                    $temp = 0;
                    if (!isset($_SESSION['id_gejala'])) {
                        // $persentase = $_SESSION['persentase'];
                        $_SESSION['id_gejala'] = $id_gejala;
                        // array_push($persentase, $id_gejala);
                        // $_SESSION['persentase'] = $persentase;
                    } else {
                        $id_gejala = $_SESSION['id_gejala'];
                    }
                    if (isset($_POST['ya'])) {
                        if (isset($id_gejala)) {
                            $sementara = $id_gejala;
                            $temp = $sementara;
                            array_push($persentase, $temp);

                        }
                        $id_gejala = $_SESSION['id_gejala'] + 1;
                        $_SESSION['id_gejala'] = $id_gejala;
                        $_SESSION['persentase'] = array_unique($persentase);
                    }
                    if (isset($_POST['tidak'])) {
                        $id_gejala = $_SESSION['id_gejala'] + 1;
                        $_SESSION['id_gejala'] = $id_gejala;
                    }
                    $data = mysqli_query($conn, "SELECT `id_gejala`, `gejala` FROM gejala WHERE id_gejala = '$id_gejala'");
                    $row = mysqli_fetch_array($data);
                    ?>
                    <p class="mb-4">
                        Apakah laptop Anda mengalami <?= $row['gejala']; ?> ?
                    </p>
                    <?php
                    echo '<input type="submit" class="btn btn-primary mr-2 px-4 py-2" name="ya" value="Ya">';
                    echo '<input type="submit" class="btn btn-danger px-3 py-2" name="tidak" value="Tidak">';
                    // $persentase = $_SESSION['persentase'];
                    if ($_SESSION['id_gejala'] > 36) {

                        $keyboard = array(1, 2, 3, 4, 5, 6);
                        $layar = array(7, 8, 9, 10, 11, 12);
                        $baterai = array(13, 14, 15, 16, 17);
                        $speaker = array(18, 19);
                        $harddisk = array(20, 21, 22);
                        $ram = array(23, 24, 25, 26, 27);
                        $motherboard = array(28, 29, 30, 31, 32, 33);
                        $virus = array(34, 35, 36);

                        $nilai = 0;
                        foreach ($persentase as $value) {
                            if (in_array($value, $keyboard)) {
                                $nilai += 1;
                            } else {
                                $nilai += 0;
                            }
                        }
                        $keyboard = $nilai / count($keyboard);
                        $keyboardParah = number_format($keyboard, 3);
                        $hasilKeyboard = $keyboardParah * 100;
                        // echo $hasilKeyboard;
                        // echo '<br>';
                        $_SESSION['keyboard'] = $hasilKeyboard;

                        $nilai = 0;
                        foreach ($persentase as $value) {
                            if (in_array($value, $layar)) {
                                $nilai += 1;
                            } else {
                                $nilai += 0;
                            }
                        }
                        $layar = $nilai / count($layar);
                        $layarParah = number_format($layar, 3);
                        $hasilLayar = $layarParah * 100;
                        // echo $hasilLayar;
                        // echo '<br>';
                        $_SESSION['layar'] = $hasilLayar;

                        $nilai = 0;
                        foreach ($persentase as $value) {
                            if (in_array($value, $baterai)) {
                                $nilai += 1;
                            } else {
                                $nilai += 0;
                            }
                        }
                        $baterai = $nilai / count($baterai);
                        $bateraiParah = number_format($baterai, 3);
                        $hasilBaterai = $bateraiParah * 100;
                        // echo $hasilBaterai;
                        // echo '<br>';
                        $_SESSION['baterai'] = $hasilBaterai;

                        $nilai = 0;
                        foreach ($persentase as $value) {
                            if (in_array($value, $speaker)) {
                                $nilai += 1;
                            } else {
                                $nilai += 0;
                            }
                        }
                        $speaker = $nilai / count($speaker);
                        $speakerParah = number_format($speaker, 3);
                        $hasilSpeaker = $speakerParah * 100;
                        // echo $hasilSpeaker;
                        // echo '<br>';
                        $_SESSION['speaker'] = $hasilSpeaker;

                        $nilai = 0;
                        foreach ($persentase as $value) {
                            if (in_array($value, $harddisk)) {
                                $nilai += 1;
                            } else {
                                $nilai += 0;
                            }
                        }
                        $harddisk = $nilai / count($harddisk);
                        $harddiskParah = number_format($harddisk, 3);
                        $hasilHarddisk = $harddiskParah * 100;
                        // echo $hasilHarddisk;
                        // echo '<br>';
                        $_SESSION['harddisk'] = $hasilHarddisk;

                        $nilai = 0;
                        foreach ($persentase as $value) {
                            if (in_array($value, $ram)) {
                                $nilai += 1;
                            } else {
                                $nilai += 0;
                            }
                        }
                        $ram = $nilai / count($ram);
                        $ramError = number_format($ram, 3);
                        $hasilRam = $ramError * 100;
                        // echo $hasilRam;
                        // echo '<br>';
                        $_SESSION['ram'] = $hasilRam;

                        $nilai = 0;
                        foreach ($persentase as $value) {
                            if (in_array($value, $motherboard)) {
                                $nilai += 1;
                            } else {
                                $nilai += 0;
                            }
                        }
                        $motherboard = $nilai / count($motherboard);
                        $motherboardError = number_format($motherboard, 3);
                        $hasilMotherboard = $motherboardError * 100;
                        // echo $hasilMotherboard;
                        // echo '<br>';
                        $_SESSION['motherboard'] = $hasilMotherboard;

                        $nilai = 0;
                        foreach ($persentase as $value) {
                            if (in_array($value, $virus)) {
                                $nilai += 1;
                            } else {
                                $nilai += 0;
                            }
                        }
                        $virus = $nilai / count($virus);
                        $virusParah = number_format($virus, 3);
                        $hasilVirus = $virusParah * 100;
                        // echo $hasilVirus;
                        // echo '<br>';
                        $_SESSION['virus'] = $hasilVirus;
                        header('Location:hasil.php');
                    }


                    ?>
                    <br>
                    
               
                    </form>
                </div>
                <div class="col d-none d-sm-block">
                    <img width="500" src="./img/3.png" alt="hero" />
                </div>
            </div>
        </div>
    </section>
</body>

<script
    src="https://code.jquery.com/jquery-3.4.1.js"
    integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
    crossorigin="anonymous"
></script>
<script
    src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
    crossorigin="anonymous"
></script>
<script
    src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
    crossorigin="anonymous"
></script>
<script
    src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
    crossorigin="anonymous"
></script>
</html>