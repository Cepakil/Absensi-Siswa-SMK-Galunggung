<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Rekap dan Cetak PDF</title>
    <!-- Tambahkan link CSS Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .page-header {
            margin-top: 50px;
        }
        .form-container {
            max-width: 400px;
            margin: auto;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="page-header text-center">
        <h4 class="page-title display-5 font-weight-bold" style="font-size: 2.2rem;">Rekap Absensi Staff</h4>
    </div>

    <div class="row justify-content-center mt-5">
        <div class="col-md-8 col-lg-6 form-container">
            <form action="modul/rekapabsen/rekap_bulan_staff.php" method="post" class="text-center">
                <div class="form-group">
                    <label for="bulan">Pilih Bulan:</label>
                    <input type="month" id="bulan" name="bulan" class="form-control" value="<?php echo date('Y-m'); ?>" required>
                </div>
                <div class="form-group">
                    <label for="semester">Pilih Semester:</label>
                    <select id="semester" name="semester" class="form-control" required>
                        <?php
                        // Menghubungkan ke database
                        $con = mysqli_connect("localhost", "root", "", "db_imas");

                        // Mendapatkan data semester
                        $result = mysqli_query($con, "SELECT * FROM tb_semester");
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                // Menandai semester aktif
                                $selected = ($row['status'] == 1) ? "selected" : "";
                                echo "<option value=\"{$row['semester']}\" $selected>{$row['semester']}</option>";
                            }
                        } else {
                            echo "<option disabled selected>Tidak ada semester yang tersedia</option>";
                        }
                        ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Rekap dan Cetak PDF</button>
            </form>
        </div>
    </div>
</div>

<!-- Tambahkan script Bootstrap -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
