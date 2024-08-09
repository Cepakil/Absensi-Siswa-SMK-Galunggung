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
        <h4 class="page-title display-5 font-weight-bold" style="font-size: 2.2rem;">Rekap Absensi Guru Per Semester</h4>
    </div>

    <div class="row justify-content-center mt-5">
        <div class="col-md-8 col-lg-6 form-container">
            <form action="modul/rekapabsen/rekap_semester_guru.php" method="post" class="text-center">
                <div class="form-group">
                    <label for="semester">Pilih Semester:</label>
                    <select id="semester" name="semester" class="form-control" required>
                        <option value="ganjil">Semester Ganjil</option>
                        <option value="genap">Semester Genap</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="tahun_ajaran">Pilih Tahun Ajaran:</label>
                    <select id="tahun_ajaran" name="tahun_ajaran" class="form-control" required>
                        <?php
                        // Mendapatkan data tahun ajaran
                        $con = mysqli_connect("localhost", "root", "", "db_imas");
                        $result = mysqli_query($con, "SELECT DISTINCT tahun_ajaran FROM tb_thajaran");
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<option value=\"{$row['tahun_ajaran']}\">{$row['tahun_ajaran']}</option>";
                            }
                        } else {
                            echo "<option disabled selected>Tidak ada tahun ajaran yang tersedia</option>";
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
