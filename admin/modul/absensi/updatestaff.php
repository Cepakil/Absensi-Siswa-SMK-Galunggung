<?php
// Koneksi ke database
$con = mysqli_connect("localhost", "root", "", "db_imas");

// Cek koneksi
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

// Mendefinisikan tanggal absensi (misalnya tanggal hari ini)
$tgl_absensi = date('Y-m-d');

// Mendapatkan data semua staff dari tabel staff
$staff_result = mysqli_query($con, "SELECT id_staff, nama_staff FROM tb_staff");

$staff= array();
while ($row = mysqli_fetch_assoc($staff_result)) {
    $staff[] = $row;
}

// Proses form jika ada pengiriman
if (isset($_POST['edit_absensi_staff'])) {
    $id_staff = $_POST['id_staff'];
    $status_absensi = $_POST['status_absensi'];

    foreach ($id_staff as $index => $id) {
        $status = $status_absensi[$index];
        $query = "UPDATE tb_absensi_staff SET status='$status' WHERE id_staff='$id' AND tanggal='$tgl_absensi'";
        mysqli_query($con, $query);
    }

    // Mengarahkan ke halaman absensi staff setelah memproses form
    echo "<script>window.location.href='?page=absen&act=absenstaff';</script>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Absensi Staff</title>
    <!-- Tambahkan CSS yang diperlukan di sini -->
</head>
<body>
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">EDIT ABSENSI STAFF</h4>
            <ul class="breadcrumbs">
                <li class="nav-home">
                    <a href="#">
                        <i class="flaticon-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Staff</a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Edit Absensi</a>
                </li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="" method="post">
                            <div class="card-title fw-mediumbold">EDIT ABSENSI</div>
                            <div class="card-list">
                                       <div class="item-list">
                                       <?php
                                if (!empty($staff)) {
                                    foreach ($staff as $s) {
                                        $id_staff = $s['id_staff'];
                                        // Mendapatkan status absensi staff dari database
                                        $query_absensi = mysqli_query($con, "SELECT status FROM tb_absensi_staff WHERE id_staff = '$id_staff' AND tanggal = '$tgl_absensi'");
                                        $data_absensi = mysqli_fetch_assoc($query_absensi);
                                         $status_absensi = isset($data_absensi['status']) ? $data_absensi['status'] : '';
                                ?>
                                         <div class="info-user">
                                            <div class="username">
                                                    <b class="text-success" style="font-size: 1.3em;"><?= $s['nama_staff'] ?></b>
                                              </div>
                                                <div class="status mt-0">
                                                    <div class="form-check" style="margin-left: 15px;">
                                                        <input type="hidden" name="id_staff[]" value="<?= $s['id_staff'] ?>">
                                                        <select name="status_absensi[]" class="form-control">
                                                            <option value="Hadir" <?= ($status_absensi == 'Hadir') ? 'selected' : '' ?>>Hadir</option>
                                                            <option value="Izin" <?= ($status_absensi == 'Izin') ? 'selected' : '' ?>>Izin</option>
                                                            <option value="Sakit" <?= ($status_absensi == 'Sakit') ? 'selected' : '' ?>>Sakit</option>
                                                            <option value="Alpha" <?= ($status_absensi == 'Alpha') ? 'selected' : '' ?>>Alpha</option>
                                                            <option value="Telat" <?= ($status_absensi == 'Telat') ? 'selected' : '' ?>>Telat</option>
                                                            <option value="Bolos" <?= ($status_absensi == 'Bolos') ? 'selected' : '' ?>>Bolos</option>
                                                        </select>
                                                    </div>
                                                </div>
                                        </div>
                                <?php 
                                    }
                                } else {
                                    echo "<p>Tidak ada data staff tersedia.</p>";
                                }
                                ?>
                            </div>
                            <div class="form-group">
                                <button type="submit" name="edit_absensi_staff" class="btn btn-success">Simpan Perubahan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
