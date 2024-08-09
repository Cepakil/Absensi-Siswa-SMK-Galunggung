<?php 
// tampilkan data mengajar
$kelasMengajar = mysqli_query($con, "SELECT * FROM tb_mengajar 
INNER JOIN tb_master_mapel ON tb_mengajar.id_mapel = tb_master_mapel.id_mapel
INNER JOIN tb_mkelas ON tb_mengajar.id_mkelas = tb_mkelas.id_mkelas
INNER JOIN tb_semester ON tb_mengajar.id_semester = tb_semester.id_semester
INNER JOIN tb_thajaran ON tb_mengajar.id_thajaran = tb_thajaran.id_thajaran
WHERE tb_mengajar.id_guru = '$data[id_guru]' AND tb_mengajar.id_mengajar = '$_GET[pelajaran]' AND tb_thajaran.status = 1");

foreach ($kelasMengajar as $d) 
?>

<div class="page-inner">
    <div class="page-header">
        <ul class="breadcrumbs" style="font-weight: bold;">
            <li class="nav-home">
                <a href="#">
                    <i class="flaticon-home"></i>
                </a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#">KELAS (<?=strtoupper($d['nama_kelas']) ?>)</a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#"><?=strtoupper($d['mapel']) ?></a>
            </li>
        </ul>
    </div>

    <div class="row">
        <?php 
        // dapatkan pertemuan terakhir di tb izin
        $last_pertemuan = mysqli_query($con, "SELECT * FROM _logabsensi WHERE id_mengajar = '$_GET[pelajaran]' GROUP BY pertemuan_ke ORDER BY pertemuan_ke DESC LIMIT 1");
        $cekPertemuan = mysqli_num_rows($last_pertemuan);
        $jml = mysqli_fetch_array($last_pertemuan);

        if ($cekPertemuan > 0) {
            $pertemuan = $jml['pertemuan_ke'] + 1;
        } else {
            $pertemuan = 1;
        }
        ?>
<div class="card col-md-8 col-sm-12">
           <div class="card-body">
                <form action="" method="post">
                    <div class="d-flex justify-content-between mb-3">
                        <div>
                            <span class="badge badge-primary" style="padding: 7px; font-size: 12px;"><b>DAFTAR HADIR SISWA</b></span>
                        </div>
                        <div>
                            <span class="badge badge-primary" style="padding: 7px; font-size: 12px; margin: right 10px;"><b>PERTEMUAN KE : <?=$pertemuan; ?></b></span>
                        </div>
                    </div>

                    <div class="card-list">
                    <div class="table-responsive">
                    <table class="table table-bordered" style="width: 100%;">

                            <thead>
                            <tr>
                                     <td colspan="3">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="mr-3" style="flex: 1;">
                                                <input type="date" name="tgl" class="form-control" value="<?=date('Y-m-d') ?>" style="background-color: #218DFF; color: #FFFFFF; width: 100%;">
                                            </div>
                                            <input type="hidden" name="pertemuan" class="form-control" value="<?=$pertemuan; ?>">
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <th style="width: 10px;">NO</th>
                                    <th>NAMA SISWA</th>
                                    <th>KETERANGAN</th>
                                </tr>
                              
                            </thead>
                            <tbody>
                                <?php 
                                // tampilkan data siswa berdasarkan kelas yang dipilih
                                $siswa = mysqli_query($con, "SELECT * FROM tb_siswa WHERE id_mkelas = '$d[id_mkelas]' ORDER BY id_siswa ASC");
                                $jumlahSiswa = mysqli_num_rows($siswa);
                                foreach ($siswa as $i => $s) {
                                    // cek apakah siswa sudah absen hari ini
                                    $tgl_hari_ini = date('Y-m-d');
                                    $siswa_telah_absen_hari_ini = mysqli_query($con, "SELECT * FROM _logabsensi WHERE id_siswa = '$s[id_siswa]' AND tgl_absen = '$tgl_hari_ini' AND id_mengajar = '$_GET[pelajaran]'");
                                    $ket_absen = '';
                                    if (mysqli_num_rows($siswa_telah_absen_hari_ini) > 0) {
                                        $data_absen = mysqli_fetch_array($siswa_telah_absen_hari_ini);
                                        $ket_absen = $data_absen['ket'];
                                    }
                                ?>
                                <tr>
                                    <td><?= $i + 1; ?></td>
                                    <td><?=$s['nama_siswa'] ?>
                                        <input type="hidden" name="id_siswa-<?=$i;?>" value="<?=$s['id_siswa'] ?>">
                                        <input type="hidden" name="pelajaran" value="<?=$_GET['pelajaran'] ?>">
                                    </td>
                                    <td>
                                        <select name="ket-<?=$i;?>" class="form-control" style="width: 100%;">
                                            <option value="H" <?=($ket_absen == 'H' ? 'selected' : '')?>>Hadir</option>
                                            <option value="I" <?=($ket_absen == 'I' ? 'selected' : '')?>>Izin</option>
                                            <option value="S" <?=($ket_absen == 'S' ? 'selected' : '')?>>Sakit</option>
                                            <option value="T" <?=($ket_absen == 'T' ? 'selected' : '')?>>Terlambat</option>
                                            <option value="A" <?=($ket_absen == 'A' ? 'selected' : '')?>>Alpa</option>
                                            <option value="B" <?=($ket_absen == 'B' ? 'selected' : '')?>>Bolos</option>
                                        </select>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    </div>
                    <center>
                        <button type="submit" name="absen" class="btn btn-success">
                            <i class="fa fa-check"></i> Selesai
                        </button>

                        <a href="?page=absen&act=update&pelajaran=<?=$_GET['pelajaran']; ?>" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Update Absen
                        </a>
                    </center>
                </form>

                <?php 
                if (isset($_POST['absen'])) {
                    $total = $jumlahSiswa - 1;
                    $today = $_POST['tgl'];
                    $pertemuan = $_POST['pertemuan'];

                    for ($i = 0; $i <= $total; $i++) {
                        $id_siswa = $_POST['id_siswa-' . $i];
                        $pelajaran = $_POST['pelajaran'];
                        $ket = $_POST['ket-' . $i];

                        $cekAbsenHariIni = mysqli_num_rows(mysqli_query($con, "SELECT * FROM _logabsensi WHERE tgl_absen = '$today' AND id_mengajar = '$pelajaran' AND id_siswa = '$id_siswa'"));

                        if ($cekAbsenHariIni > 0) {
                            echo "
                            <script type='text/javascript'>
                            setTimeout(function () { 
                                swal('Sorry!', 'Absen Hari ini sudah dilakukan', {
                                    icon: 'error',
                                    buttons: { confirm: { className: 'btn btn-danger' } },
                                });    
                            }, 10);  
                            window.setTimeout(function(){ 
                                window.location.replace('?page=absen&pelajaran=$_GET[pelajaran]');
                            }, 3000);   
                            </script>";
                        } else {
                            $insert = mysqli_query($con, "INSERT INTO _logabsensi VALUES (NULL, '$pelajaran', '$id_siswa', '$today', '$ket', '$pertemuan')");
                            if ($insert) {
                                echo "
                                <script type='text/javascript'>
                                setTimeout(function () { 
                                    swal('Berhasil', 'Absen hari ini telah tersimpan!', {
                                        icon: 'success',
                                        buttons: { confirm: { className: 'btn btn-success' } },
                                    });    
                                }, 10);  
                                window.setTimeout(function(){ 
                                    window.location.replace('?page=absen&pelajaran=$_GET[pelajaran]');
                                }, 3000);   
                                </script>";
                            }
                        }
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>

