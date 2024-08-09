<?php 
$id_guru = $_GET['id'];

// Hapus referensi di tb_absensi_guru
$del_absensi = mysqli_query($con, "DELETE FROM tb_absensi_guru WHERE id_guru=$id_guru");

if ($del_absensi) {
    // Setelah berhasil menghapus referensi, hapus data di tb_guru
    $del_guru = mysqli_query($con, "DELETE FROM tb_guru WHERE id_guru=$id_guru");
    
    if ($del_guru) {
        echo "<script>
        alert('Data telah dihapus!');
        window.location='?page=guru';
        </script>";   
    } else {
        echo "Error: " . mysqli_error($con);
    }
} else {
    echo "Error: " . mysqli_error($con);
}
?>
