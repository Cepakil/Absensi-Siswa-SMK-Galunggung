<?php 
    // Logika Pemrosesan Form
    if (isset($_POST['editJadwal'])) {
        $id_mengajar = $_POST['id_mengajar'];
        $id_guru = $_POST['id_guru'];
        $id_mapel = $_POST['id_mapel'];
        $id_mkelas = $_POST['id_mkelas'];
        $id_semester = $_POST['id_semester'];
        $id_thajaran = $_POST['id_thajaran'];
        $hari = $_POST['hari'];
        $jam_mengajar = $_POST['jam_mengajar'];
        $jamke = $_POST['jamke'];

        // Query untuk mengupdate data
        $updateQuery = "UPDATE tb_mengajar SET 
                        id_guru='$id_guru', 
                        id_mapel='$id_mapel', 
                        id_mkelas='$id_mkelas', 
                        id_semester='$id_semester', 
                        id_thajaran='$id_thajaran',
                        hari='$hari',
                        jam_mengajar='$jam_mengajar',
                        jamke='$jamke'
                        WHERE id_mengajar='$id_mengajar'";

        // Eksekusi query
        $save = mysqli_query($con, $updateQuery);

        // Periksa apakah pembaruan berhasil
        if ($save) {
          echo "
          <script type='text/javascript'>
          setTimeout(function () { 
  
          swal('($_POST[editJadwal]) ', 'Berhasil disimpan', {
          icon : 'success',
          buttons: {        			
          confirm: {
          className : 'btn btn-success'
          }
          },
          });    
          },10);  
          window.setTimeout(function(){ 
          window.location.replace('?page=jadwal');
          } ,3000);   
          </script>";
        } else {
            echo "<script>
                    alert('Data gagal diubah!');
                  </script>";
        }
    }
?>
<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title">Jadwal</h4>
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
                <a href="#">Jadwal Mengajar</a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#">Daftar Jadwal Mengajar</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <a href="?page=jadwal&act=add" class="btn btn-primary btn-sm text-white"><i class="fa fa-plus"></i> Tambah</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basic-datatables" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Guru</th>
                                    <th>Mata Pelajaran</th>
                                    <th>Kelas</th>
                                    <th>TP/Semester</th>
                                    <th>Hari</th>
                                    <th>Waktu</th>
                                    <th>Jam Ke</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $no=1;
                                $mapel = mysqli_query($con, "SELECT tb_mengajar.id_mengajar, tb_guru.nama_guru, tb_master_mapel.mapel, tb_mkelas.nama_kelas, 
                                                            tb_semester.semester, tb_thajaran.tahun_ajaran, tb_mengajar.hari, tb_mengajar.jam_mengajar, tb_mengajar.jamke
                                                        FROM tb_mengajar 
                                                        INNER JOIN tb_guru ON tb_mengajar.id_guru=tb_guru.id_guru
                                                        INNER JOIN tb_master_mapel ON tb_mengajar.id_mapel=tb_master_mapel.id_mapel
                                                        INNER JOIN tb_mkelas ON tb_mengajar.id_mkelas=tb_mkelas.id_mkelas
                                                        INNER JOIN tb_semester ON tb_mengajar.id_semester=tb_semester.id_semester
                                                        INNER JOIN tb_thajaran ON tb_mengajar.id_thajaran=tb_thajaran.id_thajaran");

                                foreach ($mapel as $d) {
                                ?>

                                <tr>
                                    <td><?=$no++; ?></td>
                                    <td><?=$d['nama_guru'] ?></td>
                                    <td><?=$d['mapel'] ?></td>
                                    <td><?=$d['nama_kelas'] ?></td>
                                    <td><?=$d['tahun_ajaran'] ?>/<?=$d['semester'] ?></td>
                                    <td><?=$d['hari'] ?></td>
                                    <td><?=$d['jam_mengajar'] ?></td>
                                    <td><?=$d['jamke'] ?></td>
                                    <td>
                                        <a href="?page=jadwal&act=cancel&id=<?=$d['id_mengajar'];?>" class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Batal</a>
                                        <a href="" class="btn btn-info btn-sm" data-toggle="modal" data-target="#edit<?=$d['id_mengajar'] ?>"><i class="far fa-edit"></i> Edit</a>

                                        <!-- Modal -->
                                        <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="edit<?=$d['id_mengajar'] ?>" class="modal fade" style="display: none;">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 id="exampleModalLabel" class="modal-title">Edit Jadwal Mengajar</h4>
                                                        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="" method="post" class="form-horizontal">
                                                            <input type="hidden" name="id_mengajar" value="<?=$d['id_mengajar'] ?>">
                                                            <div class="form-group">
                                                                <label>Nama Guru</label>
                                                                <select name="id_guru" class="form-control">
                                                                    <?php 
                                                                    $guru = mysqli_query($con,"SELECT * FROM tb_guru");
                                                                    while ($row = mysqli_fetch_array($guru)) {
                                                                        $selected = ($row['id_guru'] == $d['id_guru']) ? "selected" : "";
                                                                        echo "<option value='{$row['id_guru']}' $selected>{$row['nama_guru']}</option>";
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Mata Pelajaran</label>
                                                                <select name="id_mapel" class="form-control">
                                                                    <?php 
                                                                    $mapel = mysqli_query($con, "SELECT * FROM tb_master_mapel ORDER BY id_mapel ASC");
                                                                    while ($row = mysqli_fetch_array($mapel)) {
                                                                        $selected = ($row['id_mapel'] == $d['id_mapel']) ? "selected" : "";
                                                                        echo "<option value='{$row['id_mapel']}' $selected>{$row['kode_pelajaran']} - {$row['mapel']}</option>";
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Kelas</label>
                                                                <select name="id_mkelas" class="form-control">
                                                                    <?php 
                                                                    $kelas = mysqli_query($con, "SELECT * FROM tb_mkelas");
                                                                    while ($row = mysqli_fetch_array($kelas)) {
                                                                        $selected = ($row['id_mkelas'] == $d['id_mkelas']) ? "selected" : "";
                                                                        echo "<option value='{$row['id_mkelas']}' $selected>{$row['nama_kelas']}</option>";
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Semester</label>
                                                                <select name="id_semester" class="form-control">
                                                                    <?php 
                                                                    $semester = mysqli_query($con, "SELECT * FROM tb_semester");
                                                                    while ($row = mysqli_fetch_array($semester)) {
                                                                        $selected = ($row['id_semester'] == $d['id_semester']) ? "selected" : "";
                                                                        echo "<option value='{$row['id_semester']}' $selected>{$row['semester']}</option>";
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Tahun Ajaran</label>
                                                                <select name="id_thajaran" class="form-control">
                                                                    <?php 
                                                                    $thajaran = mysqli_query($con, "SELECT * FROM tb_thajaran");
                                                                    while ($row = mysqli_fetch_array($thajaran)) {
                                                                        $selected = ($row['id_thajaran'] == $d['id_thajaran']) ? "selected" : "";
                                                                        echo "<option value='{$row['id_thajaran']}' $selected>{$row['tahun_ajaran']}</option>";
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Hari</label>
                                                                <input type="text" name="hari" class="form-control" value="<?=$d['hari'] ?>">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Waktu</label>
                                                                <input type="text" name="jam_mengajar" class="form-control" value="<?=$d['jam_mengajar'] ?>">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Jam Ke</label>
                                                                <input type="text" name="jamke" class="form-control" value="<?=$d['jamke'] ?>">
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                                <button type="submit" name="editJadwal" class="btn btn-primary">Simpan</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
