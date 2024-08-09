<?php
// Pastikan file koneksi.php sudah disertakan di sini
$path = $_SERVER['DOCUMENT_ROOT'] . '/absensiswa/config/db.php';
require_once($path);

// Menghubungkan ke database
$con = mysqli_connect("localhost", "root", "", "db_imas");

// Periksa jika tombol "saveSiswa" ditekan
if (isset($_POST['saveSiswa'])) {
    // Buat password menggunakan SHA1 dari $_POST['nis']
    $pass = sha1($_POST['nis']);

    // Ambil sumber dan nama file dari foto yang diupload
    $sumber = @$_FILES['foto']['tmp_name'];
    $target = '../assets/img/user/';
    $nama_gambar = @$_FILES['foto']['name'];

    // Pindahkan file foto ke folder target
    $pindah = move_uploaded_file($sumber, $target . $nama_gambar);
    $nama_orangtua = $_POST['nama_orangtua'];

    // Jika pindah berhasil
    if ($pindah) {
        // Simpan data siswa ke dalam tabel tb_siswa
        $saveSiswa = mysqli_query($con, "INSERT INTO tb_siswa (nis, nama_siswa, tempat_lahir, tgl_lahir, jk, alamat, password, foto, status, th_angkatan, id_mkelas, nama_orangtua) 
                                         VALUES ('" . $_POST['nis'] . "', 
                                                 '" . $_POST['nama'] . "', 
                                                 '" . $_POST['tempat'] . "', 
                                                 '" . $_POST['tgl'] . "', 
                                                 '" . $_POST['jk'] . "', 
                                                 '" . $_POST['alamat'] . "', 
                                                 '" . sha1($_POST['nis']) . "', 
                                                 '$nama_gambar', 
                                                 '1', 
                                                 '" . $_POST['th_masuk'] . "', 
                                                 '" . $_POST['kelas'] . "', 
                                                 '" . $_POST['nama_orangtua'] . "')");

        // Jika penyimpanan data siswa berhasil
        if ($saveSiswa) {
            // Ambil ID siswa yang baru saja disimpan
            $id_siswa = mysqli_insert_id($con);

            // Simpan data orang tua ke dalam tabel tb_orangtua
            $saveOrangTua = mysqli_query($con, "INSERT INTO tb_orangtua (id_siswa, nama_siswa, nama_orangtua) 
                                                 VALUES ('$id_siswa', '" . $_POST['nama'] . "', '" . $_POST['nama_orangtua'] . "')");

            // Jika penyimpanan data orang tua berhasil
            if ($saveOrangTua) {
                // Tampilkan pesan sukses dengan sweetalert
                echo "
                <script type='text/javascript'>
                setTimeout(function () { 
                    swal('" . $_POST['nama'] . "', 'Berhasil disimpan', {
                        icon : 'success',
                        buttons: { confirm: { className: 'btn btn-success' } }
                    });    
                }, 10);  
                window.setTimeout(function() { 
                    window.location.replace('?page=siswa');
                }, 3000);   
                </script>";
            } else {
                // Jika gagal menyimpan data orang tua
                echo "
                <script type='text/javascript'>
                setTimeout(function () { 
                    swal('" . $_POST['nama'] . "', 'Gagal menyimpan data orang tua', {
                        icon : 'error',
                        buttons: { confirm: { className: 'btn btn-danger' } }
                    });    
                }, 10);  
                </script>";
            }
        } else {
            // Jika gagal menyimpan data siswa
            echo "
            <script type='text/javascript'>
            setTimeout(function () { 
                swal('" . $_POST['nama'] . "', 'Gagal menyimpan data siswa', {
                    icon : 'error',
                    buttons: { confirm: { className: 'btn btn-danger' } }
                });    
            }, 10);  
            </script>";
        }
    }
} elseif (isset($_POST['editSiswa'])) {
    // Ambil nama file gambar jika ada yang diupload
    $gambar = @$_FILES['foto']['name'];

    // Jika ada gambar yang diupload, pindahkan ke folder target
    if (!empty($gambar)) {
        move_uploaded_file($_FILES['foto']['tmp_name'], "../assets/img/user/$gambar");
        mysqli_query($con, "UPDATE tb_siswa SET foto='$gambar' WHERE id_siswa='" . $_POST['id'] . "'");
    }

    // Ambil nama_siswa dan nama_orangtua dari database sebelum di-update
    $queryOldData = mysqli_query($con, "SELECT nama_siswa, nama_orangtua FROM tb_orangtua WHERE id_siswa='" . $_POST['id'] . "'");
    $rowOldData = mysqli_fetch_assoc($queryOldData);

    // Update data siswa di tabel tb_siswa
    $editSiswa = mysqli_query($con, "UPDATE tb_siswa SET 
                                     nama_siswa='" . $_POST['nama'] . "', 
                                     tempat_lahir='" . $_POST['tempat'] . "', 
                                     tgl_lahir='" . $_POST['tgl'] . "', 
                                     jk='" . $_POST['jk'] . "', 
                                     alamat='" . $_POST['alamat'] . "', 
                                     id_mkelas='" . $_POST['kelas'] . "', 
                                     th_angkatan='" . $_POST['th_masuk'] . "', 
                                     nama_orangtua='" . $_POST['nama_orangtua'] . "' 
                                     WHERE id_siswa='" . $_POST['id'] . "'");

    // Jika update data siswa berhasil
    if ($editSiswa) {
        // Update data orang tua di tabel tb_orangtua hanya jika nama_orangtua telah berubah
        if ($_POST['nama_orangtua'] !== $rowOldData['nama_orangtua']) {
            $editOrangTua = mysqli_query($con, "UPDATE tb_orangtua SET nama_orangtua='" . $_POST['nama_orangtua'] . "' WHERE id_siswa='" . $_POST['id'] . "'");

            // Jika update data orang tua berhasil
            if ($editOrangTua) {
                // Tampilkan pesan sukses dengan sweetalert
                echo "
                <script type='text/javascript'>
                setTimeout(function () { 
                    swal('" . $_POST['nama'] . "', 'Berhasil diubah', {
                        icon : 'success',
                        buttons: { confirm: { className: 'btn btn-success' } }
                    });    
                }, 10);  
                window.setTimeout(function() { 
                    window.location.replace('?page=siswa');
                }, 3000);   
                </script>";
            } else {
                // Jika gagal update data orang tua
                echo "
                <script type='text/javascript'>
                setTimeout(function () { 
                    swal('" . $_POST['nama'] . "', 'Gagal mengubah data orang tua', {
                        icon : 'error',
                        buttons: { confirm: { className: 'btn btn-danger' } }
                    });    
                }, 10);  
                </script>";
            }
        } else {
            // Jika tidak ada perubahan pada nama_orangtua, langsung redirect
            echo "
            <script type='text/javascript'>
            setTimeout(function () { 
                swal('" . $_POST['nama'] . "', 'Berhasil diubah', {
                    icon : 'success',
                    buttons: { confirm: { className: 'btn btn-success' } }
                });    
            }, 10);  
            window.setTimeout(function() { 
                window.location.replace('?page=siswa');
            }, 3000);   
            </script>";
        }
    } else {
        // Jika gagal update data siswa
        echo "
        <script type='text/javascript'>
        setTimeout(function () { 
            swal('" . $_POST['nama'] . "', 'Gagal mengubah data siswa', {
                icon : 'error',
                buttons: { confirm: { className: 'btn btn-danger' } }
            });    
        }, 10);  
        </script>";
    }
}
?>
