<?php
@session_start();
include '../config/db.php';

if (!isset($_SESSION['siswa'])) {
    ?>
    <script>
        alert('Maaf ! Anda Belum Login !!');
        window.location='../user.php';
    </script>
    <?php
    exit; // Hentikan eksekusi jika belum login
}

$id_login = @$_SESSION['siswa'];
$sql = mysqli_query($con, "SELECT * FROM tb_siswa
	INNER JOIN tb_mkelas ON tb_siswa.id_mkelas=tb_mkelas.id_mkelas
 WHERE tb_siswa.id_siswa = '$id_login'") or die(mysqli_error($con));
$data = mysqli_fetch_array($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Siswa | Aplikasi Presensi</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="icon" href="../assets/img/icon.ico" type="image/x-icon"/>

    <!-- Fonts and icons -->
    <script src="../assets/js/plugin/webfont/webfont.min.js"></script>
    <script>
        WebFont.load({
            google: {"families":["Lato:300,400,700,900"]},
            custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['../assets/css/fonts.min.css']},
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/atlantis.min.css">

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="../assets/css/demo.css">
</head>
<body>
    <div class="wrapper">
        <div class="main-header">
            <!-- Logo Header -->
            <div class="logo-header" data-background-color="blue">
                
                <a href="index.php" class="logo">
                    <b class="text-white">SMK GALUNGGUNG</b>
                </a>
                <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon">
                        <i class="icon-menu"></i>
                    </span>
                </button>
                <button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
                <div class="nav-toggle">
                    <button class="btn btn-toggle toggle-sidebar">
                        <i class="icon-menu"></i>
                    </button>
                </div>
            </div>
            <!-- End Logo Header -->

            <!-- Navbar Header -->
            <nav class="navbar navbar-header navbar-expand-lg" data-background-color="blue2">
                
                <div class="container-fluid">
                    <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
                        <li class="nav-item dropdown hidden-caret">
                            <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
                                <div class="avatar-sm">
                                    <img src="../assets/img/user/<?=$data['foto'] ?>" alt="..." class="avatar-img rounded-circle">
                                </div>
                            </a>
                            <ul class="dropdown-menu dropdown-user animated fadeIn">
                                <div class="dropdown-user-scroll scrollbar-outer">
                                    <li>
                                        <div class="user-box">
                                            <div class="avatar-lg"><img src="../assets/img/user/<?=$data['foto'] ?>" alt="image profile" class="avatar-img rounded"></div>
                                            <div class="u-text">
                                                <h1><?=$data['nama_siswa'] ?></h1>
                                                <p class="text-muted"><?=$data['nis'] ?></p>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="?page=change">Ganti Password</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="logout.php">Logout</a>
                                    </li>
                                </div>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
            <!-- End Navbar -->
        </div>

        <!-- Sidebar -->
        <div class="sidebar sidebar-style-2">            
            <div class="sidebar-wrapper scrollbar scrollbar-inner">
                <div class="sidebar-content">
                    <div class="user">
                        <div class="avatar-sm float-left mr-2">
                            <img src="../assets/img/user/<?=$data['foto'] ?>" alt="..." class="avatar-img rounded-circle">
                        </div>
                        <div class="info">
                            <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                                <span style="font-size:11px">
                                    <?=$data['nama_siswa'] ?>
                                    <span class="user-level">Kelas <?=$data['nama_kelas'] ?></span>
                                    <span class="caret"></span>
                                </span>
                            </a>
                            <div class="clearfix"></div>

                            <div class="collapse in" id="collapseExample">
                                <ul class="nav">
                                    <li>
                                        <a href="?page=change">
                                            <span class="link-collapse">Ganti Password</span>
                                        </a>
                                    </li>
                                    
                                </ul>
                            </div>
                        </div>
                    </div>
                    <ul class="nav nav-primary">
                        <li class="nav-item active">
                            <a href="index.php" class="collapsed">
                                <i class="fas fa-home"></i>
                                <p>Dashboard</p>
                            </a>                            
                        </li>
                        <li class="nav-section">
                            <span class="sidebar-mini-icon">
                                <i class="fa fa-ellipsis-h"></i>
                            </span>
                            <h4 class="text-section">Main Utama</h4>
                        </li>

                        <li class="nav-item">
                            <a href="?page=kehadiran">
                                <i class="fas fa-clipboard-list"></i>
                                <p>Presensi</p>
                            </a>
                        
                        </li>
    
                        <li class="nav-item active mt-3">
                            <a href="logout.php" class="collapsed">
                                <i class="fas fa-arrow-alt-circle-left"></i>
                                <p>Logout</p>
                            </a>                            
                        </li>
    
                    </ul>
                </div>
            </div>
        </div>
        <!-- End Sidebar -->

        <div class="main-panel">
            <div class="content">

                <!-- Halaman dinamis -->
                <?php 
                $page = @$_GET['page'];
                $act = @$_GET['act'];

                if ($page=='change') {
                    if ($act=='') {
                        ?>
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Ganti Password</h5>
                                <form action="?page=change&act=process" method="POST">
                                    <div class="form-group">
                                        <label>Password Lama</label>
                                        <input type="password" class="form-control" name="pass_lama" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Password Baru</label>
                                        <div class="input-group" id="show_hide_password">
                                            <input type="password" class="form-control" name="pass_baru" id="pass_baru" required>
                                            <div class="input-group-append">
                                                <span class="input-group-text">
                                                    <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Konfirmasi Password Baru</label>
                                        <div class="input-group" id="show_hide_password_confirm">
                                            <input type="password" class="form-control" name="pass_baru_confirm" id="pass_baru_confirm" required>
                                            <div class="input-group-append">
                                                <span class="input-group-text">
                                                    <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                </form>
                            </div>
                        </div>
                        <?php
                    } elseif ($act=='process') {
                        // Proses ganti password disini
                        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                            $pass_lama = $_POST['pass_lama'];
                            $pass_baru = $_POST['pass_baru'];
                            $pass_baru_confirm = $_POST['pass_baru_confirm'];

                            // Validasi password lama dengan database
                            $pass_lama_hashed = sha1($pass_lama); // Hash password lama dengan SHA1

                            $stmt = $con->prepare("SELECT * FROM tb_siswa WHERE id_siswa=? AND password=?");
                            $stmt->bind_param("ss", $id_login, $pass_lama_hashed);
                            $stmt->execute();
                            $result = $stmt->get_result();

                            if ($result->num_rows == 1) {
                                // Password lama cocok, lanjutkan dengan memperbarui password baru
                                if ($pass_baru == $pass_baru_confirm) {
                                    $pass_baru_hashed = sha1($pass_baru); // Hash password baru dengan SHA1

                                    $stmt_update = $con->prepare("UPDATE tb_siswa SET password=? WHERE id_siswa=?");
                                    $stmt_update->bind_param("ss", $pass_baru_hashed, $id_login);
                                    if ($stmt_update->execute()) {
                                        echo '<div class="alert alert-success">Password berhasil diubah.</div>';
                                    } else {
                                        echo '<div class="alert alert-danger">Terjadi kesalahan saat mengubah password.</div>';
                                    }
                                } else {
                                    echo '<div class="alert alert-danger">Password baru dan konfirmasi password tidak cocok.</div>';
                                }
                            } else {
                                echo '<div class="alert alert-danger">Password lama salah.</div>';
                            }

                            $stmt->close();
                            if (isset($stmt_update)) {
                                $stmt_update->close();
                            }
                        }
                    }
                } elseif ($page=='kehadiran') {
                    if ($act=='') {
                        include 'modul/absen/kehadiran.php';
                    }
                } else {
                    include 'modul/home.php';
                }
                ?>
                <!-- end -->
                
            </div>
            <footer class="footer">
                <div class="container">
                    <div class="copyright ml-auto">
                        &copy; <?php echo date('Y');?> Absensi Siswa SMK Galunggung (<a href="index.php">Cep Akil Fikraattausi </a> | 2024)
                    </div>                
                </div>
            </footer>
        </div>
    </div>
    <!--   Core JS Files   -->
    <script src="../assets/js/core/jquery.3.2.1.min.js"></script>
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>

    <!-- jQuery UI -->
    <script src="../assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
    <script src="../assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>

    <!-- jQuery Scrollbar -->
    <script src="../assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

    <!-- Atlantis JS -->
    <script src="../assets/js/atlantis.min.js"></script>

    <!-- Atlantis DEMO methods, don't include it in your project! -->
    <script src="../assets/js/setting-demo.js"></script>

    <!-- Show hide password -->
    <script>
        $(document).ready(function() {
            $("#show_hide_password a").on('click', function(event) {
                event.preventDefault();
                if ($('#show_hide_password input').attr("type") == "text") {
                    $('#show_hide_password input').attr('type', 'password');
                    $('#show_hide_password i').addClass("fa-eye-slash");
                    $('#show_hide_password i').removeClass("fa-eye");
                } else if ($('#show_hide_password input').attr("type") == "password") {
                    $('#show_hide_password input').attr('type', 'text');
                    $('#show_hide_password i').removeClass("fa-eye-slash");
                    $('#show_hide_password i').addClass("fa-eye");
                }
            });

            $("#show_hide_password_confirm a").on('click', function(event) {
                event.preventDefault();
                if ($('#show_hide_password_confirm input').attr("type") == "text") {
                    $('#show_hide_password_confirm input').attr('type', 'password');
                    $('#show_hide_password_confirm i').addClass("fa-eye-slash");
                    $('#show_hide_password_confirm i').removeClass("fa-eye");
                } else if ($('#show_hide_password_confirm input').attr("type") == "password") {
                    $('#show_hide_password_confirm input').attr('type', 'text');
                    $('#show_hide_password_confirm i').removeClass("fa-eye-slash");
                    $('#show_hide_password_confirm i').addClass("fa-eye");
                }
            });
        });
    </script>
</body>
</html>
