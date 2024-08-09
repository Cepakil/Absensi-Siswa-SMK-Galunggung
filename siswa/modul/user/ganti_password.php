<?php
@session_start();

// Periksa apakah sesi 'siswa' sudah ada atau belum
if (!isset($_SESSION['siswa'])) {
    echo '<script>alert("Maaf ! Anda Belum Login !!");</script>';
    echo '<script>window.location="../user.php";</script>';
    exit; // Hentikan eksekusi skrip jika belum login
}

$id_siswa = $_SESSION['id_siswa'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pass_lama_input = $_POST['pass1'];
    $pass_lama_hashed = sha1($pass_lama_input); // Hash password lama dengan SHA1

    $pass_baru = $_POST['pass2'];
    $konfirmasi_pass = $_POST['pass3'];

    // Cek password lama
    // Cek password lama
$stmt = $con->prepare("SELECT * FROM tb_siswa WHERE id_siswa=? AND password=?");
$stmt->bind_param("ss", $id_siswa, $pass_lama_hashed);
$stmt->execute();
$result = $stmt->get_result();

// Debugging: Tambahkan echo atau var_dump untuk memeriksa nilai
echo "Password lama input: " . $pass_lama_input . "<br>";
echo "Password lama hashed: " . $pass_lama_hashed . "<br>";

if ($result->num_rows == 1) {
    // Password lama cocok, lanjutkan proses ganti password
    // ...
} else {
    echo "Password lama salah.";
}


    if ($result->num_rows == 1) {
        // Password lama cocok, cek kesesuaian password baru dan konfirmasi password
        if ($pass_baru == $konfirmasi_pass) {
            $pass_baru_hashed = sha1($pass_baru); // Hash password baru dengan SHA1

            // Update password baru ke database
            $stmt_update = $con->prepare("UPDATE tb_siswa SET password=? WHERE id_siswa=?");
            $stmt_update->bind_param("ss", $pass_baru_hashed, $id_siswa);
            if ($stmt_update->execute()) {
                echo "Password berhasil diubah.";
            } else {
                echo "Terjadi kesalahan saat mengubah password.";
            }
        } else {
            echo "Password baru dan konfirmasi password tidak cocok.";
        }
    } else {
        echo "Password lama salah."; // Pesan ini akan muncul jika password lama tidak cocok
    }

    // Tutup statement
    $stmt->close();
    if ($stmt_update) {
        $stmt_update->close();
    }
}
?>



<div class="col-md-4 mt-3">
    <div class="card card-profile">
        <div class="card-header" style="background-image: url('../assets/img/bguser.jpg')">
            <div class="profile-picture">
                <div class="avatar avatar-xl">
                    <img src="../assets/img/user/<?=$data['foto'];?>" alt="..." class="avatar-img rounded-circle">
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="user-profile text-center">
                <div class="name"><?=$data['nama_siswa'] ?></div>
                <div class="job"><?=$data['nis'] ?></div>
                <div class="desc">Kelas (<?=$data['nama_kelas'] ?>)</div>

                <form action="" method="POST">
                    <div class="form-group">
                        <input type="password" id="pass1" name="pass1" class="form-control" placeholder="Password Lama" required>
                    </div>
                    <div class="form-group">
                        <input type="password" id="pass2" name="pass2" class="form-control" placeholder="Password Baru" required>
                    </div>
                    <div class="form-group">
                        <input type="password" id="pass3" name="pass3" class="form-control" placeholder="Konfirmasi Password" required>
                    </div>
                    <div class="form-group d-flex align-items-center">
                        <input type="checkbox" id="showPassword" onclick="togglePasswordVisibility()" style="margin-right: 10px;"> 
                        <label for="showPassword" class="m-0">Tampilkan Password</label>
                    </div>
                    <div class="view-profile mt-3">
                        <button type="submit" class="btn btn-secondary btn-block">Ganti Password</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<script>
function togglePasswordVisibility() {
    var pass1 = document.getElementById("pass1");
    var pass2 = document.getElementById("pass2");
    var pass3 = document.getElementById("pass3");
    if (pass1.type === "password") {
        pass1.type = "text";
        pass2.type = "text";
        pass3.type = "text";
    } else {
        pass1.type = "password";
        pass2.type = "password";
        pass3.type = "password";
    }
}
</script>
