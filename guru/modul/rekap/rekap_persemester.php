<?php
$time = time();
// Skrip berikut ini adalah skrip yang bertugas untuk meng-export data tadi ke excell
// header("Content-type: application/vnd-ms-excel");
// header("Content-Disposition: attachment; filename=DAFTAR-HADIR-$time.xls");
?>
<?php 
include '../../../config/db.php';
?>
<style>
	td.rotate{
		transform:
		translate(1px,1px)
		rotate(270deg);
		padding: 0px;
		word-spacing:none;
		white-space: nowrap;
	}
</style>
<?php 
// tampilkan data mengajar
$kelasMengajar = mysqli_query($con,"SELECT * FROM tb_mengajar 
	INNER JOIN tb_guru ON tb_mengajar.id_guru=tb_guru.id_guru
	INNER JOIN tb_master_mapel ON tb_mengajar.id_mapel=tb_master_mapel.id_mapel
	INNER JOIN tb_mkelas ON tb_mengajar.id_mkelas=tb_mkelas.id_mkelas
	INNER JOIN tb_semester ON tb_mengajar.id_semester=tb_semester.id_semester
	INNER JOIN tb_thajaran ON tb_mengajar.id_thajaran=tb_thajaran.id_thajaran
WHERE tb_mengajar.id_mengajar='$_GET[pelajaran]' AND tb_mengajar.id_mkelas='$_GET[kelas]'  AND tb_thajaran.status=1 AND tb_semester.status=1  ");

foreach ($kelasMengajar as $d) 

// tampilkan data absen
$qry = mysqli_query($con,"SELECT * FROM _logabsensi 
INNER JOIN tb_siswa ON _logabsensi.id_siswa=tb_siswa.id_siswa
INNER JOIN tb_mengajar ON _logabsensi.id_mengajar=tb_mengajar.id_mengajar
INNER JOIN tb_mkelas ON tb_mengajar.id_mkelas=tb_mkelas.id_mkelas
INNER JOIN tb_semester ON tb_mengajar.id_semester=tb_semester.id_semester
INNER JOIN tb_thajaran ON tb_mengajar.id_thajaran=tb_thajaran.id_thajaran
WHERE tb_mengajar.id_mengajar='$_GET[pelajaran]' AND tb_mengajar.id_mkelas='$_GET[kelas]'  AND tb_thajaran.status=1 AND tb_semester.status=1
	 GROUP BY _logabsensi.id_siswa  ORDER BY _logabsensi.id_siswa ASC  ");

// tampilkan data walikelas
$walikelas = mysqli_query($con,"SELECT * FROM tb_walikelas INNER JOIN tb_guru ON tb_walikelas.id_guru=tb_guru.id_guru WHERE tb_walikelas.id_mkelas='$_GET[kelas]' ");
foreach ($walikelas as $walas) 

$tglTerakhir = 25;
?>
<style>
 	body{
 		font-family: arial;
 	}
</style>
<table width="100%">
 	<tr>
 		<td>
 			<img src="../../../assets/img/mts.png" width="130">
 		</td>
 		<td>
 			<center>
 				<h1>
 					ABSENSI SISWA <br>
 					<small> SMK GALUNGGUNG KOTA TASIKMALAYA</small>
 				</h1>
 				<hr>
				 <em>
                        Jl. KH. Lukmanul Hakim No.17, Tugujaya, Kec. Cihideung,
						<br> Kota Tasikmalaya, Jawa Barat 46126 <br>
                        <b>Email : smkgalunggung@gmail.com</b> 
                    </em>
 			</center>
 		</td>
 		<td>
 			<table width="100%">
  <tr>
  <td colspan="2">
    <p style="border: 1px solid; padding: 3px; font-size: 10px;">
	<em>
      <b>  KELAS <?= strtoupper($d['nama_kelas']) ?> </b>
    </p> 
	</em>
</td>
<td>
    <p style="border: 1px solid; padding: 3px; font-size: 10px; text-align:center;">
	<em>
     <b> Semester <?= $d['semester'] ?> | <?= $d['tahun_ajaran'] ?> </b> 
    </p>
	</em>
</td>


<td rowspan="5">
		<ul style="font-size: 10px; padding-left: 20px; margin: top 12px;">
    		<li>H= Hadir</li>
    		<li>S = Sakit</li>
    		<li>I = Izin</li>
    		<li>T = Telat</li>
    		<li>A = Absen</li>
    		<li>B = Bolos</li>
    	</ul>
</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Nama Guru </td>
    <td>:</td>
    <td><?=$d['nama_guru'] ?></td>
  </tr>
  <tr>
    <td>Bidang Studi </td>
    <td>:</td>
    <td><?=$d['mapel'] ?></td>
  </tr>
  <tr>
    <td>Wali Kelas </td>
    <td>:</td>
    <td><?=$walas['nama_guru'] ?></td>
  </tr>
</table>
 		</td>
 	</tr>
</table>

<hr style="height: 3px;border: 1px solid;">

<table width="100%" border="1" cellpadding="2" style="border-collapse: collapse; font-size:12px">
  <tr>
    <td rowspan="2" bgcolor="#EFEBE9" align="center">NO</td>
    <td rowspan="2" bgcolor="#EFEBE9">NAMA SISWA</td>
    <td rowspan="2" bgcolor="#EFEBE9" align="center">L/P</td>
    <td colspan="<?=$tglTerakhir;?>" style="padding: 8px;"><b>Pertemuan Ke -</b></td>
    <td colspan="6" align="center" bgcolor="#EFEBE9">JUMLAH</td>
  </tr>
  <tr>
	<?php 
	for ($i = 1; $i <=$tglTerakhir ; $i++) {
	echo "<td bgcolor='#EFEBE9' align='center'>".$i."</td>";
	}
	?> 
	<td bgcolor="#2196F3" align="center">H</td>
	<td bgcolor="#FFC107" align="center">S</td>
	<td bgcolor="#4CAF50" align="center">I</td>
	<td bgcolor="#D50000" align="center">T</td>
	<td bgcolor="#76FF03" align="center">A</td>
	<td bgcolor="#9C27B0" align="center">B</td>
  </tr>
  	<?php 
			$no=1;
			foreach ($qry as $ds) {
				 $warna = ($no % 2 == 1) ? "#ffffff" : "#f0f0f0";
				?>
			<tr bgcolor="<?=$warna; ?>">
			    <td align="center"><?=$no++; ?></td>
			    <td style="font-size: 12px;"><?=$ds['nama_siswa'];?></td>
			    <td align="center"><?=$ds['jk'];?></td>
				<?php 
				for ($i = 1; $i <=$tglTerakhir ; $i++) {
				?>
				<td align="center" bgcolor="white">
					<?php 
					$ket = mysqli_query($con,"SELECT * FROM _logabsensi
					INNER JOIN tb_mengajar ON _logabsensi.id_mengajar=tb_mengajar.id_mengajar
					INNER JOIN tb_semester ON tb_mengajar.id_semester=tb_semester.id_semester
					INNER JOIN tb_thajaran ON tb_mengajar.id_thajaran=tb_thajaran.id_thajaran
					WHERE _logabsensi.pertemuan_ke='$i' AND _logabsensi.id_siswa='$ds[id_siswa]' AND _logabsensi.id_mengajar='$_GET[pelajaran]' AND tb_mengajar.id_mkelas='$_GET[kelas]'  AND tb_thajaran.status=1 AND tb_semester.status=1 GROUP BY pertemuan_ke ");
					foreach ($ket as $h)
					
					if ($h['ket']=='H') {
						echo "<b style='color:#2196F3;'>H</b>";				
					}elseif ($h['ket']=='I') {
						echo "<b style='color:#4CAF50;'>I</b>";
					}elseif ($h['ket']=='S') {
						echo "<b style='color:#FFC107;'>S</b>";
					}elseif($h['ket']=='A'){
						echo "<b style='color:#D50000;'>A</b>";
					}elseif ($h['ket']=='T') {
						echo "<b style='color:#76FF03;'>T</b>";
					}
					else{
						echo "<b style='color:#9C27B0;'>B</b>";
					}
					?>
				</td>
				<?php
				}
				?>
				<td align="center" style="font-weight: bold;">
				<?php 
					$hadir = mysqli_fetch_array(mysqli_query($con,"SELECT COUNT(ket) AS hadir FROM _logabsensi
					INNER JOIN tb_mengajar ON _logabsensi.id_mengajar=tb_mengajar.id_mengajar
					INNER JOIN tb_semester ON tb_mengajar.id_semester=tb_semester.id_semester
					INNER JOIN tb_thajaran ON tb_mengajar.id_thajaran=tb_thajaran.id_thajaran
					WHERE _logabsensi.id_siswa='$ds[id_siswa]' and _logabsensi.ket='H' and _logabsensi.id_mengajar='$_GET[pelajaran]' AND tb_mengajar.id_mkelas='$_GET[kelas]'  AND tb_thajaran.status=1 AND tb_semester.status=1 "));
					echo $hadir['hadir'];
					?>
				</td>
				<td align="center" style="font-weight: bold;">
				<?php 
					$sakit = mysqli_fetch_array(mysqli_query($con,"SELECT COUNT(ket) AS sakit FROM _logabsensi
					INNER JOIN tb_mengajar ON _logabsensi.id_mengajar=tb_mengajar.id_mengajar
					INNER JOIN tb_semester ON tb_mengajar.id_semester=tb_semester.id_semester
					INNER JOIN tb_thajaran ON tb_mengajar.id_thajaran=tb_thajaran.id_thajaran
					WHERE _logabsensi.id_siswa='$ds[id_siswa]' and _logabsensi.ket='S' and _logabsensi.id_mengajar='$_GET[pelajaran]' AND tb_mengajar.id_mkelas='$_GET[kelas]'  AND tb_thajaran.status=1 AND tb_semester.status=1 "));
					echo $sakit['sakit'];
					?>
				</td>
				<td align="center" style="font-weight: bold;">
					<?php 
					$izin = mysqli_fetch_array(mysqli_query($con,"SELECT COUNT(ket) AS izin FROM _logabsensi
					INNER JOIN tb_mengajar ON _logabsensi.id_mengajar=tb_mengajar.id_mengajar
					INNER JOIN tb_semester ON tb_mengajar.id_semester=tb_semester.id_semester
					INNER JOIN tb_thajaran ON tb_mengajar.id_thajaran=tb_thajaran.id_thajaran
					WHERE _logabsensi.id_siswa='$ds[id_siswa]' and _logabsensi.ket='I' and _logabsensi.id_mengajar='$_GET[pelajaran]' AND tb_mengajar.id_mkelas='$_GET[kelas]'  AND tb_thajaran.status=1 AND tb_semester.status=1 "));
					echo $izin['izin'];
					?>
				</td>
				<td align="center" style="font-weight: bold;">
					<?php 
					$tlambat = mysqli_fetch_array(mysqli_query($con,"SELECT COUNT(ket) AS terlambat FROM _logabsensi
					INNER JOIN tb_mengajar ON _logabsensi.id_mengajar=tb_mengajar.id_mengajar
					INNER JOIN tb_semester ON tb_mengajar.id_semester=tb_semester.id_semester
					INNER JOIN tb_thajaran ON tb_mengajar.id_thajaran=tb_thajaran.id_thajaran
					WHERE _logabsensi.id_siswa='$ds[id_siswa]' and _logabsensi.ket='T' and _logabsensi.id_mengajar='$_GET[pelajaran]' AND tb_mengajar.id_mkelas='$_GET[kelas]'  AND tb_thajaran.status=1 AND tb_semester.status=1 "));
					echo $tlambat['terlambat'];
					?>
				</td>
				<td align="center" style="font-weight: bold;">
					<?php 
					$alfa = mysqli_fetch_array(mysqli_query($con,"SELECT COUNT(ket) AS alfa FROM _logabsensi
					INNER JOIN tb_mengajar ON _logabsensi.id_mengajar=tb_mengajar.id_mengajar
					INNER JOIN tb_semester ON tb_mengajar.id_semester=tb_semester.id_semester
					INNER JOIN tb_thajaran ON tb_mengajar.id_thajaran=tb_thajaran.id_thajaran
					WHERE _logabsensi.id_siswa='$ds[id_siswa]' and _logabsensi.ket='A' and _logabsensi.id_mengajar='$_GET[pelajaran]' AND tb_mengajar.id_mkelas='$_GET[kelas]'  AND tb_thajaran.status=1 AND tb_semester.status=1 "));
					echo $alfa['alfa'];
					?>
				</td> 
				<td align="center" style="font-weight: bold;">
					<?php 
					$bolos = mysqli_fetch_array(mysqli_query($con,"SELECT COUNT(ket) AS bolos FROM _logabsensi
					INNER JOIN tb_mengajar ON _logabsensi.id_mengajar=tb_mengajar.id_mengajar
					INNER JOIN tb_semester ON tb_mengajar.id_semester=tb_semester.id_semester
					INNER JOIN tb_thajaran ON tb_mengajar.id_thajaran=tb_thajaran.id_thajaran
					WHERE _logabsensi.id_siswa='$ds[id_siswa]' and _logabsensi.ket='B' and _logabsensi.id_mengajar='$_GET[pelajaran]' AND tb_mengajar.id_mkelas='$_GET[kelas]'  AND tb_thajaran.status=1 AND tb_semester.status=1 "));
					echo $bolos['bolos'];
					?>
				</td>  
			</tr>
			<?php } ?>
			<tr>
				<td colspan="3" align="right">Tanggal Pertemuan</td>
				<?php 
				for ($i = 1; $i <=$tglTerakhir ; $i++) { ?> 
					<td align="center">
						<em style="font: 11px;">
							<?php 
							$ket = mysqli_query($con,"SELECT * FROM _logabsensi
							INNER JOIN tb_mengajar ON _logabsensi.id_mengajar=tb_mengajar.id_mengajar
							INNER JOIN tb_semester ON tb_mengajar.id_semester=tb_semester.id_semester
							INNER JOIN tb_thajaran ON tb_mengajar.id_thajaran=tb_thajaran.id_thajaran
							WHERE _logabsensi.pertemuan_ke='$i' AND _logabsensi.id_siswa='$ds[id_siswa]' AND _logabsensi.id_mengajar='$_GET[pelajaran]' AND tb_mengajar.id_mkelas='$_GET[kelas]'  AND tb_thajaran.status=1 AND tb_semester.status=1 GROUP BY pertemuan_ke ");
							foreach ($ket as $h)
								$tgl= date('d m Y',strtotime($h['tgl_absen']));
								echo $tgl;
							?>
						</em>
					</td>
				<?php } ?>
			</tr>
		</table>
		<p></p>
		<table width="100%">
			<tr>
				<td align="right">
					<p>
						Tasikmalaya, <?php echo date('d-F-Y'); ?>
					</p>
					<p>
						Kepala Sekolah
						<br>
						<br>
						<br>
						<br>
						<br>
						<br>
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
						  <?= $nama_kepsek ?> <br>
						-----------------------------<br>
						NIP. <?= $nip ?>
					</p>
				</td>
			</tr>
		</table>
		<script>
			window.print();
		</script>

