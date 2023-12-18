<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ai_db";
$parentDirectory = getcwd();

// Create connection
$conn = new mysqli("localhost", "root", "12345678", "ai_db");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// $conn->close();

session_start();
if (isset($_GET["act"])) {
    $datalepi = $_GET["act"];
    if ($datalepi == "register") {
        register();
    } elseif ($datalepi == "login") {
        login();
    } elseif ($datalepi == "registerPakar") {
        registerPakar();
    } elseif ($datalepi == "tambahGejala") {
        tambahGejala();
    } elseif ($datalepi == "tambahKerusakan") {
        tambahKerusakan();
    } elseif ($datalepi == "tambahHasilDiagnosa") {
        tambahHasilDiagnosa();
    } elseif ($datalepi == "hapusGejala") {
        $id_gejala = $_GET["id_gejala"];
        hapusGejala($id_gejala);
    } elseif ($datalepi == "hapusKerusakan") {
        $id_kerusakan = $_GET["id_kerusakan"];
        hapusKerusakan($id_kerusakan);
    } elseif ($datalepi == "hapusPengguna") {
        $id_pengguna = $_GET["id_pengguna"];
        hapusPengguna($id_pengguna);
    } elseif ($datalepi == "hapusPakar") {
        $id_pakar = $_GET["id_pakar"];
        hapusPakar($id_pakar);
    } elseif ($datalepi == "hapusHasilDiagnosa") {
        $id_diagnosa = $_GET["id_diagnosa"];
        hapusHasilDiagnosa($id_diagnosa);
    } elseif ($datalepi == "editGejala") {
        $id_gejala = $_GET["id_kerusakan"];
        editGejala($id_gejala);
    } elseif ($datalepi == "editPengguna") {
        $id_pengguna = $_GET["id_pengguna"];
        editPengguna($id_pengguna);
    } elseif ($datalepi == "editPakar") {
        $id_pakar = $_GET["id_pakar"];
        editPakar($id_pakar);
    } elseif ($datalepi == "editkerusakan") {
        $id_kerusakan = $_GET["id_kerusakan"];
        editKerusakan($id_kerusakan);
    } elseif ($datalepi == "editHasilDiagnosa") {
        $id_diagnosa = $_GET["id_diagnosa"];
        editHasilDiagnosa($id_diagnosa);
    } elseif ($datalepi == "ulang") {
        ulang();
    }
}

function ulang()
{
    session_unset();
    session_destroy();
    header("Location: test.php");
}

function register()
{
    global $conn;
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $query_pengguna = "INSERT INTO `pengguna`(`nama`, `email`, `password`, `role`) VALUES ('$nama','$email','$password','1')";
    $data = mysqli_query($conn, $query_pengguna);
    header("Location: /tugasAI/index.php");
    exit;
    // if (!$data) {
    //     die('Query Error : ' . mysqli_errno($conn) . '-' . mysqli_error($conn));
    // } else {
    //     echo "<script>alert('Berhasil Registrasi! Silahkan Login)
    //     document.location.href = 'index.php'; </script>";
    // }
}

function registerPakar()
{
    global $koneksi;
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = password_hash(($_POST['password']), PASSWORD_DEFAULT);
    $query_pengguna = "INSERT INTO pakar VALUES ('', '1', '$nama', '$email', '$password')";
    $conn = mysqli_query($koneksi, $query_pengguna);

    if (!$conn) {
        die('Query Error : ' . mysqli_errno($koneksi) . '-' . mysqli_error($koneksi));
    } else {
        echo "<script>alert('Berhasil Registrasi! Silahkan Login); document.location.href = 'index.php'; </script>";
    }
}

function login()
{
    global $conn;
    $nama = $_POST["nama"];
    $input_pass = $_POST["password"];
    $query = mysqli_query($conn, "SELECT * FROM pengguna WHERE nama = '$nama' AND password = '$input_pass'");
    $data = mysqli_fetch_assoc($query);

    $role = $data['role'];
    if ($data) {
        if ($role == "1") {

            $_SESSION['role'] = 1;
            header("Location: /tugasAI/test.php");
        } elseif ($role == "0") {
            $_SESSION['role'] = 0;
            header("Location: /tugasAI/indexAdmin.php");
        } elseif ($role == "2") {
            $_SESSION['role'] = 2;
            header("Location: /tugasAI/indexAdmin.php");
        }


    } else {
        echo "<script>alert('Username atau password kosong/salah!');</script>";
    }
}

