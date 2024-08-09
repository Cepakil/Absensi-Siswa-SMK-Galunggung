<?php 
require_once("../../../config/db.php");

// Menghubungkan ke database
$con = mysqli_connect("localhost", "root", "", "db_imas");

// Ambil nilai bulan yang dipilih oleh pengguna dari formulir
$bulan = $_POST['bulan'];

// Ambil nilai semester yang dipilih oleh pengguna dari formulir
// Ambil nilai semester yang dipilih oleh pengguna dari formulir
$semester = $_POST['semester'];

// Query untuk mendapatkan id semester berdasarkan nilai 'semester' dari formulir
$id_semester_query = mysqli_query($con, "SELECT id_semester FROM tb_semester WHERE semester = '$semester'");

// Periksa apakah query berhasil
if ($id_semester_query) {
    // Ambil id semester dari hasil query
    $id_semester_result = mysqli_fetch_assoc($id_semester_query);
    $id_semester = $id_semester_result['id_semester'];
} else {
    // Handle jika query gagal
    echo "Query untuk mendapatkan id semester gagal!";
    exit;
}

$info_thajaran = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM tb_thajaran WHERE status = 1"));

// Tampilkan data staff
$guru = mysqli_query($con, "SELECT * FROM tb_guru");

if (mysqli_num_rows($guru) == 0) {
    echo "Data guru tidak ditemukan.";
    exit;
}

// Hitung jumlah hari dalam bulan yang dipilih
$tglTerakhir = date('t', strtotime($bulan));


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Absensi Guru - <?= namaBulan(date('m', strtotime($bulan))) ?> <?= date('Y', strtotime($bulan)) ?></title>
    <!-- Tambahkan link CSS Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<style>
    body {
        font-family: arial;
    }
    .info-table {
        font-size: small;
    }
    .flex-container {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-top: 20px;
            margin-left:3px;
        }
        .right-align {
            text-align: right;
        }
        .left-align {
            text-align: left;
        }
        .signature-container {
            margin-right: 20px;
        }
        .table-keterangan {
            border-collapse: collapse;
        }
        .table-keterangan td {
            padding: 2px 10px;
            line-height: 1.2;
        }

