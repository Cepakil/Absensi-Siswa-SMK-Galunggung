<?php 

if (isset($_POST['saveStaff'])) {
    $nama = mysqli_real_escape_string($con, $_POST['nama']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $pass = sha1($nama);

    $sumber = @$_FILES['foto']['tmp_name'];
    $target = '../assets/img/user/';
    $nama_gambar = @$_FILES['foto']['name'];
    $pindah = move_uploaded_file($sumber, $target.$nama_gambar);

    if ($pindah) {
        $save = mysqli_query($con, "INSERT INTO tb_staff (nama_staff, email, password, foto, status) VALUES ('$nama', '$email', '$pass', '$nama_gambar', 'Y')");
        if ($save) {
            echo "
            <script type='text/javascript'>
            setTimeout(function () { 
                swal('($nama)', 'Berhasil disimpan', {
                    icon: 'success',
                    buttons: { confirm: { className: 'btn btn-success' } },
                });    
            }, 10);  
            window.setTimeout(function(){ 
                window.location.replace('?page=staff');
            }, 3000);   
            </script>";
        } else {
            echo "Error: " . mysqli_error($con);
        }
    } else {
        echo "Gagal mengupload gambar.";
    }

} elseif (isset($_POST['editStaff'])) {
    // Pastikan ID dan nama di-set
    if (isset($_POST['id']) && isset($_POST['nama']) && isset($_POST['email'])) {
        $id = mysqli_real_escape_string($con, $_POST['id']);
        $nama = mysqli_real_escape_string($con, $_POST['nama']);
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $pass = sha1($email);

        $gambar = @$_FILES['foto']['name'];
        if (!empty($gambar)) {
            if (move_uploaded_file($_FILES['foto']['tmp_name'], "../assets/img/user/$gambar")) {
                $ganti = mysqli_query($con, "UPDATE tb_staff SET foto='$gambar' WHERE id_staff='$id'");
                if (!$ganti) {
                    echo "Error mengganti foto: " . mysqli_error($con);
                    exit; // Keluar dari skrip jika terjadi kesalahan
                }
            } else {
                echo "Gagal mengupload gambar.";
                exit; // Keluar dari skrip jika gambar gagal diupload
            }
        }

        // Perbarui nama dan email staff
        $editStaff = mysqli_query($con, "UPDATE tb_staff SET nama_staff='$nama', email='$email' WHERE id_staff='$id'");
        if ($editStaff) {
            echo "
            <script type='text/javascript'>
            setTimeout(function () { 
                swal('($nama)', 'Berhasil diubah', {
                    icon: 'success',
                    buttons: { confirm: { className: 'btn btn-success' } },
                });    
            }, 10);  
            window.setTimeout(function(){ 
                window.location.replace('?page=staff');
            }, 3000);   
            </script>";
        } else {
            echo "Error mengedit staff: " . mysqli_error($con);
        }
    } else {
        echo "Data tidak lengkap.";
    }
}
?>
