<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title">Wali Kelas</h4>
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
                <a href="#">Wali Kelas</a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#">Daftar Wali Kelas</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <a href="" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i> Tambah</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-sm">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Kelas</th>
                                    <th>Nama Wali Kelas</th>
                                    <th>Kode Guru</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>  
                            <tbody>
                                <?php 
                                $no=1;
                                $kelas = mysqli_query($con,"SELECT tb_walikelas.*, tb_guru.nama_guru, tb_guru.nip, tb_mkelas.nama_kelas 
                                                            FROM tb_walikelas
                                                            INNER JOIN tb_guru ON tb_walikelas.id_guru=tb_guru.id_guru
                                                            INNER JOIN tb_mkelas ON tb_walikelas.id_mkelas=tb_mkelas.id_mkelas
                                                            ORDER BY tb_walikelas.id_mkelas DESC");
                                foreach ($kelas as $k) { ?>
                                    <tr>
                                        <td><?=$no++;?>.</td>
                                        <td><?=$k['nama_kelas'];?></td>
                                        <td><?=$k['nama_guru'];?></td>
                                        <td><?=$k['nip'];?></td>
                                        <td>
                                            <a href="" class="btn btn-info btn-sm" data-toggle="modal" data-target="#edit<?=$k['id_walikelas'] ?>"><i class="far fa-edit"></i> Edit</a>
                                            <a class="btn btn-danger btn-sm" onclick="return confirm('Yakin Hapus Data ??')" href="?page=walas&act=delwakel&id=<?=$k['id_walikelas'] ?>"><i class="fas fa-trash"></i> Del</a>

                                            <!-- Modal Edit -->
                                            <div class="modal fade" id="edit<?=$k['id_walikelas'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Edit Wali Kelas</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="" method="post" class="form-horizontal">
                                                                <input type="hidden" name="id" value="<?=$k['id_walikelas'] ?>">
                                                                <div class="form-group">
                                                                    <label>Nama Guru</label>
                                                                    <select name="wakel" class="form-control">
                                                                        <?php 
                                                                        $wkel = mysqli_query($con,"SELECT * FROM tb_guru");
                                                                        foreach ($wkel as $wk) {
                                                                            $selected = ($wk['id_guru'] == $k['id_guru']) ? 'selected' : '';
                                                                            echo "<option value='{$wk['id_guru']}' $selected>{$wk['nama_guru']}</option>";
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Nama Kelas</label>
                                                                    <select name="kelas" class="form-control">
                                                                        <option value="">Pilih Kelas</option>
                                                                        <?php 
                                                                        $kel = mysqli_query($con,"SELECT * FROM tb_mkelas ORDER BY id_mkelas ASC ");
                                                                        foreach ($kel as $kl) {
                                                                            $selected = ($kl['id_mkelas'] == $k['id_mkelas']) ? 'selected' : '';
                                                                            echo "<option value='{$kl['id_mkelas']}' $selected>{$kl['nama_kelas']}</option>";
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                                <div class="row form-group">
                                                                    <div class="col-lg-12 text-right">
                                                                        <button name="edit" class="btn btn-info" type="submit">Edit</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                            <?php 
                                                            if (isset($_POST['edit'])) {
                                                                $id_walikelas = $_POST['id'];
                                                                $id_guru = $_POST['wakel'];
                                                                $id_mkelas = $_POST['kelas'];

                                                                $update = mysqli_query($con, "UPDATE tb_walikelas SET id_guru='$id_guru', id_mkelas='$id_mkelas' WHERE id_walikelas='$id_walikelas'");
                                                                if ($update) {
                                                                    echo "<script>
                                                                    alert('Data diubah!');
                                                                    window.location='?page=walas';
                                                                    </script>";
                                                                } else {
                                                                    echo "<script>
                                                                    alert('Gagal mengubah data!');
                                                                    </script>";
                                                                }
                                                            }
                                                            ?>
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

<!-- Modal Tambah -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Wali Kelas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" class="form-horizontal">
                    <div class="form-group">
                        <label>Nama Guru</label>
                        <select name="wakel" class="form-control" id="selectGuru">
                            <option value="">Pilih Guru</option>
                            <?php 
                            $wkel = mysqli_query($con,"SELECT * FROM tb_guru");
                            foreach ($wkel as $wk) {
                                echo "<option value='{$wk['id_guru']}' data-nip='{$wk['nip']}'>{$wk['nama_guru']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Nama Kelas</label>
                        <select name="kelas" class="form-control">
                            <option value="">Pilih Kelas</option>
                            <?php 
                            $kel = mysqli_query($con,"SELECT * FROM tb_mkelas ORDER BY id_mkelas ASC ");
                            foreach ($kel as $k) {
                                echo "<option value='{$k['id_mkelas']}'>{$k['nama_kelas']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <input type="hidden" name="nip" id="inputNip" value="">
                    <div class="row form-group">
                        <div class="col-lg-12 text-right">
                            <button name="save" class="btn btn-info" type="submit">Save</button>
                        </div>
                    </div>
                </form>
                <?php
                if (isset($_POST['save'])) {
                    $wakel = $_POST['wakel'];
                    $kelas = $_POST['kelas'];
                    $nip = $_POST['nip'];
                    $password = 'walikelas'; // Ganti dengan password yang sesuai atau mekanisme untuk menghasilkan password
                    $status = 'aktif'; // Ganti dengan status yang sesuai

                    if (!empty($wakel) && !empty($kelas) && !empty($nip)) {
                        $save = mysqli_query($con, "INSERT INTO tb_walikelas (id_guru, id_mkelas, nip, password, status) VALUES('$wakel', '$kelas', '$nip', '$password', '$status')");
                        if ($save) {
                            echo "<script>
                            alert('Data tersimpan!');
                            window.location='?page=walas';
                            </script>";
                        } else {
                            echo "<script>
                            alert('Gagal menyimpan data!');
                            </script>";
                            echo "Error: " . mysqli_error($con);
                        }
                    } else {
                        echo "<script>
                        alert('Harap isi semua kolom!');
                        </script>";
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById("selectGuru").addEventListener('change', function() {
        var selectedOption = this.options[this.selectedIndex];
        var nip = selectedOption.getAttribute('data-nip');
        document.getElementById("inputNip").value = nip;
    });
</script>
