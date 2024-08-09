<?php 

// Pastikan parameter id diteruskan
if (!isset($_GET['id'])) {
    // Jika tidak ada id, mungkin tindakan selanjutnya adalah menampilkan pesan kesalahan atau mengarahkan ke halaman lain.
    exit("ID tidak ditemukan.");
}

// Sanitasi ID
$id = mysqli_real_escape_string($con, $_GET['id']);

// Ambil data staf yang akan diedit
$edit = mysqli_query($con, "SELECT * FROM tb_staff WHERE id_staff='$id'");
$d = mysqli_fetch_assoc($edit);

?>

<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title">Staff</h4>
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
                <a href="#">Data Staff</a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#">Edit Staff</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <h3 class="h4">Form Edit Staff</h3>
                </div>
                <div class="card-body">
				<form action="?page=staff&act=proses" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= htmlspecialchars($d['id_staff']) ?>">
    <div class="form-group">
        <label>Nama Staff</label>
        <input name="nama" type="text" class="form-control" value="<?= htmlspecialchars($d['nama_staff']) ?>">                                
    </div>
    <div class="form-group">
        <label>Email</label>
        <input name="email" type="text" class="form-control" value="<?= htmlspecialchars($d['email']) ?>">
    </div>
    <div class="form-group">
        <p>
            <img src="../assets/img/user/<?= htmlspecialchars($d['foto']); ?>" class="img-fluid rounded-circle kotak" style="height: 65px; width: 65px;">
        </p>
        <label>Foto</label>
        <input type="file" name="foto">
    </div>
    <div class="form-group">
        <button name="editStaff" type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Update</button>
        <a href="javascript:history.back()" class="btn btn-warning"><i class="fa fa-chevron-left"></i> Batal</a>
    </div>
</form>

                </div>
            </div>
        </div>
    </div>
</div>
