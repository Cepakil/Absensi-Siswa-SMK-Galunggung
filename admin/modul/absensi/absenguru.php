<?php
// Tampilkan data guru
$guru = mysqli_query($con, "SELECT * FROM tb_guru");

if (mysqli_num_rows($guru) == 0) {
    echo "Data guru tidak ditemukan.";
    exit;
}
?>

<!-- Tampilkan Informasi Guru -->
<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title">ABSENSI GURU</h4>
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
                <a href="#">Guru</a>
            </li>
        </ul>
    </div>

    <div class="row">
        <!-- Form Absensi Guru -->
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="" method="post">
                        <div class="card-title fw-bold">ABSENSI HARI INI</div>

                        <!-- Tanggal Absensi -->
                        <div class="form-group">
                            <label>Tanggal Absensi:</label>
                            <input type="date" name="tgl_absensi" class="form-control" value="<?= date('Y-m-d') ?>" required>
                        </div>

                        <!-- Tabel Absensi -->
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>NAMA GURU</th>
                                        <th>STATUS KEHADIRAN</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($guru as $g) {
                                        // Mendapatkan status absensi guru dari database
                                        $id_guru = $g['id_guru'];
                                        $tgl_absensi = date('Y-m-d'); // Sesuaikan tanggal absensi dengan kebutuhan
                                        $query_absensi = mysqli_query($con, "SELECT status FROM tb_absensi_guru WHERE id_guru = '$id_guru' AND tanggal = '$tgl_absensi'");
                                        $data_absensi = mysqli_fetch_assoc($query_absensi);
                                        $status_absensi = isset($data_absensi['status']) ? $data_absensi['status'] : ''; // Mengambil status absensi jika sudah diinput
                                    ?>
                                        <tr>
                                            <td> <b><?= $g['nama_guru'] ?></b></td>
                                            <td>
                                                <input type="hidden" name="id_guru[]" value="<?= $g['id_guru'] ?>">
                                                <select name="kehadiran[<?= $g['id_guru'] ?>]" class="form-control">
                                                    <option value="">-- Pilih Status --</option>
                                                    <option value="Hadir" <?= ($status_absensi == 'Hadir') ? 'selected' : '' ?>>Hadir</option>
                                                    <option value="Izin" <?= ($status_absensi == 'Izin') ? 'selected' : '' ?>>Izin</option>
                                                    <option value="Sakit" <?= ($status_absensi == 'Sakit') ? 'selected' : '' ?>>Sakit</option>
                                                    <option value="Alpha" <?= ($status_absensi == 'Alpha') ? 'selected' : '' ?>>Alpa</option>
                                                    <option value="Telat" <?= ($status_absensi == 'Telat') ? 'selected' : '' ?>>Telat</option>
                                                    <option value="Bolos" <?= ($status_absensi == 'Bolos') ? 'selected' : '' ?>>Bolos</option>
                                                </select>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>

                        <!-- Tombol Submit -->
                        <div class="form-group">
                            <button type="submit" name="absen_guru" class="btn btn-primary">Absen</button>
                            <!-- Tambahkan tombol Edit Absen -->
                            <a href="?page=absen&act=update" class="btn btn-success">Edit Absen</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
// Proses Absensi Guru
if (isset($_POST['absen_guru'])) {
    $tgl_absensi = $_POST['tgl_absensi'];
    $kehadiran = $_POST['kehadiran']; // Array dari input dropdown

    foreach ($kehadiran as $id_guru => $status) {
        // Ambil nilai id_semester dari tabel tb_semester
        $semester_query = mysqli_query($con, "SELECT id_semester FROM tb_semester WHERE tb_semester.status=1"); // tambahkan kondisi yang sesuai
        $semester_row = mysqli_fetch_assoc($semester_query);
        $id_semester = $semester_row['id_semester'];
    
        // Ambil nilai id_thajaran dari tabel tb_thajaran
        $thajaran_query = mysqli_query($con, "SELECT id_thajaran FROM tb_thajaran WHERE tb_thajaran.status=1 "); // tambahkan kondisi yang sesuai
        $thajaran_row = mysqli_fetch_assoc($thajaran_query);
        $id_thajaran = $thajaran_row['id_thajaran'];

        // Simpan data absensi ke database dengan nilai id_semester dan id_thajaran yang telah diambil
        $insert_query = "INSERT INTO tb_absensi_guru (id_guru, status, tanggal, id_semester, id_thajaran) 
                         VALUES ('$id_guru', '$status', '$tgl_absensi', '$id_semester', '$id_thajaran')";
        if (mysqli_query($con, $insert_query)) {
            echo "Absensi berhasil disimpan untuk guru dengan ID " . $id_guru . ".<br>";
        } else {
            echo "Terjadi kesalahan saat menyimpan absensi untuk guru dengan ID " . $id_guru . ": " . mysqli_error($con) . "<br>";
        }
    }
    
    // Setelah proses selesai, arahkan kembali ke halaman ini atau halaman lain
    echo "<script>window.location.href='?page=absen&act=absenguru';</script>";
}
?>
