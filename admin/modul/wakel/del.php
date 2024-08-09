<?php 
$id = isset($_GET['id']) ? $_GET['id'] : null;
if ($id) {
    $check = mysqli_query($con, "SELECT * FROM tb_walikelas WHERE id_walikelas=$id");
    if (mysqli_num_rows($check) > 0) {
        $del = mysqli_query($con, "DELETE FROM tb_walikelas WHERE id_walikelas=$id");
        if ($del) {
            echo " <script>
            alert('Data telah dihapus !');
            window.location='?page=walas&act=';
            </script>";    
        } else {
            echo " <script>
            alert('Gagal menghapus data!');
            </script>";
            echo "Error: " . mysqli_error($con);
        }
    } else {
        echo " <script>
        alert('Data tidak ditemukan!');
        </script>";
    }
} else {
    echo " <script>
    alert('ID tidak valid!');
    </script>";
}
?>
