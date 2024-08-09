<?php
include('config.php'); // Include your database connection

if (isset($_POST['editJadwal'])) {
    $id_mengajar = $_POST['id_mengajar'];
    $id_guru = $_POST['id_guru'];
    $id_mapel = $_POST['id_mapel'];
    $id_mkelas = $_POST['id_mkelas'];
    $id_semester = $_POST['id_semester'];
    $id_thajaran = $_POST['id_thajaran'];

    $updateQuery = "UPDATE tb_mengajar SET 
                    id_guru='$id_guru', 
                    id_mapel='$id_mapel', 
                    id_mkelas='$id_mkelas', 
                    id_semester='$id_semester', 
                    id_thajaran='$id_thajaran' 
                    WHERE id_mengajar='$id_mengajar'";

    if (mysqli_query($con, $updateQuery)) {
        header('Location: data_mengajar.php?page=jadwal'); // Pastikan path ini benar
        exit();
    } else {
        echo "<script>alert('Data gagal diubah!');</script>";
    }
}
?>
