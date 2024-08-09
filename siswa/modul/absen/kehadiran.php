<div class="card">
    <div class="card-body">
        <h2 class="card-title"> <b>KEHADIRAN |  <?=$data['nama_siswa'] ?>  </b> </h2>
        <hr>
        <div class="row">
            <?php 
            // tampilkan data absen setiap bulan, berdasarkan tahun ajaran yg aktif
            $qry = mysqli_query($con,"SELECT *, MONTH(tgl_absen) as bulan_absen, tb_master_mapel.mapel FROM _logabsensi
                INNER JOIN tb_mengajar ON _logabsensi.id_mengajar=tb_mengajar.id_mengajar
                INNER JOIN tb_thajaran ON tb_mengajar.id_thajaran=tb_thajaran.id_thajaran
                INNER JOIN tb_semester ON tb_mengajar.id_semester=tb_semester.id_semester
                INNER JOIN tb_master_mapel ON tb_mengajar.id_mapel=tb_master_mapel.id_mapel
                WHERE _logabsensi.id_siswa='$data[id_siswa]' and tb_thajaran.status=1 and tb_semester.status=1
                GROUP BY MONTH(tgl_absen), tb_mengajar.id_mapel
                ORDER BY MONTH(tgl_absen) DESC, tb_master_mapel.mapel ASC
             ");

             foreach ($qry as $absen) {
                $bulan = date('m', strtotime($absen['tgl_absen']));
                $nama_mapel = $absen['mapel'];
                ?>

                <div class="col-xl-12">
                    <div class="card text-left">
                        <div class="card-body">
                            <b class="text-primary" style="text-transform: uppercase; margin-bottom:10px;">BULAN <?=namaBulan($bulan); ?> <?= date('Y', strtotime($absen['tgl_absen'])) ?> | Mata Pelajaran: <?= $nama_mapel; ?></b>
                            <br>
                            <br>
                            <table cellpadding="5" width="100%">
                                <tr>
                                    <td>Hadir</td>
                                    <td>:</td>
                                    <td>
                                        <?php 
                                        $hadir = mysqli_fetch_array(mysqli_query($con,"SELECT COUNT(ket) AS hadir FROM _logabsensi 
                                        WHERE id_siswa='$data[id_siswa]' AND id_mengajar='{$absen['id_mengajar']}' AND ket='H' AND MONTH(tgl_absen)='$bulan' "));
                                        echo $hadir['hadir'];
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Sakit</td>
                                    <td>:</td>
                                    <td>
                                        <?php 
                                        $sakit = mysqli_fetch_array(mysqli_query($con,"SELECT COUNT(ket) AS sakit FROM _logabsensi 
                                        WHERE id_siswa='$data[id_siswa]' AND id_mengajar='{$absen['id_mengajar']}' AND ket='S' AND MONTH(tgl_absen)='$bulan' "));
                                        echo $sakit['sakit'];
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Izin</td>
                                    <td>:</td>
                                    <td>
                                        <?php 
                                        $izin = mysqli_fetch_array(mysqli_query($con,"SELECT COUNT(ket) AS izin FROM _logabsensi 
                                        WHERE id_siswa='$data[id_siswa]' AND id_mengajar='{$absen['id_mengajar']}' AND ket='I' AND MONTH(tgl_absen)='$bulan' "));
                                        echo $izin['izin'];
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Absen</td>
                                    <td>:</td>
                                    <td>
                                        <?php 
                                        $alfa = mysqli_fetch_array(mysqli_query($con,"SELECT COUNT(ket) AS alfa FROM _logabsensi 
                                        WHERE id_siswa='$data[id_siswa]' AND id_mengajar='{$absen['id_mengajar']}' AND ket='A' AND MONTH(tgl_absen)='$bulan' "));
                                        echo $alfa['alfa'];
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Bolos</td>
                                    <td>:</td>
                                    <td>
                                        <?php 
                                        $bolos = mysqli_fetch_array(mysqli_query($con,"SELECT COUNT(ket) AS bolos FROM _logabsensi 
                                        WHERE id_siswa='$data[id_siswa]' AND id_mengajar='{$absen['id_mengajar']}' AND ket='B' AND MONTH(tgl_absen)='$bulan' "));
                                        echo $bolos['bolos'];
                                        ?>
                                    </td>
                                </tr>
								<tr>
                                    <td>Terlambat</td>
                                    <td>:</td>
                                    <td>
                                        <?php 
                                        $telat = mysqli_fetch_array(mysqli_query($con,"SELECT COUNT(ket) AS telat FROM _logabsensi 
                                        WHERE id_siswa='$data[id_siswa]' AND id_mengajar='{$absen['id_mengajar']}' AND ket='T' AND MONTH(tgl_absen)='$bulan' "));
                                        echo $telat['telat'];
                                        ?>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
             <?php } ?>
        </div>
    </div>
</div>

<a href="javascript:history.back()" class="btn btn-default btn-block"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