function tambahGejala()
{
    global $conn;
    $gejala = htmlspecialchars($_POST['namaGejala']);
    $id_kerusakan = htmlspecialchars($_POST['id_kerusakan']);
    $queryGejala = "INSERT INTO gejala (gejala) VALUES ('$gejala')";

    $exe = mysqli_query($conn, $queryGejala);
    if (!$exe) {
        die('Error pada database');
    }
    $id_gejala = mysqli_insert_id($conn);
    $queryRelasi = "INSERT INTO relasi (id_gejala,id_kerusakan) VALUES ('$id_gejala', '$id_kerusakan')";
    $ex = mysqli_query($conn, $queryRelasi);
    if (!$ex) {
        die('Error pada database');
    }
    echo "<script>alert('Gejala berhasil ditambahkan'); document.location.href = 'indexGejala.php'</script>";
}

function tambahKerusakan()
{
    global $conn;
    $kerusakan = htmlspecialchars($_POST['namaKerusakan']);
    $queryKerusakan = "INSERT INTO `kerusakan`(`kerusakan`) VALUES ('$kerusakan');";
    $exe = mysqli_query($conn, $queryKerusakan);
    if (!$exe) {
        die('Error pada database');
    }
    echo "<script>alert('Kerusakan berhasil ditambahkan'); document.location.href = 'indexKerusakan.php'</script>";
}

function tambahHasilDiagnosa()
{
    global $conn;
    $diagnosa = htmlspecialchars(
        $_POST['namaDiagnosa']
    );
    $id_kerusakan = htmlspecialchars($_POST['id_kerusakan']);
    $queryDiagnosa = "INSERT INTO diagnosa  (id_kerusakan, diagnosa) VALUES ('$id_kerusakan', '$diagnosa')";
    $exe = mysqli_query($conn, $queryDiagnosa);
    if (!$exe) {
        die('Error pada database');
    }
    echo "<script>alert('Diagnosa berhasil ditambahkan'); document.location.href = 'indexDiagnosa.php'</script>";
}

function editGejala($id_gejala)
{
    global $koneksi;
    $id_kerusakan = htmlspecialchars($_POST['id_kerusakan']);
    $gejala = htmlspecialchars($_POST['namaGejala']);
    $queryGejala = "UPDATE gejala SET gejala = '$gejala' WHERE id_gejala = '$id_gejala'";
    $exe = mysqli_query($koneksi, $queryGejala);
    if (!$exe) {
        die('Error pada database');
    }
    $queryRelasi = "UPDATE relasi SET id_gejala = '$id_gejala', id_kerusakan = '$id_kerusakan' WHERE id_gejala = '$id_gejala'";
    $ex = mysqli_query($koneksi, $queryRelasi);
    if (!$ex) {
        die('Error pada database');
    }
    echo "<script>alert('Data Gejala berhasil diubah'); document.location.href = 'indexGejala.php'</script>";
}

function editHasilDiagnosa($id_solusi)
{
    global $koneksi;
    $diagnosa = htmlspecialchars($_POST['namaHasilDiagnosa']);
    $id_kerusakan = htmlspecialchars($_POST['id_kerusakan']);
    $queryDiagnosa = "UPDATE diagnosa SET diagnosa = '$diagnosa', id_kerusakan = '$id_kerusakan' WHERE id_diagnosa = '$id_kerusakan'";
    $exe = mysqli_query($koneksi, $queryDiagnosa);
    if (!$exe) {
        die('Error pada database');
    }
    echo "<script>alert('Data Hasil Diagnosa berhasil diubah!'); document.location.href = 'indexDiagnosa.php'</script>";
}

function editKerusakan($id_kerusakan)
{
    global $koneksi;
    $kerusakan = htmlspecialchars($_POST['namaKerusakan']);
    $queryKerusakan = "UPDATE kerusakan SET kerusakan = '$kerusakan' WHERE id_kerusakan = '$id_kerusakan'";
    $exe = mysqli_query($koneksi, $queryKerusakan);
    if (!$exe) {
        die('Error pada database');
    }
    echo "<script>alert('Data Kerusakan berhasil diubah!'); document.location.href = 'indexKerusakan.php'</script>";
}