</style>
<body>
    <table width="100%" style="margin-right:20px;">
        <!-- Bagian header -->
        <tr>
            <td>
                <img src="../../../assets/img/mts.png" width="160" style="margin-left: 18px;">
            </td>
            <td>
                <center>
                    <h1>
                        <small>
                            <b>REKAP ABSENSI GURU <br>
                            SMK GALUNGGUNG</b>
                        </small>
                    </h1>
                    <hr style="border-top: 2px solid black;">
                    <em>
                        Jl. KH. Lukmanul Hakim No.17, Tugujaya, Kec. Cihideung, Kota Tasikmalaya, Jawa Barat 46126 <br>
                        <b>Email : smkgalunggung@gmail.com</b> 
                    </em>
                </center>
            </td>
            <td>
                <table width="100%" class="info-table" style="border-collapse: collapse; margin-bottom:100px; margin-left: auto; margin-right:20px; margin-top:15px;">
                    <tr>
                        <td style="border: 0.5px solid; padding: 8px;">SEMESTER</td>
                        <td style="border: 0.5px solid; padding: 8px;"><?=$semester = $_POST['semester'] ?></td>
                    </tr>
                    <tr>
                        <td style="border: 0.5px solid; padding: 8px;">TAHUN AJARAN</td>
                        <td style="border: 0.5px solid; padding: 8px;"><?= $info_thajaran['tahun_ajaran']; ?></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <hr style="height:1px;border: 1px solid;">

    <!-- Tabel rekap absensi guru -->
    <table width="100%" border="1" cellpadding="2" style="border-collapse: collapse;">
        <!-- Isi tabel rekap absensi guru -->
        <tr>
            <td rowspan="2" bgcolor="#EFEBE9" align="center">NO</td>
            <td rowspan="2" bgcolor="#EFEBE9">NAMA GURU</td>
            <td colspan="<?= $tglTerakhir; ?>" style="padding: 8px;">BULAN : <b style="text-transform: uppercase;"><?php echo namaBulan(date('m', strtotime($bulan))); ?> <?= date('Y', strtotime($bulan)); ?></b></td>
            <td colspan="6" align="center" bgcolor="#EFEBE9">JUMLAH</td>
        </tr>
        <tr>
            <?php 
            for ($i = 1; $i <= $tglTerakhir; $i++) {
                echo "<td bgcolor='#EFEBE9' align='center'>".$i."</td>";
            }
            ?> 
            <td bgcolor="#00FF4C" align="center">H</td>
            <td bgcolor="#E2FF07" align="center">S</td>
            <td bgcolor="#00A2FF" align="center">I</td>
            <td bgcolor="#FF0000" align="center">A</td>
            <td bgcolor="#D000FF" align="center">T</td>
            <td bgcolor="#959595" align="center">B</td>
        </tr>
        <?php 
        $no = 1;
        foreach ($guru as $s) {
            $warna = ($no % 2 == 1) ? "#ffffff" : "#f0f0f0";
            $ds = $s; // Menyesuaikan variabel untuk menyamakan dengan sebelumnya
            
            // Inisialisasi jumlah absensi untuk setiap staf
            $hadir = 0;
            $sakit = 0;
            $izin = 0;
            $alpha = 0;
            $telat = 0;
            $bolos = 0;
            
            // Hitung jumlah absensi untuk setiap staf
            for ($i = 1; $i <= $tglTerakhir; $i++) {
                $ket = mysqli_query($con, "SELECT * FROM tb_absensi_guru
                WHERE DAY(tanggal)='$i' AND id_guru='$ds[id_guru]' AND MONTH(tanggal)='".date('m', strtotime($bulan))."' AND id_semester = $id_semester AND id_thajaran IN (SELECT id_thajaran FROM tb_thajaran WHERE status=1)");
                $h = mysqli_fetch_assoc($ket);
                
                    if ($h['status'] == 'Hadir') {
                        $hadir++;
                    } elseif ($h['status'] == 'Sakit') {
                        $sakit++;    
                    } elseif ($h['status'] == 'Izin') {
                        $izin++;
                    } elseif ($h['status'] == 'Alpha') {
                        $alpha++;
                    } elseif ($h['status'] == 'Telat') {
                        $telat++;
                    } elseif ($h['status'] == 'Bolos') {
                        $bolos++;
                    }
                }
                // Tampilkan baris tabel untuk setiap guru
                ?>
                <tr bgcolor="<?= $warna; ?>">
                    <td align="center"><?= $no++; ?></td>
                    <td><?= $ds['nama_guru']; ?></td>
                    <?php 
                    // Tampilkan absensi untuk setiap staf
                    for ($i = 1; $i <= $tglTerakhir; $i++) {
                        $ket = mysqli_query($con, "SELECT * FROM tb_absensi_guru
                        WHERE DAY(tanggal)='$i' AND id_guru='$ds[id_guru]' AND MONTH(tanggal)='".date('m', strtotime($bulan))."' AND id_semester = $id_semester AND id_thajaran IN (SELECT id_thajaran FROM tb_thajaran WHERE status=1)");
                        $h = mysqli_fetch_assoc($ket);
    
                        if ($h) {
                            if ($h['status'] == 'Hadir') {
                                echo "<td align='center' bgcolor='#00FF4C'>H</td>";                
                            } elseif ($h['status'] == 'Izin') {
                                echo "<td align='center' bgcolor='#00A2FF'>I</td>";
                            } elseif ($h['status'] == 'Sakit') {
                                echo "<td align='center' bgcolor='#E2FF07'>S</td>";
                            } elseif ($h['status'] == 'Alpha') {
                                echo "<td align='center' bgcolor='#FF0000'>A</td>";
                            } elseif ($h['status'] == 'Telat') {
                                echo "<td align='center' bgcolor='#D000FF'>T</td>";
                            } elseif ($h['status'] == 'Bolos') {
                                echo "<td align='center' bgcolor='#959595'>B</td>";
                            }
                        } else {
                            // Jika tidak ada data absensi, tampilkan sel kosong
                            echo "<td align='center' bgcolor='white'></td>";
                        }
                    }
                    ?>
                    <!-- Tampilkan jumlah absensi untuk setiap staf -->
                    <td align="center" style="font-weight: bold;"><?= $hadir ?></td>
                    <td align="center" style="font-weight: bold;"><?= $sakit ?></td>
                    <td align="center" style="font-weight: bold;"><?= $izin ?></td>
                    <td align="center" style="font-weight: bold;"><?= $alpha ?></td>
                    <td align="center" style="font-weight: bold;"><?= $telat ?></td>
                    <td align="center" style="font-weight: bold;"><?= $bolos ?></td>
                </tr>
                <?php 
            } // akhir loop foreach
            ?>
        </table>
    
        <div class="flex-container">
        <div class="left-align">
            <table class="table-keterangan">
                <p style="margin-left:3px; line-height: 1.0;">Keterangan:</p>
                <tr style="margin-top:5px;">
                    <td>H</td>
                    <td>=</td>
                    <td>Hadir</td>
                </tr>
                <tr>
                    <td>S</td>
                    <td>=</td>
                    <td>Sakit</td>
                </tr>
                <tr>
                    <td>I</td>
                    <td>=</td>
                    <td>Izin</td>
                </tr>
                <tr>
                    <td>A</td>
                    <td>=</td>
                    <td>Alpa</td>
                </tr>
                <tr>
                    <td>T</td>
                    <td>=</td>
                    <td>Telat</td>
                </tr>
                <tr>
                    <td>B</td>
                    <td>=</td>
                    <td>Bolos</td>
                </tr>
            </table>
        </div>
        <div class="right-align">
            <p class="signature-container">
                Tasikmalaya, <?php echo date('d-F-Y'); ?>
            </p>
            <?php
            // Query untuk mengambil data dari tabel tb_kepsek
            $sql = "SELECT nama_kepsek, nip FROM tb_kepsek";
            // Eksekusi query
            $result = $con->query($sql);
            // Periksa jika hasil query tidak kosong
            if ($result->num_rows > 0) {
                // Ambil data (hanya mengambil baris pertama, asumsi hanya satu kepala sekolah)
                $row = $result->fetch_assoc();
                $nama_kepsek = $row['nama_kepsek'];
                $nip = $row['nip'];
            } else {
                echo "Tidak ada data kepala sekolah yang ditemukan";
            }
            ?>
            <!-- Tampilkan informasi kepala sekolah -->
            <div class="signature-container">
                <p>
                    <?= $nama_kepsek ?>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <hr style="border-top: 1px solid #000;">
                    NIP. <?= $nip ?><br>
                </p>
            </div>
        </div>
    </div>

    <!-- Script untuk melakukan pencetakan otomatis -->
    <script>
        window.print();
    </script>

    <!-- Tambahkan script Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