function editPengguna($id_user)
{
    global $koneksi;
    $nama = htmlspecialchars($_POST['nama']);
    $email = htmlspecialchars($_POST['email']);
    $queryPengguna = "UPDATE pengguna SET nama = '$nama', email = '$email' WHERE id_pengguna = '$id_user'";
    $exe = mysqli_query($koneksi, $queryPengguna);
    if (!$exe) {
        die('Error pada database');
    }
    echo "<script>alert('Data Pengguna berhasil diubah!'); document.location.href = 'indexAdmin.php'</script>";
}

function editPakar($id_user)
{
    global $koneksi;
    $nama = htmlspecialchars($_POST['nama']);
    $email = htmlspecialchars($_POST['email']);
    $queryPakar = "UPDATE pengguna SET nama = '$nama', email = '$email' WHERE id_pakar = '$id_user'";
    $exe = mysqli_query($koneksi, $queryPakar);
    if (!$exe) {
        die('Error pada database');
    }
    echo "<script>alert('Data Pakar berhasil diubah!'); document.location.href = 'indexPakar.php'</script>";
}

function hapusGejala($id_gejala)
{
    global $koneksi;
    mysqli_query($koneksi, "DELETE FROM gejala WHERE id_gejala = $id_gejala");
    $result = mysqli_affected_rows($koneksi);
    if ($result > 0) {
        echo "<script>alert('Gejala berhasil dihapus!'); document.location.href = 'indexGejala.php';</script>";
    } else {
        echo "<script>alert('Gejala gagal dihapus, karena masih terikat dengan penyakit!'); document.location.href = 'indexGejala.php';</script>";
    }
}

function hapusPengguna($id_pengguna)
{
    global $koneksi;
    mysqli_query($koneksi, "DELETE FROM pengguna WHERE id_pengguna = $id_pengguna");
    $result = mysqli_affected_rows($koneksi);
    if ($result > 0) {
        echo "<script>alert('Akun Pengguna berhasil dihapus!'); document.location.href = 'indexAdmin.php';</script>";
    } else {
        echo "
        <script>alert('Akun Pengguna gagal dihapus!'); document.location.href = 'indexAdmin.php';</script>";
    }
}

function hapusPakar($id_pengguna)
{
    global $koneksi;
    mysqli_query($koneksi, "DELETE FROM pengguna WHERE id_pengguna = $id_pengguna");
    $result = mysqli_affected_rows($koneksi);
    if ($result > 0) {
        echo "
        <script>alert('Akun Pakar berhasil dihapus!'); document.location.href = 'indexPakar.php';</script>";
    } else {
        echo "
        <script>alert('Akun Pakar gagal dihapus!'); document.location.href = 'indexPakar.php';</script>";
    }
}

function hapusKerusakan($id_kerusakan)
{
    global $koneksi;
    mysqli_query($koneksi, "DELETE FROM kerusakan WHERE id_kerusakan = $id_kerusakan");
    $result = mysqli_affected_rows($koneksi);
    if ($result > 0) {
        echo "
        <script>alert('Penyakit berhasil dihapus!'); document.location.href = 'indexKerusakan.php';</script>";
    } else {
        echo "
        <script>alert('Penyakit gagal dihapus, karena masih terikat dengan gejala!'); document.location.href = 'indexKerusakan.php';</script>";
    }
}

function hapusHasilDiagnosa($id_diagnosa)
{
    global $koneksi;
    mysqli_query($koneksi, "DELETE FROM diagnosa WHERE id_diagnosa = $id_diagnosa");
    $result = mysqli_affected_rows($koneksi);
    if ($result > 0) {
        echo "
        <script>alert('Solusi berhasil dihapus!'); document.location.href = 'indexDiagnosa.php';</script>";
    } else {
        echo "
        <script>alert('Solusi gagal dihapus!'); document.location.href = 'indexSolusi.php';</script>";
    }
}

function gejala($id_kerusakan)
{
    global $conn;
    $query = "SELECT relasi.id_gejala as id_gejala FROM relasi INNER JOIN gejala ON relasi.id_gejala = gejala.id_gejala INNER JOIN kerusakan ON relasi.id_kerusakan = kerusakan.id_kerusakan WHERE relasi.id_kerusakan = '$id_kerusakan'";
    $data = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($data);

    return $row['id_gejala'];
}
?>